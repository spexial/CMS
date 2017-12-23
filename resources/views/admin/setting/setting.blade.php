@extends('layouts.admin.app')
@section('content')
    <div class=" col-md-offset-2 admin-setting">
        <div class="portlet-title"><strong>网站设置</strong>@if($id == 1)>>>SEO设置@else>>>微信配置@endif</div>
        <form action="/admin/setting/edit/{id}" method="post" class="form-horizontal" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group-body">
                @foreach($setting as $sys)
                    <div class="col-md-10 group">
                        <label class="col-md-2 control-label">{{$cname[$sys->name]}}</label>
                        <div class="col-md-10">
                            <div class="input-icon">
                                <input type="text" name="{{$sys->name}}" class="form-control" value="{{$sys->value}}"
                                       placeholder="请输入{{$cname[$sys->name]}}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class=" col-md-12 setting-button" >
                        <button type="submit" class="btn green">提交</button>
                        @if(Session::get('msg'))
                            <span style="color:green;margin-left: 20px;">{{Session::get('msg')}}</span>
                        @endif
                    </div>

                </div>
            </div>
        </form>
    </div>

@endsection