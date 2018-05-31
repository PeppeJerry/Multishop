<?php
include "assets/page/1head.php";
?>
<link rel="stylesheet" href="assets/css/product.css">
<?php
include "assets/page/2body.php";
if(isset($_GET['type'])){
	$i = null;
	switch (strtolower($_GET['type'])){
		case 'sorted':
		try{
			require "assets/php/get_con.php";
			require "assets/php/get_setting.php";
			$setting = get_setting();
			$con = get_con();
		}
		catch(Exception $e){
			$con = false;
		}
		if($con){
			$query ='SELECT * FROM `products` WHERE enable = 1 ORDER BY name ';
			$limit ='LIMIT ';
			if(isset($_GET['page'])){
				if(is_numeric($_GET['page'])){
					if($_GET['page']<=0){
						$_GET['page']=1;
					}
					$limit .=(string)(10*($_GET['page']-1)).",10";
				}
				else{
					$limit .=" 0,10";
				}
			}
			else{
				$limit .=" 0,10";
			}
			$query .=$limit;
			$link = $con->prepare($query);
			$link->execute();
			$i = 0;
			while($result = $link->fetch()){
				$price = "";
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
				
				echo "
				<div class='product'>
				
				<span class='prod_title' style='font-size:25px'>".$result['name']."</span>
				<img alert='".$result['name']."' src='".$url."'>
				".$price."
				".$desc."
				";
				if(isset($_SESSION['a_p']) AND $_SESSION['a_p']){
					echo "<a class='modify' href='modify.php?id=".$result['id']."'>Modify</a>";
				}
				echo
				"
				</div>
				";
				$i++;
				
				echo "<br>";
			}
			$page = intval($_GET['page']);
			echo "<div style='max-width:1000px;display:block;margin:0 auto;'>";
			if($_GET['page']>1)
				echo "<a href='index.php?type=sorted&page=".intval($page-1)."' style='float:left;color:black'>Back</a>";
			if ($i == 10){
				echo "<a href='index.php?type=sorted&page=".intval($page+1)."' style='float:right;color:black'>Next</a>";
			}
			echo "</div>";
		}
		break;
	}
}
?>
<?php
include "assets/page/4end.php";
?>