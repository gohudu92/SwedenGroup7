<?php
include_once("../../config/config.php");

$content = $_POST["contents"];
$user_id = $_POST["id_user"];
$idPost = $_POST["idPost"];

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

function getUsernameById($bdd, $id)
{
    $datas = $bdd->prepare("SELECT * FROM `user` WHERE id=?");
    $datas->execute(array($id));
    while ($data = $datas->fetch()) {
        return $data["username"];
    }
}

$req = $bdd->prepare("INSERT INTO `comment`(`user_id`, `content`, `time`, `post_id`) VALUES (?,?,?,?)");
$req->execute(array($user_id, $content, time(), $idPost));

$data["username"] = getUsernameById($bdd, $user_id);
$data["contents"] = $content;
$data["date"] = date('Y-m-d H:i:s', time());
$data["img"] = getImageUrlUser($bdd, $user_id);

echo json_encode($data);