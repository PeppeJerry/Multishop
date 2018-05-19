<?php

function secure_db($db){
	
	$error = false;
	/* MAX 20| min 6 | a-z | Special char are not allowed*/
	if(strlen($db)<6||strlen($db)>20)				{$error=true;}
	if(!ctype_alnum($db))							{$error=true;}
	return $error;
	
}

?>