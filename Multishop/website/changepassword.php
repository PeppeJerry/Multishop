<?php
include "assets/page/1head.php";
include "assets/page/2body.php";

if(!isset($_SESSION['user'])){
	header("Location: ./");
	exit();
}

if(isset($_GET['error'])){
	echo '<p style="font-size:18px;text-align:center;background:white;display:block;max-width:300px;padding:10px;margin:0 auto;margin-top:20px">';
	switch ($_GET['error']){
		case (1):
		echo "Missing Parameters";
		break;
		
		case (2):
		echo "Bad Current Password";
		break;
		
		case (3):
		echo "Password Dis-match";
		break;
		
		case (4):
		echo "Bad Password";
		break;
		
		case (5):
		echo "Password Changed";
		break;
		
		case (6):
		echo "Error during the change";
		break;
		
		case (7):
		echo "Same password as before";
		break;
		
		default:
		echo "Bad Error";
	}
	echo '</p>';
}

?>

<form enctype="multipart/form-data" action="new_password.php" method="POST">
  
	<div style ="margin-top:30px;"class="form-group">
      <input type="Password" class="form-control" placeholder="Current Password" name="pwd" required/>
    </div>
	
	<div class="form-group">
      <input type="Password" class="form-control" placeholder="New Password" name="n_pwd" required/>
    </div>
	
	<div class="form-group">
      <input type="Password" class="form-control" placeholder="ConfirmPassowrd" name="c_pwd" required/>
    </div>
	
	<input style="font-size:20px;display:block; margin:0 auto;" value="Confirm" type="submit" class="btn btn-default">
	
</form>

<?php
include "assets/page/4end.php";
?>