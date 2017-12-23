@extends('layouts.mobile.app')


@section('content')
    <div class="nav">
        <div class="logo">
            <img src="/image/logo3.png" id ="logo2">
        </div>
        <div class="button"><span class="glyphicon glyphicon-th-list" style="font-size: 6em;line-height: 1.5em;float:right;"></span></div>
        <div class="button1"><span class="glyphicon glyphicon-th-list" style="font-size: 6em;line-height: 1.5em;float:right;"></span></div>
        <div class="menu" style="display: none;">
            <ul>
                @foreach($articleTypes as $types)
                    <li>&nbsp;{{$types->name}}&nbsp;</li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="banner">
    </div>
    <div class="cov">
                @foreach ($articles as $article)
                    <div class="box">
                        <a href="/detail/{{$article->id}}">
                            <div class="preview"><img src="{{$article->preview}}"/></div>
                            <div class="article">
                                <div class="heading">
                                    <span class="title">{{$article->title}}</span>
                                        <span style="color:#999; float:right;margin-right: 4em;line-height: 70px;font-size: 20px;">
                                            {{$article->created_at}} &nbsp;By {{$article->author}}
                                        </span>
                                </div>
                                <div class="panel-body" style="height:10em;">
                                    <span class="content">{!! mb_substr($article->content,0,30,'utf-8') !!}...</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            <div class="page">
                {{ $articles->links() }}
            </div>
    </div>

@endsection
