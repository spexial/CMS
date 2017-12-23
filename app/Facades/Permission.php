<?php
namespace App\Facades;


class Permission
{

    /**
     * @var array
     */
    protected  $permission = [
        '网站设置' =>'setting',
        '操作日志'=>'log',
        '商品管理'=> 'product',
        '文章管理'=> 'article',
        '单页管理'=>'page',
        '用户管理'=>'auser',
        '会员管理'=>'user',
        '微信管理'=>'wechat'
    ];

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getAdmin()
    {
        return $admin = auth('admin')->user();
    }

    /**
     * @return array
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * @param $module
     * @return bool
     */
    public function can($module)
    {
        $permission = $this->getAdmin()->permission;
        if($permission == 'admin')
        {
            return true;
        }
        else
        {
            $permission = json_decode($permission);
            if(in_array($module,$permission))
            {
                return true;
            }
            return false;
        }
    }
}