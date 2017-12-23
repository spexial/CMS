<?php

namespace App\Http\Controllers\Admin;

use App\Log;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * SettingController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin:admin');
    }

    /**
     * @param $id
     * @return $this
     */
    public function  index($id)
    {
        switch($id)
        {
            case 1:   $setting = Setting::whereIn('id',[1,2,3,4,5])->orderBy('id','ASC')->get();
                        $cname = array(
                            'web_name'=>'网站名称',
                            'keywords'=>'SEO关键词',
                            'description' =>'描述',
                            'telephone'=>'客服电话',
                            'address'=>'地址',

                        );
                break;
            case 6:     $setting = Setting::whereIn('id',[6,7,8])->orderBy('id','ASC')->get();
                $cname = array(
                    'AppID'=>'AppID',
                    'AppSecret'=>'AppSecret',
                    'Token' =>'Token'

                );
                break;
            default: $setting = Setting::where('type',$id)->orderBy('id','ASC')->get();
                $cname = array(
                    'web_name'=>'网站名称',
                    'keywords'=>'SEO关键词',
                    'description' =>'描述',
                    'telephone'=>'客服电话',
                    'address'=>'地址',
                );
        }
        return view('admin.setting.setting')->with([
            'setting' => $setting,
            'cname'    => $cname,
            'id'   =>   $id
        ]);

    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function edit(Request $request,$id)
    {
        $array = $request->input();
        array_shift($array);
        foreach ($array as $key=>$val)
        {
            $setting = Setting::where('name',$key)->first();
            $setting->value = $val;
            $setting->save();
        }
        //记录log
        $log = new Log();
        $log->name = auth('admin')->user()->name;
        if($id==1){
            $log->operation = '修改了网站设置>>>SEO';
        }
        else{
            $log->operation = '修改了网站设置>>>微信配置';
        }
        $log->save();

        return back()->withMsg('操作成功');
    }
}
