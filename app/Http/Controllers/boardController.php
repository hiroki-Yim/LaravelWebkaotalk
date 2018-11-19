<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;  //boardModel 씀
use App\User;
use App\Comment;
use App\hit;
use Log; // Log사용
use App\Http\Requests\updateBoardRequest; //검증된 정보(빈값x)를 받기위해 정의해놓았고 그 class를 객체로 사용하기 위해 use 해줌.

class boardController extends Controller
{
    public function index(){    //REQUEST에는 무엇이 넘어올까
         //비지니스 로직 다 만든 다음에 view로 호출
         
        $board = Board::orderBy('boards.created_at', 'desc')->join('users','boards.author','=','users.nickname')->paginate(5);
        $viewCount = 1;
        //Hit::where('postid', 'userid')->join('postid','boards.postid','=','hits.userid')->count();//조회수
        return view('board.board', ['msgs' => $board, 'viewCount'=>$viewCount]); // 이건 배열 형태로 쭉 받으면 됨, 연관배열,
 
        // $totlaCount = Board::count();
        //*** Log::11가지 현업에서는 LOG를 남기는것이 중요하다~ 이말이지
    }
    public function show($board){
        //$this->hits($id);
        
        if(!Hit::where('postid',$board)->where('userid',\Auth::user()['email'])->exists()){
            Hit::create(['postid' => $board, 'userid' => \Auth::user()['email']]);
        }
        $msg = Board::where('postid', $board)->first();  // 레코드 1나만 들고옴 first
        $comments = Comment::orderBy('postnum', 'desc');
        $viewCount = Hit::where('postid', $board)->count();//조회수 
        return view('board.views', ['msg' => $msg, 'comments'=>$comments, 'viewCount'=>$viewCount]);
    }
    public function create(){   //create
        // 작성 폼으로 연결
        if(\Auth::check()){
            return view('board.writeForm');
        }else{
            echo "<script>
            alert('로그인 한 사용자만 글을 쓸 수 있습니다.');
            history.back();
            </script>";
        }
    }

    public function store(updateBoardRequest $request){
        //폼에 입력된 것을 db에 삽입
        $title = $request->title;
        $content = $request->content;
        $author = $request->author;

        Board::create([
            'title' => $title,
            'content' => $content,
            'author' => $author,
        ]);

        return redirect('board')->with('message');
    }

    public function edit(Request $request, $board){
        
        $msg = Board::where('postid', $board)->first();
        $author = $msg['author'];
        if(\Auth::user()['nickname'] == $author){
        return view('board.modifyForm',['msg' => $msg]);
        }else{
            echo "<script>
            alert('본인의 글만 수정할 수 있습니다.');
            history.back();
            </script>";
        }
        // return redirect();  // 수정이 완료되면 alert창과 함께 수정했던 글로 다시 돌아간다.
        // return view('modify')->with('postid', $postid)->with('page', $page)->with('row', $row);
    }
        
    public function update(updateBoardRequest $request, $board){  // make:request updateBoardRequest에 의해 생성된 class를 사용 
                                                          //넘어온 값은 검증된 값으로 넘어오게 된다.
        //갱신 작업 수행
         $title = $request->title;
         $content = $request->content;
         $author = $request->author;
         
         Board::where('postid', $board)->update([
            'title' => $title,
            'content' => $content,
            'author' => $author,
        ]);

         return redirect('board/'.$board);
    }
    public function destroy($board){   //delete                        //board에는 모든 것이 들어갈 수 있고 $board로 받아와야함
        
        Board::where('postid', $board)->delete();

        return redirect('board');
    }

    public function find(){
        return view('board.find');
    }
}
