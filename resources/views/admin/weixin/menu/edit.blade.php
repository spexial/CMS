@extends('layouts.admin.app')
@section('content')
    <div class=" col-md-offset-2 admin-article">
        <div class="portlet-title"><strong>新增菜单</strong></div>
        <div class="alert alert-danger"  style="display: none;">
            <ul>
                <li class="error-name"></li>
                <li class="error-key"></li>
                <li class="error-title"></li>
                <li class="error-description"></li>
                <li class="error-image"></li>
                <li class="error-imgUrl"></li>
                <li class="error-url"></li>
            </ul>
        </div>
        <div class="error-msg"></div>
        <div class="wemenu">
            <form  enctype="multipart/form-data" id="form" role="form">
                <div class="form-group-body">
                    <div class="col-md-10 group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-md-2 control-label">菜单名称<span class="required">*</span></label>
                        <div class="col-md-10">
                            <div class="input-icon">
                                <input type="text" name="name" id ="name" class="form-control" value="{{$menu->name}}"
                                       placeholder="请输入菜单名称">
                            </div>
                        </div>
                    </div>
                    <div class="wemenu-type">
                        <div class="col-md-10 group">
                            <label class="col-md-2 control-label">菜单类型<span class="required">*</span></label>
                            <div class="col-md-10">
                                <select name="type" id="type" class="form-control">
                                    @if($menu->type=="noEvent")
                                        @if($count>=3)
                                            @else
                                    <option value="{{$menu->type}}">无事件的一级菜单</option>
                                        @endif
                                    <option value="click">点击推送事件</option>
                                    <option value="view">跳转链接</option>
                                    @elseif($menu->type=="click")
                                        <option value="{{$menu->type}}">点击推送事件</option>
                                        @if($count>=3)
                                        @else
                                            <option value="{{$menu->type}}">无事件的一级菜单</option>
                                        @endif
                                        <option value="view">跳转链接</option>
                                    @else
                                        <option value="{{$menu->type}}">跳转链接</option>
                                        @if($count>=3)
                                        @else
                                            <option value="{{$menu->type}}">无事件的一级菜单</option>
                                        @endif
                                        <option value="click">点击推送事件</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="parent-menu">
                        <div class="col-md-10 group">
                            <label class="col-md-2 control-label">一级菜单<span class="required">*</span></label>
                            <div class="col-md-10">
                                <select name="parent_id" class="form-control">
                                    <option value="{{$menu->parent_id}}">@if($menu->parent_id==0)无@else{{$menu->menu->name}}@endif</option>
                                    @foreach($parents as $parent)
                                        <option value="{{$parent->id}}">{{$parent->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="event">
                        <div class="col-md-10 group">
                            <label class="col-md-2 control-label">key<span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="input-icon">
                                    <input type="text" name="key" id="key" class="form-control" value="{{$menu->key}}"
                                           placeholder="请输入key值，英文">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 group ">
                            <label class="col-md-2 control-label">标题<span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="input-icon">
                                    <input type="text" name="title" id="title" class="form-control" value="{{$menu->title}}"
                                           placeholder="请输入标题">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 group ">
                            <label class="col-md-2 control-label">简介<span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="input-icon">
                                    <input type="text" name="description" id="description" class="form-control" value="{{$menu->description}}"
                                           placeholder="请输入简介">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 group ">
                            <label class="col-md-2 control-label">缩略图<span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="input-icon">
                                    <img src="{{"/".$menu->image}}" width="15%;"/>
                                    <input type="file" id="image" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 group ">
                            <label class="col-md-2 control-label">图文链接<span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="input-icon">
                                    <input type="text" name="imgUrl" id="imgUrl" class="form-control" value="{{$menu->imgUrl}}"
                                           placeholder="请输入跳转链接">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="url">
                        <div class="col-md-10 group ">
                            <label class="col-md-2 control-label">跳转链接<span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="input-icon">
                                    <input type="text" name="url" id="url" class="form-control" value="{{$menu->url}}"
                                           placeholder="请输入链接">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="id" value="{{$menu->id}}">
                <div class="form-actions wemenu">
                    <div class="row">
                        <div class=" col-md-12 setting-button" >
                            <button type="button" class="btn green">提交</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
