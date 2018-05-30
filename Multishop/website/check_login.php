<?php
require './assets/php/secure_user.php';

try{
	$user = $_POST['admin'];
	$pwd  = $_POST['pwd'];
}
catch(Exception $e){
	header('Location: ./login.php?error=Missing+param');
	exit();
}


if(secure_user($user)){
	header('Location: ./login.php?error=Login+failed');
	exit();
}
$pwd = hash("sha512",md5($pwd).$pwd);

require "./assets/php/get_con.php";

$con = get_con();
if(!$con){
	header('Location: ./login.php?error=Connection+aborted');
	exit();
}

$query = "SELECT userid,a_product,a_admin,enable FROM users WHERE userid = :user AND pwd = :pwd";

$link = $con->prepare($query);

$link->bindParam(":user",$user);
$link->bindParam(":pwd",$pwd);
$link->execute();

$result = $link->fetch();


if(!isset($result['userid'])){
	header('Location: ./login.php?error=Login+failed');
	exit();
}

if(!$result['enable']){
	header('Location: ./login.php?error=Account+disabled');
	exit();
}

session_start();

$_SESSION['user']=$result['userid'];
$_SESSION['a_p']=$result['a_product'];
$_SESSION['a_a']=$result['a_admin'];
$_SESSION['check'] = md5($pwd);

header('Location: ./index.php');
