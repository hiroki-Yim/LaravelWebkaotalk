<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class userController extends Controller
{
    public function __construct(){
        $this->middleware('guest'); //guest만 사용가능 컨트롤러
    }
    
    public function store(Request $request){//sendmail
        $this->validate($request);

        $confirmCode = str_random(60);

        $user = User::create([
            'confirm_code' => $confirmCode,
        ]);

        \Mail::send('emails.auth.confirm', compact('user'), function ($message) use($user){
            $message->to($user->email);
            $message->subject(
                sprintf('[%s] 회원 가입을 확인한 뒤 이용하세요.', config('app.name'))
            );
        });

        //event(new \App\Events\UserCreated($user));

        flash('가입하신 메일 계정으로 가입 확인 메일을 보냈습니다. 가입 확인을 한 다음 로그인해 주세요.');

        return redirect('/');
    }

    public function confirm($code){
        $user = User::whereConfirmCode($code)->first();

        if(!$user){
            flash('URLが正しくありません。');

            return redirect('/');
        }

        $user->activated = 1;
        $user->confirm_code = null;
        $user->save();

        auth()->login($user);
        flash(auth()->user()->nickname.'様ようこそウェブカカオトークへ.');

        return redirect('/');
    }
}
