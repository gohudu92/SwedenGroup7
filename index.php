<?php
include_once("config/config.php");
include_once("view/header.php");
?>
    <div class="container paddingBot30">
        <h1>Lastest Posts
            <?php
            if (isset($_GET["cat"]) AND $_GET["cat"] != '') {
                echo " : " . ucfirst($_GET["cat"]);
            }
            ?>
        </h1>

        <div class="col-xs-8 col-xs-offset-2">
            <?php if (isConnected()) { ?>
                <div id="editor"></div>
                <div class="end-editor" style="display: inline-block">
                    <div class="col-xs-10">
                        <input class="form-control" id="categoryInput" placeholder="Category"/>
                    </div>
                    <div class="col-xs-2">
                        <button id="sendEditorData" type="button" class="btn btn-primary">Send</button>
                    </div>
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
                    '<div class="post" id="' + post.id + '">\n';
                if (global_id_user == post.user_id) {
                    onePost = onePost + '<i onclick="deletePost(this)" class="fa fa-times deletePost" aria-hidden="true"></i>\n';
                }
                onePost = onePost + '    <div class="col-xs-12">\n' +
                    '        <img src="' + post.imgUrl + '" class="img-responsive img-circle profilePicture" alt="profile">\n' +
                    '        <p class="name"><a href="#">' + post.username + '</a></p>\n' +
                    '        <p class="date">' + post.date + '</p>\n' +
                    '    </div>\n' +
                    '    <div class="col-xs-12">\n' +
                    '        <p class="content">' + post.content + '</p>\n' +
                    '    </div>\n' +
                    '    <div class="col-xs-10 col-xs-offset-1">\n' +
                    '        <hr/>\n' +
                    '    </div>\n' +
                    '<div id="newComment"></div>' +
                    '    <div class="col-xs-12 interact">\n' +
                    '        <span class="addRemoveLove pointer ' + post.nbLove + '" onclick="addLove(this)" style="margin-right: 5px"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</span>\n' +
                    '        <span class="pointer" onclick="hideShowComment(this)"><i class="fa fa-comment-o" aria-hidden="true"></i> Comment</span>\n' +
                    '    </div>\n' +
                    '    <hr/>\n' +
                    '    <div class="comments">\n' +
                    '    <span class="nbLoveMargin"><i class="fa fa-thumbs-up noPointer" aria-hidden="true"></i> <span class="nbLove">' + post.love + '</span></span>\n' +
                    '<div class="newComment"></div>';
                (post.comments).forEach(function (comment) {
                    onePost = onePost + '<div class="col-xs-12">\n' +
                        '        </div>\n' +
                        '        <div class="col-xs-10 col-xs-offset-1">\n' +
                        '            <hr style="margin-bottom: 5px;"/>\n' +
                        '        </div>\n' +
                        '        <div class="col-xs-12 oneComment" id="' + comment.id + '">\n' +
                        '            <img src="' + comment.imgUrl + '" class="img-responsive img-circle profilePicture"\n' +
                        '                 alt="profile">\n' +
                        '            <p><a href="#"><span class="name">' + comment.username + '</span></a> <span class="content">' + comment.content + '</span></p>\n' +
                        '            <p class="date">' + comment.date + '</p>\n';
                    if (global_id_user == comment.user_id) {
                        onePost = onePost + '<p onclick="deleteComment(this)" class="delete pointer">Delete</p>\n';
                    }
                    onePost = onePost + '        </div>\n';
                });
                onePost = onePost + '    </div>\n' +
                    '    <div class="col-xs-12">\n' +
                    '<form class="sendComment">' +
                    '        <input style="display: none" class="form-control" type="text" placeholder="Your comment">\n' +
                    '</form>' +
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
            var cat = "";
            <?php if (isset($_GET['cat'])) { ?>
            cat = '<?= $_GET['cat']; ?>';
            <?php } ?>
            $.post("/functions/ajax/getPosts.php",
                {
                    id_user: global_id_user,
                    cat: cat
                },
                function (data, status) {
                    console.log(data);
                    displayPosts(JSON.parse(data));
                });
        }

        function addComment($this, data) {
            var oneComment = '' +
                '<div class="col-xs-12">\n' +
                '        </div>\n' +
                '        <div class="col-xs-10 col-xs-offset-1">\n' +
                '            <hr style="margin-bottom: 5px;"/>\n' +
                '        </div>\n' +
                '        <div class="col-xs-12 oneComment" id="' + data.id + '">\n' +
                '            <img src="' + data.img + '" class="img-responsive img-circle profilePicture"\n' +
                '                 alt="profile">\n' +
                '            <p><a href="#"><span class="name">' + data.username + '</span></a> <span class="content">' + data.contents + '</span></p>\n' +
                '            <p class="date">' + data.date + '</p>\n' +
                '<p onclick="deleteComment(this)" class="delete pointer">Delete</p>\n' +
                '        </div>\n' +
                '';
            $($this).append(oneComment);
        }

        function deleteComment($this) {
            var comment = $($this).parent();
            var hr = $(comment).prev();
            $.post("/functions/ajax/deleteComment.php",
                {
                    id: $(comment).attr("id")
                },
                function (data, status) {
                    $(comment).remove();
                    $(hr).remove();
                });
        }

        function deletePost($this) {
            var postElement = getPostElement($this);
            $.post("/functions/ajax/deletePost.php",
                {
                    id: $(postElement).attr("id")
                },
                function (data, status) {
                    console.log(data);
                    $(postElement).remove();
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
            category = $("#categoryInput").val();
            $("#categoryInput").val("");
            $.post("/functions/ajax/sendPost.php",
                {
                    post: datas,
                    id_user: global_id_user,
                    cat: category
                },
                function (data, status) {
                    getPosts();
                });
            CKEDITOR.instances.editor.setData('');
        });

        $(document).on('submit', 'form.sendComment', function (e) {
            e.preventDefault();
            var content = $(e.target).find("input").val();
            var idPost = $(getPostElement(e.target)).attr("id");
            $.post("/functions/ajax/sendComment.php",
                {
                    contents: content,
                    id_user: global_id_user,
                    idPost: idPost
                },
                function (data, status) {
                    $(e.target).find("input").val("");
                    addComment($(getPostElement(e.target)).find(".newComment"), JSON.parse(data))
                });
        });
    </script>
<?php
include_once("view/footer.php");
?>