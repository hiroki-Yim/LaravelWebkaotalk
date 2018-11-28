<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
class AjaxController extends Controller
{
    public function search(Request $request){
        $input = $request->message;
        $board = Board::where('title','LIKE', $input."%")
        ->orderBy('boards.created_at', 'desc')->join('users','boards.author','=','users.nickname')->get();
        $count = Board::where('title', 'like', $input."%")->count();
        
        $result = array(
            ['status' => 'success'],
            ['inputText' => $input],
            ['data'=> $board->toJson()],
            ['count'=> $count],
        );
        return response()->json($result, 200);
    }
}
