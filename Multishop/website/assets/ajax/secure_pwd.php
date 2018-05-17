<?php

function secure_password($pwd){
	
	$error = false;
	
	if(strlen($pwd)<8||strlen($pwd)>20)			{$error=true;}
	if(!preg_match("#[0-9]+#",$pwd))			{$error=true;}
	if(!preg_match("#[a-z]+#",$pwd))			{$error=true;}
	if(!preg_match("#[A-Z]+#",$pwd))			{$error=true;}
	if(!preg_match("#[<>!\"'$%&/()=\#]+#",$pwd))	{$error=true;}
	
	return $error;
	
}


?>