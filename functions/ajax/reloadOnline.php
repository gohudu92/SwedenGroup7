<?php
include_once("../../config/config.php");

$id=$_POST['id'];

$req=$bdd->prepare("UPDATE `online` SET `time`=:varTime WHERE `id_user`=:idUser");
$req->bindParam(":varTime",time());
$req->bindParam(":idUser",$id);
$req->execute();