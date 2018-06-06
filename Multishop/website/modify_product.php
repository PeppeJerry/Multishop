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
	header("Location: ./newproduct.php?type=advice&mex=".add_product($_POST));
	exit();
}
header("Location: ./newproduct.php?type=advice&mex=Product+not+loaded");
exit();
