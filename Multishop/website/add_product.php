<?php

session_start();

if(!isset($_SESSION['a_p'])){
	header("Location: ./");
	exit();
} 

if(isset($_POST) AND $_SESSION['a_p']){
	require "assets/php/add_product.php";
	require "assets/php/upload.php";
	$image = upload("./assets/img/");
	if(is_string($image)){
		$_POST['url'] = "./assets/img/".$image;
	}
	$_POST['action'] = 'Add Product ('.$_SESSION['user'].')';
	$mex = add_product($_POST);
	if(!strcmp($mex,"Good+you+add+a+new+product")){
		require "assets/php/get_con.php";
		$con = get_con();
		
		$prod = "SELECT id FROM products ORDER BY added DESC LIMIT 1";
		
		$link = $con->prepare($prod);
		$link->execute();
		$prod = $link->fetch();
		$prod = $prod['id'];
		
		$query = 'INSERT INTO prod_transictions(product,stockist,action) VALUES (:prod,:stock,:action)';
		$link = $con->prepare($query);
		
		$action = "Added Product (".$_SESSION['user'].")";
		
		
		$link->bindParam(":prod",$prod);
		$link->bindParam(":stock",$_POST['stockist']);
		$link->bindParam(":action",$action);
		$link->execute();
	}
	header("Location: ./newproduct.php?type=advice&mex=".$mex);
	exit();
}
header("Location: ./newproduct.php?type=advice&mex=Product+not+loaded");
exit();
