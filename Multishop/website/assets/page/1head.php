<?php

try{
	if(!(file_exists('assets/php/Created.php') AND file_exists('assets/php/database.php'))){
		header('Location: ../');
		exit();
	}
	require "assets/php/Created.php";
	require "assets/php/database.php";
	if(file_exists("assets/php/favicon.php")){
		require "assets/php/setting.php";
	}
}
catch(Exception $e){
	header("Location: ../");
}

session_start();

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
	<title><?php if(!isset($website))echo $db_name;else echo $website; ?></title>
	<?php if(isset($favicon))echo $favicon; ?>
