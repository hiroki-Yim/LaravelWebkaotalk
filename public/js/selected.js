$(document).ready(function () {
    var urlId = $(location).attr('pathname').toLowerCase();
    console.log(urlId);
    var temp = "/";
    // var temp = temps.toLowerCase();
    var path = "";
    switch (urlId) {
        case temp + "board":
            path = "board";
            break;
        case temp + "chats":
            path = "chats";
            break;
        case temp + "/":
            path = "index";
            break;
        case temp + "find":
            path = "find";
            break;
        case temp + "more":
            path = "more";
            break;
        default:
            path = "index";
    }
    var urlvalue = path;
    var urlClass = $('#tab-bar__' + urlvalue);
    console.log(urlClass);
    $('.tab-bar__tab').removeClass("tab-bar__tab--selected");
    if (urlvalue) {
        urlClass.addClass("tab-bar__tab--selected");
        // console.log($('#tab-bar__'+urlvalue));
    }
});
