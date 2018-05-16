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
					try{
						/* Creating .php page with variable contained DB name */
						$database = fopen("database.php","w");
						$write = '<?php $db_name = "'.$_POST['datab'].'" ?>';
						fwrite($database,$write);
						fclose($database);
						
						/* PDO -> Creation of the database */
						$path = 'mysql:host =localhost';
						$user = 'root';
						$pwd = '';
						$con = new PDO($path,$user,$pwd);
						$link = $con->exec('CREATE DATABASE '.$_POST['datab']);
						unset($con);
						unset($link);
						unset($log);
						$return = array(
							"result" => "Done"
						);
					}
					catch(Excaption $e){
						$return = array(
							"result" => "Writing permission error"
						);
					}
					
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
			$path = 'mysql:host =localhost';
			$user = 'root';
			$pwd = '';
			$con = new PDO($path,$user,$pwd);
			unset($con);
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
