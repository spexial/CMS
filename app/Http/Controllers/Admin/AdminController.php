<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Facades\Permission;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * ArticleController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin:admin');
    }

    /**
     * @param AdminRepository $admin
     */
    public function index(AdminRepository $admin)
    {
        $admins = $admin->paginate(15);
        return view('admin.admin.admin')->with('admins',$admins);
    }

    /**
     * @param Permission $permissions
     */
    public function create(Permission $permissions)
    {
        $permissions = $permissions->getPermission();
        return view('admin.admin.create')->with('permissions',$permissions);
    }

    public function edit($id)
    {

    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'name'     => 'required|max:255',
            'email'    => 'required|email',
            'password' => 'required|max:255'
        ]);
        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->password = bcrypt($request->input('password'));
        $admin->permission = json_encode($request->input('permission'));
        $admin->save();
        return redirect('admin/admin');
    }

    public function store(Request $request,$id)
    {

    }

    public function destroy($id)
    {

    }
}
