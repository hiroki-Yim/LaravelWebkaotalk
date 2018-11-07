<?php
session_start();
require_once("../../config/tools.php");
require_once("../../Model/boardDao.php");

$num = requestValue("num");   // requestValue는 호출한쪽 name을 인자로 받아서 갖고 옴 페이지 num값
$bdao = new boardDao();     //2. 그 값으로 해당하는 게시글을 읽는다.
$row = $bdao->getMsg($num);  //1차원 배열로 받고, 그 배열에 있는 정보들을 []안에 넣어서 읽음
$sid = $_SESSION["id"]??''; // 1. 클라이언트가 송신한 id 값(페이지 번호)을 읽는다.

if($row['Writer']!=$sid){   //row[writer] = 작성자 id
  errorBack("다른 작성자의 글은 수정할 수 없습니다.", "board.php");
}else{                      // 작성자와 세션id가 같으면 페이지 생성

?>
<!DOCTYPE html>
<html>

<head>
  <title>게시글 수정 페이지</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../public/css/write_modify.css">
  <!-- include libraries(jQuery, bootstrap) 라이브러리 적용 -->
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

  <script src="../../bower_components/dropzone/dist/dropzone.js"></script>
  <link rel="stylesheet" href="../../public/css/dropzone.css">

  <!-- include summernote css/js SmartEditor-SUMMERNOTE-서버에서 CSS,JS 가져와서 적용함(CDN) -->
  <link href="../../bower_components/summernote/dist/summernote.css" rel="stylesheet">
  <script src="../../bower_components/summernote/dist/summernote.js"></script>
  <script src="../../public/js/tools.js"></script>
</head>

<body>
  <div class="wrapper">
    <fieldset>
          <!-- 3. 그 게시글 정보를 이용해 html을 동적으로 생성한다. -->
    <form action="../../Controller/modify.php?writer=<?= $row['Writer'] ?>" method="post" class="form">
    @csrf
      <input type="hidden" name="num" value="<?= $row["Num"]?>">
      <!-- 작성자는 보여주면 안되나 값을 넘겨줘야 하니 숨김 -->
      <div class="form-group">
        <label for="title">MODIFY_FORM</label> <!-- label은 id에 반응함 -->
        <input id="title" type="text" class="form-control" name="title" value="<?= $row['Title'] ?>">
      </div>
      <div class="form-group">
        <label for="content">내용</label>
        <textarea class="summernote" id="summernote" name="content"><?= $row['Content'] ?></textarea>
        <button type="submit" class="btn btn-primary" onclick="locationValue('modify')" value="수정하기">수정하기</button> <!-- 원래 상대경로 "location.href='../Controller/modify.php'" -->
        <button type="button" class="btn btn-danger" onclick="locationValue('board')">목록보기</button>
      </div>
    </form>
    </fieldset>
  </div>

  <script src = '../../public/js/summernote_opt.js'></script>

</body>

</html>
<?php } ?>