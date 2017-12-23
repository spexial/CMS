@extends('layouts.admin.app')
@section('content')
    <div class=" col-md-offset-2 admin-setting">
        <div class="portlet-title"><strong>新增用户</strong></div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/admin/admin/save" method="post" class="form-horizontal" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group-body">
                    <div class="col-md-10 group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-md-2 control-label">名称</label>
                        <div class="col-md-10">
                            <div class="input-icon">
                                <input type="text" name="name" class="form-control" value=""
                                       placeholder="请输入名称">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="col-md-2 control-label">邮箱</label>
                        <div class="col-md-10">
                            <div class="input-icon">
                                <input type="email" name="email" class="form-control" value=""
                                       placeholder="请输入邮箱">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label class="col-md-2 control-label">密码</label>
                        <div class="col-md-10">
                            <div class="input-icon">
                                <input type="password" name="password" class="form-control" value=""
                                       placeholder="请输入密码">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 group">
                        <label class="col-md-2 control-label">权限</label>
                        <div class="col-md-10" style="font-size: 16px;">
                            @foreach($permissions as $key => $value)
                                <label class="checkbox-inline" style="margin-left: 0;">
                                    <input type="checkbox"  name="permission[]" value="{{$value}}"> {{$key}}
                                </label>
                            @endforeach
                        </div>
                    </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class=" col-md-12 setting-button" >
                        <button type="submit" class="btn green">提交</button>
                    </div>

                </div>
            </div>
        </form>
    </div>

@endsection