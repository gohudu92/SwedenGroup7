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
    $datas = $bdd->prepare("SELECT * FROM `user` WHERE id=?");
    $datas->execute(array($id));
    while ($data = $datas->fetch()) {
        $img = $data["image"];
    }
    if (is_string($img) AND $img != '') {
        return '/view/img/uploads/' . $img;
    } else {
        return 'view/img/default.png';
    }
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
    $data["imgUrl"]=getImageUrlUser($bdd, $user_id);
    array_push($result, $data);
}
echo json_encode($result);