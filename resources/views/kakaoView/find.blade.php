<?php 

require_once('../../Model/boardDao.php');
require_once('../../config/config.php');
require_once('../../config/tools.php');
session_start();
$sid = session_exist('id');
$dao = new boardDao();                                                                                 
$currentPage = requestValue("page");
$totalCount = $dao->getNumMsgs();
$msgs = $dao->getAllMessage();   

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once('./html/head.php'); ?>
  <link rel="stylesheet" href="../../public/css/write_modify.css">
  <link rel="stylesheet" href="../../../bower_components/bootstrap-material-design/css/mdb.min.css">
  <title>board</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header class="top-header">
    <?php require_once('./html/header_top.php'); ?>
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

  <ul class ="chats__list">

  
  </ul>


  </main>
  <nav class="tab-bar">
    <a href="index.php" class="tab-bar__tab">
      <i class="fa fa-user"></i>
      <span class="tab-bar__title">Friends</span>
    </a>
    <a href="chats.php" class="tab-bar__tab">
      <i class="fa fa-comment"></i>
      <span class="tab-bar__title">Chats</span>
    </a>
    <a href="board.php" class="tab-bar__tab">
      <i class="fas fa-clipboard-list"></i>
      <span class="tab-bar__title">board</span>
    </a>
    <a href="find.php" class="tab-bar__tab tab-bar__tab--selected">
      <i class="fa fa-search"></i>
      <span class="tab-bar__title">Find</span>
    </a>
    <a href="more.php" class="tab-bar__tab">
      <i class="fa fa-ellipsis-h"></i>
      <span class="tab-bar__title">More</span>
    </a>
  </nav>

<script>
      var isLoading = false;
      $('#search-bar').on("change keyup paste", onSearch);

      function onSearch(e){
      var searchBoard = e.target.value+"%";
      if(searchBoard.length >=2 && !isLoading){
      isLoading = true;  
      console.log(searchBoard);
      
      $.ajax({
        type:"GET",
        url: "../../Controller/getTitle.php?param="+searchBoard,
        dataType: "json",
        error: function(){
          throw new Error("ajax 통신 실패");
        },
        success: function(data){
          console.log(data);
          console.log(data[0].length);
          makeTag(data);
        }
      });
    }//end of if

    }
      function makeTag(data){
        var tag = "";
        if(data[0].length === 0){
          isLoading = false;
          // tag += '<p id = "resultNone"> 결과가 없습니다. </p>';
          $('.chats__chat').html(tag);
          return;
        }
        
        var items = data[0];
        items = !items.length ? [items] : items;
        for(var i = 0; i <items.length; i++){
          if(items[i]){
          tag += "<li class='chats__chat'>" +
                  "<a href=views.php?num="+ items[i].Num +">" + // page=currentpage
                 "<div class='chat__content'>"+
                 "<img src='images/person-icon.png'>"+
                 "<div class='chat__preview'>"+
                 "<h3 class='chat__user'>"+items[i].Title+"</h3>"+
                 "<span class='chat__last-message'>"+items[i].Writer+"</span>"+
                 "</div>"+
                 "</div>"+
                 "<span class='chat__date-time'>"+items[i].Regtime+
                 "<br>"+
                 "<br>"+
                 'Hits : ' + items[i].Hits +
                 "</span>"+
                 "</a>"+
                 "</li>";
                }
        }if(items.length==0){
                  tag += '<p id = "resultNone"> 결과가 없습니다. </p>';
                }
        $('.chats__list').html(tag);

        isLoading = false;
      }
      </script>
</body>
</html>
