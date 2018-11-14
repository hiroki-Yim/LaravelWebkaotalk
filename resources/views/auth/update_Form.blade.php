<?php
session_start();
require_once("../../Model/MemberDao.php");
require_once("../../config/tools.php");
$id = session_exist('id'); // 로그인 된 사용자의 정보를 가져온다.
$mdao = new MemberDao(); // DB에 접속한다.
$account = $mdao->getMember("id",$id); // DB에서 해당 사용자의 정보를 읽어온다. 그 것을 변수 $account에 저장
?>
<!DOCTYPE html>
<html lang="kr" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>회원정보 수정 페이지</title>
  <link rel="stylesheet" type="text/css" href="../../public/css/registerForm.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/innks/NanumSquareRound/master/nanumsquareround.min.css">
</head>

<body>
  <form id="msform" method="post" action="../../Controller/update.php">
  @csrf
    <fieldset>
      <!-- 저장된 데이터 중 해당 ID에 대한 칼럼을 1차원 배열로 가져와서 폼에 넣어 준다. -->
      <h2 class="fs-title">UPDATE your account</h2>학번
      <input type="tel" maxlength="7" pattern="[0-9]{7}" name="id" value="<?= $account["id"] ?>" readonly> 비밀번호
      <input type="password" maxlength="15" name="pwd" pattern=".{6,}" title="6자 이상 입력 해 주세요!" value="<?= $account["pwd"] ?>" placeholder="비밀번호 6자 이상" required>
      <input type="password" maxlength="15" name="cpwd" placeholder="비밀번호 재확인" required> 이름
      <input type="text" maxlength="10" name="name" placeholder="ex)홍길동" value="<?= $account["name"] ?>" required> 이메일
      <input type="text" name="mail" placeholder="exemple@google.com" value="<?= $account["mail"] ?>" required> 전화번호
      <input type="text" name="phone" placeholder="010-1234-5678" value="<?= $account["phone"] ?>" required>
      <input type="submit" class="submit action-button" value="UPDATE" />
    </fieldset>
  </form>
</body>

</html>