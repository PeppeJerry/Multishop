<?php

if (is_ajax()) {

	$report = array(
		"result" => "Action not found"
	);

	if(isset($_POST["action"]) && !empty($_POST["action"])){
		$action = $_POST['action'];
		switch($action){
			case "CREATE_DB":
				break;

			case "CHECK_CONNECTION";
				if(check(0)){
					$report = array(
						"result" => "Connection Stable"
					);
				}
				else{
					$report = array(
						"result" =>"Connection aborted"
					);
				}
				break;

				default:
					exit();

		}
	}


	$return["json"] = json_encode($return);
	echo json_encode($return);
}


function check($mode){
	switch($mode){
		case 0:
		if(true){
			mysqli_close($con);
			return(true);
		}
		return(false);
		break;
	}
}

function is_ajax() {
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
?>
