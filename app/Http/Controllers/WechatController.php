<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Weixin\Wechat;
use Illuminate\Support\Facades\Log;
class WechatController extends Controller
{
    public function valid(Request $request)
    {
        $wechat = new Wechat();

        if (isset($_GET['echostr'])) {

            $wechat->valid();

        }
        $wechat->receiveEvent();
    }
}
