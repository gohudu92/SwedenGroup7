<?php
include_once("../../config/config.php");

$data = $_POST['post'];
$data = json_decode($data);
$id_user = $_POST['id_user'];

$req = $bdd->prepare("INSERT INTO `post`(`user_id`, `content`, `time`) VALUES (?,?,?)");
$req->execute(array($id_user, $data, time()));
