<?php

function get_con(){
	try{
		require "database.php";
		$con = new PDO("mysql:host=localhost;dbname=".$db_name,'root','');
		return $con;
	}
	catch(Exception $e){
		return false;
	}
}