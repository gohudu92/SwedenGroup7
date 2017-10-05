$( document ).ready(function() {
    heightSideBar();
    divBeforeSideBar();
});

$( window ).resize(function() {
    heightSideBar();
    divBeforeSideBar();
});

function heightSideBar(){
    $("#side_bar").height($(window).height());
}

function divBeforeSideBar() {
    var height=$("nav").height();
    $("#divBeforeSideBar").height(height);
}
