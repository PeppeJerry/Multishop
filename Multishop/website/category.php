<?php
include "assets/page/1head.php";
include "assets/page/2body.php";
include "assets/php/get_setting.php";

$con = get_con();
$setting = get_setting();
$check = true;
if(isset($_GET['category'])){
	$link = $con->prepare("SELECT COUNT(*) as num FROM categories WHERE id=:id");
	$link->bindParam(":id",$_GET['category']);
	$link->execute();
	$check = $link->fetch();
	$check = $check['num'];
	if($check != 0){
		$check = true;
	}
	else{
		$check = false;
	}
}

	



if(!isset($_GET['category']) OR !$check){
	if(!$check){
		echo "<p style='max-width:300px;margin:0 auto;margin-top:20px;background:#ffd480;padding:5;font-size:18;text-align:center;'> Invalid Category </p>";
	}
	echo '<div style="text-align:center;max-width:300px;font-size:18px;display:block;background:white;margin:0 auto;margin-top:20px;">
	Research by Category
	</div>';
	$link = $con->prepare("SELECT * FROM categories");
	$link->execute();
	
	echo '<form style="margin-top:20px;" enctype="multipart/form-data" action="#" method="GET">';
	echo "<select class='form-control' name='category'>";
	while($result = $link->fetch()){
		echo "<option value='".$result['id']."'>".$result['name']."</option>";
	}
	echo "</select>";
	echo '<input style="font-size:20px;display:block; margin:0 auto;margin-top:10px;" value="Confirm" type="submit" class="btn btn-default">';
	echo "</form>";
	
}
else{
	if($check){
		$con = get_con();
		$link = $con->prepare("SELECT id,name FROM categories");
		$link->execute();
		$category;
		while($result = $link->fetch()){
			$category[$result['id']] = $result['name'];
		}
		$link = $con->prepare("SELECT count(*) as num FROM `products` WHERE enable = 1 AND category = :cat");
		$link->bindParam(":cat",$_GET['category']);
		$link->execute();
		$result = $link->fetch();
		$num = $result['num'];
		

		/* Num of row that come back from the query*/
		$offset = 12;		
		
		$query ='SELECT * FROM `products` WHERE enable = 1 AND category = :cat ORDER BY name ';
		$limit = 'LIMIT 0,'.$offset;
		
		if(isset($_GET['page']) AND is_numeric($_GET['page'])){
			if($_GET['page']<=0){
				$_GET['page'] = 1;
				$limit = "LIMIT 0,".$offset;
			}
			else{
				$limit = "LIMIT ".$offset*($_GET['page']-1).",".$offset;
			}
		}
		else{
			$_GET['page']= 1;
			$limit = "LIMIT 0,".$offset; 
		}
		
		$query .=$limit;
		$link = $con->prepare($query);
		$link->bindParam(":cat",$_GET['category']);
		$link->execute();
		$i = 0;
		while($result = $link->fetch()){
			
			$price = "Not Defined";
			if($setting['OK'] AND $setting['price'] AND is_numeric($result['price'])){
				$price = (string)($result['price'])."&euro;";
			}
			
			$url = "./assets/img/no.png";
			if(isset($result['url_img']) AND file_exists($result['url_img'])){
					$url = $result['url_img'];
			}
			$desc = '';
			if($i == 0)
				echo '<div style="margin-top:20px;" class="row">';
			echo '
			<div style="margin-top:20px;text-align:center;" class="col-sm-4">
				<div class="card">
					<div class="card-body">
						<img class="card-img-top" style="max-width:200;" src="'.$url.'" alt="'.$result['name'].'">
					</div>
					<ul class="list-group list-group-flush">
					<li style="text-align:center" class="list-group-item"><h5 class="card-title">'.$result['name'].'</h5></li>';
						if(strcmp($price,"Not Defined")){
							echo '<li style="font-size:20px;text-align:center" class="list-group-item">'.$price.'</li>';
						}
						if(isset($category[$result['category']]) AND $result['category']!= 1)
							echo '<li style="text-align:center" class="list-group-item">'.$category[$result['category']].'</li>';
						if(!strcmp($result['description'],""))
							echo "<span style='border-bottom:1px solid rgba(0,0,0,.125);'/></span>";
						else
							echo '
							<li style="text-align:center" class="list-group-item">'.$result['description'].'</li>';
						 if(isset($_SESSION['a_p']) AND $_SESSION['a_p']){
							echo '<a style="margin-top:10px;margin-bottom:10px;" href="modify.php?id='.$result['id'].'".><button type="button" style="font-size:16px;" class="btn btn-warning">Modify</button></a>';
							echo '<a style="margin-top:10px;margin-bottom:10px;" href="delete.php?id='.$result['id'].'".><button type="button" style="font-size:16px;" class="btn btn-danger">Delete</button></a>';
						}
						echo '
					</ul>
				</div>
			</div>
					';
			if($i == 2){
				echo '</div>';
				$i=0;
			}
			else{
				$i++;
			}
			
			}
			if($i != 0)
				echo "</div>";
		
		$page = $_GET['page'];
		
		if(($_GET['page']-2)*$offset > $num){
				$page = (int)($num/$offset)+1;
				if($num%$offset !=0 AND $offset <= $num)
					$page++;
		}
		
		if($offset > $num)
			$page++;
		
		if($page-1 == $_GET['page']){
			$page--;
		}
		if($page>1)
			echo "<a style='float:left;' href='".$_SERVER['PHP_SELF']."?page=".($page-1)."&category=".$_GET['category']."'><img style='width:50px;margin-top:20px' src='./assets/img/left-arrow.png'></a>";
		
		if($_GET['page']*$offset<$num)
			echo "<a style='float:right;' href='".$_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."&category=".$_GET['category']."'><img style='width:50px;margin-top:20px' src='./assets/img/right-arrow.png'></a>";
		
		if($num == 0){
			echo "<p class='h1'>Ops, there is nothing to see here</p>";
		}
	}
}

?>

<?php
include "assets/page/4end.php";
?>