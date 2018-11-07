<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function registerForm(){
        return view('kakaoView.account.registerForm');
    }
}
