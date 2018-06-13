<?php

session_start();

require "assets/php/get_con.php";

$con = get_con();
$link = $con->prepare('SELECT priority FROM users WHERE userid = :name');
$link->bindParam(":name",$_SESSION['user']);
$link->execute();
$priority = $link->fetch();
$priority = $priority['priority'];

if(!($priority == 1 OR $priority == 2)){
	header("Location: ./newadmin.php?error=1"); // Missing privilage 1
	exit();
}

if(!isset($_POST['name']) OR !isset($_POST['pwd']) OR !isset($_POST['c_pwd'])){
	header("Location: ./newadmin.php?error=2"); // Missing Paramether 2
	exit();
}

$user = $_POST['name'];
$pwd = $_POST['pwd'];
$c_pwd = $_POST['c_pwd'];

require "assets/php/secure_form.php";

$link = $con->prepare("SELECT COUNT(*) as num FROM users WHERE userid = :name");
$link->bindParam(":name",$user);
$link->execute();
$num = $link->fetch();
$num = $num['num'];

if($num != 0){
	header("Location: ./newadmin.php?error=4"); // User Already Exist 4
	exit();
}

if(strcmp(secure_form($user,$pwd,$c_pwd),"Good")){
	header("Location: ./newadmin.php?error=3"); // Bad form 3
	exit();
}

$pwd = hash("sha512",(md5($pwd).$pwd));

if(!isset($_POST['priority']))
	$_POST['priority'] = 2;

if(($_POST['priority'] == 1 OR $_POST['priority'] == 2) AND $priority != 1){
	header("Location: ./newadmin.php?error=1"); // Missing privilage 1
	exit();
}

$a_a = false;
if(isset($_POST['a_a']) AND $_POST['a_a'] == 1)
	$a_a = true;

$a_p = false;
if(isset($_POST['a_p']) AND $_POST['a_p'] == 1)
	$a_p = true;



$link = $con->prepare("INSERT INTO users(userid,pwd,a_product,a_admin,priority) VALUES (:name,:pwd,:a_a,:a_p,:prio)");
$link->bindParam(":name",$user);
$link->bindParam(":pwd",$pwd);
$link->bindParam(":a_a",$a_a);
$link->bindParam(":a_p",$a_p);
$link->bindParam(":prio",$_POST['priority']);
$link->execute();

$stock = 2;
$action = "Added User [".$user."] from [".$_SESSION['user']."]";
$query = 'INSERT INTO prod_transictions(stockist,action) VALUES (:stock,:action)';
$link = $con->prepare($query);
$link->bindParam(":action",$action);
$link->bindParam(":stock",$stock);
$link->execute();

header("Location: ./newadmin.php?error=5"); // Done!
exit();