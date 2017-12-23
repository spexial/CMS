@extends('layouts.admin.app')
@section('content')
    <div class=" col-md-offset-2 admin-setting">
        <div class="portlet-title"><strong>新增分类</strong></div>
            <div class="alert alert-danger" style="display: none;">
                <ul>
                        <li class="error1" style="display: none;"></li>
                        <li class="error2" style="display: none;"></li>
                </ul>
            </div>
        <div class="wereplay">
            <form  id="form" role="form" enctype="multipart/form-data" method="post">
                <div class="form-group-body">
                    <div class="col-md-10 group">
                        <label class="col-md-2 control-label">关键词<span class="required">*</span></label>
                        <div class="col-md-10">
                            <div class="input-icon">
                                <input type="text" id="keywords" name="keywords" class="form-control" value=""
                                       placeholder="请输入关键词">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 group">
                        <label class="col-md-2 control-label">分类</label>
                        <div class="col-md-10">
                            <select id="type" name="type" class="form-control">
                                <option value="1">文本消息</option>
                                <option value="2">图片消息</option>
                                <option value="3">语音消息</option>
                                <option value="4">视频消息</option>
                                <option value="5">音乐消息</option>
                                <option value="6">图文消息</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-10 group" id="group1">
                        <label class="col-md-2 control-label">内容<span class="required">*</span></label>
                        <div class="col-md-10">
                            <div class="input-icon">
                                <textarea class="form-control" rows="3" id="content" name="content"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 group" id="group2">
                        <label class="col-md-2 control-label">图片<span class="required">*</span></label>
                        <div class="col-md-10">
                            <input type="file" id="image" name="image" multiple>
                        </div>
                    </div>
                    <div class="col-md-10 group" id="group3">
                        <label class="col-md-2 control-label">语音<span class="required">*</span></label>
                        <div class="col-md-10">
                            <input type="file" id="voice" name="voice">
                        </div>
                    </div>
                    <div class="col-md-10 group" id="group4">
                        <label class="col-md-2 control-label">视频<span class="required">*</span></label>
                        <div class="col-md-10">
                            <input type="file"  id="video" name="video">
                        </div>
                    </div>
                    <div class="col-md-10 group" id="group5">
                        <label class="col-md-2 control-label">音乐<span class="required">*</span></label>
                        <div class="col-md-10">
                            <input type="file" id="music" name="music">
                        </div>
                    </div>
                    <div class="col-md-10 group" id="group6">
                        <label class="col-md-2 control-label">图文<span class="required">*</span></label>
                        <div class="col-md-10">
                            <input type="file"  id="article" name="article">
                        </div>
                    </div>
                </div>
                <div class="form-actions replay">
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