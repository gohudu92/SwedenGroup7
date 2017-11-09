<?php
include_once("../../config/config.php");

$req = $bdd->prepare("DELETE FROM `comment` WHERE `id`=?");
$req->execute(array($_POST["id"]));