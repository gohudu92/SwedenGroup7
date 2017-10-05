<h4>Connected User</h4>

<script>
    function waitBeforeShowOnline() {
        setTimeout(function() {
            updateShowOnlinefForThisUser();
        }, timeBeforeShowOnline);
    }

    function updateShowOnlinefForThisUser() {
        $.post("/functions/ajax/displayOnline.php",
            {
                timeBeforeShowOnline: timeBeforeShowOnline
            },
            function (data, status) {
                $("#usersConnected").empty();
                var parsed = JSON.parse(data);
                var arr = [];
                for(var x in parsed){
                    arr.push(parsed[x]);
                }
                for (var i = 0; i < arr.length; i=i+2) {
                    if(global_id_user==arr[i+1] || global_id_user==0){
                        $("#usersConnected").append(
                            '<span class="label label-default">'+arr[i]+'</span><br/>'
                        )
                    }else{
                        $("#usersConnected").append(
                            '<span class="label label-default">'+arr[i]+'</span><i onclick="openChatBox('+arr[i+1]+')" class="fa fa-paper-plane" aria-hidden="true"></i><br/>'
                        )
                    }
                }
            });
        waitBeforeShowOnline();
    }
</script>

<div id="usersConnected" class="usersSideBar">

</div>