<?php
if(isset($_POST['registrationForm'])){
	$resulRegistrationLogin="";
	$resulRegistrationLogin=registerUser($_POST['registrationEmail'],$_POST['registrationUsername'],$_POST['registrationPassword'],$_POST['registrationConfirm'],$bdd);
	if($resulRegistrationLogin==""){
		loginUser($_POST['registrationEmail'],$_POST['registrationUsername'],$_POST['registrationPassword'],$bdd);
	}
}
if(isset($_POST['loginUser'])){
	$resulRegistrationLogin="";
	$resulRegistrationLogin=loginUser($_POST['emailUsername'],$_POST['emailUsername'],$_POST['password'],$bdd);
}
