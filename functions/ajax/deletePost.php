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

$cat_name = "";
$datas = $bdd->prepare("SELECT * FROM `post` WHERE `id`=?");
$datas->execute(array($id));
while ($data = $datas->fetch(PDO::FETCH_ASSOC)) {
    $cat_name = $data["category_name"];
}

if ($cat_name != "") {
    $datas = $bdd->prepare("SELECT * FROM `post` WHERE `category_name`=?");
    $datas->execute(array($cat_name));
    $count = $datas->rowCount();
    if($count<=1){
        $req = $bdd->prepare("DELETE FROM `category` WHERE `name`=?");
        $req->execute(array($cat_name));
    }
}

$req = $bdd->prepare("DELETE FROM `post` WHERE `id`=?");
$req->execute(array($id));