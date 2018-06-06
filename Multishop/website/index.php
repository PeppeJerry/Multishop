<?php
include "assets/page/1head.php";
include "assets/page/2body.php";
require "assets/php/get_setting.php";
$con = get_con();
$setting = get_setting();
$link = $con->prepare('SELECT * FROM products WHERE enable = 1 ORDER BY added LIMIT 3');
$link->execute();
$i = 0;

while($result = $link->fetch()){
	if($i==0){
		echo "<h1 style='margin:0 auto;'>New Entry!</h1><div style='margin-top:20px;' class='row'>";
	}
	$price = "Not Defined";
	if($setting['OK'] AND $setting['price'] AND is_numeric($result['price'])){
		$price = "<span style='font-size:20px;'>".(string)($result['price'])."&euro;</span>";
	}
	
	$url = "./assets/img/no.png";
	if(isset($result['url_img']) AND file_exists($result['url_img'])){
			$url = $result['url_img'];
	}
	$desc = '';
	if(isset($result['description']) AND is_string($result['description']))
		$desc = '<span class="desc">'.$result['description'].'</span>';
	echo '
	<div style="margin-top:20px;text-align:center;" class="col-sm-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">'.$result['name'].'</h5>
				<img class="card-img-top" style="max-width:200;" src="'.$url.'" alt="'.$result['name'].'">
			</div>
			<ul class="list-group list-group-flush">
				 <li style="text-align:center" class="list-group-item">'.$price.'</li>
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
?>
<?php
include "assets/page/4end.php";
?>