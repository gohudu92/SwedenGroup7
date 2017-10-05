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
                for (var i = 0; i < arr.length; i++) {
                    $("#usersConnected").append(
                        '<span class="label label-default">'+arr[i]+'</span><i class="fa fa-paper-plane" aria-hidden="true"></i><br/>'
                    )
                }
            });
        waitBeforeShowOnline();
    }
</script>

<div id="usersConnected" class="usersSideBar">

</div>