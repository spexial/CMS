<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    protected $username;

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
        $this->username = config('admin.global.username');
    }
    /**
     * 重写登录视图页面
     * @author
     * @date   2016-09-05T23:06:16+0800
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }
    /**
     * 自定义认证驱动
     * @author
     * @date   2016-09-05T23:53:07+0800
     */
    protected function guard()
    {
        return auth()->guard('admin');
    }
}
