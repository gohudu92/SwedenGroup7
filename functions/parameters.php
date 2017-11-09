<?php
$current_page = basename($_SERVER['PHP_SELF']);
$nameWebsite = "Fake Facebook";
$title = $nameWebsite;
if ($current_page == 'index.php') {
    $title = "Home";
}
if ($current_page == 'profile.php') {
    $title = "Profile";
}