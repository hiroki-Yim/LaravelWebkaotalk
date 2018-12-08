@extends('layouts.master') 
@section('title') board
@endsection
 
@section('head')
    @include('components.head')
<link rel="stylesheet" href="{{asset('css/write_modify.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/bootstrap-material-design/css/mdb.min.css')}}">
<script src="{{asset('bower_components/jscroll/dist/jquery.jscroll.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-material-design/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/moment.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
 
@section('header-top')
    @include('components.header-top')
@endsection
 
@section('login')
    @include('auth.login')
@endsection
 
@section('boardContent')
<div class="header__bottom">
    <div class="header__column">
        <span class="header__text" id="postedNum">등록된 게시글</span>
    </div>
    <div class="header__column">
        <span class="header__text">게시글 리스트</span>
    </div>
    <div class="header__column">

    </div>
</div>
</header>
<!-- {{-- 
<div>
  <button type="submit" onclick="location.href='../../Controller/getTitle.php?param=test'"></button>
</div> --}} -->

<main class="chats">
    <div class="search-bar">
        <!-- <i class="fa fa-search"></i> -->
        <input type="text" placeholder="게시글을 검색해 보세요" id="search-bar">

    </div>
    <ul class="chats__list">
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <div class="infinite-scroll">
            @forelse($msgs as $row)
            <li class="chats__chat">
                <a href="{{route('board.show' , ['postid'=>$row['postid']])}}">
                    <div class="chat__content">
                        @if($row->profileImg)
                        <img src="{{$row['profileImg']}}"> @else
                        <img src="{{asset('img/person-icon.png')}}"> @endif
                        <div class="chat__preview">
                            <h3 class="chat__user">{{ $row['title']}}</h3>
                            <span class="chat__last-message">{{$row->author}}</span>
                        </div>
                    </div>
                    <span class="chat__date-time">
                        {{ $row['created_at']->diffForHumans()}}
                        <br>
                        <br>
                        Hits : 
                        @if($row->hits)
                        {{$row->hits}}
                        @else
                        {{0}}
                        @endif
                    </span>
                </a>
            </li>
            @empty @endforelse {{$msgs->links()}}
        </div>
    </ul>
    <div class="chat-btn">
        <i class="fa fa-comment"></i>
    </div>
    <script>
        $('.chat-btn').click(function () {
            location.href = "{{route('board.create')}}";
        });
    </script>
    <script src="{{asset('js/find.js')}}"></script><!-- Title 검색기능 스크립트 -->
    <script>
        $('ul.pagination').hide();
                $(function () {
                    $('.infinite-scroll').jscroll({
                        autoTrigger: true,
                        loadingHtml: '<img class="center-block" src="{{asset("img/loading.gif")}}" alt="Loading... " />', // MAKE SURE THAT YOU PUT THE CORRECT IMG PATH
                        padding: 0,
                        nextSelector: '.pagination li.active + li a',
                        contentSelector: 'div.infinite-scroll',
                        callback: function () {
                            $('ul.pagination').remove();
                        }
                    });
                });
    </script><!-- 무한페이지네이션 구현 -->
</main>
@endsection
 
@section('nav-bottom')
    @include('Components.nav-bottom')
@endsection