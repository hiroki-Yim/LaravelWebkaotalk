<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;

class boardController extends Controller
{
    public function index(){
        require_once('../../Model/boardDao.php');
        require_once('../../config/config.php');
        require_once('../../config/tools.php');
        session_start();
        $sid = session_exist('id');
        $dao = new boardDao();                                                                                 
        $currentPage = requestValue("page");
        $totalCount = $dao->getNumMsgs();

        if($totalCount > 0){
        $totalPages = ceil($totalCount/NUM_LINES);                            
        if($currentPage < 1){ $currentPage = 1; }
        if($currentPage > $totalPages){ $currentPage = $totalPages; }

        $start = ($currentPage - 1) * NUM_LINES;
        $msgs = $dao->getManyMsgs($start, NUM_LINES);                        

        $startPage = floor(($currentPage-1)/NUM_PAGE_LINKS)*NUM_PAGE_LINKS+1;
        $endPage = $startPage + NUM_PAGE_LINKS - 1;                          

        if($endPage > $totalPages){ $endPage = $totalPages; }                 
        if($startPage == 1){ $prev = true; }                                  
        if($endPage > $totalPages){ $next = true; }                          

        $startRecord = floor(($currentPage-1)/NUM_LINES);
        //비지니스 로직 다 만든 다음에
}           //view 호출
            return view('kakaoView.board')->with('startpage', $startPage)
            ->with('endpage', $endPage)->with('titalpages', $totalPages);  // 체이닝을 통해 view에서도 사용할 값들을 넘겨줌
    }
    public function show(){

    }
    public function writer(){   //create
        
    }
    public function modify(){   //edit
        
    }
    public function update(){
        $boards = Board::orderBy('created_at', 'desc')->paginate(6);
        //1. return view('board')->with('boards', $boards);
        //2. return view('board', ['boards' => $boards]);
        /*출력은 $boards 담겨있어 똑같이 foreach 뿌려주는데*/
        /*1. $board['칼럼이름']  */
        /*2. $board->칼럼이름 페이지네이트하면 이걸로 해야할거야*/
        /*페이지 네이트 적용은 {{$boards->links()}}*/

    }
    public function destroy(){   //delete
        session_start();
        require_once("../config/tools.php");    
        require_once("../Model/boardDao.php");    
        $bdao = new boardDao();           


        $sid = $_SESSION['id']??'';       //php 7버전 이상부터 사용할 수 있음 isset에다가 삼항 연산자를 사용 한것과 같음 현재 세션아이디를 가져옴
        $num = requestValue("num");       //현재 보고있는 글의 번호를 들고옴
        $writer = requestValue("writer"); //보고 있는 view에서 보고있는 글 작성자를 받아옴
        $page = requestValue("page");

        if($sid == $writer){                 //세션 아이디(현재 접속자)와 쓰여진 글의 작성자가 같은지 확인함.
        if($num){                            //글이 존재하면
        $bdao->deleteMsg($num);              //bdo에서 만든 delete문을 실행함
        okGo("해당글이 삭제되었습니다.", "../View/kakaoView/board.php?page=".$page);
        }else{
            errorBack("이미 삭제된 게시물 입니다.", "../DBS/board.php"); //글이 존재하지 않으면
        }
        }else{
        errorBack("작성자만 삭제 할 수 있습니다.");            //접속된 아이디와 글의 아이디가 다르면
            }

        return redirect()->action('${App\Http\Controllers\HomeController@index}', ['parameterKey' => 'value']);
        }

        public function chats(){
            return view('kakaoview/chats');
        }

}
