
@extends('layouts.master')
@section('title')
  findBoard
@endsection

@section('head')
  @include('components.head')
  <link rel="stylesheet" href="../../public/css/write_modify.css">
  <link rel="stylesheet" href="../../../bower_components/bootstrap-material-design/css/mdb.min.css">
@endsection

  @section('header-top')
    @include('components.header-top')
  @endsection


 @section('findContent')
 <div class="header__bottom">
      <div class="header__column">
        <span class="header__text">find</span>
      </div>
      <div class="header__column">
        <span class="header__text">게시글 검색</span>
      </div>
      <div class="header__column">
      </div>
    </div>
  </header>
  <main class="chats">
    <div class="search-bar">
      <i class="fa fa-search"></i>
      <input type="text" placeholder="게시글을 검색해 보세요" id="search-bar">
    </div>
  <ul class ="chats__list">
  </ul>
  </main>
  @endsection

  @section('nav-bottom')
    @include('Components.nav-bottom')
  @endsection

