<?php

function getUsers($bdd, $nbUsers)
{
    if (isConnected()) {
        $datas = $bdd->prepare("SELECT * FROM `user` WHERE id!=? LIMIT " . $nbUsers);
        $datas->execute(array(getId()));
    } else {
        $datas = $bdd->prepare("SELECT * FROM `user` LIMIT " . $nbUsers);
        $datas->execute();
    }
    $result=array();
    while ($data = $datas->fetch()) {
        array_push($result,$data['username']);
    }
    return $result;
}