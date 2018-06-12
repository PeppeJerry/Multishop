<?php

session_start();
require "assets/php/get_con.php";

if(!(isset($_SESSION['a_p']) AND $_SESSION['a_p'])){
	header("Location: ./");
	exit();
}

if(!isset($_POST['category'])){
	header("Location: ./newcategory.php?error=1"); //Missing Name
	exit();
}

$con = get_con();

$name = strtolower($_POST['category']);

$link = $con->prepare("SELECT COUNT(*) as num FROM categories WHERE name = :name");
$link->bindParam(":name",$name);
$link->execute();
$num = $link->fetch();
$num = $num['num'];

if($num != 0){
	header("Location: ./newcategory.php?error=2"); //Already exist
	exit();
}

$link = $con->prepare("INSERT INTO categories(name,description) VALUE (:name,:desc)");
$link->bindParam(":name",$name);
$link->bindParam(":desc",$_POST['desc']);
$link->execute();

$res = $link->rowCount();
if($res != 1){
	header("Location: ./newcategory.php?error=3"); //An error
	exit();
}
else{
	header("Location: ./newcategory.php?error=4"); //Done
	exit();
}