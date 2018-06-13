<?php
include "assets/page/1head.php";
include "assets/page/2body.php";
require "assets/php/get_setting.php";
$con = get_con();
$setting = get_setting();
if(!isset($_SESSION['a_p']) OR !$_SESSION['a_p']){
	header("Location: ./");
	exit();
}
if(isset($_GET['type'])){
	switch ($_GET['type']){
		case "advice":
			echo "<span style='margin-top:20px;margin-bottom:20px;display:block;width:100%;text-align:center;font-size:30px;'>".$_GET['mex']."</span>";
		break;
	}

}

$link = $con->prepare("SELECT id,name FROM categories");
$link->execute();
$category;
while($result = $link->fetch()){
	$category[$result['id']] = $result['name'];
}

if(!isset($_GET['id']) OR !is_numeric($_GET['id'])){
	echo "<p style='margin-top:20px;font-size:17px;'>Ops, wrong id</p>";
}

$link = $con->prepare('SELECT count(*) as num from products WHERE id="'.$_GET['id'].'"');
$link->execute();
$num = $link->fetch();
$num = $num['num'];

if($num == 1){
	$link = $con->prepare('SELECT * from products WHERE id="'.$_GET['id'].'"');
	$link->execute();
}
else{
	echo "<p style='margin-top:20px;font-size:17px;'>Ops, wrong id</p>";
}

while($num == 1 AND $result = $link->fetch()){
			?>
	<h1 style="margin 0 auto" >Are you sure to delete this?</h1>  
			<?php
		$price = "Not Defined";
		if($setting['OK'] AND $setting['price'] AND is_numeric($result['price'])){
			$price = (string)($result['price'])."&euro;";
		}
		
		$url = "./assets/img/no.png";
		if(isset($result['url_img']) AND file_exists($result['url_img'])){
				$url = $result['url_img'];
		}
		$desc = '';
		if(isset($result['description']) AND is_string($result['description']))
			$desc = '<span class="desc">'.$result['description'].'</span>';
		echo '
		<div style="margin:0 auto;margin-top:20px;text-align:center;" class="col-sm-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">'.$result['name'].'</h5>
					<img class="card-img-top" style="max-width:200;" src="'.$url.'" alt="'.$result['name'].'">
				</div>
				<ul class="list-group list-group-flush">
					 ';
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
						echo '<a style="margin-top:10px;margin-bottom:10px;" href="delete_product.php?id='.$result['id'].'".><button type="button" style="font-size:16px;" value="'.$_GET['id'].'" class="btn btn-danger">Confirm</button></a>';
					}
					echo '
				</ul>
			</div>
		</div>
				';
		
}

?>
<?php
include "assets/page/4end.php";
?>