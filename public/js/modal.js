
$(function(){
    var modal = $("#login_btn"); // Get the modal
    $(window).click(function (e) {
    if (e.target.className == modal[0].className) {
    $("#login_btn").css("display", "none");
 }
});
});