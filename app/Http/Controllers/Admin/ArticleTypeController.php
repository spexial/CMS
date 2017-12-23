<?php

namespace App\Http\Controllers\Admin;

use App\ArticleType;
use App\Repositories\ArticleTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleTypeController extends Controller
{

    /**
     * ArticleTypeController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin:admin');
    }

    /**
     * @param ArticleTypeRepository $articleType
     * @return $this
     */
    public function  index(ArticleTypeRepository $articleType)
    {
        $articleTypes = $articleType->paginate(15);
        $arr = $this->tree($articleTypes);
        return view('admin.articleType.articleType')->with([
            'arr' => $arr,
            'articleTypes' => $articleTypes
        ]);
    }

    public function  create(ArticleTypeRepository $articleType)
    {
        $articleTypes = $articleType->all();
        return view('admin.articleType.create')->with('articleTypes', $articleTypes);
    }

    public function edit($id)
    {

    }

    public function save(Request $request)
    {
        $articleType = new ArticleType();
        $articleType->name = $request->input('name');
        $articleType->parent_id = $request->input('type');
        $articleType->save();
        return redirect('/admin/articleType');
    }

    public function store(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    private function tree($articleTypes)
    {
        $arr = [];
        foreach($articleTypes as $type)
        {
            $name = $type->name;
            $parent = $type->parentType;
            while(isset($parent))
            {
                $name = $parent->name.'>'.$name;
                $parent = $parent->parentType;
            }
            array_push($arr,[
                'raw'  => $type,
                'name' => $name
            ]);
        }
//        dd($arr);
        return $arr;

    }
}