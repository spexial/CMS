<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,'http://192.168.40.27/api/user');
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

curl_setopt($ch, CURLOPT_HTTPHEADER,['Authorization:Bearer 2K7fbVVRTfZVyXAuCDpIVZed6PAamsu3xq3zSorX']);
$result = curl_exec($ch);
curl_close($ch);

var_dump(json_decode($result));


/** 带参数访问URL的API接口*/
//        $url = "http://192.168.40.27/api/access_token";
//        $post_data = array (
//            'grant_type'  => 'password',
//            'client_id'  =>  'hdq',
//            'client_secret' =>  'hdq',
//            'username'  =>  '110',
//            'password'  => '',
//        );
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        // post数据
//        curl_setopt($ch, CURLOPT_POST, 1);
//        // post的变量
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//        $output = curl_exec($ch);
//        curl_close($ch);
//        //打印获得的数据
//        print_r($output);
/** 直接访问URL的API接口 */
//         $results =  json_decode(file_get_contents('http://192.168.40.27/api/productions'));
