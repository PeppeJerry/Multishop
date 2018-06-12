<?php
session_start();

try{
	if(!file_exists('assets/php/database.php')){
		header('Location: ../');
		exit();
	}
	require "assets/php/database.php";
	require "assets/php/check_session.php";
}
catch(Exception $e){
	header("Location: ../");
}


if(!isset($_SESSION['user']))
	require "assets/php/get_con.php";
require "assets/php/Created.php";

?>
<html class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<script src="assets/js/modernizr.js"></script>
	<script src="assets/js/generalpage.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<title><?php echo $site_name; ?></title>
	<link rel="icon" href="<?php echo $icon?>" sizes="16x16">
	
