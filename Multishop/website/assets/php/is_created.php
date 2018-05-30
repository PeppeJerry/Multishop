<?php

function Post_Creation($datab,$admin,$pwd,$price,$stockist,$stock){
	require 'Created.php';
	$s1 = $price;
	$s2 = $stockist;
	$s3 = $stock;
	$path = 'mysql:host=localhost;dbname='.$datab;
	$user = 'root';
	$pwd_db = '';
	$con = new PDO($path,$user,$pwd_db);
	$Levels =
	"
	INSERT INTO priorities(lvl, name) VALUE (0, 'Root'), (1, 'Admin'), (2, 'Simple')
	";
	
	$Admin =
	"
	INSERT INTO users(userid,pwd,a_product,a_admin,priority) VALUE('".$admin."','".hash('sha512',$pwd)."',true,true,0)
	";
	
	$Setting =
	"
	INSERT INTO settings(id,price,stockist,stock) VALUE ('1', ".$s1.", ".$s2.", ".$s3.")
	";
	
	$Default =
	"
	INSERT INTO stockists(p_iva,name,cap) VALUE (0,'Unknown',0), (1,'Customer',0)
	";
	$link = $con->exec($Levels);
	$link = $con->exec($Admin);
	$link = $con->exec($Setting);
	$link = $con->exec($Default);
	unset($con);
	unset($link);
	
}