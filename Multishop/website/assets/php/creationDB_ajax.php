<?php

require 'is_ajax.php';

if(is_ajax()){
	require 'secure_pwd.php';
	$return['result'] = "Database is created!";
	$control = true;
	
	/* Password and Confirm_Password */
	$pwd = $_POST['pwd'];
	$c_pwd = $_POST['c_pwd'];
	
	/* Are this the same password?*/
	if($pwd != $c_pwd){
		$return['result'] = "Password dismatch";
		$control = false;
	}
	
	/* Is the password strong? */
	if(secure_password($pwd)){
		$return['result'] = "Password is wrong";
		echo json_encode($return);
		exit();
	}
	
	try{
		/* Save database name */
		$database = fopen("database.php","w");
		$write = '<?php $db_name = "'.$_POST['datab'].'" ?>';
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
	}
	catch(Exception $e){
			$return['result'] = "Permission error";
	}
	
	echo json_encode($return);
}