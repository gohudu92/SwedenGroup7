$( document ).ready(function() {
    $("#side_bar").height($(window).height()-50);
});

$( document ).resize(function() {
    $("#side_bar").height($(window).height()-50);
});