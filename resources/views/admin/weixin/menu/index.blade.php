@extends('layouts.admin.app')

@section('content')
    <div class="col-md-9 admin-article">
        <div class="portlet-title">
            <strong>菜单配置</strong>
            <div class="button">
                <a href="/admin/wemenu/create" class="btn" role="button">添加菜单</a>
            </div>
            <div class="button" style="margin-right: 35px;background-color: rebeccapurple;">
                <a href="/admin/wemenu/push" class="btn" role="button">更新菜单</a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th class="text-center"> 菜单名称 </th>
                        <th class="text-center"> 菜单类型 </th>
                        <th class="text-center"> 所属一级菜单 </th>
                        <th class="text-center"> 操作 </th>
                    </tr>
                    </thead>
                    <tbody class="tbody">
                    @foreach($weMenus as $weMenu)
                        <tr class="text-center">
                            <td>{{$weMenu->name}}</td>
                            <td>@if($weMenu->type=="noEvent")无事件的一级菜单@elseif($weMenu->type=="click")点击推送事件@else跳转链接@endif</td>
                            <td>@if($weMenu->parent_id ==0)@else{{$weMenu->menu->name}}@endif</td>
                            <td width="25%">
                                <a href="/admin/wemenu/edit/{{$weMenu->id}}" class="label label-info">
                                    <i class="glyphicon glyphicon-edit"></i> 编辑 </a>&nbsp;&nbsp;
                                <a class="label label-danger" href="/admin/wemenu/del/{{$weMenu->id}}" onClick="return confirm('你确定要删除吗？')"><i class="glyphicon glyphicon-share-alt"></i> 删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col-md-5 col-sm-5">
                </div>
                <div class="col-md-7 col-sm-7">
                    <div class="dataTables_paginate paging_bootstrap_number" id="sample_editable_1_paginate">
                        {!! $weMenus->render() !!}
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