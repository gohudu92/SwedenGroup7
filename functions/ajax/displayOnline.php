<?php
include_once("../../config/config.php");

$result = null;
$time = time() - ($_POST['timeBeforeShowOnline'] / 1000);

$datas = $bdd->prepare("SELECT * FROM `online` WHERE `time`>?");
$datas->execute(array($time));

$resultIdConnected = array();
while ($data = $datas->fetch()) {
    array_push($resultIdConnected, $data['id_user']);
}
if (count($resultIdConnected) > 0) {
    $req = "SELECT * FROM `user` WHERE `id`=" . $resultIdConnected[0];
    $i = 1;
    while (isset($resultIdConnected[$i])) {
        $req = $req . " OR `id`=" . $resultIdConnected[$i];
        $i++;
    }
    $datas = $bdd->query($req);
    $result = array();
    $y = 0;
    while ($data = $datas->fetch()) {
        $result[$y] = [$data['username']];
        $result[$y + 1] = [$data['id']];
        $y = $y + 2;
    }
}
$result = json_encode($result);
echo $result;