function locationView(url, param, opt, opt2) {
    // alert(url, param, opt);
    // alert(param);

    this.url = url;
    var deletephp = "delete.php";
    var boardphp = "board.php";
    var viewphp = "view.php";
    var modifyphp = "modify.php";
    var modifyFormphp = "modify_Form.php";
    var registerphp = "registerForm.php";
    var commentphp = "comment.php";
    //"location.href='view.php?num=<?= $prenex[0]['Num'].'&page='.$page ?>'"

    switch (url) {
        case 'board':
            location.href = boardphp + "?page=" + param;
            break;
        case 'modify':
            location.href = "../../Controller/" + modifyphp + "?num=" + param;
            break;
        case 'modifyForm':
            location.href = modifyFormphp + "?num=" + param;
            break;
        case 'delete':
            location.href = "../../Controller/" + deletephp + "?num=" + param + "&writer=" + opt + "&page=" + opt2;
            break;
        case 'view':
            location.href = viewphp + "?num=" + param + '&page=' + opt;
            break;
        case 'register':
            location.href = registerphp;
            break;
        case 'comment':
            location.href = commentphp;
            break;
        case 'registerForm':
            location.href = "../account/" + registerphp;
        default:
            return;
    }
}

function delReq(num, writer, page) { // 삭제할 경우 삭제를 확인을 받기 위해 deleteRequest함수를 만듦
    var yn = confirm("정말 삭제 하시겠습니까?");
    if (yn == false) {
        return;
    } // 아니오를 눌렀을 시 아무 반응 하지않게 함
    else {
        locationView('delete', num, writer, page);
    } // 예를 눌렀을 때 delete.php에 글 값을 전달하여 삭제함
}

function commentAjax() {
    $(".comment_btn").click(function () {
        $.ajax({
            type: 'post',
            url: '../../Controller/comment.php',
            dataType: 'html',
            success: function (data) {
                $("#listDiv").html(data);
            }
        });
    })

}
