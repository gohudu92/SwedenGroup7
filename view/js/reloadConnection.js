function waitBeforeUpdateOnline($id) {
    setTimeout(function() {
        updateOnlinefForThisUser($id);
    }, timeBeforeReloadOnline);
}

function updateOnlinefForThisUser($id) {
    $.post("/functions/ajax/reloadOnline.php",
        {
            id: $id
        },
        function (data, status) {});
    waitBeforeUpdateOnline($id);
}