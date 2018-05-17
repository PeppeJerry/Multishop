<?php
require 'is_ajax.php';

if (is_ajax()) {
	require 'check_connection.php';
	if(check_connection()){
		$return['result'] = "Connection Stable";
		$return['connect'] = true;
	}
	else{
		$return['result'] = "Connection aborted";
		$return['connect'] = false;
	}
	
	echo json_encode($return);
}
