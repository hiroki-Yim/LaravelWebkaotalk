{{$user->nickname}}님 가입을 환영합니다.
<br>웹카오톡 이용을 위해 다음 링크로 이동하여 주세요.<br>
<a href="{{route('register.confirm', $user->confirm_code)}}">{{route('register.confirm', $user->confirm_code)}}</a>

{{-- 메일 발송 시 표시되는 blade --}}