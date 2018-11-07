<?php 
  // require_once('../../Model/MemberDao.php');
  // require_once('../../config/tools.php');
?>

<!DOCTYPE html>
<html lang="kr" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>회원가입 페이지</title>
  
  <?php // require_once('./html_head.php'); ?>
  @section('head')
    @include('Components.head')
  @endsection

<link rel="stylesheet" type="text/css" href="{{asset('css/registerForm.css')}}" />
  
</head>
<body>
  <form id="msform" method="post" action="../../Controller/register.php">
    <fieldset>
      <h2 class="fs-title">Create your account</h2>
        아이디(이메일 형식)
      <input type="email" pattern="(\w+\.)*\w+@(\w+\.)+[A-Za-z]+" name="email" title="이메일 형식으로 입력해 주세요!" placeholder="ex)exemple@google.com"
        required> 
        비밀번호
      <input type="password" maxlength="15" name="password" pattern=".{6,}" title="6자 이상 입력 해 주세요!" placeholder="비밀번호 6자 이상"
        required>
      <input type="password" maxlength="15" name="cpwd" placeholder="비밀번호 재확인" required> 
      이름
      <input type="text" maxlength="10" name="name" placeholder="ex)홍길동" required> 
      전화번호
      <input type="text" name="phone" placeholder="010-1234-5678" required>  
      <p id="horizon_boxing">성별
        <hr/>
        <input class="hidden_btns" type="radio" id="male_btn" name="gender" value="0" required />
        <label for="male_btn">
          <div class="gender">남성</div>
        </label>
        <input class="hidden_btns" type="radio" id="female_btn" name="gender" value="1" required />
        <label for="female_btn">
          <div class="gender">여성</div>
        </label>
      </p>
      <input type="submit" class="submit action-button" value="Submit" />
    </fieldset>
  </form>
</body>
</html>