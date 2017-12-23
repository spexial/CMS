@extends('layouts.admin.app')
@section('content')
    <div class=" col-md-offset-2 admin-setting">
        <div class="portlet-title"><strong>新增分类</strong></div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/admin/articleType/save" method="post" class="form-horizontal" >
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
                    <label class="col-md-2 control-label">分类</label>
                    <div class="col-md-10">
                        <div class="input-icon">
                            <select name="type">
                                <option value="0">请选择分类</option>
                                @foreach($articleTypes as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
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