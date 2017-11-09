<?php
include_once("../../config/config.php");

$data = $_POST['post'];
$data = json_decode($data);
$id_user = $_POST['id_user'];
$cat_name = strtolower($_POST["cat"]);

if ($data != "" AND $cat_name != '') {
    $req = $bdd->prepare("INSERT INTO `post`(`user_id`, `content`, `time`, `love`, `category_name`) VALUES (?,?,?,?,?)");
    $req->execute(array($id_user, $data, time(), 0, $cat_name));

    $datas = $bdd->prepare("SELECT * FROM `category` WHERE name=?");
    $datas->execute(array($cat_name));
    $count = $datas->rowCount();
    if ($count == 0) {
        $req = $bdd->prepare("INSERT INTO `category`(`name`) VALUES (?)");
        $req->execute(array($cat_name));
    }
}

