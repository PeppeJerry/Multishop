<?php

function add_product($info){
	
	if(!isset($info['category']))
		$category = 0;
	else
		$category = $info['category'];
	
	require 'get_setting.php';
	
	if(!isset($info['name']))
		return "Name+problem";
	$info['name'] = strtolower($info['name']);
	$setting = get_setting();
	
	if(!$setting['OK'])
		return "Get_Setting+problem";
	
	$con = $setting['con'];
	unset($setting['con']);
	
	try{
		$info['name'] = strtolower($info['name']);
		$query = "SELECT id FROM products WHERE name = :name";
		$link = $con->prepare($query);
		$link->bindParam(":name",$info['name']);
		$link->execute();
		if($link->rowCount()>0){
			unset($con);
			unset($link);
			return "Name+already+used";
		}
	}
	catch(Exception $e){
		return "Problem+to+check+the+name";
	}
	
	if(!$setting['price'] OR !is_numeric($info['price']))
		$info['price'] = NULL;
	
	
	if(!$setting['stockist'] OR !isset($info['stockist']) OR!is_numeric($info['stockist']))
		$info['stockist'] = 0;
	else{
		$query ="SELECT p_iva FROM stockists WHERE p_iva = ".$info['stockist'];
		try{
			$link = $con->prepare($query);
			$link->execute();
			if($link->rowCount()==0){
				unset($link);
				unset($con);
				return "Stockist+not+exist";
			}
		}
		catch(Exception $e){
			return "Problem+to+check+stockist";
		}
	}
	
	if(!isset($info['stock']))
		$info['stock'] = 0;
	
	if(!is_numeric($info['quantity']) OR $info['quantity']<0)
		$info['quantity'] = NULL;
	
	$query = "
	INSERT INTO products(category,name,url_img,quantity,description,price) VALUE (:cat,:name,:url,:quan,:desc,:pric)
	";
	if(is_null($info['url']))
		$info['url'] = "./assets/img/no.png";
	try{
		$link = $con->prepare($query);
		$link->bindParam(":name",$info['name']);
		$link->bindParam(":cat",$category);
		$link->bindParam(":url",$info['url']);
		$link->bindParam(":quan",$info['quantity']);
		$link->bindParam(":desc",$info['description']);
		$link->bindParam(":pric",$info['price']);
		$link->execute();
	}
	catch(Exception $e){
		return "Insert+product+failed";
	}
		
	unset($link);
	unset($con);
	return "Good+you+add+a+new+product";
	
}