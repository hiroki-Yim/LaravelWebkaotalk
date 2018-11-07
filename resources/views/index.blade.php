@extends('kakaoView.main')

@section('title')
    Friends!
@endsection

@section('head')
    @include('Components.head')
@endsection

@section('header-top')
    @include('Components.header-top')
@endsection 

@section('loginmodal')
    @include('Components.loginmodal')
@endsection

@section('mainContent') <!-- 메인 컨텐츠  -->
<div class="header__bottom">
      <div class="header__column">
        <div class="navbar">
      @if(!\Auth::check())
        <a onclick="$('#login_btn').css('display', 'block')" style="width:auto;">
        <span class="header__text">Login</span>
        </a>
      @else
        <form method="post" action="{{route('logout')}}" id='logout_btn'>
            @csrf
            <span class="header__text" style="text-decoration:none;">
           <a onclick="$('#logout_btn').submit();">Logout</a>
            </span>
        </form>
      @endif
        </div>
      </div>

      <div class="header__column">
        <span class="header__text">Friends<span class="header__number">1</span></span>
      </div>
      <div class="header__column">
        <i class="fa fa-cog fa-lg"></i>
      </div>
    </div>
  </header>

  <main class="friends">
    <div class="search-bar">
      <!-- <i class="fa fa-search"></i> -->
      <input type="text" placeholder="Find friends, chats, Plus Friends">
    </div>
    @if(\Auth::user())
    <section class="friends__section">
      <header class="friends__section-header">
        <h6 class="friends__section-title">My Profile</h6>
      </header>
      <div class="friends__section-rows">
        <div class="friends__section-row">
            <img src="{{asset('img/person-icon.png')}}" alt="">
            <a href="profile.php" class="fiends__section-name">
                    {{ Auth::user()['name'] }}
            </a>
        </div>
        {{-- <div class="friends__section-row">
          <img src="images/person-icon.png" alt="">
          <span class="fiends__section-name">공기친구</span>
        </div> --}}
      </div>
    </section>
    @endif
    <section class="friends__section">
      <header class="friends__section-header">
        <h6 class="friends__section-title">Friends</h6>
      </header>
      <div class="friends__section-rows">
        <div class="friends__section-row with-tagline">
          <div class="friends__section-column">
              <img src="{{asset('img/person-icon.png')}}" alt="">
              <span class="friends__section-name">공기친구</span>
          </div>
          <span class="friends__section-tagline">
            술마실사람
          </span>
        </div>
      </div>
    </section>
  </main>
@endsection

@section('footer')
    @include('Components.footer')
@endsection