@extends('layouts.master')
@section('head')
  @include('components.head')
  <script src="{{asset('bower_components/dropzone/dist/dropzone.js')}}"></script>
  <link rel="stylesheet" href="{{asset('bower_components/dropzone/dist/dropzone.css')}}">
  
  <link href="{{asset('bower_components/summernote/dist/summernote.css')}}" rel="stylesheet">
  <script src="{{asset('bower_components/summernote/dist/summernote.js')}}"></script>
@endsection

@section('title')
  writeForm
@endsection

@section('writeForm')
<body>
  <div class="wrapper">
    <fieldset>
    <form action="{{route('board.store')}}" method="post" class="form" enctype="multipart/form-data">
    @csrf
      <!-- id가 label값, name이 php REQUEST값, value가 진짜 값 -->
      <input type="hidden" class="form-control" name="writer" value="{{\auth::user()->author}}">
      <!-- 작성자값을 보내긴 해야하는데 값이 보이면 안되니까 숨김
                                                            작성자의 기본 전달값을 작성자로 설정 -->
      <div class="form-group">
        <h2><label for="title" class="wrapper">WRITE_FORM</label></h2>
        <input type="text" class="form-control" name="title" placeholder="TITLE">
      </div>

      <div class="dropzone" id="fileDropzone">
      </div>

      <div class="form-group">
        <textarea class = "summernote" id="summernote" name="content" rows="8">
        </textarea>

        <button type="submit" class="btn btn-primary" id="startUpload">작성하기</button>
        <button type="button" class="btn btn-danger" onclick="locationView('board')">목록보기</button>
      </div>
    </form>
    </fieldset>
  </div>

  <script src = '../../public/js/summernote_opt.js'></script>
  
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
  @endsection

@section('nav-bottom')
    @include('Components.nav-bottom')
@endsection 