@extends('layouts.master')
@section('title')
  findBoard
@endsection

@section('head')
  @include('components.head')
  <link rel="stylesheet" href="{{asset('css/write_modify.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-material-design/css/mdb.min.css')}}">
@endsection

@section('header-top')
  @include('components.header-top')
@endsection

@section('moreContent')
    <div class="header__bottom">
      <div class="header__column">

      </div>
      <div class="header__column">
        <span class="header__text">More</span>
      </div>
      <div class="header__column">
        <i class="fa fa-cog fa-lg"></i>
      </div>
    </div>
  </header>
  <main class="more">
    <header class="more__header">
      <div class="more-header__column">
        @if(!Auth::user()['profileImg'])
        <img src="{{asset('img/person-icon.png')}}" alt="">
        @else
        <img src="{{auth::user()['profileImg']}}" alt="">
        @endif
        <div class="more-header__info">
          <h3 class="more-header__title">
            @if(Auth::user()['nickname'])
            {{Auth::user()['nickname']}}
            @else
            geust
            @endif
          </h3>
          <span class="more-header__subtitle">
          {{ Auth::user()['email'] }}
          </span>
        </div>
      </div>
      <i class="fa fa-comment-o fa-2x"></i>
    </header>
    <section class="more__options">
      <div class="more__option">
          <i class="fa fa-smile-o fa-2x"></i>
          <span class="more__option-title">Emoticons</span>
      </div>
      <div class="more__option">
          <i class="fa fa-paint-brush fa-2x"></i>
          <span class="more__option-title">Themes</span>
      </div>
      <div class="more__option">
          <i class="fa fa-hand-peace-o fa-2x"></i>
          <span class="more__option-title">Plus Friend</span>
      </div>
      <div class="more__option">
          <i class="fa fa-user-circle-o fa-2x"></i>
          <span class="more__option-title">Account</span>
      </div>
    </section>
    <section class="more__plus-friends">
      <header class="plus-friends__header">
        <h2 class="plus-friends__title">Plus Friends</h2>
        <span class="plus-friends__learn-more">
          <i class="fa fa-info-circle"></i>
          Learn More
        </span>
      </header>
      <div class="plus-friends__items">
        <div class="plus-friends__item">
            <i class="fa fa-cutlery"></i>
            <span class="plus-friends__item-title">Order</span>
        </div>
        <div class="plus-friends__item">
            <i class="fa fa-home"></i>
            <span class="plus-friends__item-title">Store</span>
        </div>
        <div class="plus-friends__item">
            <i class="fa fa-television"></i>
            <span class="plus-friends__item-title">TV Channel/Radio</span>
        </div>
        <div class="plus-friends__item">
            <i class="fa fa-pencil"></i>
            <span class="plus-friends__item-title">Creation</span>
        </div>
        <div class="plus-friends__item">
            <i class="fa fa-graduation-cap"></i>
            <span class="plus-friends__item-title">Education</span>
        </div>
        <div class="plus-friends__item">
            <i class="fa fa-university"></i>
            <span class="plus-friends__item-title">Politics/Society</span>
        </div>
        <div class="plus-friends__item">
            <i class="fa fa-krw"></i>
            <span class="plus-friends__item-title">Finance</span>
        </div>
        <div class="plus-friends__item">
            <i class="fa fa-video-camera"></i>
            <span class="plus-friends__item-title">Movies/Music</span>
        </div>
      </div>
    </section>
    <section class="more__links">
      <div class="more__option">
          <img src="images/kakaoStory.png" alt="" class="more__options-image">
          <span class="more__options-title">Kakao Story</span>
      </div>
      <div class="more__option">
          <img src="images/path.png" alt="" class="more__options-image">
          <span class="more__options-title">Path</span>
      </div>
      <div class="more__option">
          <img src="images/kakaoFriends.png" alt="" class="more__options-image">
          <span class="more__options-title">kakao friends</span>
      </div>
    </section>
  </main>
  @endsection

  @section('nav-bottom')
    @include('components.nav-bottom')
  @endsection