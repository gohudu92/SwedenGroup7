<?php
include_once("../../config/config.php");

function getUsernameById($bdd, $id)
{
    $datas = $bdd->prepare("SELECT * FROM `user` WHERE id=?");
    $datas->execute(array($id));
    while ($data = $datas->fetch()) {
        return $data["username"];
    }
}

$datas = $bdd->prepare("SELECT * FROM `post` ORDER BY `id` DESC");
$datas->execute(array());
$result = array();
while ($data = $datas->fetch(PDO::FETCH_ASSOC)) {
    $username = getUsernameById($bdd, $data["user_id"]);
    $data["username"] = $username;
    array_push($result, $data);
}
echo json_encode($result);