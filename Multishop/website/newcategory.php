<?php
include "assets/page/1head.php";
include "assets/page/2body.php";
if(!isset($_SESSION['a_p'])){
	header("Location: ./");
	exit();
}

if(isset($_GET['error'])){
	echo "<p style='max-width:300px;margin:0 auto;margin-top:20px;background:#ffd480;padding:5;font-size:18;text-align:center;'>";
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
		
		case (5):
		echo "You can't remove 'Undefined' category";
		break;
		
		case (6):
		echo "Missing Category";
		break;
		
		case (7):
		echo "Category Deleted";
		break;
	}
	echo "</p>";
}

if($_SESSION['a_p']){
	echo '
	<div style="text-align:center;max-width:300px;font-size:18px;display:block;background:white;margin:0 auto;margin-top:20px;">
	New Category
	</div>
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
		echo "<hr>";
}

$con = get_con();
$link = $con->prepare("SELECT name FROM categories");
$link->execute();
echo "<div style='font-size:16px;'> List of Categories <br>";
while($result = $link->fetch()){
	echo $result['name']."<br>";
}
echo '</div>';

if($_SESSION['a_p']){
	echo "<hr>";
	echo '<form style="margin-top:20px;" enctype="multipart/form-data" action="remove_category.php" method="POST">';
	$link = $con->prepare("SELECT id,name FROM categories");
	$link->execute();
	$category[1] = false;
	$i;
	while($result = $link->fetch()){
		if($result['id'] != 1){
			$category[$result['id']] = $result['name'];
			$category[1] = true;
		}
		$i = 1;
	}
	if($category[1]){
		echo '<div style="text-align:center;max-width:300px;font-size:18px;display:block;background:white;margin:0 auto;margin-top:20px;margin-bottom:10px;">
	Remove Category
	</div>';
		unset($category[1]);
		foreach($category as $key=>$value){
			if($i == 1){
				echo '<select style="margin-bottom:10px;" class="form-control" name="todelete">';
				$i++;
			}
			echo '<option value="'.$key.'">'.$value.'</option>';
		}
		if($i != 1){
			echo "</select>";
		}
	
		if($i!= 1){
			echo '<input style="font-size:20px;display:block; margin:0 auto;" value="Confirm" type="submit" class="btn btn-default">';
		}
	
		echo '</form>';
	}
}

include "assets/page/4end.php";
?>