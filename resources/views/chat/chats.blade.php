@extends('layouts.master')  {{-- 메인상속 --}}

@section('title')
  Chats
@endsection

@section('head')
  @include('components.head')
@endsection

    @section('header-top')
      @include('components.header-top')
    @endsection

    @section('chatsContent')  {{--Start ChatContents--}}
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
  <main class="chats">
    <div class="search-bar">
      <i class="fa fa-search"></i>
      <input type="text" placeholder="Find friends, chats, Plus Friends">
    </div>
    <ul class="chats__list">
      
        <li class="chats__chat">
          <a href="chat.php">
            <div class="chat__content">
              <img src="{{asset('img/person-icon.png')}}">
              <div class="chat__preview">
                <h3 class="chat__user">Lynn</h3>
                <span class="chat__last-message">Hello! This is a test message!</span>
              </div>
            </div>
            <span class="chat__date-time">
              15:55
            </span>
          </a>
        </li>
        <li class="chats__chat">
          <a href="chat.php">
            <div class="chat__content">
              <img src="{{asset('img/person-icon.png')}}">
              <div class="chat__preview">
                <h3 class="chat__user">KakaoTalk</h3>
                <span class="chat__last-message">You logged into KakaoTalk PC</span>
              </div>
            </div>
            <span class="chat__date-time">
              Jul 29
            </span>
          </a>
        </li>
    </ul>
    <div class="chat-btn">
      <i class="fa fa-comment"></i>
    </div>
  </main>
  @endsection {{-- end ChatsContents --}}

@section('nav-bottom')  {{-- 공동 Components Footer --}}
  @include('components.nav-bottom')
@endsection