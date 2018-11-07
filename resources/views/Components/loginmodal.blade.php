  <!-- The Modal -->
  <div id="login_btn" class="modal">
    <span onclick="document.getElementById('login_btn').style.display='none'" class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
    <form class="modal-content animate" action="{{route('login')}}" method="post">
      @csrf
      <div class="imgcontainer">
        <img src="{{asset('img/avatar.png')}}" alt="Avatar" class="avatar">
      </div>    
      <div class="container wrapper">
        <b>이메일</b>
        <input type="text" placeholder="학번" name="email" required>
        <b>비밀번호</b>
        <input type="password" placeholder="비밀번호" name="password" required>
        <button type="submit">로그인</button>
      </div>
    </form>
    <a class="pwd cancelbtn" href="{{url('registerForm')}}">아직 회원이 아니세요?</a>
  </div>