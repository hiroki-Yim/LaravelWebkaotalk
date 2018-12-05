@extends('layouts.master') {{-- 메인상속 --}} 
@section('title') Chats
@endsection
 
@section('head')
  @include('components.head')
@endsection
 
@section('header-top')
  @include('components.header-top')
@endsection
 
@section('chatsContent') {{--Start ChatContents--}}
<div class="header__bottom">
  <div class="header__column">
    <span class="header__text">Edit</span>
  </div>
  <div class="header__column">
    <span class="header__text">Chats <i class="fa fa-caret-down"></i></span>
  </div>
  <div class="header__column">

  </div>
</div>
</header>
<!-- endof header -->


<main class="chats">
  <div class="search-bar">
    <!-- <i class="fa fa-search"></i> -->
    <input type="text" placeholder="Find friends, chats, Plus Friends">
  </div>

  <ul class="chats__list">
    @forelse($friends as $friend)
    <li class="chats__chat">
      <a href="{{url('chatting')}}">
        <div class="chat__content">
          <img src="{{asset('img/person-icon.png')}}">
          <div class="chat__preview">
            <h3 class="chat__user">{{$friend->nickname}}</h3>
            <span class="chat__last-message">Hello! This is a test message!</span>
          </div>
        </div>
        <span class="chat__date-time">
              11:11
            </span>
      </a>
    </li>
    @empty
    <li class="chats__chat">You don't have any friends</li>
    @endforelse
  </ul>

  <div class="chat-btn">
    <i class="fa fa-comment"></i>
  </div>
</main>
@endsection
 {{-- end ChatsContents --}} 
@section('nav-bottom') {{-- 공동 Components Footer --}}
  @include('components.nav-bottom')
@endsection