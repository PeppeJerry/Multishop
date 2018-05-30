<?php

function add_product($info){
	require 'get_setting.php';
	
	if(!isset($info['name']))
		return "Name problem";
	$setting = get_setting();
	
	if(!$setting['OK'])
		return "Get_Setting problem";
	
	$con = $setting['con'];
	unset($setting['con']);
	
	try{
		$query = "SELECT id FROM products WHERE name = :name";
		$link = $con->prepare($query);
		$link->bindParam(":name",$info['name']);
		$link->execute();
		if($link->rowCount()>0){
			unset($con);
			unset($link);
			return "Name already used";
		}
	}
	catch(Exception $e){
		return "Problem to check the name";
	}
	
	if(!$setting['price'] OR !is_numeric($info['price']))
		$info['price'] = NULL;
	
	
	if(!$setting['stockist'] OR !is_numeric($info['stockist']))
		$info['stockist'] = 0;
	else{
		$query ="SELECT p_iva FROM stockists WHERE p_iva = ".$info['stockist'];
		try{
			$link = $con->prepare($query);
			$link->execute();
			if($link->rowCount()==0){
				unset($link);
				unset($con);
				return "Stockist not exist";
			}
		}
		catch(Exception $e){
			return "Problem to check stockist";
		}
	}
	
	
	$stock = true;
	if(!$setting['stock'])
		$stock = false;
	
	if(!isset($info['stock']))
		$info['stock'] = 0;
	
	if(!is_numeric($info['quantity']) OR $info['quantity']<0)
		$info['quantity'] = NULL;
	
	$query = "
	INSERT INTO products(name,url_img,quantity,description,price) VALUE (:name,:url,:quan,:desc,:pric)
	";
	
	try{
		$link = $con->prepare($query);
		$link->bindParam(":name",$info['name']);
		$link->bindParam(":url",$info['url']);
		$link->bindParam(":quan",$info['quantity']);
		$link->bindParam(":desc",$info['description']);
		$link->bindParam(":pric",$info['price']);
		$link->execute();
	}
	catch(Exception $e){
		return "Insert product failed";
	}
	
	unset($link);
	unset($con);
	if(!$stock)
		return "Good, you add a new product!";
		
	$sub_query = "
		(SELECT id FROM products WHERE name = :name)
	";
	$query = "
		INSERT INTO prod_transictions(product,stockist,quantity) VALUE (".$sub_query.",:stockl,:quant)
	";
	
	try{
		$link = $con->prepare($query);
		$link->bindParam(":name",$info['name']);
		$link->bindParam(":quant",$info['quantity']);
		$link->bindParam(":stockl",$info['stockist']);
		$link->execute();
	}
	catch(Exception $e){
		return "Problem with product transictions";
	}
	unset($link);
	unset($con);
	return "Good, you add a new product!";
	
}