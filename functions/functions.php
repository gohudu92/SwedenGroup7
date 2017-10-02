<?php
function loginUser($mail,$pseudo,$password,$bdd){
	if($mail=="" OR $pseudo=="" OR $mail==null OR $pseudo==null){
		return "Mail or Username required";
	}if($password=="" OR $password==""){
		return "Password required";
	}
	
	$reqMail=$bdd->prepare("SELECT * FROM `user` WHERE mail=?");
	$reqMail->execute(array($mail));
	$reqUsername=$bdd->prepare("SELECT * FROM `user` WHERE username=?");
	$reqUsername->execute(array($pseudo));
	$countMail = $reqMail->rowCount();
	$countUsername = $reqUsername->rowCount();
	if($countMail==0 AND $countUsername==0){
		return "Bad Mail or Username";
	}
	if($countMail!=0){
		$datas = $bdd->prepare("SELECT * FROM `user` WHERE mail=?");
		$datas->execute(array($mail));
		while ($data = $datas->fetch()) {
			if($data['password']==$password){
				$_SESSION['id']=$data['id'];
				$_SESSION['admin']=$data['admin'];
				$_SESSION['username']=$data['username'];
				$_SESSION['mail']=$data['mail'];
				return true;
			}
		}
	}elseif($countUsername!=0){
		$datas = $bdd->prepare("SELECT * FROM `user` WHERE username=?");
		$datas->execute(array($pseudo));
		while ($data = $datas->fetch()) {
			if($data['password']==$password){
				$_SESSION['id']=$data['id'];
				$_SESSION['username']=$data['username'];
				$_SESSION['mail']=$data['mail'];
				return true;
			}
		}
	}
	return "Bad Password";
}

function registerUser($mail,$pseudo,$password,$password2,$bdd){
	if($password!=$password2){
		return "Passwords don't match.";
	}
	$reqMail=$bdd->prepare("SELECT * FROM `user` WHERE mail=?");
	$reqMail->execute(array($mail));
	$reqUsername=$bdd->prepare("SELECT * FROM `user` WHERE username=?");
	$reqUsername->execute(array($pseudo));
	$countMail = $reqMail->rowCount();
	$countUsername = $reqUsername->rowCount();
	if($countMail!=0){
		return "Mail already exist";
	}if($countUsername!=0){
		return "Username already exist";
	}
	$req=$bdd->prepare("INSERT INTO `user`(`mail`, `password`, `username`) VALUES (?,?,?)");
	$req->execute(array($mail,$password,$pseudo));
}