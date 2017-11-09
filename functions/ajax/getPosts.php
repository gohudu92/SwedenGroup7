<?php
include_once("../../config/config.php");

$user_id = $_POST["id_user"];

function getUsernameById($bdd, $id)
{
    $datas = $bdd->prepare("SELECT * FROM `user` WHERE id=?");
    $datas->execute(array($id));
    while ($data = $datas->fetch()) {
        return $data["username"];
    }
}

function getImageUrlUser($bdd, $id)
{
    if ($id != 0) {
        $datas = $bdd->prepare("SELECT * FROM `user` WHERE id=?");
        $datas->execute(array($id));
        while ($data = $datas->fetch()) {
            $img = $data["image"];
        }
        if (is_string($img) AND $img != '') {
            return '/view/img/uploads/' . $img;
        } else {
            return '/view/img/default.png';
        }
    }
    return '/view/img/default.png';
}

function loveThisPost($bdd, $user_id, $post_id)
{
    if ($user_id != 0) {
        $datas = $bdd->prepare("SELECT * FROM `love` WHERE `user_id`=? AND `post_id`=?");
        $datas->execute(array($user_id, $post_id));
        $count = $datas->rowCount();
        if ($count != 0) {
            return true;
        }
    }
    return false;
}

function getComments($bdd, $post_id)
{
    $datas = $bdd->prepare("SELECT * FROM `comment` WHERE post_id=? ORDER BY `id` DESC");
    $datas->execute(array($post_id));
    $result = array();
    while ($data = $datas->fetch(PDO::FETCH_ASSOC)) {
        $data["username"] = getUsernameById($bdd, $data["user_id"]);
        $data["date"] = date('Y-m-d H:i:s', intval($data["time"]));
        $data["imgUrl"] = getImageUrlUser($bdd, $data["user_id"]);
        array_push($result, $data);
    }
    return $result;
}

$datas = $bdd->prepare("SELECT * FROM `post` ORDER BY `id` DESC");
$datas->execute(array());
$result = array();
while ($data = $datas->fetch(PDO::FETCH_ASSOC)) {
    $username = getUsernameById($bdd, $data["user_id"]);
    $data["username"] = $username;
    $data["date"] = date('Y-m-d H:i:s', intval($data["time"]));
    if (loveThisPost($bdd, $user_id, $data["id"])) {
        $data["nbLove"] = "active";
    } else {
        $data["nbLove"] = "";
    }
    $data["imgUrl"] = getImageUrlUser($bdd, $data["user_id"]);
    $data["comments"] = getComments($bdd, $data["id"]);
    array_push($result, $data);
}
echo json_encode($result);