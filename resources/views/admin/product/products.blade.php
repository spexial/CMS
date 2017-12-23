@extends('layouts.admin.app')

@section('content')
    <div class="col-md-9 admin-products">
        <div class="portlet-title">
            <strong>商品列表</strong>
            <div class="button">
                    <a href="/admin/product/new" class="btn" role="button">新增商品</a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                        <td>名称</td>
                        <td>价格</td>
                        <td>文件</td>
                        <td>操作</td>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>￥{{$product->price}}</td>
                                <td>{{$product->file->original_filename}}</td>
                                <td><a href="/admin/product/destroy/{{$product->id}}"><button class="btn btn-danger">删除</button></a> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection