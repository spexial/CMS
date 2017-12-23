@extends('layouts.admin.app')

@section('content')
    <div class="col-md-9 admin-article">
        <div class="portlet-title">
            <strong>分类列表</strong>
            <div class="button">
                <a href="/admin/articleType/create" class="btn" role="button">添加分类</a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th class="text-center"> 分类 </th>
                        <th class="text-center"> 更新时间 </th>
                        <th class="text-center"> 操作 </th>
                    </tr>
                    </thead>
                    <tbody class="tbody">
                    @foreach($arr as $articleType)
                        <tr class="text-center">
                            <td>{{$articleType['name']}}</td>
                            <td>{{$articleType['raw']->updated_at}}</td>
                            <td width="25%">
                                <a href="/admin/article/edit/{{$articleType['raw']->id}}" class="label label-info">
                                    <i class="glyphicon glyphicon-edit"></i> 编辑 </a>&nbsp;&nbsp;
                                <a class="label label-danger" href="/admin/article/del/{{$articleType['raw']->id}}" onClick="return confirm('你确定要删除吗？')"><i class="glyphicon glyphicon-share-alt"></i> 删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col-md-5 col-sm-5">
                </div>
                <div class="col-md-7 col-sm-7">
                    <div class="dataTables_paginate paging_bootstrap_number" id="sample_editable_1_paginate">
                        {!! $articleTypes->render() !!}
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