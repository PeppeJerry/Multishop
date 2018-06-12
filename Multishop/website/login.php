<?php
include "assets/page/1head.php";
if(isset($_SESSION['user'])){
	header("Location: ./");
	exit();
}
?>
<script src="assets/js/jquery.js"></script>
<link rel="stylesheet" href="assets/css/configuration.css" type="text/css">
<link rel="stylesheet" href="assets/css/general.css" type="text/css">
<script src="assets/js/support_function.js"></script>
<?php
include "assets/page/2body.php";
?>


<div class="box" style="margin-top:100px;"> 

<div id="Display" ></div>

<?php

if(isset($_GET['error'])){
	echo "<div class='container'>";
	switch ($_GET['error']){
		case 1:
		echo "<div style='text-align:center;font-size:30px' class='box'>Login Failed</div>";
		break;
		
		case 2:
		echo "<div style='text-align:center;font-size:30px' class='box'>Connection Failed</div>";
		break;
		
		case 3:
		echo "<div style='text-align:center;font-size:30px' class='box'>Account Disabled</div>";
		break;
		
		case 5:
		echo "<div style='text-align:center;font-size:30px' class='box'>Session destroy</div>";
		break;
		
		default:
		echo "<div style='text-align:center;font-size:30px' class='box'>Fake Error</div>";
	}
	echo "</div>";
}

?>

  <form id="settings" class="container" action="check_login.php" method="POST">
    <h3 style="text-align:center">Login</h3>
    <h4 style="text-align:center">Correct credentials for enter obviously</h4>
	
	<fieldset>
      <input placeholder="Admin name" class="chars" name="admin" type="text" required>
    </fieldset>
	
	<fieldset>
      <input placeholder="Admin password" class="password" name="pwd" type="password" required>
    </fieldset>
      <button name="submit" type="submit" id="settings-submit">Submit</button>
	  
    </fieldset>
	</form>
</div>
<?php
include "assets/page/4end.php";
?>