<?php
session_start();

require "assets/php/get_con.php";

$con = get_con();
try{
	$pwd = $_POST['pwd'];
	$n_pwd = $_POST['n_pwd'];
	$c_pwd = $_POST['c_pwd'];
}
catch(Exception $e){
	header("Location: ./changepassword.php?error=1"); // Missing Parameters
	exit();
}
$storepwd = $pwd;
$pwd = hash('sha512',md5($pwd).$pwd);

$link = $con->prepare("SELECT COUNT(*) as num FROM users WHERE userid=:user AND pwd=:pwd");
$link->bindParam(":user",$_SESSION['user']);
$link->bindParam(":pwd",$pwd);

$link->execute();
$res = $link->fetch();
$res = $res['num'];

if($res != 1){
	header("Location: ./changepassword.php?error=2"); // Bad Current Password
	exit();
}

if(strcmp($n_pwd,$c_pwd)){
	header("Location: ./changepassword.php?error=3"); // Password Dis-match
	exit();
}

require "assets/php/secure_pwd.php";

if(secure_password($n_pwd)){
	header("Location: ./changepassword.php?error=4"); // Bad Password
	exit();
}

if(!strcmp($storepwd,$n_pwd)){
	header("Location: ./changepassword.php?error=7"); // Same Password as before
	exit();
}

$pwd = hash('sha512',md5($n_pwd).$n_pwd);

$link = $con->prepare("UPDATE users SET pwd = :pwd WHERE userid = :user");
$link->bindParam(":pwd",$pwd);
$link->bindParam(":user",$_SESSION['user']);
$link->execute();
$r = $link->rowCount();
if($r != 0){
	$_SESSION['check'] = md5($pwd);
	header("Location: ./changepassword.php?error=5"); // Done
	exit();
}
else{
	header("Location: ./changepassword.php?error=6"); // An error
	exit();
}
?>