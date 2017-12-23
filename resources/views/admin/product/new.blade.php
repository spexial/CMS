@extends('layouts.admin.app')

@section('新增商品', 'Page Title')

@section('content')
    <div class="col-md-9 admin-products">
        <div class="portlet-title"><strong>新增商品</strong></div>
            <form method="POST" action="/admin/product/save" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <div class="form-group-product-body">
                    <!-- Text input-->
                    <div class="col-md-10 group">
                        <label class="col-md-1 control-label" for="name">名称</label>
                        <div class="col-md-10">
                            <input id="name" name="name" type="text" placeholder="商品名称" class="form-control input-md" required="">

                        </div>
                    </div>
                    <div class="col-md-10 group">
                        <label class="col-md-1 control-label" for="textarea">描述</label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="textarea" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col-md-10 group">
                        <label class="col-md-1 control-label" for="price">价格</label>
                        <div class="col-md-10">
                            <input id="price" name="price" type="text" placeholder="商品价格" class="form-control input-md" required="">

                        </div>
                    </div>
                    <div class="col-md-10 group">
                        <label class="col-md-1 control-label" for="image">图片</label>
                        <div class="col-md-10">
                            <input id="image" name="image" type="text" placeholder="商品图片" class="form-control input-md" >

                        </div>
                    </div>
                    <div class="col-md-10 group">
                        <label class="col-md-1 control-label" for="file">文件</label>
                        <div class="col-md-10">
                            <input id="file" name="file" class="input-file" type="file">
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-4 setting-button" >
                            <button type="submit" class="btn green">提交</button>
                        </div>

                    </div>
                </div>
            </form>

    </div>
    <div class="col-md-2"></div>
@endsection