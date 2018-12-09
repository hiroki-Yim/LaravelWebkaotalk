$('.summernote').summernote({ //스마트 에디터 summernote탑재 그리고 에디터 기본 UI설정
    height: 350, // set editor height
    minHeight: null, // set minimum height of editor
    maxHeight: null, // set maximum height of editor
    focus: false, // set focus to editable area after initializing summernote
    placeholder: "글을 쓰거나 이미지를 드래그 해보세요",
    lang: 'ko-Kr',
    codemirror: {
        lineNumbers: true,
        tabSize: 2,
        theme: "solarized ligth"
    },
    callbacks: {
        onImageUpload: function (image) { //summernote 내장 이벤트
            editor = $(this);
            uploadImageContent(image[0], editor);
        }
    },
    dialogsFade: true,
});

function uploadImageContent(image, editor) {
    var data = new FormData();
    data.append("image", image);
    $.ajax({
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/imgUpload",
        cache: false,
        contentType: false,
        processData: false,
        enctype: 'multipart/form-data',
        success: function (url) {
            var image = $('<img>').attr('src', url);
            $(editor).summernote("insertNode", image[0]);
            console.log(url);
        },
        error: function (err) {
            alert(err.responseText); //서버에서 받아온 responseText출력
        }
    });
}
