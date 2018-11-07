
<?php
session_start();
require_once("../../config/tools.php");
require_once("../../Model/boardDao.php");
$sid = session_exist('id'); 
if(!$sid){  // 만약 로그인 되어있지 않으면 error발생
  errorBack("로그인 한 뒤에 볼 수 있습니다.");
}else{      // 로그인 되어 있으면 정보를 가져와서 렌더링 해줌
  $num = requestValue("num");     // 현재 게시글의 번호 Num을 게시글로 부터 받
  $page = requestValue("page");
  $bdao = new boardDao();
  $prenex = $bdao->prenex($num); // 이전 글과 다음 글의 정보를 가져오기 위해 db 2차원 배열 형태로 가져옴
  $msg = $bdao->getMsg($num);    // 현재 글 번호에 맞춰 DB에 저장된 글을 가지고 옴(1차원 배열로)
  $bdao->increaseHits($num);     // 현재 글의 조회수를 1증가 시키는 메서드 호출
  $result = $bdao->getFile($num);
  $comments = $bdao->getComment($num);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once('./html/head.php'); ?>
  
  <title>Views</title>
  <link rel="stylesheet" href="css/style.css">
    <script src="../../public/js/tools.js"></script>
    <script src="../../public/js/view.js"></script>  
</head>


<body class="body-chat">
  <header class="top-header chat-header">
    <?php require_once('./html/header_top.php'); ?>
    <div class="header__bottom">
      <div class="header__column">
        <a onclick="locationView('board',<?= $page ?>);">
          <i class="fa fa-chevron-left fa-lg"></i>
        </a>
      </div>
      <div class="header__column">
        <span class="header__text">Title:<?= $msg["Title"] ?></span>
        <br>
      </div>
      <div class="header__column">
        <i class="fa fa-search"></i>
        <i class="fa fa-bars"></i>
      </div>
    </div>
  </header>
  <main class="chat">
    <div class="date-divider">
      <span class="date-divider__text" style="font-size=1em;">Author : <?= $msg["Writer"] ?></span>
        <br>
        <i class="fas fa-eye"></i>
        <?= $msg["Hits"] ?>
    </div>
    
    
    <?php if($sid == $msg['Writer']) : //현재 접속자와 글쓴이와 동일하면 노란박스 ?>
    <div class="chat__message chat__message-from-me">
      <span class="chat__message-time"><?= passing_time($msg["Regtime"]); ?></span>
      
      <span class="chat__message-body">
        <?= $msg["Content"] ?>
        <?php foreach ($result as $files) :?>
        <?php if($files['file_name']){
        $filenames = $files['file_name'];
        $file_url = $files['file_url'];
        
        ?>
        <br>
        첨부파일 : 
        <a href="../../Controller/downloadFile.php?filenames=<?= $filenames ?>&num=<?= $num ?>&file_url=<?= $file_url ?>"> <?=$files['file_name']; ?> </a>
         <br>
        <?php
        }else{
          return "";
        } ?>
        <br>
        <?php endforeach ?>
        <?php if($msg['Writer'] == $sid) : ?>
        <br>
    <input type="button" class="btn btn-success" onclick="locationView('modifyForm',<?= $num ?>);" value="수정하기">

      <form action="delete" method="post">
        @csrf
        <input type="button" class="delete" onclick="delReq(<?= $num ?> , <?= $msg['Writer'] ?>, <?= $page ?>);"
        value="삭제하기">
      </form>
      <!-- <i class="fas fa-trash-alt"></i> -->
    <?php endif ?>
      </span>
    </div>
    <?php endif ?> 
<!------------------------------------------------------------------------------------------------------------>
<?php if($sid != $msg['Writer']) : //현재 접속자와 글쓴이와 다르면 하얀박스 ?>
  <div class="chat__message chat__message--to-me">

      <img src="images/person-icon.png" class="chat__message-avatar">
      <div class="chat__message-center">
        <h3 class="chat__message-username"><?= $msg['Writer']; ?></h3>
      <span class="chat__message-body">
        <?= $msg["Content"] ?>
        <?php foreach ($result as $files) :?>
        <?php if($files['file_name']){
        $filenames = $files['file_name'];
        $file_url = $files['file_url'];
        ?>
        <br>
        첨부파일 : 
        <a href="../../Controller/downloadFile.php?filenames=<?= $filenames ?>&num=<?= $num ?>&file_url=<?= $file_url ?>"> <?=$files['file_name']; ?> </a>
         <br>
        <?php }else{ return ""; } ?>
        <br>
        <?php endforeach ?>
      </span>
    </div>
    <span class="chat__message-time"><?= passing_time($msg["Regtime"]); ?></span>
    </div>
    <?php endif ?> 
<!------------------------------------------------------------------------------------------------------------>
        

    <?php if($comments) : ?>
    <?php foreach($comments as $comment) : ?>
    <?php if($comment['writer'] == $sid) : ?>
<div class="chat__message chat__message-from-me">
      <span class="chat__message-time"><?= passing_time($comment['regtime']); ?></span>
      <span class="chat__message-body">
        <?= $comment['contents'] ?>

      </span>
      <a href="../../Controller/deleteComment.php?commentNum=<?= $comment['num'] ?>&writer=<?= $comment["writer"] ?>&num=<?=$num?>&page=<?=$page?>" style="color:black;">☒</a></span>
    </div>

    <?php else : ?>
<!--------------------------------------------------------------------------------------------------------------> 
    <div class="chat__message chat__message--to-me">  <!--접속자와 작성자가 다르면 흰 바탕 -->
      <img src="images/person-icon.png" class="chat__message-avatar">
      <div class="chat__message-center">
        <h3 class="chat__message-username"><?= $comment['writer'] ?></h3>
        <span class="chat__message-body">
        <?= $comment['contents'] ?>
        </span>
      </div>
      <span class="chat__message-time"> <?= passing_time($comment['regtime']); ?>
        </div>
    
        <?php endif ?>
    <?php endforeach ?>
    
    <?php endif ?>

  </main>

    <form class="comment" method="post" action="../../Controller/comment.php?page=<?= $page ?>">
      <div class="type-message">
        <i class="fa fa-plus fa-lg"></i>
        <div class="type-message__input">
        <input type="text" name="comments">
        <i class="fa fa-smile-o fa-lg"></i>
          
          <button type="submit" class="comment_btn btn btn-primary">
            <i class="fas fa-comment"></i>
            <input type="hidden" name="board_num" value="<?= $num ?>">
            </button>
       </div>
      </div>
  </form>
</body>
</html>
