<!-- The Modal -->
<div id="login_btn" class="modal">
    <span onclick="$('#login_btn').css('display', 'none')" class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
    <form class="modal-content animate" action="{{route('login')}}" method="post">
        @csrf
        <div class="imgcontainer">
            <img src="{{asset('img/avatar.png')}}" alt="Avatar" class="avatar">
        </div>
        <div class="container wrapper">
            <b>이메일</b><input type="text" placeholder="Email" name="email" required>
            <b>비밀번호</b><input type="password" placeholder="Password" name="password" required>
            <button type="submit" class="button">로그인</button>
            <a id="kakao-login-btn"></a>
            <a class="pwd cancelbtn" href="{{route('register')}}" style="text-align: center">아직 회원이 아니세요?</a>
            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                    </div>
                </div>

                <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('비밀번호를 잊어버리셨나요?') }}</a>
            </div>
        </div>
    </form>
</div>

<script>
    Kakao.init('2c95436371fe2b214c00944d71b32514');
    // 카카오 로그인 버튼을 생성합니다.
    Kakao.Auth.createLoginButton({
        container: '#kakao-login-btn',
        success: function(authObj) {
            location.href = "{{url('auth/loginForKakao')}}";
            //alert(JSON.stringify(authObj));
        },
        fail: function(err) {
            alert(JSON.stringify(err));
        }
    });
</script> 