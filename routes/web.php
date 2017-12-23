<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*展示页*/
Route::get('/show',function(){
    return view('show');
});
Route::get('/showTwo',function(){
    return view('showTwo');
});

Route::group(['prefix'=>'show'],function ($router){
    $router->get('Three',function (){
        return view('show.three');
    });
});




Auth::routes();





//前台
Route::group(['namespace' => 'Home'],function ($router){
    $router->get('/', 'HomeController@index');
    //商品
    $router->get('/addProduct/{productId}', 'CartController@addItem');
    $router->get('/removeItem/{productId}', 'CartController@removeItem');
    $router->get('/cart', 'CartController@showCart');
    //文章
    $router->get('/detail/{id}', 'HomeController@details');
});



//后台
Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
    //登录
    $router->get('login', 'LoginController@showLoginForm')->name('admin.login');
    $router->post('login', 'LoginController@login');
    $router->post('logout', 'LoginController@logout');

    //首页
    $router->get('/', 'DashboardController@index');
    //设置
    $router->get('setting/{id}', 'SettingController@index');
    $router->post('setting/edit/{id}', 'SettingController@edit');
    //日志
    $router->get('log', 'LogController@index');
    //文章
    $router->get('article', 'ArticleController@index');
    $router->get('article/search', 'ArticleController@search');
    $router->get('article/create', 'ArticleController@create');
    $router->get('article/edit/{id}', 'ArticleController@edit');
    $router->post('article/save', 'ArticleController@save');
    $router->post('article/store/{id}', 'ArticleController@store');
    $router->get('article/del/{id}', 'ArticleController@destroy');
    //文章分类
    $router->get('articleType', 'ArticleTypeController@index');
    $router->get('articleType/create', 'ArticleTypeController@create');
    $router->get('articleType/edit/{id}', 'ArticleTypeController@edit');
    $router->post('articleType/save', 'ArticleTypeController@save');
    $router->post('articleType/store/{id}', 'ArticleTypeController@store');
    $router->get('articleType/del/{id}', 'ArticleTypeController@destroy');
    //商品
    $router->get('product/new', 'ProductController@newProduct');
    $router->get('product', 'ProductController@index');
    $router->get('product/destroy/{id}', 'ProductController@destroy');
    $router->post('product/save', 'ProductController@add');
    //用户
    $router->get('admin', 'AdminController@index');
    $router->get('admin/create', 'AdminController@create');
    $router->get('admin/edit/{id}', 'AdminController@edit');
    $router->post('admin/save', 'AdminController@save');
    $router->post('admin/store/{id}', 'AdminController@store');
    $router->get('admin/del/{id}', 'AdminController@destroy');
    //会员
    $router->get('user', 'UserController@index');
    $router->get('user/view/{id}', 'UserController@view');
    $router->post('user/store/{id}', 'UserController@store');
    $router->get('user/del/{id}', 'UserController@destroy');

    //微信菜单
    $router->get('wemenu','WeChatMenuController@index');
    $router->get('wemenu/create','WeChatMenuController@create');
    $router->post('wemenu/save','WeChatMenuController@save');
    $router->get('wemenu/edit/{id}','WeChatMenuController@edit');
    $router->get('wemenu/del/{id}','WeChatMenuController@destroy');
    $router->get('wemenu/push','WeChatMenuController@push');
    //微信回复
    $router->get('wereplay','WeChatReplayController@index');
    $router->get('wereplay/create','WeChatReplayController@create');
    $router->post('wereplay/save','WeChatReplayController@save');
    $router->get('wereplay/edit/{id}','WeChatReplayController@edit');
    $router->get('wereplay/del/{id}','WeChatReplayController@destroy');

});





//Route::any('menu','WechatController@menu');
Route::any('/check','WechatController@valid');
//Route::get('user','WechatController@user');
//Route::get('users','WechatController@users');
//Route::get('token','WechatController@token');
