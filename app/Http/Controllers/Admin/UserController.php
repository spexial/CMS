<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * ArticleController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin:admin');
    }

    public function index(UserRepository $user)
    {
        $users = $user->paginate(15);
        return view('admin.user.user')->with('users',$users);
    }

    public function view($id)
    {

    }

    public function store($id)
    {

    }

    public function destroy($id)
    {

    }
}
