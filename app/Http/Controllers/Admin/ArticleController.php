<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Events\ArticleEvent;
use App\Image;
use App\Jobs\Test;
use App\Repositories\ArticleRepository;
use App\Repositories\ArticleTypeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * ArticleController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin:admin');
    }

    /**
     * @param ArticleRepository $articles
     * @param ArticleTypeRepository $articleTypes
     * @return
     */
    public function index(ArticleRepository $articles,ArticleTypeRepository $articleTypes)
    {
        $articles = $articles->paginate(15);
        $articleTypes = $articleTypes->all();
        return view('admin.article.article')->with([
            'articles'     => $articles,
            'articleTypes' => $articleTypes
        ]);
    }

    public function create(ArticleTypeRepository $articleType)
    {
        $articleTypes = $articleType->all();
        return view('admin.article.create')->with('articleTypes',$articleTypes);
    }

    /**
     * @param $id
     * @param ArticleRepository $article
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id,ArticleRepository $article)
    {
        dispatch((new Test())->delay(Carbon::now()->addMinutes(1)));
//        $article = $article->find($id);
//        \Event::fire(new ArticleEvent($article));
        return redirect('/admin/article');
    }

    public function save(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'type' => 'required',
            'images' => 'required|images',
        ]);
        $article = new Article();
        $article->title = $request->title;
        $article->type_id = $request->type;
        $article->keywords = $request->keywords;
        $article->description = $request->description;
        $article->author = auth('admin')->user()->name;
        $article->content = $request->input('content');
        $article->view = 0;
        $file = $request->file('images');
        $extension = $file->getClientOriginalExtension();
        $image = uniqid().'.'.$extension ;
        $file->storeAs('',$image,'public');
        $article->preview = 'uploads/'.$image;
        $images = New Image();
        $images->compress(public_path($article->preview),public_path($article->preview),600,600);
        $article->save();
        return redirect()->back();
    }

    public function store(Request $request,$id)
    {

    }

    public function destroy($id)
    {
        Article::destroy($id);
        return redirect('admin/article');
    }

    /**
     * @param Request $request
     * @param ArticleTypeRepository $articleType
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function search(Request $request,ArticleTypeRepository $articleType)
    {
        $articles = Article::orderBy('created_at', 'DESC');
        //查询为空
        if ($request->input('type') == '' && $request->input('title') == '') {
            return redirect('/admin/article');
        }
        //查询全部
        elseif ($request->input('type') == 0 && $request->input('title') == '') {
            $articles = $articles->paginate(15);
        }
        //分类查询
        else {
                 if ($request->input('type') == 0 && $request->input('title') != '') {
                    $articles = $articles->where('title', 'like', '%' . trim($request->input('title')) . '%');
                 }
                 else{
                     $articles = $articles->where('type_id', $request->input('type'));
                     if ($request->input('title')) {
                         $articles = $articles->where('title', 'like', '%' . trim($request->input('title')) . '%');
                     }
                 }
            $articles = $articles->paginate(15);
        }
        $type = $articleType->find($request->input('type'));
        $articleTypes = $articleType->all()->except($request->input('type'));
        if ($articles)
        {
            return view('admin.article.search')->with([
                'articleTypes' => $articleTypes,
                'articles' => $articles,
                'type' => $type,
                'title' => $request->input('title'),
            ]);
        }
        else
        {
            return redirect('/admin/article');
        }
    }

}
