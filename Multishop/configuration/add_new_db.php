<?php
if (is_ajax()) {

	$return = array(
		"result" => "Action not found"
	);

	if(isset($_POST["action"]) && !empty($_POST["action"])){
		$action = $_POST;
		switch($action['action']){
			
			case "CREATE_DB":
				if(check(0)){
					$con = mysqli_connect('localhost','root','');
					$result = $con->query('CREATE DATABASE '.$_POST['datab']);
					mysqli_close($con);
					$database = fopen("database.php","w");
					$write = '<?php $db_name = "'.$_POST['datab'].'" ?>';
					fwrite($database,$write);
					fclose($database);
					$return = array(
						"result" => "Done"
					);
					
				}
				else{
					$return = array(
						"result" =>"Connection aborted"
					);
				}
				
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
		try {
			$con = mysqli_connect('localhost','root','');
			mysqli_close($con);
			return(true);
		}
		catch(Excaption $e){
			return(false);
		}
		break;
		default: return(false);
	}
}

function is_ajax() {
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
