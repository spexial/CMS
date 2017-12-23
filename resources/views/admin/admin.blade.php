@extends('layouts.admin.app')
@section('content')
    <div class="container" style="margin-left: 25%;">
        <div class="row">
            <div class="col-md-10 " style=";width:1150px;text-align: center">
                <div class="panel panel-info" style="line-height:10px;height:70px;display: none;background-color: #d9edf7;">
                    <div class="panel-heading" style="border-color:#d9edf7;">提示消息<span class="glyphicon glyphicon-remove" style="float: right"></span></div>
                    <div class="panel-body">
                        <p><strong>{{auth('admin')->user()->name}}</strong>，欢迎!</p>
                    </div>
                </div>
            </div>
            <div class="admin-box blue">
                <div class="panel-body">
                    <p><span>{{$products}}</span></p>商品
                </div>
                <a href="/admin/product">
                    <div class="box-footer blue ">
                        <small>查看<i class="glyphicon glyphicon-circle-arrow-right"></i></small>
                    </div>
                </a>
            </div>
            <div class="admin-box red">
                <div class="panel-body">
                    <p><span>{{$articles}}</span></p>文章
                </div>
                <a href="/admin/article">
                    <div class="box-footer red">
                        <small>查看<i class="glyphicon glyphicon-circle-arrow-right"></i></small>
                    </div>
                </a>
            </div>
            <div class="admin-box skyblue">
                <div class="panel-body">
                    <p><span>{{$admins}}</span></p>用户
                </div>
                <a href="/admin/admin">
                    <div class="box-footer skyblue">
                        <small>查看<i class="glyphicon glyphicon-circle-arrow-right"></i></small>
                    </div>
                </a>
            </div>
            <div class="admin-box purple">
                <div class="panel-body">
                    <p><span>{{$users}}</span></p>会员
                </div>
                <a href="/admin/user">
                    <div class="box-footer purple">
                        <small>查看<i class="glyphicon glyphicon-circle-arrow-right"></i></small>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- js-->
    <script>
        $(function () {
            if(!Cookies.get('message'))
            {
                $(document).ready(function () {
                    $('.panel-info').css({
                        'display':'block'
                    })
                });
                Cookies.set('message','123',{ expires:1});
            }
            else
            {
                Cookies.set('message','123',{ expires:1});
                $(document).ready(function () {
                    $('.panel-info').css({
                        'display':'none'
                    })
                });
            }
            $('.glyphicon-remove').click(function () {
                $(document).ready(function () {
                    $('.panel-info').css({
                        'display':'none'
                    })
                });
                Cookies.set('message','123',{ expires:1});
            });
        });
    </script>
@endsection


