<?php
include "assets/page/1head.php";
include "assets/page/2body.php";
if(!isset($_SESSION['a_p'])){
	header("Location: ./");
	exit();
}

if(isset($_GET['error'])){
	echo "<p style='max-width:300px;margin:0 auto;margin-top:20px;background:white;padding:5;font-size:18;text-align:center;'>";
	switch ($_GET['error']){
		case (1):
		echo "Missing name";
		break;
		
		case (2):
		echo "Already exist";
		break;
		
		case (3):
		echo "An error";
		break;
		
		case (4):
		echo "Category added";
		break;
	}
	echo "</p>";
}

if($_SESSION['a_p']){
	echo '
	<form style="margin-top:20px;" enctype="multipart/form-data" action="add_category.php" method="POST">
	
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Category Name" name="category" required/>
		</div>
		
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Description (Optional)" name="description" />
		</div>
		
		 <input style="font-size:20px;display:block; margin:0 auto;" value="Confirm" type="submit" class="btn btn-default">
		
	</form>
	';
}

$con = get_con();
$link = $con->prepare("SELECT name FROM categories");
$link->execute();
echo "<div style='font-size:16px;'> List of Categories <br>";
while($result = $link->fetch()){
	echo $result['name']."<br>";
}
echo '</div>';
?>

<?php
include "assets/page/4end.php";
?>