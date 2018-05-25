<?php

function add_product($info){
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
		
		if(!$setting['price'])
			$info['price'] = '0';
		
		if(!$setting['stockist'])
			$info['stockist'] = '0';
		
		if(!$setting['stock'])
			$info['stock'] = '0';
		
		$info['name'];
		$info['description'];
		
		$query = "
		INSERT INTO products(name,quantity,description,price) VALUE 
		";
		
		
		print_r($info);
		unset($con);
	}
	catch(Exception $e){
		echo "no";
	}
}


$info['echo'] = 'si';
add_product($info);