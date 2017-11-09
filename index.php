<?php
include_once("config/config.php");
include_once("view/header.php");
?>
    <div class="container">
        <h1>Lastest Posts</h1>

        <div class="col-xs-8 col-xs-offset-2">
            <?php if (isConnected()) { ?>
                <div id="editor"></div>
                <div class="end-editor">
                    <button id="sendEditorData" type="button" class="btn btn-primary">Send</button>
                </div>
            <?php } ?>
            <div id="allPost"></div>
        </div>
    </div>

    <script>
        function getPostElement($this) {
            var $thisPost = $this;
            while ($($thisPost).attr('class') !== "post") {
                $thisPost = $($thisPost).parent();
            }
            return $thisPost;
        }

        function hideShowComment($this) {
            var $postElement = getPostElement($this)
            var $input = $($postElement).find("input");
            $($input).slideToggle();
        }

        function displayPosts(array) {
            $("#allPost").html('');
            array.forEach(function (post) {
                var onePost = '' +
                    '<div class="post" id="' + post.id + '">\n' +
                    '    <div class="col-xs-12">\n' +
                    '        <img src="' + post.imgUrl + '" class="img-responsive img-circle profilePicture" alt="profile">\n' +
                    '        <a href="#"><p class="name">' + post.username + '</p></a>\n' +
                    '        <p class="date">' + post.date + '</p>\n' +
                    '    </div>\n' +
                    '    <div class="col-xs-12">\n' +
                    '        <p class="content">' + post.content + '</p>\n' +
                    '    </div>\n' +
                    '    <div class="col-xs-10 col-xs-offset-1">\n' +
                    '        <hr/>\n' +
                    '    </div>\n' +
                    '    <div class="col-xs-12 interact">\n' +
                    '        <span class="addRemoveLove pointer ' + post.nbLove + '" onclick="addLove(this)" style="margin-right: 5px"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</span>\n' +
                    '        <span class="pointer" onclick="hideShowComment(this)"><i class="fa fa-comment-o" aria-hidden="true"></i> Comment</span>\n' +
                    '    </div>\n' +
                    '    <hr/>\n' +
                    '    <div class="comments">\n' +
                    '    <span class="nbLoveMargin"><i class="fa fa-thumbs-up noPointer" aria-hidden="true"></i> <span class="nbLove">' + post.love + '</span></span>\n';

                for (var i = 0; i < 2; i++) {
                    onePost = onePost + '<div class="col-xs-12">\n' +
                        '        </div>\n' +
                        '        <div class="col-xs-10 col-xs-offset-1">\n' +
                        '            <hr style="margin-bottom: 5px;"/>\n' +
                        '        </div>\n' +
                        '        <div class="col-xs-12 oneComment" id="commentId">\n' +
                        '            <img src="view/img/default.png" class="img-responsive img-circle profilePicture"\n' +
                        '                 alt="profile">\n' +
                        '            <p><a href="#"><span class="name">Name</span></a> <span class="content">Content</span></p>\n' +
                        '            <p class="date">Date</p>\n' +
                        '        </div>\n';
                }
                onePost = onePost + '    </div>\n' +
                    '    <div class="col-xs-12">\n' +
                    '        <input style="display: none" class="form-control" type="text" placeholder="Your comment">\n' +
                    '    </div>\n' +
                    '</div>' +
                    '';
                $("#allPost").append(onePost);
            });
        }

        function addLove($this) {
            var $postElement = getPostElement($this);
            var $love = $($postElement).find(".addRemoveLove");
            var $nbLove = $($postElement).find(".nbLove");
            $.post("/functions/ajax/addRemoveLove.php",
                {
                    post: $($postElement).attr("id"),
                    user: global_id_user
                },
                function (data, status) {
                    if (data === "add") {
                        $($love).addClass("active");
                        var $newLove = parseInt($($nbLove).text()) + 1;
                        $($nbLove).text($newLove);
                    } else if (data === "remove") {
                        $($love).removeClass("active");
                        var $newLove = parseInt($($nbLove).text()) - 1;
                        $($nbLove).text($newLove);
                    }
                });
        }

        function getPosts() {
            $.post("/functions/ajax/getPosts.php",
                {
                    id_user: global_id_user
                },
                function (data, status) {
                    displayPosts(JSON.parse(data));
                });
        }
    </script>

    <script>
        getPosts();
    </script>
    <script>
        $("#sendEditorData").click(function () {
            var data = CKEDITOR.instances.editor.getData();
            var datas = JSON.stringify(data);
            $.post("/functions/ajax/sendPost.php",
                {
                    post: datas,
                    id_user: global_id_user
                },
                function (data, status) {
                    getPosts();
                });
            CKEDITOR.instances.editor.setData('');
        });
    </script>
<?php
include_once("view/footer.php");
?>