<?php
include_once("config/config.php");
include_once("view/header.php");
?>
    <div class="container">
        <h1>Lastest Posts</h1>

        <div class="col-xs-8 col-xs-offset-2">
            <?php if (isConnected()) { ?>
                <div id="editor">test</div>
                <div class="end-editor">
                    <button id="sendEditorData" type="button" class="btn btn-primary">Send</button>
                </div>
            <?php } ?>
            <div class="allPost">
                <div class="post">
                    <div class="row">
                        <div class="col-xs-2">
                            <img src="view/img/default.png" class="img-responsive" alt="profile">
                        </div>
                        <div class="col-xs-10">
                            <p>Name</p>
                            <p>date</p>
                        </div>
                    </div>
                    <div class="row">
                        <p>Content</p>
                    </div>
                    <hr/>
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    <i class="fa fa-comment-o" aria-hidden="true"></i>
                    <div class="row">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>5
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-xs-2">
                            <img src="view/img/default.png" class="img-responsive" alt="profile">
                        </div>
                        <div class="col-xs-10">
                            <p><span>Name</span> <span>Content</span></p>
                            <p>Date</p>
                        </div>
                    </div>
                    <div class="row">
                        <input class="form-control" type="text" placeholder="Your comment">
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    if (status == "200") {
//                        addNewPost();
                    }
                });
            CKEDITOR.instances.editor.setData('');
        });
    </script>

    <script>//get Posts
        function displayPosts(array) {
            array.forEach(function (post) {
                console.log(post);
            });
        }

        $.post("/functions/ajax/getPosts.php",
            {},
            function (data, status) {
                displayPosts(JSON.parse(data));
            });
    </script>
<?php
include_once("view/footer.php");
?>