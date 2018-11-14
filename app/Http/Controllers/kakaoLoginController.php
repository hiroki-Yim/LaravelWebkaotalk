<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class kakaoLoginController extends Controller
{
    public function index(){
        return view('auth.kakaoLogin');
    }

    public function redirectToprovider(){
        return Socialite::driver('kakao')->redirect();
    }

    public function handleProviderCallback(){
        //로그인 하면 실행되며 로그인을 처리해  줌
        $kaUser = Socialite::driver('kakao')->user();
        
        // return response()->json($kaUser,200,[],JSON_PRETTY_PRINT);//어떤값이 오는지 확인

        $password = $kaUser->token;    //password
        $id = $kaUser->getId();     //id

        $nickname = $kaUser->getNickName();
        $profileImg = $kaUser->getAvatar();

        if(!User::all()->where('email', $id)->first()){
            $user = new User();
            $user->email = $id;
            $user->nickname = $nickname; 
            $user->password = Hash::make($password);
            $user->profileImg = $profileImg;
            $user->save();
        }else{
            User::where('email', $id)
                ->update(['password' => Hash::make($password)]);

        }

        // if (user::all()->where('email', $id)->first()){ // 방금 받은 토큰으로 저장
        //     user::where('email', $id)->update(['password'=>$token]);   //이메일이 kaid인 값의 비번을 업데이트
        // }else{
        //     user::create([   //가져온 값으로 회원가입 시킴
        //         'nickname' => $nickname,
        //         'email' => $id,
        //         'password' => Hash::make($token),
        //         'profileImg' =>$profileImg,
        //     ]);
        // }

        //회원가입 후 자동 로그인 
        if (\Auth::attempt(['email'=>$id, 'password'=>$password])) {    // DB에 있는 토큰과 비교후 로그인
            // Authentication passed...
            echo "<script> alert('로그인 되었습니다.'); </script>";
            return redirect('/');
        }else{
            echo "<script>alert('로그인에 실패하였습니다.');</script>";
        }
    
    }
}
