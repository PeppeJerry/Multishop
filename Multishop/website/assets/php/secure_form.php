<?php

require 'secure_pwd.php';
require 'secure_user.php';

function secure_form($user,$pwd,$c_pwd){
	
	/* Is the UserID strong? */
	if(secure_user($user)){
		return ("User with bad name");
	}

	/* Are this the same password?*/
	if(strcmp($pwd,$c_pwd)){
		return ("Password dis-match");
	}
	/* Is the password strong? */
	if(secure_password($pwd)){
		return ("Password is week or bad digit");
	}
	return ("Good");
}

?>