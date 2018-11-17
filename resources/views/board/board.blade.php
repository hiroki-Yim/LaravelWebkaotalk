@extends('layouts.master')

  @section('title')
    board
  @endsection

  @section('head')
    @include('components.head')
    <link rel="stylesheet" href="{{asset('css/write_modify.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-material-design/css/mdb.min.css')}}">
  @endsection
  
  @section('header-top')
    @include('components.header-top')
  @endsection

  @section('boardContent')
    <div class="header__bottom">
      <div class="header__column">
        <span class="header__text">create</span>
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
    <i class="fa fa-search"></i>
    <input type="text" placeholder="게시글을 검색해 보세요" id="search-bar">
    
  </div>
  <ul class="chats__list">
  @forelse($msgs as $row)
      <li class="chats__chat">
      <a href="{{url('user')}}/{{ $row['postid'] }}">
          <div class="chat__content">
          @if($row->profileImg)
            <img src="{{$row['profileImg']}}">
          @else
            <img src="{{asset('img/person-icon.png')}}">
          @endif
            <div class="chat__preview">
              <h3 class="chat__user">{{ $row['title']}}</h3>
            <span class="chat__last-message">{{$row->author}}</span>
            </div>
          </div>
          <span class="chat__date-time">
          
            {{passing_time($row->created_at)}}
          <br>
          <br>
          Hits : {{$row['viewCount']}}
          </span>
        </a>
      </li>
  @empty
  <p>there is no board</p>
  @endforelse

  <div class="chat-btn">
  <i class="fa fa-comment"></i>
  </div>
  </ul>
  <script>
  $('.chat-btn').click(function(){
    location.href="{{route('board.create')}}";
  });
  </script>



  <!-- 
  
<ul class="pagination pg-dark wrapperboard">
  {{$msgs->links()}}
  {{-- @if($startPage > 1) --}}
  <li class="page-item">
  <a class="page-link" href="<? //bdUrl("board.php", 0, $currentPage - NUM_PAGE_LINKS) ?>">
  <span aria-hidden="true">&laquo;</span>
    <span class="sr-only">previous</span>
  </a>
  </li>
  {{-- @endif --}}

      {{-- @for ($i = $startPage; $i <= $endPage; $i++) --}}
      {{-- @if($i == $currentPage) --}}
      <li class="page-item active">
      <a class="page-link" href="<?php //bdUrl("board.php", 0, $i) ?>">
          now<?php //$i ?>
      </a>
      </li>
      {{-- @else --}}
      <li class="page-item">
      <a class="page-link" href="<? //bdUrl("board.php", 0, $i) ?>">
        <? $i ?></a>&nbsp;
      </li> 
      {{-- @endif
      @endfor --}}

      {{-- @if($endPage < $totalPages) --}}
      <li class="page-item ">
      <a class="page-link" aria-label="Next" href="<? //bdUrl("board.php", 0, $currentPage + NUM_PAGE_LINKS) ?>">
      <span aria-hidden="true">&raquo;</span>
      <span class="sr-only">Next</span>
      </a>
      </li> 
      </ul> -->
      {{-- @endif --}}
</main>
@endsection

@section('nav-bottom')
    @include('Components.nav-bottom')
@endsection 