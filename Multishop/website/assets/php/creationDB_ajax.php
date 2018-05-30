<?php

require 'is_ajax.php';

if(file_exists("Created.php")){
	$return['result'] = "Database is already created!";
	$return['Good'] = false;
	echo json_encode($return);
	exit();
}

if(is_ajax()){
	require 'secure_form.php';
	require 'secure_db.php';
	
	$return['result'] = "Database is created!";
	$return['Good'] = false;
	
	/* Password, Confirm_Password and User*/
	try{
		$user = $_POST['admin'];
		$creation_a = $user;
		$pwd = $_POST['pwd'];
		$c_pwd = $_POST['c_pwd'];
		$datab = $_POST['datab'];
	}
	catch(Exception $e){
		$return['result'] = "Missing parameters";
		echo json_encode($return);
		exit();
	}
	
	$price = $stock = $stockist = 0;
	if(isset($_POST['price']))
		if($_POST['price'])
			$price = 1;
		
	if(isset($_POST['stock']))
		if($_POST['stock'])
			$stock = 1;
		
	if(isset($_POST['stockist']))
		if($_POST['stockist'])
			$stockist = 1;
	
	
	/* Check secure_db.php for more information */
	
	if(secure_db($datab)){
		$return['result'] = "Database with bad name";
		echo json_encode($return);
		exit();
	}
	
	/* Check secure_form.php for more information*/
	$form = secure_form($user,$pwd,$c_pwd);
	if(strcmp($form,"Good")){
		$return['result'] = $form;
		echo json_encode($return);
		exit();
	}
	require 'DB_Structure.php';
	try{
		/* Save database name */
		$database = fopen("database.php","w");
		$write = '<?php $db_name = "'.$datab.'"; ?>';
		fwrite($database,$write);
		fclose($database);
	
		/* Creation of database by SQL using PDO */
		$path = 'mysql:host =localhost';
		$user = 'root';
		$pwd_db = '';
		$con = new PDO($path,$user,$pwd_db);
		$link = $con->exec('CREATE DATABASE '.$datab);
		unset($con);
		unset($link);
		
		/* Check DB_Structure.php for more information */
		try{
			Creation_DB($datab);
			$Create = fopen("Created.php","w");
			$write = '<?php $Creation = "Done"; ?>';
			fwrite($Create,$write);
			fclose($Create);
		}
		catch(Exception $e){
			$return['result'] = "Structure didn't load";
			echo json_encode($return);
			exit();
		}
		
	}
	catch(Exception $e){
			$return['result'] = "Permission error";
			echo json_encode($return);
			exit();
	}
	
	try{
		require 'is_created.php';
		Post_Creation($datab,$creation_a,$pwd,$price,$stockist,$stock);
	}
	catch(Exception $e){
		$return['result'] = "Admin and Levels didn't load";
		echo json_encode($return);
		exit();
	}
	
	$return['Good'] = true;
	echo json_encode($return);
}