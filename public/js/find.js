var isLoading = false;
$('#search-bar').on("change keyup paste", onSearch);

function onSearch(e) {
    var searchBoard = e.target.value + "%";
    if (searchBoard.length >= 2 && !isLoading) {
        isLoading = true;
        console.log(searchBoard);

        $.ajax({
            type: "GET",
            url: "../../Controller/getTitle.php?param=" + searchBoard,
            dataType: "json",
            error: function () {
                throw new Error("ajax 통신 실패");
            },
            success: function (data) {
                console.log(data);
                console.log(data[0].length);
                makeTag(data);
            }
        });
    } //end of if

}

function makeTag(data) {
    var tag = "";
    if (data[0].length === 0) {
        isLoading = false;
        // tag += '<p id = "resultNone"> 결과가 없습니다. </p>';
        $('.chats__chat').html(tag);
        return;
    }

    var items = data[0];
    items = !items.length ? [items] : items;
    for (var i = 0; i < items.length; i++) {
        if (items[i]) {
            tag += "<li class='chats__chat'>" +
                "<a href=views.php?num=" + items[i].Num + ">" + // page=currentpage
                "<div class='chat__content'>" +
                "<img src='images/person-icon.png'>" +
                "<div class='chat__preview'>" +
                "<h3 class='chat__user'>" + items[i].Title + "</h3>" +
                "<span class='chat__last-message'>" + items[i].Writer + "</span>" +
                "</div>" +
                "</div>" +
                "<span class='chat__date-time'>" + items[i].Regtime +
                "<br>" +
                "<br>" +
                'Hits : ' + items[i].Hits +
                "</span>" +
                "</a>" +
                "</li>";
        }
    }
    if (items.length == 0) {
        tag += '<p id = "resultNone"> 결과가 없습니다. </p>';
    }
    $('.chats__list').html(tag);

    isLoading = false;
}
