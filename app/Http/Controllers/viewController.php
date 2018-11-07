<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class viewController extends Controller
{
    public function view(){
        
    }

    public function boardView(){
        return view('kakaoview/board');
    }
}
