<?php

session_start();
require "assets/php/check_session.php";
if(!isset($_SESSION['a_p'])){
	header("Location: ./");
	exit();
} 

if(isset($_POST) AND $_SESSION['a_p']){
	require "assets/php/delete.php";
	
$con = get_con();
$link = $con->prepare("SELECT name FROM products WHERE id = :id");
$link->bindParam(":id",$_GET['id']);
$link->execute();

$name = $link->fetch();
$name = $name['name'];

	if(!delete_product($_GET['id'])){
		header ("Location: ./delete.php?mex=1Error+during+applying+elimination&id=".$_GET['id']);
		exit();
	}
	
	
	
	
	$id = 2;
	$action = "Delete product (".$_SESSION['user'].")[".$name."]";
	$query = 'INSERT INTO prod_transictions(product,stockist,action) VALUES (:prod,:id,:action)';
	$link = $con->prepare($query);
	$link->bindParam(":prod",$_GET['id']);
	$link->bindParam(":action",$action);
	$link->bindParam(":id",$id);
	
	$link->execute();
	
	header("Location: ./index.php?advice=Elimination+complete");
	exit();
}
header("Location: ./");
exit();
