<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Repositories\WeReplayRepository;
use App\Weixin\Wechat;
use App\WeReplay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeChatReplayController extends Controller
{
    /**
     * WeChatReplayController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin:admin');
    }

    /**
     * @param WeReplayRepository $weReplay
     * @return $this
     */
   public function  index(WeReplayRepository $weReplay)
   {
       $weReplays = $weReplay->paginate(15);
       return view('admin.weixin.replay.index')->with('weReplays',$weReplays);
   }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.weixin.replay.create');
    }

    /**
     * @param $id
     */
    public function edit($id)
    {

    }

    /**
     * @param Request $request
     * @return string
     */
    public function save(Request $request)
    {
        $this->validRequest($request,$request->input('type'));
            $weReplay = new WeReplay();
            switch($request->input('type'))
            {
                case 2:
                    $file = $request->file('images');
                    $extension = $file->getClientOriginalExtension();
                    $image = uniqid().'.'.$extension ;
                    $file->storeAs('',$image,'public');
                    $images = New Image();
                    $images->compress(public_path('uploads/'.$image),public_path('uploads/'.$image),400,400);
                    $weChat = new Wechat();
                    $content = $weChat->upload(public_path('uploads/'.$image),"images");
                    $weReplay->keywords = $request->input('keywords');
                    $weReplay->type = $request->input('type');
                    $weReplay->content = $content;
                    break;
                case 3:
                    break;
                case 4:

                    break;
                case 5:

                    break;
                case 6:

                    break;
                default:

                    break;
            }
        $result = $weReplay->save();
        if($result) {
            $msg= json_encode(['code'=>1,'msg'=>'Successful']);
            return  $msg;
        }
        else{
            $msg= json_encode(['code'=>0,'msg'=>'Error']);
            return  $msg;
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        WeReplay::destroy($id);
        return redirect('admin/wereplay');
    }



    /**
     *  根据消息类型进行不同验证
     * @param $request
     * @param $type
     */
    public function validRequest($request,$type)
    {
        switch($type)
        {
            case 1:
                $this->validate($request,[
                        'keywords' => 'required|unique:we_replays',
                        'content' => 'required'
                    ]
                );
                break;
            case 2:
                $this->validate($request,[
                        'keywords' => 'required|unique:we_replays',
                        'images' => 'required|images'
                    ]
                );
                break;
            case 3:
                $this->validate($request,[
                        'keywords' => 'required|unique:we_replays',
                        'voice' => 'required'
                    ]
                );
                break;
            case 4:
                $this->validate($request,[
                        'keywords' => 'required|unique:we_replays',
                        'video' => 'required'
                    ]
                );
                break;
            case 5:
                $this->validate($request,[
                        'keywords' => 'required|unique:we_replays',
                        'music' => 'required'
                    ]
                );
                break;
            case 6:
                $this->validate($request,[
                        'keywords' => 'required|unique:we_replays',
                        'article' => 'required'
                    ]
                );
                break;
            default:
                $this->validate($request,[
                        'keywords' => 'required|unique:we_replays',
                        'content' => 'required'
                    ]
                );
                break;
        }
    }



}
