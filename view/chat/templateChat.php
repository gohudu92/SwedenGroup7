<div id="<?= $_POST['id']; ?>" class="row chat-window newChat col-xs-3" style="left: 0px;">
    <div class="col-xs-12" style="padding-left: 0px;">
        <div class="panel panel-default">
            <div class="panel-heading top-bar">
                <div class="col-md-8 col-xs-8">
                    <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat - Miguel</h3>
                </div>
                <div class="col-md-4 col-xs-4" style="text-align: right;">
                    <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                    <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                </div>
            </div>
            <div class="panel-body msg_container_base">

            </div>
            <div class="panel-footer">
                <input id="<?= $_POST['id']; ?>" type="text" class="form-control sendMessage"
                       placeholder="Write your message here..."/>
            </div>
        </div>
    </div>
</div>