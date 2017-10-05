$( document ).ready(function() {
    heightSideBar();
});

$( window ).resize(function() {
    heightSideBar();
});

function heightSideBar(){
    $("#side_bar").height($(window).height());
}
