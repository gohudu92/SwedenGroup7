<?php

function loginUser($mail,$username,$password,$bdd){
	if($mail=="" OR $username=="" OR $mail==null OR $username==null){
		return "Mail or Username required";
	}if($password=="" OR $password==""){
		return "Password required";
	}
	
	$reqMail=$bdd->prepare("SELECT * FROM `user` WHERE mail=?");
	$reqMail->execute(array($mail));
	$reqUsername=$bdd->prepare("SELECT * FROM `user` WHERE username=?");
	$reqUsername->execute(array($username));
	$countMail = $reqMail->rowCount();
	$countUsername = $reqUsername->rowCount();
	if($countMail==0 AND $countUsername==0){
		return "Bad Mail or Username";
	}else{
		if($countMail!=0){
			$datas = $bdd->prepare("SELECT * FROM `user` WHERE mail=?");
			$datas->execute(array($mail));
		}else{
			$datas = $bdd->prepare("SELECT * FROM `user` WHERE username=?");
			$datas->execute(array($username));
		}
		while ($data = $datas->fetch()) {
			if($data['password']==sha1($password)){
				$_SESSION['id']=$data['id'];
				$_SESSION['username']=$data['username'];
				$_SESSION['mail']=$data['mail'];
				return true;
			}
		}
	}
	return "Bad Password";
}

function registerUser($mail,$username,$password,$password2,$bdd){
	if($password!=$password2){
		return "Passwords don't match.";
	}
	$reqMail=$bdd->prepare("SELECT * FROM `user` WHERE mail=?");
	$reqMail->execute(array($mail));
	$reqUsername=$bdd->prepare("SELECT * FROM `user` WHERE username=?");
	$reqUsername->execute(array($username));
	$countMail = $reqMail->rowCount();
	$countUsername = $reqUsername->rowCount();
	if($countMail!=0){
		return "Mail already exist";
	}if($countUsername!=0){
		return "Username already exist";
	}
	$req=$bdd->prepare("INSERT INTO `user`(`mail`, `password`, `username`) VALUES (?,?,?)");
	$req->execute(array($mail,sha1($password),$username));
}

function isConnected(){
    if(isset($_SESSION['id'])){
        return true;
    }
    return false;
}

function getId(){
    if(isConnected()){
        return $_SESSION['id'];
    }
    return null;
}