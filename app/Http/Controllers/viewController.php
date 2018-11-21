<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;

class viewController extends Controller
{
    public function profile(){
        $profile = \Auth::user();
       return view('auth/profile', ['profile' => $profile]); 
    }

}
