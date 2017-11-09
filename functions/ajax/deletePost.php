<?php
include_once("../../config/config.php");

$id = $_POST["id"];

function deleteLove($id, $bdd)
{
    $req = $bdd->prepare("DELETE FROM `love` WHERE `id`=?");
    $req->execute(array($id));
}

function deleteComment($id, $bdd)
{
    $req = $bdd->prepare("DELETE FROM `comment` WHERE `id`=?");
    $req->execute(array($id));
}

$datas = $bdd->prepare("SELECT * FROM `love` WHERE `post_id`=?");
$datas->execute(array($id));
$allLove = array();
while ($data = $datas->fetch(PDO::FETCH_ASSOC)) {
    array_push($allLove, $data);
}
foreach ($allLove as $obj) {
    deleteLove($obj["id"], $bdd);
}

$datas = $bdd->prepare("SELECT * FROM `comment` WHERE `post_id`=?");
$datas->execute(array($id));
$allComment = array();
while ($data = $datas->fetch(PDO::FETCH_ASSOC)) {
    array_push($allComment, $data);
}
foreach ($allComment as $obj) {
    deleteComment($obj["id"], $bdd);
}

$req = $bdd->prepare("DELETE FROM `post` WHERE `id`=?");
$req->execute(array($id));