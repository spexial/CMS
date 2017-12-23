@extends('layouts.admin.app')

@section('content')
    <div class="col-md-9 admin-article">
    <div class="portlet-title">
        <strong>文章列表</strong>
        <div class="button">
            <a href="/admin/article/create" class="btn" role="button">添加文章</a>
        </div>
        <div  class="search">
            <form action="/admin/article/search" method="get">
                <div class="col-md-2">
                    <select name="type" class="bs-select form-control bs-select-hidden type">
                        <option value="0">全部</option>
                        @foreach($articleTypes as $articleType)
                        <option value="{{$articleType->id}}">{{$articleType->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input class=" form-control" type="search" name="title"  autocomplete="off" placeholder="标题">
                </div>
                <button type="submit" class="btn green">提交</button>
            </form>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-scrollable">
            <table class="table table-hover table-light">
                <thead>
                <tr>
                    <th class="text-center"> 标题 </th>
                    <th class="text-center"> 分类 </th>
                    <th class="text-center"> 缩略图 </th>
                    <th class="text-center"> 简介 </th>
                    <th class="text-center"> 浏览次数 </th>
                    <th class="text-center"> 操作 </th>
                </tr>
                </thead>
                <tbody class="tbody">
                @foreach($articles as $article)
                    <tr class="text-center">
                        <td>{{$article->title}}</td>
                        <td> {{$article->articleType->name}}</td>
                        <td> <img src="{{$article->preview}}" style="width:3em;height:3em;" /></td>
                        <td>{!! $article->description !!}</td>
                        <td>{{$article->view}}</td>
                        <td width="25%">
                            <a href="/admin/article/edit/{{$article->id}}" class="label label-info">
                                <i class="glyphicon glyphicon-edit"></i> 编辑 </a>&nbsp;&nbsp;
                            <a class="label label-danger" href="/admin/article/del/{{$article->id}}" onClick="return confirm('你确定要删除吗？')"><i class="glyphicon glyphicon-share-alt"></i> 删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-md-5 col-sm-5">
            </div>
            <div class="col-md-7 col-sm-7">
                <div class="dataTables_paginate paging_bootstrap_number" id="sample_editable_1_paginate">
                    {!! $articles->render() !!}
                </div>
            </div>
            <!-- 分页结束-->
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.button a').hover(function(){
            $(this).css({
                'color':'white'
            });
        });
    });
</script>
@endsection