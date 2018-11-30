<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nickname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'gender' => $data['gender'],
        ]);
    }
    public function register(Request $request){
        $this->validator($request->all())->validate();

        $confirmCode = str_random(60);
        $user = User::create([
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'confirm_code' => $confirmCode,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);

        // email 전송
        \Mail::send('auth.registerEmail', compact('user') , function($message) use($user) {
            $message->to($user->email);
            $message->subject('[Webkaotalk] 회원 가입을 확인한 뒤 이용하세요.');
        });

        //flash('가입하신 메일 계정으로 가입 확인 메일을 보냈습니다. 가입 확인을 한 다음 로그인해 주세요.');
        return redirect('/')->with('message', '가입 확인 메일을 확인해 주세요.');
    }

    public function confirm($code) {
        $user = User::where('confirm_code', $code)->first();
        if(!$user) {
            return redirect('/')->with('message', 'URLが正しくありません。');
        }
        $user->activated = true;
        $user->confirm_code = null; //확인코드 발급 후 메일에서 
        $user->save();

        \Auth::login($user);

        return redirect('/')->with('message', $user->nickname.'様ようこそウェブカカオトークへ');
    }

}
