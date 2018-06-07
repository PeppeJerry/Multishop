<?php

function alternative_connection(){
	
	try{
		require "access/LocalUser.php";
		require "database.php";
		$dbh = new pdo( 'mysql:host=localhost;dbname='.$db_name,$user,$pwd,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		echo json_encode(array('connection' => true));
		exit();
	}
	catch(Exception $e){
		echo json_encode(array('connection' => false, 'error' => 'Unable to connect'));
		exit();
	}
	echo json_encode(array('connection' => false, 'error' => 'Unstable connection'));
	exit();
	
}