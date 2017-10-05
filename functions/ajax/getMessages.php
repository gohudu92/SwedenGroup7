<?php
include_once("../../config/config.php");

$id_other_user=$_POST['id_other_user'];
$me=$_POST['me'];

$datas = $bdd->prepare("SELECT * FROM `messages` WHERE (`id_receiver`=? AND `id_sender`=?) OR (`id_receiver`=? AND `id_sender`=?) ORDER BY `id` ASC");
$datas->execute(array($id_other_user,$me,$me,$id_other_user));
$result=array();
while ($data = $datas->fetch()) {
    array_push($result,$data['id_sender']);
    array_push($result,$data['content']);
    $date=date("F j, Y, g:i a",$data['time']);
    array_push($result,$date);
}
$viewe=1;
$req=$bdd->prepare("UPDATE `messages` SET `view`=:viewe WHERE `id_receiver`=:id_receiver AND `id_sender`=:id_sender ORDER BY `id` ASC");
$req->bindParam(":viewe",$viewe);
$req->bindParam(":id_receiver",$me);
$req->bindParam(":id_sender",$id_other_user);
$req->execute();
$result=json_encode($result);
echo $result;