</div><!-- Closing main container -->

<div class="col-xs-2 well" id="side_bar">
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/view/side_bar/side_bar.php"); ?>
</div>

<div class="col-xs-2 well">
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/view/side_bar/side_bar_right.php"); ?>
</div>

<footer>

</footer>

<div id="allChatBox" class="container" style="z-index: 1;height: 1px"></div>

<script src="/view/js/parameters.js"></script>

<script src="/view/js/script.js"></script>

<?php
if (isConnected()) {
    ?>
    <script src="/view/js/reloadConnection.js"></script>
    <script src="/view/js/chat.js"></script>
    <script>
        $(document).ready(function () {
            updateOnlinefForThisUser(<?= getId(); ?>);
        });
    </script>
<?php } ?>

<script>
    $(document).ready(function () {
        updateShowOnlinefForThisUser();
        initSample();
    });
</script>

</body>
</html>
