<?php namespace App\Weixin;
use App\WeMenu;
use Illuminate\Support\Facades\Log;
use App\WeReplay;
use Illuminate\Support\Facades\Request;

define('token','wunan');
class Wechat
{

    //验证
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->check()){
            echo $echoStr;
            exit;
        }
    }
    function check()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = token;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
    //创建菜单
    function createMenu($menu)
    {
        $access_token = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $result = $this->https_request($url,$menu);
        return $result;
    }
    //删除菜单
    function  deleteMenu()
    {
        $access_token = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$access_token;
        $result = $this->httpGet($url);
        return $result;
    }
    //回复
    function receiveEvent()
    {
        $postStr = file_get_contents('php://input');
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $event = $postObj->Event;
        $keyword = trim($postObj->Content);
        $contentStr = "success";
        $eventKey = trim($postObj->EventKey);
        //回复消息
        if($keyword)
        {
            $weReplay = WeReplay::where('keywords',$keyword)->first();
            if(isset($weReplay))
            {
                $contentStr = $weReplay->content;
                switch($weReplay->type)
                {
                    //文本消息
                    case 1:
                        $resultStr = $this->transmitText($postObj, $contentStr);
                        break;
                    //图片消息
                    case 2:
                        $resultStr = $this->transmitImg($postObj, $contentStr);
                        break;
                    //语音消息
                    case 3:
                        $resultStr = $this->transmitText($postObj, $contentStr);
                        break;
                    //视频消息
                    case 4:
                        $resultStr = $this->transmitText($postObj, $contentStr);
                        break;
                    //音乐消息
                    case 5:
                        $resultStr = $this->transmitText($postObj, $contentStr);
                        break;
                    //图文消息
                    case 6:
                        $resultStr = $this->transmitText($postObj, $contentStr);
                        break;
                    default:
                        $resultStr = $this->transmitText($postObj, $contentStr);

                }
            }
            else
            {
                $contentStr = "你说的是:".$keyword;
                $resultStr = $this->transmitText($postObj, $contentStr);
            }

        }
        else
        {
            //事件
            if ($eventKey != null)
            {
                switch ($event)
                {
                    case "subscribe":
                        $contentStr = "你好，感谢关注,收听录音地址为:" . substr($eventKey, 8);
                        $resultStr = $this->transmitText($postObj, $contentStr);
                        break;
                    case "SCAN":
                        $contentStr = "收听录音地址为:" . $eventKey;
                        $resultStr = $this->transmitText($postObj, $contentStr);
                        break;
                    case "CLICK":  //菜单click事件
                        $article = WeMenu::where('key',$eventKey)->first();
                        $resultStr = $this->transmitArticle($postObj,$article);
                        break;
                    default :
                        $resultStr = $this->transmitText($postObj, $contentStr);
                        break;
                }
            }
            else
            {
                //直接关注公众号
                $contentStr = "你好，感谢关注,输入关键词试试";
                $resultStr = $this->transmitText($postObj, $contentStr);
            }

        }
        echo $resultStr;
    }

    //文本消息XML
    function transmitText($object,$content)
    {
        $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                <FuncFlag>%s</FuncFlag>
                </xml>";
        $resultStr = sprintf($textTpl,$object->FromUserName,$object->ToUserName,time(), $content,0);
        return $resultStr;
    }
    //图片消息XML
    function transmitImg($object,$id)
    {
        $imgTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[image]]></MsgType>
                <Image>
                <MediaId><![CDATA[%s]]></MediaId>
                </Image>
                </xml>";
        $resultStr = sprintf($imgTpl,$object->FromUserName,$object->ToUserName,time(), $id);
        return $resultStr;
    }
    //图文消息
    function transmitArticle($object,$article)
    {
        $articleTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[news]]></MsgType>
                    <ArticleCount>1</ArticleCount>
                    <Articles>
                    <item>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    <PicUrl><![CDATA[%s]]></PicUrl>
                    <Url><![CDATA[%s]]></Url>
                    </item>
                    </Articles>
                    </xml>";
        $resultStr = sprintf($articleTpl,$object->FromUserName,$object->ToUserName,time(),$article->title,$article->description,"http://www.wunan.online/".$article->image,$article->imgUrl);
        return $resultStr;

    }
    function https_request($url,$data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    function getAccessToken()
    {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode($this->get_php_file("access_token.php"));
        if ($data->expire_time < time()) {
            // 如果是企业号用以下URL获取access_token
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx1b1af4475f8ce3b1&secret=8d600e01b4db89670ceae5819d437ec7";
            $res = json_decode($this->httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $this->set_php_file("access_token.php", json_encode($data));
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }
    function get_php_file($filename)
    {
        return trim(substr(file_get_contents($filename), 15));
    }
    function set_php_file($filename, $content)
    {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
    }
    function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }

    function upload($filename,$type)
    {
        $access_token = $this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$access_token&type=$type";  //新增永久素材
        //$url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$access_token&type=voice";   //新增临时素材
        $ch1 = curl_init ($url);
        $real_path = new \CURLFile($filename);
        $fields['media'] = $real_path;
        curl_setopt ( $ch1, CURLOPT_POST, 1 );
        curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt ( $ch1, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec ( $ch1 );
        if(curl_errno($ch1)){
            curl_close ( $ch1 );
            return $result;
        }else {
            curl_close ( $ch1 );
            $result2= json_decode($result,true);
            return $result2['media_id'];
        }
    }
}
