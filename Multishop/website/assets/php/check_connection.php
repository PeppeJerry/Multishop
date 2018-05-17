<?php

function check_connection() {
	/* If connect give me true, if not false */
	try {
		$user = 'connection';
		$pwd = '';
		$conn = new PDO('mysql:host=localhost;',$user, $pwd);
		unset($conn);
		return true;
	}
	catch(Exception $e) {
		return false;
	}
}