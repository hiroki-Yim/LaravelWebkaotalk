<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;  //boardModel 씀
use App\User;
use Log; // Log사용
use App\Http\Requests\updateBoardRequest; //검증된 정보(빈값x)를 받기위해 정의해놓았고 그 class를 객체로 사용하기 위해 use 해줌.

class boardController extends Controller
{
    public function index(Request $request){    //REQUEST에는 무엇이 넘어올까
         //비지니스 로직 다 만든 다음에 view로 호출

        // ** $mgs->update(["hits"=>hits+1]);//조회수 증가 엘로퀀트
        // ** $msg = Board::find($id); select * from boards where id = ?


        $board = Board::orderBy('boards.created_at', 'desc')->join('users','boards.author','=','users.nickname')->paginate(5);
        return view('board.board', ['msgs' => $board]); // 이건 배열 형태로 쭉 받으면 됨, 연관배열,
        //return view('kakaoView.board')->with('msgs', $board);
        
        // ->with('startpage', $startPage)
        // ->with('endpage', $endPage)->with('titalpages', $totalPages);  // 체이닝을 통해 view에서도 사용할 값들을 넘겨줌
        // $totlaCount = Board::count();
        //*** Log::11가지 현업에서는 LOG를 남기는것이 중요하다~ 이말이지
    }
    public function show($id){
        $board = Board::where('postid', $id)->first();  // 레코드 1나만 들고옴 first
        return view('board.views', ['msg' => $board]);

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

    public function edit(Request $request){
        //갱신 폼으로 연결
        $author = requestValue("author");
        $title = requestValue("title");
        $content = requestValue("content");
        $num = $request->post_id;
        
        $row = Board::find($num);

        if($sid == $writer){
          //로그인한 사용자가 아니면 수정 못하게 
        if($writer && $title && $content){  // 수정 하고자 하는 글의 폼에 모든 정보가 입력되어 있으면
    
          $bdao = new boardDao();           //db에 접속하고 정보를 가져오고 update 쿼리를 실행시킨다.
          $bdao->updateMsg($title, $writer, $content, $num);
          return redirect();  // 수정이 완료되면 alert창과 함께 수정했던 글로 다시 돌아간다.
        }else{
         // 모든 폼에 정보가 쓰여지지 않았다면 error발생 다시 수정 폼으로 돌아간다.
        }
      }else{
        errorBack("게시글 작성자만 수정할 수 있습니다.", "../DBS/view.php?num=$num");
      }
      return view('modify')->with('postid', $postid)->with('page', $page)->with('row', $row);
    }

    public function update(updateBoardRequest $request){  // make:request updateBoardRequest에 의해 생성된 class를 사용 
                                                          //넘어온 값은 검증된 값으로 넘어오게 된다.
        //갱신 작업 수행
        $title = $request->title;
        $content = $request->content;
        $author = $request->author;
                                    //request에 정의한 값들이 검증을 거치고 들어오면 실행됨
        $b = Board::find($num);
        $b->update([
            'title' => $title,
            'author' => $content,
            'content' => $content,
        ]);
        
        if(!$sid){ // 회원정보 수정 방어 (세션 아이디가 없으면)
          errorBack("로그인 하여 주십시오.");
        }else if($sid != $id){ // 세션 아이디와 수정 하고자 하는 아이디가 다르면
          errorBack("다른 회원의 정보는 수정할 수 없습니다.");
        }
        if($id && $pwd && $name && $mail && $phone){  // 모든 정보가 다 입력 되었다면
            $mdao = new MemberDao();
            $mdao->updateAccount($id, $pwd, $name, $mail, $phone);     // 쓰여진 정보를 기반으로 update함수 실행 = DB에 저장
            $_SESSION["name"] = $name;
            return redirect('board?page=$page')->with('message', $postid);      // 원래 url정보로 MAIN_PAGE상수 넣어야 함
        }else{
            errorBack("모든 정보를 입력해 주세요.");  // 모든 정보가 입력되지 않으면 다시 작성
        }

    }
    public function destroy(){   //delete

        $sid = $_SESSION['id']??'';       //php 7버전 이상부터 사용할 수 있음 isset에다가 삼항 연산자를 사용 한것과 같음 현재 세션아이디를 가져옴
        $num = requestValue("num");       //현재 보고있는 글의 번호를 들고옴
        $writer = requestValue("writer"); //보고 있는 view에서 보고있는 글 작성자를 받아옴
        $page = requestValue("page");

        if($sid == $writer){                 //세션 아이디(현재 접속자)와 쓰여진 글의 작성자가 같은지 확인함.
        if($num){                            //글이 존재하면
        $bdao->deleteMsg($num);              //bdo에서 만든 delete문을 실행함
        okGo("해당글이 삭제되었습니다.", "../View/kakaoView/board.php?page=".$page);
        }else{
            //글이 존재하지 않으면 이미 삭제된 게시물
        }
        }else{
            //접속된 아이디와 글의 아이디가 다르면 작성자만 삭제가능
            }

        return redirect()->action('${App\Http\Controllers\HomeController@index}', ['parameterKey' => 'value']);
        }

        public function find(){
            return view('board.find');
        }
}
