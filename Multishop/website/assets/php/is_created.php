<?php

function Post_Creation($datab,$admin,$pwd,$s1,$s2,$s3){
	require 'Created.php';
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
	$link = $con->exec($Levels);
	$link = $con->exec($Admin);
	unset($con);
	unset($link);
	
}