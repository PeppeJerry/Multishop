<?php

if(isset($_SESSION['user'])){
	require "get_con.php";
	$con = get_con();
	if(!$con){
		header('Location: ./index.php?error=2');
		exit();
	}
	
	$query = "SELECT userid,a_product,a_admin,pwd,enable FROM users WHERE userid = :user";
	$link = $con->prepare($query);
	$link->bindParam(":user",$_SESSION['user']);
	$link->execute();
	$result = $link->fetch();
	
	if(!isset($result['userid'])){
		session_destroy();
		header('Location: ./login.php?error=5');
		exit();
	}
	
	if(!$result['enable']){
		session_destroy();
		header('Location: ./login.php?error=3');
		exit();
	}
	
	if(strcmp(md5($result['pwd']),$_SESSION['check'])){
		session_destroy();
		header('Location: ./login.php?error=5');
		exit();
	}
	
	$_SESSION['user']=$result['userid'];
	$_SESSION['a_p']=$result['a_product'];
	$_SESSION['a_a']=$result['a_admin'];
	unset($con);
	unset($link);
}