<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
class commentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->get('comments')){
            return redirect(route('board.show', ['board'=>$request->get('postnum')]))->with('message', '입력 후 전송하세요');
        }else{
         $comments = $request->get('comments');
         $author = $request->get('writer');
         $postnum = $request->get('postnum');

            if($profile = \Auth::user()['profileImg']){
             $profile = \Auth::user()['profileImg'];
            }else{
             $profile = null;
        }

        $comment = new Comment();
        $comment->writer = $author;
        $comment->postnum = $postnum;
        $comment->content = $comments;
        $comment->commentImg = $profile;

        $comment->save();
        return redirect(route('board.show', ['board'=>$postnum]));
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::fine($id);
        //return 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
