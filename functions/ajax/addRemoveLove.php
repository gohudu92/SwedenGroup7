<?php
include_once("../../config/config.php");

$post_id = $_POST["post"];
$user_id = $_POST["user"];

if($user_id==0){
    die();
}

function getNbLovePost($bdd, $id)
{
    $datas = $bdd->prepare("SELECT * FROM `post` WHERE `id`=?");
    $datas->execute(array($id));
    while ($data = $datas->fetch()) {
        return $data["love"];
    }
}

$datas = $bdd->prepare("SELECT * FROM `love` WHERE `user_id`=? AND `post_id`=?");
$datas->execute(array($user_id, $post_id));
$count = $datas->rowCount();

if ($count == 0) {
    $req = $bdd->prepare("INSERT INTO `love`(`user_id`, `post_id`) VALUES (?,?)");
    $req->execute(array($user_id, $post_id));
    $nbLovePost = getNbLovePost($bdd, $post_id) + 1;
    $req2 = $bdd->prepare("UPDATE `post` SET `love`=:love WHERE `id`=:id");
    $req2->bindParam(":love", $nbLovePost);
    $req2->bindParam(":id", $post_id);
    $req2->execute();
    echo "add";
} else {
    $req = $bdd->prepare("DELETE FROM `love` WHERE `user_id`=? AND `post_id`=?");
    $req->execute(array($user_id, $post_id));
    $nbLovePost = getNbLovePost($bdd, $post_id) - 1;
    $req2 = $bdd->prepare("UPDATE `post` SET `love`=:love WHERE `id`=:id");
    $req2->bindParam(":love", $nbLovePost);
    $req2->bindParam(":id", $post_id);
    $req2->execute();
    echo "remove";
}
