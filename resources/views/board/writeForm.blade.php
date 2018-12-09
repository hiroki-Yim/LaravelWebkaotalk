@extends('layouts.master') 
@section('title') writeForm
@endsection
 
@section('head')
<script src="{{asset('bower_components/jquery/dist/jquery.js')}}"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns"
  crossorigin="anonymous">

<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

<link rel="stylesheet" href="{{asset('css/kakaoview/style.css')}}">

<script src="{{asset('bower_components/summernote/dist/summernote.js')}}"></script>
<link rel="stylesheet" href="{{asset('bower_components/summernote/dist/summernote2.css')}}">

<script src="{{asset('bower_components/dropzone/dist/dropzone.js')}}"></script>
<link rel="stylesheet" href="{{asset('bower_components/dropzone/dist/dropzone.css')}}">

<meta name="csrf-token" content="{{ csrf_token() }}" />
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
    <span class="header__text">게시글 작성</span>
  </div>

  <div class="header__column">
    OPTION
  </div>
</div>
</header>
@endsection
 
@section('writeForm')
<main>
  <div class="wrapper" style="padding:15px">
    <fieldset>
      <form action="{{route('board.store')}}" method="post" class="form" id="store" enctype="multipart/form-data">
        @csrf
        <!-- id가 label값, name이 php REQUEST값, value가 진짜 값 -->
        <input type="hidden" class="form-control" name="author" value="{{\auth::user()->nickname}}">
        <input type="hidden" name="profileImg" value="{{\auth::user()->profileImg}}">
        <!-- 작성자값을 보내긴 해야하는데 값이 보이면 안되니까 숨김 작성자의 기본 전달값을 작성자로 설정 -->
        <div class="form-group">
          <label for="title" class="wrapper"></label>
          <input type="text" class="form-control" name="title" placeholder="TITLE" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}">          @if ($errors->has('title'))
          <span class="invalid-feedback warning" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
          </span> @endif
        </div>
        <!-- <div id="my-dropzone" class="dropzone"></div> -->
        <div class="form-group">
          <textarea class="summernote" id="summernote" name="content" rows="8">
            {{old('content')}}
          </textarea>
        </div>
        @if($errors->has('content'))
        <span class="warning">
             {{$errors->first('content')}}
            </span> @endif
      </form>

      
      <form action="{{route('fileUpload')}}" class="dropzone" id="dropzone" method="post" enctype="multipart/form-data">
        @csrf
      </form>

      <button type="button" class="btn" id="startUpload" style="float:right;" onclick="$('#store').submit()">작성하기</button>
      <a type="button" class="btn btn-success" href="{{url('board')}}" style="float:right;">목록보기</a>
    </fieldset>
  </div>
  
  <script>
  Dropzone.options.dropzone = {
      addRemoveLinks: true,
      dictRemoveFile: "취소하기",
      paramName: "file",
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      removedfile: function(file) {
      console.log(file);
      var name = file.upload.filename;
      var fileid = file.upload.id;
      $.ajax({
          headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
          type: 'DELETE',
          url: '/deleteFile/'+fileid,
          data: {filename: name},
          success: function (data){
              alert(data + '해당 파일을 지웠습니다.');
          },
          error: function(e) {
              //console.log(e);
              alert(e.responseText);
          }});
          var fileRef;
          return (fileRef = file.previewElement) != null ? 
          fileRef.parentNode.removeChild(file.previewElement) : void 0;
      },
      success: function(file, response) {
        console.log(file);
        console.log(response);  //controller에서 response 메서드로 보낸 데이터가 들어있음
        // console.log([
        //   file.name,
        //   file.size,
        // ]);
          file.upload.id = response.id;
          $("<input>", {type:'hidden', name:'attachments[]', value:response.id}).appendTo($('#store'));
      },  
      error: function(file, response){
         return false;
      }
  }
  </script>

  <script src="{{asset('js/summernote_opt.js')}}"></script>

  <!-- summernote 옵션 정의 -->
</main>
@endsection
 
@section('nav-bottom')
  @include('Components.nav-bottom')
@endsection