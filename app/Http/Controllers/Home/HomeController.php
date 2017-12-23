<?php

namespace App\Http\Controllers\Home;

use App\Article;
use App\ArticleType;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     *  判断设备
     * @return bool
     */

    public function Mobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        {
            return true;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
        {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT']))
        {
            $clientkeywords = array ('nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'oppo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            {
                return true;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT']))
        {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @param ArticleRepository $articles
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ArticleRepository $articles)
    {
        $signPackage = $this->getSP();
        $articles =$articles->paginate(10);
        $articleTypes = ArticleType::all();
        $device = $this->Mobile();
        if($device)
        {
            return view('mobile.index',['articles' => $articles,'signPackage' => $signPackage,'articleTypes' => $articleTypes]);
        }
        else{
            return view('home.index',['articles' => $articles,'signPackage' => $signPackage]);
        }


    }

    public function details(ArticleRepository $articles,$id)
    {
        $signPackage = $this->getSP();
        $article = $articles->find($id);
        $device = $this->Mobile();
        if($device)
        {
            return view('mobile.articleDetail',['article' => $article,'signPackage' => $signPackage]);
        }
        else
        {

        }
    }

    public function getSP()
    {
        $jssdk = new \App\Weixin\JSSDK('wx1b1af4475f8ce3b1','8d600e01b4db89670ceae5819d437ec7');
        return $signPackage = $jssdk->GetSignPackage();
    }
}
