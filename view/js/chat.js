$(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $button = $(this);
    var $bodyChat = $button.parents('.panel').find('.panel-body');
    var $input = $button.parents('.panel').find('.panel-body').next();
    if (!$button.hasClass('panel-collapsed')) {
        $bodyChat.slideUp();
        $input.slideUp();
        $button.addClass('panel-collapsed');
        $button.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $bodyChat.slideDown();
        $input.slideDown();
        $button.removeClass('panel-collapsed');
        $button.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '.icon_close', function (e) {
    var $button = $(this);
    var chatbox = $($button).parent().parent().parent().parent().parent().parent();
    $(chatbox).remove();
});

function openChatBox($id) {
    var open = true;
    $("#allChatBox").children().each(function () {
        if ($(this).attr('id') == $id) {
            open = false;
        }
    });
    if (open == true) {
        showChatBox($id);
    }
}
function showChatBox($id) {
    $.post("/view/chat/templateChat.php",
        {
            id: $id
        },
        function (template) {
            $("#allChatBox").append(template);
            InitShowMessage();
        });
}

$("#allChatBox").on("keypress", "input.sendMessage", function (e) {
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    var input = e.target;
    if (keyCode == '13') {
        var contentInput = $(input).val();
        var idReceiver = $(input).attr('id');
        sendMessage(contentInput, idReceiver);
        $(input).val('');
        return false;
    }
});

function sendMessage(contentInput, idReceiver) {
    $.post("/functions/ajax/sendMessage.php",
        {
            contentInput: contentInput,
            id_receiver: idReceiver,
            id_sender: global_id_user
        },
        function (date) {
            var childAllChatBox = $("#allChatBox").children();
            $(childAllChatBox).each(function () {
                var $thisChatBox = $(this);

                $($thisChatBox).find(".msg_container_base").append('' +
                    '<div class="row msg_container base_sent">' +
                    '<div class="col-md-10 col-xs-10">' +
                    '<div class="messages msg_sent">' +
                    '<p>' + contentInput + '</p>' +
                    '<time>'+date+'</time>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-2 col-xs-2 avatar">' +
                    '<img' +
                    'src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg"' +
                    'class=" img-responsive ">' +
                    '</div>' +
                    '</div>' +
                    '');

            });
        });
}

    function waitUpdateShowMessage() {
        setTimeout(function () {
            updateShowMessage();
        }, timeBeforeReloadOnline);
    }

    function updateShowMessage() {
        var childAllChatBox = $("#allChatBox").children();
        $(childAllChatBox).each(function () {
            var idOtherUser = $(this).attr('id');
            var $thisChatBox = $(this);
            $.post("/functions/ajax/getNewMessages.php",
                {
                    id_other_user: idOtherUser,
                    me: global_id_user
                },
                function (data) {
                    var parsed = JSON.parse(data);
                    var arr = [];
                    for (var x in parsed) {
                        arr.push(parsed[x]);
                    }
                    for (var i = 0; i < arr.length; i = i + 3) {
                        var sender = arr[i];
                        var content = arr[i + 1];
                        var time = arr[i + 2];
                        if (sender == global_id_user) {
                            $($thisChatBox).find(".msg_container_base").append('' +
                                '<div class="row msg_container base_sent">' +
                                '<div class="col-md-10 col-xs-10">' +
                                '<div class="messages msg_sent">' +
                                '<p>' + content + '</p>' +
                                '<time>' + time + '</time>' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-md-2 col-xs-2 avatar">' +
                                '<img' +
                                'src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg"' +
                                'class=" img-responsive ">' +
                                '</div>' +
                                '</div>' +
                                '');
                        } else {
                            $($thisChatBox).find(".msg_container_base").append('' +
                                '<div class="row msg_container base_receive">' +
                                '<div class="col-md-2 col-xs-2 avatar">' +
                                '<img' +
                                'src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg"' +
                                'class=" img-responsive ">' +
                                '</div>' +
                                '<div class="col-md-10 col-xs-10">' +
                                '<div class="messages msg_receive">' +
                                '<p>' + content + '</p>' +
                                '<time>' + time + '</time>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '');
                        }
                    }
                });
        });
        waitUpdateShowMessage();
    }

    function InitShowMessage() {
        var childAllChatBox = $("#allChatBox").children();
        $(childAllChatBox).each(function () {
            if ($(this).attr('id') > 0) {
                var idOtherUser = $(this).attr('id');
                var $thisChatBox = $(this);
                if ($($thisChatBox).hasClass("newChat")) {
                    $($thisChatBox).removeClass("newChat");
                    $thisChatBox.find(".msg_container_base").empty();
                    $.post("/functions/ajax/getMessages.php",
                        {
                            id_other_user: idOtherUser,
                            me: global_id_user
                        },
                        function (data) {
                            var parsed = JSON.parse(data);
                            var arr = [];
                            for (var x in parsed) {
                                arr.push(parsed[x]);
                            }
                            for (var i = 0; i < arr.length; i = i + 3) {
                                var sender = arr[i];
                                var content = arr[i + 1];
                                var time = arr[i + 2];
                                if (sender == global_id_user) {
                                    $($thisChatBox).find(".msg_container_base").append('' +
                                        '<div class="row msg_container base_sent">' +
                                        '<div class="col-md-10 col-xs-10">' +
                                        '<div class="messages msg_sent">' +
                                        '<p>' + content + '</p>' +
                                        '<time>' + time + '</time>' +
                                        '</div>' +
                                        '</div>' +
                                        '<div class="col-md-2 col-xs-2 avatar">' +
                                        '<img' +
                                        'src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg"' +
                                        'class=" img-responsive ">' +
                                        '</div>' +
                                        '</div>' +
                                        '');
                                } else {
                                    $($thisChatBox).find(".msg_container_base").append('' +
                                        '<div class="row msg_container base_receive">' +
                                        '<div class="col-md-2 col-xs-2 avatar">' +
                                        '<img' +
                                        'src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg"' +
                                        'class=" img-responsive ">' +
                                        '</div>' +
                                        '<div class="col-md-10 col-xs-10">' +
                                        '<div class="messages msg_receive">' +
                                        '<p>' + content + '</p>' +
                                        '<time>' + time + '</time>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>' +
                                        '');
                                }
                            }
                        });
                }
            }
        });
        waitUpdateShowMessage();
    }