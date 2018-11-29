@extends('layouts.master') 
@section('title') profile
@endsection
 
@section('head')
  @include('components.head')
@endsection


@section('profile')
<header class="top-header top-header--transparent">
  <div class="header__bottom">
    <div class="header__column">
      <a href="index.php">
          <i class="fa fa-times fa-lg"></i>
        </a>
    </div>
    <div class="header__column">

    </div>
    <div class="header__column">
      <i class="fa fa-user fa-lg"></i>
    </div>
  </div>
</header>
<main class="profile">
  <header class="profile__header">
    <div class="profile__header-container">
      <img src="{{$profile['profileImg']}}" alt="">
      <h3 class="profile__header-title">{{$profile['nickname']}}</h3>
    </div>
  </header>
  <div class="profile__container">
    {{$profile['email']}}
    <div class="profile__actions">
      <div class="profile__action">
        <span class="profile__action-circle">
              <i class="fa fa-comment fa-lg"></i>
          </span>
        <span class="profile__action-title">My Chatroom</span>
      </div>
      <div class="profile__action">
        <span class="profile__action-circle">
           <i class="far fa-circle"></i>
          </span>
        <a href="{{url('profileEdit')}}" class="profile__action-title">Edit Profile</a>
      </div>
    </div>
  </div>
</main>
@endsection