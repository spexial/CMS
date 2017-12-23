<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Repositories\WeMenuRepository;
use App\Weixin\Wechat;
use App\WeMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeChatMenuController extends Controller
{

    /**
     * WeChatMenuController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin:admin');
    }
    /**
     * 列表
     * @param WeMenuRepository $weMenu
     * @return $this
     */
    public function  index(WeMenuRepository $weMenu)
    {

        $weMenus = $weMenu->paginate(15);
        return view('admin.weixin.menu.index')->with('weMenus',$weMenus);
    }

    /**
     * 创建
     * @return $this
     */
    public function create()
    {
        $parents = WeMenu::where('parent_id',0)->get();
        return view('admin.weixin.menu.create')->with('parents',$parents);
    }


    /**
     * @param WeMenuRepository $weMenu
     * @param $id
     * @return $this
     */
    public function edit(WeMenuRepository $weMenu,$id)
    {
        $menu = $weMenu->find($id);
        if(isset($menu->menu))
        {
            $parents = WeMenu::where('parent_id',0)->get()->except($menu->menu->id);
        }
        else
        {
            $parents =  WeMenu::where('parent_id',0)->get();
        }
        $count = WeMenu::where('parent_id',0)->count();
        return view('admin.weixin.menu.edit')->with(['parents'=>$parents,'menu'=>$menu,'count'=>$count]);
    }


    /**
     * 保存
     * @param Request $request
     * @param WeMenuRepository $weMenu
     * @return array|bool|int
     */
    public function save(Request $request,WeMenuRepository $weMenu)
    {
        $this->validType($request, $request->type);
        if(isset($request->id)) {  //编辑
            $weReplay = $weMenu->find($request->id);
            if($this->validEditMenu($request->parent_id)==1){
                foreach ($request->except('_token') as $key => $value) {
                    $weReplay[$key] = $value;
                }
                if( $request->file('images')) {
                    $file = $request->file('images');
                    $extension = $file->getClientOriginalExtension();
                    $image = uniqid() . '.' . $extension;
                    $file->storeAs('', $image, 'public');
                    $weReplay->image = 'uploads/' . $image;
                    $images = New Image();
                    $images->compress(public_path($weReplay->image), public_path($weReplay->image), 200, 200);
                };
                $weReplay->id = $request->id;
                $result = $weReplay->save();
                if ($result) {
                    $msg = ['code' => 1, 'msg' => 'Successful'];
                    return $msg;
                } else {
                    $msg = ['code' => 0, 'msg' => 'Error'];
                    return $msg;
                }
            }
            else{
                return $this->validEditMenu($request->parent_id);
            }
        }
        else{ //新建
            $weReplay = new WeMenu();
            if($this->validCreateMenu($request->parent_id)==1){
                foreach ($request->except('_token') as $key => $value) {
                    $weReplay[$key] = $value;
                }
                if( $request->file('images'))
                {
                    $file = $request->file('images');
                    $extension = $file->getClientOriginalExtension();
                    $image = uniqid() . '.' . $extension;
                    $file->storeAs('', $image, 'public');
                    $weReplay->image = 'uploads/' . $image;
                    $images = New Image();
                    $images->compress(public_path($weReplay->image), public_path($weReplay->image), 200, 200);
                };
                $result = $weReplay->save();
                if ($result) {
                    $msg = ['code' => 1, 'msg' => 'Successful'];
                    return $msg;
                } else {
                    $msg = ['code' => 0, 'msg' => 'Error'];
                    return $msg;
                }
            }
            else{
                return $this->validCreateMenu($request->parent_id);
            }
        }

    }


    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        WeMenu::destroy($id);
        return redirect('admin/wemenu');
    }


    /**
     * 推送菜单到微信服务器
     */
    public function push()
    {
        $parent_data = WeMenu::where('parent_id',0)->get();
        $menu = array();
        if(count($parent_data)>0)
        {
            foreach($parent_data as $parent)
            {
                $menu2 = array();
                $child_data = WeMenu::where('parent_id',$parent->id)->get();
                //有子菜单
                if(count($child_data)>0)
                {
                    $menu2 = array('name'=>$parent->name);
                    foreach($child_data as $child)
                    {
                        switch($child->type)
                        {
                            case "click":
                                $menu2['sub_button'][] = array('name'=>$child->name,'type'=>$child->type,'key'=>$child->key);
                                break;
                            case "view":
                                $menu2['sub_button'][] = array('name'=>$child->name,'type'=>$child->type,'url'=>$child->url);
                                break;
                            default:
                                $menu2['sub_button'][] = array('name'=>$child->name,'type'=>$child->type,'url'=>$child->url);
                                break;
                        }
                    }
                }
                //无子菜单
                else
                {
                    switch($parent->type)
                    {
                        case "click":
                            $menu2 = array('name'=>$parent->name,'type'=>$parent->type,'key'=>$parent->key);
                            break;
                        case "view":
                            $menu2 = array('name'=>$parent->name,'type'=>$parent->type,'url'=>$parent->url);
                            break;
                        default:
                            $menu2 = array('name'=>$parent->name);
                            break;
                    }
                }
                $menu[] = $menu2;
            }
        }
        $create = array();
        $create['button'] = $menu;
        if(!empty($menu)) //不为空，创建菜单
        {
            $weChat = new Wechat();
            $json_menu = json_encode($create,JSON_UNESCAPED_UNICODE);
            $weChat->createMenu($json_menu);
            return redirect()->to('/admin/wemenu');
        }
        else  //为空，删除菜单
        {
            $weChat = new Wechat();
            $weChat->deleteMenu();
            return redirect()->to('/admin/wemenu');
        }

    }


    /**
     * 判断输入验证
     * @param $request
     * @param $type
     */
    public function validType($request,$type)
    {
        switch($type)
        {
            case "noEvent":
                $this->validate($request,[
                    'name' => 'required'
                ]);
                break;
            case "click":
                $this->validate($request,[
                    'name' => 'required',
                    'key' => 'required|alpha',
                    'title' => 'required',
                    'description' => 'required',
                    'images' => 'required|images',
                    'imgUrl' => 'required|url',
                ]);
                break;
            case "view":
                $this->validate($request,[
                    'name' => 'required',
                    'url' => 'required|url',
                ]);
                break;
            default:
                $this->validate($request,[
                    'name' => 'required'
                ]);
                break;
        }
    }

    /**
     * 判断菜单限制
     * @param $parent_id
     * @return array|int
     */
    public function validCreateMenu($parent_id)
    {
        $count = WeMenu::where('parent_id',$parent_id)->count();
        $type = WeMenu::where('id',$parent_id)->value('type');
            if($parent_id==0 && $count>=3) {
                return ['code'=>0,'msg'=>'一级菜单超出数量限制'];
            }
            elseif($type!=null && $type!="noEvent")
            {
                return ['code'=>0,'msg'=>'一级菜单类型不允许创建子菜单'];
            }
            elseif($count>=5 && $parent_id!=0 )
            {
                return ['code'=>0,'msg'=>'子菜单数量超出限制'];
            }
            else {
                return 1;
            }

    }

    public function validEditMenu($parent_id)
    {
        $count = WeMenu::where('parent_id',$parent_id)->count();
        $type = WeMenu::where('id',$parent_id)->value('type');
        if($parent_id==0 && $count>3) {
            return ['code'=>0,'msg'=>'一级菜单超出数量限制'];
        }
        elseif($type!=null && $type!="noEvent")
        {
            return ['code'=>0,'msg'=>'一级菜单类型不允许创建子菜单'];
        }
        elseif($count>5 && $parent_id!=0 )
        {
            return ['code'=>0,'msg'=>'子菜单数量超出限制'];
        }
        else {
            return 1;
        }

    }

}
