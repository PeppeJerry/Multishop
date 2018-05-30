<?php

function get_setting(){
	require 'database.php';
	try{
		$path = 'mysql:host=localhost;dbname='.$db_name;
		$user = 'root';
		$pwd = '';
		$get_setting = "SELECT * FROM settings";
		$con = new PDO($path,$user,$pwd);
		
		
		$link = $con->prepare($get_setting);
		$link->execute();
		
		$setting = $link->fetch();
		$setting['OK'] = true;
		$setting['con'] = $con;
		unset($link);
	}
	catch(Exception $e){
		$setting['OK'] = false;
	}
	return ($setting);
}