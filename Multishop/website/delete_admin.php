<?php
session_start();
require "assets/php/check_session.php";
$con = get_con();

if(!(isset($_SESSION['a_p']) AND $_SESSION['a_p'] AND $_SESSION['priority'] == 1)){
	header("Location: ./");
	exit();
}

if(!isset($_POST['todelete'])){
	
}

$link = $con->prepare("SELECT COUNT(*) as num FROM users WHERE priority = 1 AND a_admin = 1");
$link->execute();
$num = $link->fetch();
$num = $num['num'];

$link = $con->prepare("SELECT COUNT(*) as num FROM users");
$link->execute();
$num2 = $link->fetch();
$num2 = $num2['num'];

if(($num == 1 AND $num2-$num!=0) OR $num != 1){
	
	$admin = $con->prepare("SELECT COUNT(*) as num FROM users WHERE id = :id");
	$admin->bindParam(":id",$_POST['todelete']);
	$admin->execute();
	$admin = $admin->fetch();
	$admin = $admin['num'];
	
	if($admin != 1){
		header("Location: ./deleteadmin.php?error=1"); // Missing user
		exit();
	}
	$admin = $con->prepare("SELECT userid FROM users WHERE id=:id");
	$admin->bindParam(":id",$_POST['todelete']);
	$admin->execute();
	$admin = $admin->fetch();
	$admin = $admin['userid'];
	
	$link = $con->prepare("DELETE FROM users WHERE id=:id");
	$link->bindParam(":id",$_POST['todelete']);
	$link->execute();
	
	$stock = 2;
	$action = "Deleted User [".$admin."] from [".$_SESSION['user']."]";
	$query = 'INSERT INTO prod_transictions(stockist,action) VALUES (:stock,:action)';
	$link = $con->prepare($query);
	$link->bindParam(":action",$action);
	$link->bindParam(":stock",$stock);
	$link->execute();
	header("Location: ./deleteadmin.php?error=2"); // Done
	exit();
}
else{
	header("Location: ./deleteadmin.php");
	exit();
}