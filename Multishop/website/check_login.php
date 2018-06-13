<?php

try{
	$user = $_POST['admin'];
	$pwd  = $_POST['pwd'];
}
catch(Exception $e){
	header('Location: ./login.php?error=1');
	exit();
}

$pwd = hash("sha512",md5($pwd).$pwd);

require "./assets/php/get_con.php";

$con = get_con();
if(!$con){
	header('Location: ./login.php?error=2');
	exit();
}

$query = "SELECT * FROM users WHERE userid = :user AND pwd = :pwd";

$link = $con->prepare($query);

$link->bindParam(":user",$user);
$link->bindParam(":pwd",$pwd);
$link->execute();

$result = $link->fetch();


if(!isset($result['userid'])){
	header('Location: ./login.php?error=1');
	exit();
}

if(!$result['enable']){
	header('Location: ./login.php?error=3');
	exit();
}

session_start();

$_SESSION['user']=$result['userid'];
$_SESSION['a_p']=$result['a_product'];
$_SESSION['a_a']=$result['a_admin'];
$_SESSION['check'] = md5($pwd);
$_SESSION['priority'] = $result['priority'];

header('Location: ./index.php');
