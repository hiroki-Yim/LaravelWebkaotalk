<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;  //정의한 Model(db)들 사용
use App\User;
use App\Comment;
use App\hit;
use Illuminate\Support\Facades\DB;
use Log; // Log사용
use App\Http\Requests\updateBoardRequest; //검증된 정보(빈값x)를 받기위해 정의해놓았고 그 class를 객체로 사용하기 위해 use 해줌.

class boardController extends Controller
{
    public function __construct(){
        //return $this->middleware('guest'); //guest이외의 사람에게는 이 컨트롤러를 사용하지 못하게 만든다는 뜻
        //return $this->middleware('auth');//인증된 사용자만 이용할 수 있게 board 볼수있게 만듦 board들어가면 url(login)이 실행됨
    }

    public function index(){
         //비지니스 로직 이후 view로 호출
         
        $board = Board::select('users.email', 'users.nickname', 'users.profileImg',
	    'boards.postid', 'boards.author', 'boards.title', 'boards.content', 'boards.created_at')->orderBy('boards.created_at', 'desc')->join('users','boards.author','=','users.nickname')->paginate(7);
        
        $viewCount = Hit::select('postid', DB::raw('count(*) hits'))->groupBy('postid')->orderBy('postid', 'desc');
        
        // $board = Board::select('users.email', 'users.nickname', 'users.profileImg',
        // 'boards.postid', 'boards.author', 'boards.title', 'boards.content', 'boards.created_at','hits')->join('users','boards.author','=','users.nickname')
        // ->joinsub($viewCount, 'hits', function($join){
        // $join->on('boards.postid', '=', 'hits.postid');
        // })->paginate(7);
        //-> 문제점 조회된 게시글만 찾아서 갖고옴, 조회 안된 게시글들도 가져올 수 있어야 함
        
        $hits =  Board::select('hits')->join('users','boards.author','=','users.nickname')
        ->joinsub($viewCount, 'hits', function($join){
        $join->on('boards.postid', '=', 'hits.postid');
        })->get();

        //return response()->json($hits, 200, [], JSON_PRETTY_PRINT);
        return view('board.board', ['msgs' => $board]); // 이건 배열 형태로 쭉 받으면 됨, 연관배열,
        
        // $hits = hit::select('pro_id', DB::raw('count(*) hits'))->groupBy('pro_id')->orderBy('hits', 'desc');

        // $products = product::joinSub($hits, 'hits', function ($join){
        //     $join->on('id', '=', 'hits.pro_id');
        // })->paginate(9);
        
        //$board->toJson();
        // $totlaCount = Board::count();
        //*** Log::11가지 현업에서는 LOG를 남기는것이 중요하다~
    }
    public function show($board){
        //$this->hits($id);
        if(\Auth::check()){
        if(!Hit::where('postid',$board)->where('userid',\Auth::user()['email'])->exists()){
            
            Hit::create(['postid' => $board, 'userid' => \Auth::user()['email']]);
        }
        $msg = Board::where('postid', $board)->first();  // 레코드 1나만 들고옴 first
        $comments = Comment::orderBy('postnum', 'desc');
        $viewCount = Hit::where('postid', $board)->count();//조회수 
        return view('board.views', ['msg' => $msg, 'comments'=>$comments, 'viewCount'=>$viewCount]);
        }else{
        echo 
        "<script>
        alert('로그인 한 사용자만 글을 볼 수 있습니다.');
        history.back();
        </script>";  
        
        //return redirect('board')->with('message', "로그인을 해 주세요!　( ´∀｀ )");
    }
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

        return redirect('board')->with('message', $title.'의 글이 저장되었습니다.');
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

    public function uploadImg(){
        $return_value = "";
        if ($_FILES['image']['name']) {
        if (!$_FILES['image']['error']) {
        $ext = explode('.', $_FILES['image']['name']);  
        $filename = time().'.'.$ext[1];
        $destination = "{{asset('uploadedFile/Images/users')}}".$filename;
        $location = $_FILES['image']['tmp_name'];
        move_uploaded_file($location, $destination);
        $return_value ="{{asset('uploadedFile/Images/users')}}".$filename;
        }else{
        $return_value ='업로드에 실패 하였습니다.: '.$_FILES['image']['error'];
        }
        }
        return $return_value;
    }
}
