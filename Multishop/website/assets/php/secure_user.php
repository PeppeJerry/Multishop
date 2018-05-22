<?php

function secure_user($user){
	
	$error = false;
	/* MAX 20| min 8 | A-Z | a-z | OPTIONAL 0-9 | Special char are not allowed*/
	if(strlen($user)<8||strlen($user)>20)			{$error=true;}
	if(!preg_match("#[a-z]+#",$user))				{$error=true;}
	if(!preg_match("#[A-Z]+#",$user))				{$error=true;}
	if(!ctype_alnum($user))							{$error=true;}
	return $error;
	
}

?>