<?php

session_start();

if(!isset($_SESSION['a_p'])){
	header("Location: ./");
	exit();
} 

if(isset($_POST) AND $_SESSION['a_p']){
	require "assets/php/delete.php";

	if(!delete_product($_GET['id'])){
		header ("Location: ./delete.php?mex=1Error+during+applying+elimination&id=".$_GET['id']);
		exit();
	}
	header("Location: ./index.php?advice=Elimination+complete");
	exit();
	
}
header("Location: ./");
exit();
