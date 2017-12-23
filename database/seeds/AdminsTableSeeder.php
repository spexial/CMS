<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //生成后台用户
        factory('App\Admin',1)->create([
            'password'   => bcrypt('123456'),
            'permission' => 'admin'
        ]);

        //生成基本网站设置
        $name = array(
            '1'=>'web_name',
            '2'=>'keywords',
            '3' =>'description',
            '4'=>'telephone',
            '5'=>'address',
            '6'=>'AppID',
            '7'=>'AppSecret',
            '8'=>'Token',
        );
        $value = array(
            '1'=>'网站名称',
            '2'=>'SEO关键字',
            '3' =>'描述',
            '4'=>'客服电话',
            '5'=>'地址',
            '6'=>'应用ID',
            '7'=>'应用密钥',
            '8'=>'令牌',
        );
        for($i= 1 ;$i <= count($name);$i++)
        {
            $setting = new \App\Setting();
            $setting->name = $name[$i];
            $setting->value = $value[$i];
            $setting->save();
        }
    }
}
