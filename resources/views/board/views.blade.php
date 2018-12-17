@extends('layouts.master') 
@section('title') board.view
@endsection
 
@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/innks/NanumSquareRound/master/nanumsquareround.min.css">
<link rel="stylesheet" href="{{asset('css/kakaoview/style.css')}}?after">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
    crossorigin="anonymous">
<script src="{{asset('bower_components/jquery/dist/jquery.js')}}"></script>
<script src="{{asset('js/tools.js')}}"></script>
<script src="{{asset('js/selected.js')}}"></script>
<script src="{{asset('js/view.js')}}"></script>

<style>
    .chat__message--to-me .chat__message-avatar {
        height: 35px;
        border-radius: 50%;
        margin-right: 10px;
        width: 35.1px;
        height: 35px;
    }
</style>
@endsection
 
@section('header-top')
    @include('Components.header-top')
<div class="header__bottom">
    <div class="header__column">
        <a href="{{route('board.index')}}">
            <i class="fa fa-chevron-left fa-lg"></i>
        </a>
    </div>
    <div class="header__column">
        <span class="header__text">title:{{$msg["title"]}}</span>
        <br>
    </div>
    <div class="header__column">
        OPTION
    </div>
</div>
</header>
@endsection
 
@section('viewContent')
<main class="chat">
    <div class="date-divider">
        <span class="date-divider__text" style="font-size=1em;">Author : {{$msg["author"]}}</span>
        <br>
        <i class="fas fa-eye"></i> {{ $viewCount }}
    </div>


    @if($msg['author'] == Auth::user()['nickname']) {{--현재 접속자와 글쓴이와 동일하면 노란박스--}}
    <div class="chat__message chat__message-from-me">
        <span class="chat__message-time">
            {{ $msg["created_at"]->diffForHumans() }} </span>
        <span class="chat__message-body">
            {!!$msg["content"] !!}
            
            @if($files && count($files))
            <br>
            <br>
            <strong> 첨부된 파일 리스트 : </strong>
            @foreach($files as $file)
            <ul>
            <li><a href="{{url('downloadFile', $file)}}">{{$file->savename}}</a></li>
            <li>파일 크기 : {{format_filesize($file->filesize)}}</li>
            </ul>
            @endforeach
            @endif
            
            <br>
            <br>

            <div style="text-align:left">
            <a type="button" class="btn btn-success" value="수정하기" onclick="location.href='{{$msg['postid']}}/edit'"><i class="fas fa-edit"></i></a>
            </div>
            

            <form action="{{route('board.destroy', ['board' => $msg['postid']]) }}" method="POST" id="deleteform">
                @csrf
                @method('delete')
               <a class ="button" onclick='deleter(); return false;'> <i class="fas fa-trash-alt fa-input"></i></a>
            </form>
            
                <script>
                    function deleter(){
                        var yn = confirm("정말 삭제 하시겠습니까?");
                        if(yn == true)
                        document.getElementById('deleteform').submit();
                        else return;
                    }
                </script>

            <input type="hidden" name="postid" value="{{$msg['postid']}}">
            
            <!-- <i class="fas fa-trash-alt"></i> -->
        </span>
    </div>
    @endif
    <!------------------------------------------------------------------------------------------------------------>
    @if($msg['author'] != Auth::user()['nickname'])
    <!-- 현재 접속자와 글쓴이와 다르면 하얀박스 -->
    <div class="chat__message chat__message--to-me">
        @if($profile['profileImg'])
        <img src="{{$profile['profileImg']}}" class="chat__message-avatar"> 
        @else
        <img src="{{asset('img/person-icon.png')}}" class="chat__message-avatar"> 
        @endif

        <div class="chat__message-center">
            <h3 class="chat__message-username"> {{$msg['author']}}</h3>
            <span class="chat__message-body">
                {!!$msg["content"] !!}

                @if($files && count($files))
                <br>
                <br>
                <strong>첨부된 파일 리스트 :</strong>
                @foreach($files as $file)
                <ul>
                <!-- {{$file}} -->
                <li><a href="{{url('downloadFile', $file)}}">{{$file->savename}}</a></li>
                <li>파일 크기 : {{format_filesize($file->filesize)}}</li>
                </ul>
                @endforeach
                @endif
            </span>
        </div>
        <span class="chat__message-time"> {{ $msg["created_at"]->diffForHumans() }} </span>
    </div>
    @endif


    <!------------------------------------------------comment------------------------------------------------------------>
    @if($comments) @foreach($comments as $comment) @if($comment['writer'] == \Auth::user()['nickname'])
    <div class="chat__message chat__message-from-me">
        <span class="chat__message-time">{{$comment['created_at']->diffForHumans()}} </span>
        <span class="chat__message-body">
            {{$comment['content']}}

        
        <!--</span><a href="">☒</a></span> -->
    </div>

    @else
    <!-------------------------------------------------------------------------------------------------------------->
    <div class="chat__message chat__message--to-me">
        <!--접속자와 작성자가 다르면 흰 바탕 -->
        @if($comment['commentImg'])
        <img src="{{$comment['commentImg']}}" class="chat__message-avatar"> @else
        <img src="{{asset('img/person-icon.png')}}" class="chat__message-avatar"> @endif

        <div class="chat__message-center">
            <h3 class="chat__message-username">{{$comment['writer']}}</h3>
            <span class="chat__message-body">
                {{$comment['content']}}
            </span>
        </div>
        <span class="chat__message-time"> {{ $comment['created_at']->diffForHumans() }}
    </div>

    @endif
    @endforeach
    @endif
</main>

<form class="comment" method="post" action="{{route('board.comment.store',['board' => $msg['postid']])}}" id="comment">
    @csrf
        <div class="type-message">
            <i class="fa fa-plus fa-lg"></i>
            <div class="type-message__input">
                <input type="text" name="comments">
                <i class="fa fa-smile-o fa-lg"></i>
                
                <button type="submit" class="comment_btn btn btn-primary">
                    <i class="fas fa-comment"></i>
                    <input type="hidden" name="postnum" value="{{$msg['postid']}}">
                    <input type="hidden" name="writer" value="{{\auth::user()->nickname}}">
                </button>
            </div>
        </div>
    </form>

    <script>
    </script>
@endsection

@section('nav-bottom')
    @include('Components.nav-bottom')
@endsection