<?php

function get_con(){
	try{
		require 'access/LocalUser.php';
		require "database.php";
		$con = new PDO("mysql:host=localhost;dbname=".$db_name,$user,$pwd);
		return $con;
	}
	catch(Exception $e){
		return false;
	}
}