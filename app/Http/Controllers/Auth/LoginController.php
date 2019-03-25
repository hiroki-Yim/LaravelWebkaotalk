<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    public function store()
    {
        //로그인 검증
        return redirect()->intended('board'); // 로그인 하면 내가 요청했던 곳으로 감
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('message', 'ありがとうございました。');
    }
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user['activated'] == false) {
            \Mail::send('auth.registerEmail', compact('user'), function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('[Webkaotalk] 회원 가입을 확인한 뒤 이용하세요.');
            });
            return redirect('/')
                ->with('message', '인증코드가 재발급 되었습니다. 등록하신 이메일에서 확인해주세요.');
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/');
        } else {
            return redirect('/')->with('message', '존재하지 않는 아이디 이거나 비밀번호를 확인 해 주세요!');
        }
    }
}
