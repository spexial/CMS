@extends('layouts.admin.app')
@section('content')
<div class=" col-md-offset-2 admin-log" style="border: 1px solid whitesmoke;">
    <div class="portlet-title"><strong>操作日志</strong></div>
    <div class="portlet-body">
    @if(count($log))
        <table class="table">
            {{--@if(auth('admin')->user()->permission == 'admin')--}}
            {{--<button style="float: right;">删除</button>--}}
            {{--@endif--}}
            <thead>
            <tr>
                <th></th>
                <th>管理员</th>
                <th style="width: 30%;padding-left: 33px;">操作</th>
                <th></th>
                <th style="padding-left: 53px;">时间</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($log as $item)
                <tr>
                    <td></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->operation}}</td>
                    <td></td>
                    <td>{{$item->created_at}}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
            <div class=" col-md-offset-3 col-md-6 page">
                {{ $log->links() }}
            </div>
        @else
        <div style="text-align: center;">还没有相关操作记录哦！</div>
        @endif
    </div>
</div>
@endsection