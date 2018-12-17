jQuery(document).ready(function () {
    jQuery("time.timeago").timeago();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var isLoading = false;
$('#search-bar').on("change keyup paste", onSearch);

function onSearch(e) {
    var searchBoard = e.target.value;
    if (searchBoard.length >= 2 && !isLoading) {
        isLoading = true;
        console.log(searchBoard);

        $.ajax({
            type: "POST",
            url: '/postajax',
            data: {
                message: searchBoard,
            },
            dataType: "JSON",
            error: function (e) {
                //alert(e);
                console.log(e);
                throw new Error("ajax 통신 실패");
            },
            success: function (data) {
                console.log(data);
                const dataList = JSON.parse(data[2].data);
                console.log(dataList);
                // console.log(dataList);
                // console.log(data[3].count);
                makeTag(dataList);
                $('#postedNum').html('<p>검색된 게시글 갯수: ' + data[3].count + '건</p>');
            }
        });
    } //end of if

}

function makeTag(data) {
    var tag = "";
    if (data.length === 0) {
        isLoading = false;
        tag = '<p id = "resultNone"> 결과가 없습니다. </p>';
        $('.chats__chat').html(tag);
        return;
    }
    var items = data;
    items = !items.length ? [items] : items;
    for (var i = 0; i < items.length; i++) {
        if (items[i]) {
            tag +=
                "<li class='chats__chat'>" +
                "<a href=board/" + items[i].postid + ">" +
                "<div class='chat__content'>" +
                "<img src=" + "'" + items[i].profileImg + "'" + ">" +
                "<div class='chat__preview'>" +
                "<h3 class='chat__user'>" + items[i].title + "</h3>" +
                "<span class='chat__last-message'>" + items[i].author + "</span>" +
                "</div>" +
                "</div>" +
                "<span class='chat__date-time' data-date=" + new Date().toISOString(items[i].created_at) + ">" +
                "<br>" +
                "<br>" +
                'Hits : ' + //items[i].Hits +
                "</span>" +
                "</a>" +
                "</li>";
        }
    }
    if (items.length === 0) {
        tag = '<p id = "resultNone"> 결과가 없습니다. </p>';
    }
    $('.chats__list').children('.infinite-scroll').html(tag);

    isLoading = false;
}

$(function () {
    setInterval(timeagoNoti, 1000 * 30);
});

function timeagoNoti() {
    $(".chat__date-time").each(function () {
        var timeago_t = jQuery.timeago($(this).data("date"));
        $(this).text(timeago_t);
    })
}
