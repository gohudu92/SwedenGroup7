$(document).ready(function () {
    heightSideBar();
    divBeforeSideBar();
});

$(window).resize(function () {
    heightSideBar();
    divBeforeSideBar();
});

$(window).scroll(function () {
    divBeforeSideBar();
});

function heightSideBar() {
    $("#side_bar").height($(window).height());
}

function divBeforeSideBar() {
    var height = $("nav").height();
    height = height - $(window).scrollTop();
    if (height < 0) {
        height = 0;
    }
    $("#divBeforeSideBar").height(height);
}
