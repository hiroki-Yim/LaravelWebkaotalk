@extends('layouts.master')

@section('title')
Friends!
@endsection

@section('head')
@include('Components.head')
<script src="{{asset('js/modal.js')}}"></script>
@endsection

@section('header-top')
@include('Components.header-top')
@endsection

@section('login')
@include('auth.login')
@endsection

@section('mainContent')
<!-- 메인 컨텐츠  -->
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
    <section class="friends__section">
        <header class="friends__section-header">
            <h6 class="friends__section-title">My Profile</h6>
        </header>
        <div class="friends__section-rows">
            <div class="friends__section-row with-tagline">
                <div class="friends__section-column">
                    @if(Auth::check() && Auth::user()['profileImg'])
                    <img src="{{Auth::user()['profileImg']}}" alt="">
                    <a href="profile" class="fiends__section-name">
                        {{ Auth::user()['nickname'] }}
                        @elseif(Auth::check() && !Auth::user()['profileImg'])
                        <img src="{{asset('img/person-icon.png')}}" alt="">
                        <a href="profile" class="fiends__section-name">
                            {{ Auth::user()['nickname'] }}
                            @else
                            <img src="{{asset('img/person-icon.png')}}" alt="">
                            <a href="profile" class="fiends__section-name">
                                guest
                                @endif
                            </a>

                </div>
                <span class="friends__section-tagline">
                    텀프로젝트 웹카오톡
                </span>
            </div>
        </div>
    </section>
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

@section('nav-bottom')
@include('Components.nav-bottom')
@endsection 