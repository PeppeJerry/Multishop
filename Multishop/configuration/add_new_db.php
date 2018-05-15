<?php
if (is_ajax()) {

	$return = array(
		"result" => "Action not found"
	);

	if(isset($_POST["action"]) && !empty($_POST["action"])){
		$action = $_POST['action'];
		switch($action){
			case "CREATE_DB":
				break;

			case "CHECK_CONNECTION";
				if(check(0)){
					$return = array(
						"result" => "Connection Stable"
					);
				}
				else{
					$return = array(
						"result" =>"Connection aborted"
					);
				}
				break;

				default:
					exit();

		}
	}


	echo json_encode($return);
}


function check($mode){
	switch($mode){
		case 0:
		if($con = mysqli_connect('localhost','root','')){
			return(true);
		}
		return(false);
		break;
	}
}

function is_ajax() {
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
