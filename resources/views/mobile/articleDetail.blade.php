@extends('layouts.mobile.app')


@section('content')
    <div class="article-details">
        <div class="details-title">{{$article->title}}</div>
        &nbsp;
        <div class="autor">
            {{date('Y-m-d',strtotime($article->created_at))}} &nbsp;{{$article->author}}
        </div>
        <div class="details-content">&nbsp;{!!$article->content!!}</div>
        <img src="{{$article->preview}}"/>
    </div>

@endsection
