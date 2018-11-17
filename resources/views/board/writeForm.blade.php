@extends('layouts.master')

  @section('title')
    writeForm
  @endsection

  @section('head')
    @include('Components.head')
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

    <script src="{{asset('bower_components/dropzone/dist/dropzone.js')}}"></script>
    <link rel="stylesheet" href="{{asset('bower_components/dropzone/dist/dropzone.css')}}">

    <script src="{{asset('bower_components/summernote/dist/summernote.js')}}"></script>
    <link rel="stylesheet" href="{{asset('bower_components/summernote/dist/summernote.css')}}">
  @endsection

  @section('header-top')
    @include('Components.header-top')
    <div class="header__bottom">
    <div class="header__column">
      <a onclick="history.back()">
        <i class="fa fa-chevron-left fa-lg"></i>
      </a>
    </div>

    <div class="header__column">
        <span class="header__text">게시글 리스트</span>
    </div>
    
    </div>

    </header>
  @endsection

  @section('writeForm')
  <main>
    <div class="wrapper" style="padding:15px">
      <fieldset>
      <form action="{{route('board.store')}}" method="post" class="form" enctype="multipart/form-data">
      @csrf
        <!-- id가 label값, name이 php REQUEST값, value가 진짜 값 -->
        <input type="hidden" class="form-control" name="author" value="{{\auth::user()->nickname}}">
        <input type="hidden" name = "profileImg" value="{{\auth::user()->profileImg}}">
        <!-- 작성자값을 보내긴 해야하는데 값이 보이면 안되니까 숨김
                                                              작성자의 기본 전달값을 작성자로 설정 -->
        <div class="form-group">
          <label for="title" class="wrapper" s>WRITE_FORM</label>
          <input type="text" class="form-control" name="title" placeholder="TITLE">
        </div>

        <div class="dropzone" id="fileDropzone">
        </div>

        <div class="form-group">
          <textarea class ="summernote" id="summernote" name="content" rows="8">
          </textarea>

          <button type="submit" class="btn" id="startUpload">작성하기</button>
          <!-- <button type="button" class="btn btn-danger" onclick="locationView('board')">목록보기</button> -->
        </div>
      </form>
      </fieldset>
    </div>

    <script>
      // autoDiscover를 사용하지 않도록 설정합니다. 
      Dropzone.autoDiscover = false;
        var data = new FormData();
        //Dropzone class
        var myDropzone = new Dropzone(".dropzone", {
          url: "../../Controller/uploadFile.php",
          paramName: "file",
          maxFilesize: 200,
          maxFiles: 10,
          acceptedFiles: "image/*,application/pdf,*,txt/*,text/*,jpg,png",
          autoProcessQueue: false,      //올리자 말자 서버로 전송하지 않겠다 = false
          createImageThumbnails : true, //이미지 썸네일 활성화
          addRemoveLinks: true,         //remove링크 추가
          dictRemoveFile: "취소하기",    //remove링크에 쓰일 글
        });
        $('#startUpload').click(function () {
          myDropzone.processQueue();
        });
    </script>
    <script src="{{asset('js/summernote_opt.js')}}"></script>
    </main>
    @endsection

  @section('nav-bottom')
      @include('Components.nav-bottom')
  @endsection 