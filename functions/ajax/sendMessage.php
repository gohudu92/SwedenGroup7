<?php
include_once("../../config/config.php");
$content=$_POST['contentInput'];
$id_receiver=$_POST['id_receiver'];
$id_sender=$_POST['id_sender'];

$req=$bdd->prepare("INSERT INTO `messages`(`id_receiver`, `id_sender`, `content`, `time`, `view`) VALUES (?,?,?,?,?)");
$req->execute(array($id_receiver,$id_sender,$content,time(),0));

$time=time();
$date=date("F j, Y, g:i a",$time);
echo $date;