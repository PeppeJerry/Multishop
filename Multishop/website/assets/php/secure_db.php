<?php

function secure_db($db){
	
	$error = false;
	/* MAX 20| min 6 | a-z | Special char are not allowed*/
	if(strlen($db)<6||strlen($db)>15)				{$error=true;}
	if(!preg_match("#[a-z]+#",$db))				{$error=true;}
	return $error;
	
}

?>