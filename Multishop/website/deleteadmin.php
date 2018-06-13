<?php
include "assets/page/1head.php";
include "assets/page/2body.php";
if(!(isset($_SESSION['a_p']) AND $_SESSION['a_p'] AND $_SESSION['priority'] == 1)){
	header("Location: ./");
	exit();
}
$con = get_con();

$link = $con->prepare("SELECT COUNT(*) as num FROM users WHERE priority = 1 ");
$link->execute();
$num = $link->fetch();
$num = $num['num'];

$link = $con->prepare("SELECT COUNT(*) as num FROM users");
$link->execute();
$num2 = $link->fetch();
$num2 = $num2['num'];

$query = "SELECT * FROM users";
if($num == 1){
	$query .=" WHERE category!=1";
}

if(isset($_GET['error'])){
	echo "<p style='max-width:300px;margin:0 auto;margin-top:20px;background:white;padding:5;font-size:18;text-align:center;'>";
	switch ($_GET['error']){
		case (1):
		echo "Missing User";
		break;
		
		case (2):
		echo "User Deleted";
		break;
		
		default:
		echo "Fake Error";
	}
	echo "</p>";
}

if(($num == 1 AND $num2-$num!=0) OR $num != 1){
	echo "<p style='max-width:300px;margin:0 auto;margin-top:20px;background:white;padding:5;font-size:18;text-align:center;'>Admin Delete</p>";
	echo '<form style="margin-top:20px;" enctype="multipart/form-data" action="delete_admin.php" method="POST">';
	$link = $con->prepare($query);
	$link->execute();
	echo "<select class='form-control' name='todelete'>";
	while($result = $link->fetch()){
		echo '<option value="'.$result['id'].'">'.$result['userid'].'</option>';
	}
	echo '<div class="form-group">
		<input style="font-size:20px;display:block; margin:0 auto;margin-top:10px;" value="Confirm" type="submit" class="btn btn-default">
    </div>';
	echo '</select></form>';
}
else{
	echo "<p style='max-width:300px;margin:0 auto;margin-top:20px;background:#ffd480;padding:5;font-size:18;text-align:center;'>Delete Admin isn't Permitted</p>";
}



?>

<?php
include "assets/page/4end.php";
?>