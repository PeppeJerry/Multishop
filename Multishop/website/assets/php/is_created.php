<?php

function Post_Creation($datab,$admin,$pwd,$price,$stockist,$stock){
	$s1 = $price;
	$s2 = true;
	$s3 = true;
	$path = 'mysql:host=localhost;dbname='.$datab;
	$user = 'root';
	$pwd_db = '';
	$con = new PDO($path,$user,$pwd_db);
	$Levels =
	"
	INSERT INTO priorities(lvl, name) VALUE (1, 'Root'), (2, 'Admin'), (3, 'Simple')
	";
	
	$Admin =
	"
	INSERT INTO users(userid,pwd,a_product,a_admin,priority) VALUE('".$admin."','".hash('sha512',md5($pwd).$pwd)."',true,true,1)
	";
	
	$Setting =
	"
	INSERT INTO settings(id,price,stockist,stock) VALUE ('1', ".$s1.", ".$s2.", ".$s3.")
	";
	
	$Default =
	"
	INSERT INTO stockists(p_iva,name,cap) VALUE (0,'Unknown',0), (1,'Customer',0), (2,'Worker',0)
	";
	
	$Category =
	"
	INSERT INTO categories (id,name,description) VALUE (0,'Undefined','Without a specific category');
	";
	
	$link = $con->exec($Levels);
	$link = $con->exec($Admin);
	$link = $con->exec($Setting);
	$link = $con->exec($Default);
	$link = $con->exec($Category);
	unset($con);
	unset($link);
	
}