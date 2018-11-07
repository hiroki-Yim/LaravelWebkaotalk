<?php 

// require_once('../../Model/boardDao.php');
// require_once('../../config/config.php');
// require_once('../../config/tools.php');
// session_start();
// $sid = session_exist('id');
// $dao = new boardDao();                                                                                 
// $currentPage = requestValue("page"); 
// $totalCount = $dao->getNumMsgs();
/*클래스 위에 use App\Board; */
/*=> Board::orderBy('created_at', 'desc')->paginate(5);*/

//   if($totalCount > 0){
//   $totalPages = ceil($totalCount/NUM_LINES);                            
//   if($currentPage < 1){ $currentPage = 1; }
//   if($currentPage > $totalPages){ $currentPage = $totalPages; }

//   $start = ($currentPage - 1) * NUM_LINES;
//   $msgs = $dao->getManyMsgs($start, NUM_LINES);                        

//   $startPage = floor(($currentPage-1)/NUM_PAGE_LINKS)*NUM_PAGE_LINKS+1;
//   $endPage = $startPage + NUM_PAGE_LINKS - 1;                          

//   if($endPage > $totalPages){ $endPage = $totalPages; }                 
//   if($startPage == 1){ $prev = true; }                                  
//   if($endPage > $totalPages){ $next = true; }                          

//   $startRecord = floor(($currentPage-1)/NUM_LINES);

// }
// else{}

?>
  @extends('kakaoView.main')
  @section('title')
    board
  @endsection

  @yield('head')
  <link rel="stylesheet" href="../../public/css/write_modify.css">
  <link rel="stylesheet" href="../../../bower_components/bootstrap-material-design/css/mdb.min.css">
  <title>board</title>
</head>

<body>
  <header class="top-header">
  @yield('haeder-top')
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

<!-- <div>
  <button type="submit" onclick="location.href='../../Controller/getTitle.php?param=test'"></button>
</div> -->

  <main class="chats">
    <div class="search-bar">
      <i class="fa fa-search"></i>
      <input type="text" placeholder="게시글을 검색해 보세요" id="search-bar">
      
    </div>
    <ul class="chats__list">
    @forelse($msgs as $row)
        <li class="chats__chat">
        <a href="{{url('kakaoView/board/views')}}">
          
          bdUrl("views.php", $row["Num"], $currentPage)

            <div class="chat__content">
              <img src="images/person-icon.png">
              <div class="chat__preview">
                <h3 class="chat__user"><?= $row["Title"]?></h3>
                <span class="chat__last-message"><?= $row["Writer"]?></span>
              </div>
            </div>
            <span class="chat__date-time">
            <?= passing_time($row["Regtime"]); ?>
            <br>
            <br>
            Hits : <?= $row["Hits"]?>
            </span>

            
          </a>
        </li>
    @empty
    <p>there is no board</p>
    @endforelse
    
    </ul>
    <div class="chat-btn" onclick="location.href='<?= bdUrl('write_Form.php',0, $currentPage) ?>'">
      <i class="fa fa-comment"></i>
    </div>

<ul class="pagination pg-dark wrapperboard">
    @if($startPage > 1)
    <li class="page-item">
    <a class="page-link" href="<?= bdUrl("board.php", 0, $currentPage - NUM_PAGE_LINKS) ?>">
    <span aria-hidden="true">&laquo;</span>
      <span class="sr-only">previous</span>
    </a>
    </li>
    @endif

        @for ($i = $startPage; $i <= $endPage; $i++)
        @if($i == $currentPage)
        <li class="page-item active">
        <a class="page-link" href="<?php bdUrl("board.php", 0, $i) ?>">
            now<?php $i ?>
        </a>
        </li>
        @else
        <li class="page-item">
        <a class="page-link" href="<?= bdUrl("board.php", 0, $i) ?>">
          <?= $i ?></a>&nbsp;
        </li> 
        @endif
        @endfor

        @if($endPage < $totalPages)
        <li class="page-item ">
        <a class="page-link" aria-label="Next" href="<?= bdUrl("board.php", 0, $currentPage + NUM_PAGE_LINKS) ?>">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
        </a>
        </li> 
        </ul>
        @endif
  </main>
@yield('footer')