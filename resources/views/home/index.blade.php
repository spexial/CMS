@extends('layouts.home.master')


@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container" style="margin-top: 70px;">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-8">
                @foreach ($articles as $article)
                            <div class="panel panel-default" style="margin:-20px 0 10px -15px;">
                                <div class="panel-heading">
                                    <a href="">{{$article->title}}</a>
                                <span style="color:#999; float:right;margin-right: 20px;">
                                    <small>{{$article->created_at}}</small>
                                </span>
                                </div>
                                <div class="panel-body">
                                    {!! mb_substr($article->content,0,40,'utf-8') !!}
                                </div>
                            </div>
                        <div class="class=col-md-9" style=" color: red; text-align:center; background-color: whitesmoke;margin: -10px 0 0 -15px;">
                        </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
