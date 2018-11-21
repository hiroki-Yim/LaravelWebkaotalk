@extends('layouts.master')

@section('title')
board.view
@endsection

@section('head')
@include('Components.head')
<script src="{{asset('js/view.js')}}"></script>
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
        <i class="fas fa-eye"></i>
        {{ $viewCount }}
    </div>


    @if($msg['author'] == Auth::user()['nickname'])
    {{--현재 접속자와 글쓴이와 동일하면 노란박스--}}
    <div class="chat__message chat__message-from-me">
        <span class="chat__message-time">
            {{ passing_time($msg["created_at"]) }} </span>
        <span class="chat__message-body">
            {{$msg["content"]}}
            {{--
            @foreach($result as $files)
            @if($files['file_name'])

            {{$filenames = $files['file_name']}}
            {{$file_url = $files['file_url']}}

            <br>
            첨부파일 :

            <a href="../../Controller/downloadFile.php?filenames={{$filenames}}&num={{$num}}&file_url={{$file_url}}">
                {{$files['file_name']}} </a>
            <br>

            @else

            <br>
            @endforeach
            --}}
            @if($msg['author'] == Auth::user()['nickname'])
            <br>
            <input type="button" class="btn btn-success" value="수정하기" onclick="location.href='{{$msg['postid']}}/edit'">
            <script>
                function delReq(){ // 삭제할 경우 삭제를 확인을 받기 위해 deleteRequest함수를 만듦
                    var yn = confirm("정말 삭제 하시겠습니까?");
                    if (yn == true){ return true; } // 아니오를 눌렀을 시 아무 반응 하지않게 함
                    else { return false; }
                }
            </script>
            <form action="{{route('board.destroy', ['board' => $msg['postid']]) }}" method="POST" onsubmit="return delReq();">
                @csrf
                @method('delete')
                <input type="submit" class="btn btn-dangerous" value="삭제하기" onclick='delReq()'>
            </form>


            <input type="hidden" name="postid" value="{{$msg['postid']}}">
            {{-- <form action="{{route('board.destroy'),$msg['postid']}}" method="post">
                @csrf
                <input type="button" class="delete" value="삭제하기">
            </form> --}}
            <!-- <i class="fas fa-trash-alt"></i> -->
            @endif
        </span>
    </div>
    @endif
    <!------------------------------------------------------------------------------------------------------------>
    @if($msg['author'] != Auth::user()['nickname']) {{--현재 접속자와 글쓴이와 다르면 하얀박스--}}
    <div class="chat__message chat__message--to-me">

        <img src="images/person-icon.png" class="chat__message-avatar">
        <div class="chat__message-center">
            <h3 class="chat__message-username"> {{$msg['author']}}</h3>
            <span class="chat__message-body">
                {{$msg["content"]}}
                {{-- @foreach($result as $files)

                @if($files['file_name'])
                {{$filenames = $files['file_name']}}
                {{$file_url = $files['file_url']}}
                <br>
                첨부파일 :
                <a href="../../Controller/downloadFile.php?filenames= {{$filenames}} &num= {{$num}} &file_url= {{$file_url}} ">
                    {{$files['file_name']}} </a>
                <br>
                @else

                <br>
                @endforeach
                --}}
            </span>
        </div>
        <span class="chat__message-time"> {{passing_time($msg["Regtime"])}} </span>
    </div>
    @endif
    <!------------------------------------------------------------------------------------------------------------>


    @if($comments)
    @foreach($comments as $comment)
    @if($comment['writer'] == $sid)
    <div class="chat__message chat__message-from-me">
        <span class="chat__message-time">{{passing_time($comment['regtime'])}} </span>
        <span class="chat__message-body">
            {{$comment['contents']}}

        </span>
        <a href="../../Controller/deleteComment.php?commentNum={{$comment['num']}}&author={{$comment["author"]}}&num={{$num}}&page={{$page}}"
            style="color:black;">☒</a></span>
    </div>

    @else
    <!-------------------------------------------------------------------------------------------------------------->
    <div class="chat__message chat__message--to-me">
        <!--접속자와 작성자가 다르면 흰 바탕 -->
        <img src="images/person-icon.png" class="chat__message-avatar">
        <div class="chat__message-center">
            <h3 class="chat__message-username">{{$comment['writer']}}</h3>
            <span class="chat__message-body">
                {{$comment['contents']}}
            </span>
        </div>
        <span class="chat__message-time"> {{passing_time($comment['regtime'])}}
    </div>

    @endif
    @endforeach
    @endif
    <form class="comment" method="post" action="" style="margin-bottom:50px">
        <div class="type-message">
            <i class="fa fa-plus fa-lg"></i>
            <div class="type-message__input">
                <input type="text" name="comments">
                <i class="fa fa-smile-o fa-lg"></i>

                <button type="submit" class="comment_btn btn btn-primary">
                    <i class="fas fa-comment"></i>
                    <input type="hidden" name="postnum" value="">
                </button>
            </div>
        </div>
    </form>
</main>


@endsection


@section('nav-bottom')
@include('Components.nav-bottom')
@endsection
