@extends('layouts.admin.app')

@section('content')
    <div class="col-md-9 admin-admin">
        <div class="portlet-title">
            <strong>会员列表</strong>
            {{--<div class="button">--}}
                {{--<a href="/admin/admin/create" class="btn" role="button">添加用户</a>--}}
            {{--</div>--}}
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th class="text-center"> 名称 </th>
                        <th class="text-center"> 帐号 </th>
                        <th class="text-center"> 操作 </th>
                    </tr>
                    </thead>
                    <tbody class="tbody">
                    @foreach($users as $user)
                        <tr class="text-center">
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td width="25%">
                                <a href="/admin/user/view/{{$user->id}}" class="label label-primary">
                                    <i class="glyphicon glyphicon-edit"></i> 查看 </a>&nbsp;&nbsp;
                                <a class="label label-danger" href="/admin/user/del/{{$user->id}}" onClick="return confirm('你确定要删除吗？')"><i class="glyphicon glyphicon-share-alt"></i> 删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col-md-5 col-sm-5">
                </div>
                <div class="col-md-7 col-sm-7">
                    <div class="dataTables_paginate paging_bootstrap_number" id="sample_editable_1_paginate">
                        {!! $users->links() !!}
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