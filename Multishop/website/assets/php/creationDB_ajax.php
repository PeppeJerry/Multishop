<?php

require 'is_ajax.php';

if(is_ajax()){
	require 'secure_form.php';
	
	$return['result'] = "Database is created!";
	
	/* Password, Confirm_Password and User*/
	try{
		$user = $_POST['admin'];
		$pwd = $_POST['pwd'];
		$c_pwd = $_POST['c_pwd'];
	}
	catch(Exception $e){
		$return['result'] = "Missing parameters";
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
		$write = '<?php $db_name = "'.$_POST['datab'].'"; ?>';
		fwrite($database,$write);
		fclose($database);
	
		/* Creation of database by SQL using PDO */
		$path = 'mysql:host =localhost';
		$user = 'root';
		$pwd_db = '';
		$con = new PDO($path,$user,$pwd_db);
		$link = $con->exec('CREATE DATABASE '.$_POST['datab']);
		unset($con);
		unset($link);
		
		/* Check DB_Structure.php for more information */
		Creation_DB($_POST['datab']);
	}
	catch(Exception $e){
			$return['result'] = "Permission error";
	}
	
	echo json_encode($return);
}