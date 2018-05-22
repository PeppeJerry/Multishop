<?php

function secure_password($pwd){
	
	$error = false;
	/* MAX 30| min 8 | A-Z | a-z | 0-9 | One of this: < > ! " ' $ % & / ( ) = \ # ?           */
	if(strlen($pwd)<10||strlen($pwd)>30)				{$error=true;}
	if(!preg_match("#[0-9]+#",$pwd))				{$error=true;}
	if(!preg_match("#[a-z]+#",$pwd))				{$error=true;}
	if(!preg_match("#[A-Z]+#",$pwd))				{$error=true;}
	if(!preg_match("#[<>!\"'$%&/()=\#?]+#",$pwd))	{$error=true;}
	
	return $error;
	
}


?>