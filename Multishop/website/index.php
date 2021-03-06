<?php
include "assets/page/1head.php";
include "assets/page/2body.php";
require "assets/php/get_setting.php";
$con = get_con();
$link = $con->prepare("SELECT id,name FROM categories");
$link->execute();
$category;
while($result = $link->fetch()){
	$category[$result['id']] = $result['name'];
}
$setting = get_setting();
$link = $con->prepare('SELECT * FROM products WHERE enable = 1 ORDER BY added LIMIT 3');
$link->execute();
$i = 0;
$f = 0;
while($result = $link->fetch()){
	$f++;
	if($i==0){
		echo "<h1 style='margin:0 auto;'>New Entry!</h1><div style='margin-top:20px;' class='row'>";
	}
	$price = "Not Defined";
	if($setting['OK'] AND $setting['price'] AND is_numeric($result['price'])){
		$price = $result['price']."&euro;";
	}
	
	$url = "./assets/img/no.png";
	if(isset($result['url_img']) AND file_exists($result['url_img'])){
			$url = $result['url_img'];
	}
	$desc = '';
	if(isset($result['description']) AND is_string($result['description']))
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
				 <li style="text-align:center" class="list-group-item">'.$result['description'].'</li>
				 ';
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
		$i = 0;
	}
	$i++;
	
}
if($f == 0){
	echo "<h1 style='margin:0 auto;'>Nothing to see here</h1>";
	if(isset($_SESSION['a_p']) AND $_SESSION['a_p'])
		echo "<a style='text-decoration:none' href='./newproduct.php'><button type='button' style='display:block;margin:0 auto;font-size:18px;' class='btn btn-dark'>Add Product</button>
</a>";
}
?>
<?php
include "assets/page/4end.php";
?>