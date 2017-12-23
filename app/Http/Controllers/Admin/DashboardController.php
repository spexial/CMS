<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Article;
use App\Product;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin:admin');
    }

    /**
     * @return $this
     */
    public function index()
    {
        $products = Product::count();
        $articles = Article::count();
        $admins = Admin::count();
        $users = User::count();
//        return view('admin.admin')->with([
//            'products' => $products,
//            'articles' => $articles,
//            'admins' => $admins,
//            'users' => $users,
//        ]);
        return view('admin.admin',compact('products','articles','admins','users'));
    }
}
