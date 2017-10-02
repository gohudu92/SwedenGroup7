<?php
$current_page = basename($_SERVER['PHP_SELF']);
$title = "No title";
if ($current_page == 'index.php') {
    $title = "Home";
}
$nameWebsite="Fake Facebook";