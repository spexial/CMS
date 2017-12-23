@extends('layouts.admin.app')

@section('content')
    <div class="col-md-9 admin-article">
        <div class="portlet-title">
            <strong>自动回复</strong>
            <div class="button">
                <a href="/admin/wereplay/create" class="btn" role="button">添加回复规则</a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th class="text-center"> 关键词 </th>
                        <th class="text-center"> 消息类型 </th>
                        <th class="text-center"> 回复内容 </th>
                        <th class="text-center"> 操作 </th>
                    </tr>
                    </thead>
                    <tbody class="tbody">
                    @foreach($weReplays as $weReplay)
                        <tr class="text-center">
                            <td>{{$weReplay->keywords}}</td>
                            <td> @if($weReplay->type==1)文本消息@elseif($weReplay->type==2)图片消息@elseif($weReplay->type==3)语音消息@elseif($weReplay->type==4)视频消息@elseif($weReplay->type==5)音乐消息@else图文消息@endif</td>
                            <td>{{$weReplay->content}}</td>
                            <td width="25%">
                                <a href="/admin/wereplay/edit/{{$weReplay->id}}" class="label label-info">
                                    <i class="glyphicon glyphicon-edit"></i> 编辑 </a>&nbsp;&nbsp;
                                <a class="label label-danger" href="/admin/wereplay/del/{{$weReplay->id}}" onClick="return confirm('你确定要删除吗？')"><i class="glyphicon glyphicon-share-alt"></i> 删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col-md-5 col-sm-5">
                </div>
                <div class="col-md-7 col-sm-7">
                    <div class="dataTables_paginate paging_bootstrap_number" id="sample_editable_1_paginate">
                        {!! $weReplays->render() !!}
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