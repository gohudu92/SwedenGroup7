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
            <div id="allPost">

            </div>
        </div>
    </div>

    <script>//get Posts
        function displayPosts(array) {
            $("#allPost").html('');
            array.forEach(function (post) {
                $("#allPost").append('' +
                    '<div class="post" id="postId">\n' +
                    '    <div class="col-xs-12">\n' +
                    '        <img src="view/img/default.png" class="img-responsive img-circle profilePicture" alt="profile">\n' +
                    '        <p class="name">' + post.username + '</p>\n' +
                    '        <p class="date">' + post.date + '</p>\n' +
                    '    </div>\n' +
                    '    <div class="col-xs-12">\n' +
                    '        <p class="content">' + post.content + '</p>\n' +
                    '    </div>\n' +
                    '    <div class="col-xs-10 col-xs-offset-1">\n' +
                    '        <hr/>\n' +
                    '    </div>\n' +
                    '    <div class="col-xs-12">\n' +
                    '        <span class="pointer" style="margin-right: 5px"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</span>\n' +
                    '        <span class="pointer" onclick="hideShowComment(this)"><i class="fa fa-comment-o" aria-hidden="true"></i> Comment</span>\n' +
                    '    </div>\n' +
                    '    <hr/>\n' +
                    '    <div class="comments">\n' +
                    '        <div class="col-xs-12">\n' +
                    '            <span><i class="fa fa-thumbs-up noPointer" aria-hidden="true"></i> 5</span>\n' +
                    '        </div>\n' +
                    '        <div class="col-xs-10 col-xs-offset-1">\n' +
                    '            <hr style="margin-bottom: 5px;"/>\n' +
                    '        </div>\n' +
                    '        <div class="col-xs-12 oneComment" id="commentId">\n' +
                    '            <img src="view/img/default.png" class="img-responsive img-circle profilePicture"\n' +
                    '                 alt="profile">\n' +
                    '            <p><span class="name">Name</span> <span class="content">Content</span></p>\n' +
                    '            <p class="date">Date</p>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <div class="col-xs-12">\n' +
                    '        <input style="display: none" class="form-control" type="text" placeholder="Your comment">\n' +
                    '    </div>\n' +
                    '</div>' +
                    '');
            });
        }

        $.post("/functions/ajax/getPosts.php",
            {},
            function (data, status) {
                displayPosts(JSON.parse(data));
            });
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
                    $.post("/functions/ajax/getPosts.php",
                        {},
                        function (data, status) {
                            displayPosts(JSON.parse(data));
                        });
                });
            CKEDITOR.instances.editor.setData('');
        });
    </script>

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
    </script>

<?php
include_once("view/footer.php");
?>