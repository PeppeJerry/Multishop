<?php

session_start();
require "assets/php/check_session.php";
if(!isset($_SESSION['a_p'])){
	header("Location: ./");
	exit();
}

if($_POST['todelete'] == 1){
	header("Location: ./newcategory.php?error=5"); // Can't delete Undefined
	exit();
}

$con = get_con();
$link = $con->prepare("SELECT COUNT(*) as num FROM categories WHERE id=:id");
$link->bindParam(":id",$_POST['todelete']);
$link->execute();
$num = $link->fetch();
$num = $num['num'];

if($num == 0){
	header("Location: ./newcategory.php?error=6"); // Missing Category
	exit();
}

$con = get_con();
$link = $con->prepare("UPDATE products SET category = 0 WHERE category = :id");
$link->bindParam(":id",$_POST['todelete']);
$link->execute();

$query = 'INSERT INTO prod_transictions(stockist,action) VALUES (:stock,:action)';
$subquery = 'SELECT name FROM categories WHERE id=:id';
$link = $con->prepare($subquery);
$link->bindParam(":id",$_POST['todelete']);
$link->execute();

$name = $link->fetch();
$name = $name['name'];

$link = $con->prepare($query);

$action = "Deleted Category (".$_SESSION['user'].") [".$name."]";

$stock = 2;
$link->bindParam(":stock",$stock);
$link->bindParam(":action",$action);
$link->execute();

$link = $con->prepare("DELETE FROM categories WHERE id = :id");
$link->bindParam(":id",$_POST['todelete']);
$link->execute();




header("Location: ./newcategory.php?error=7"); // Missing Category
exit();