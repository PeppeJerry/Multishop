<?php

session_start();
require "assets/php/check_session.php";
if(!isset($_SESSION['a_p'])){
	header("Location: ./");
	exit();
} 

if(isset($_POST) AND $_SESSION['a_p']){
	require "assets/php/add_product.php";
	require "assets/php/upload.php";
	require "assets/php/delete.php";
	require "assets/php/update.php";
	
	$image = upload("./assets/img/");
	if(is_string($image)){
		$image = "./assets/img/".$image;
	}
	else{
		$image = "./assets/img/".basename($_POST['previous_IMG']);
	}
	$_POST['stockist'] = 2;
	$_POST['url'] = $image;
	$_POST['action'] = 'Modificated ('.$_SESSION['user'].')';
	if(!delete_product($_POST['id'])){
		header ("Location: ./modify.php?mex=1Error+during+applying+modification&id=".$_POST['id']);
		exit();
	}
	
	if(add_product($_POST) != 'Good+you+add+a+new+product'){
		header ("Location: ./modify.php?mex=2Error+during+applying+modification&id=".$_POST['id']);
		exit();
	}

	if(update('UPDATE products SET id='.$_POST['id'].' WHERE name = "'.$_POST['name'].'"')){
		$con = get_con();
		$action = " Modify Product (".$_SESSION['user'].") [".$_POST['name']."]";
		
		$link = $con->prepare("INSERT INTO prod_transictions(product,stockist,action) VALUE (:prod,:stock,:action)");
		
		$link->bindParam(":prod",$_POST['id']);
		$link->bindParam(":stock",$_POST['stockist']);
		$link->bindParam(":action",$action);
		
		$link->execute();
		header ("Location: ./modify.php?mex=Modification+applied&id=".$_POST['id']);
		exit();
	}
	
}
header("Location: ./");
exit();
