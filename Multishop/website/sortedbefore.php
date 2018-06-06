<?php
include "assets/page/1head.php";
?>
<link rel="stylesheet" href="assets/css/product.css">
<?php
	include "assets/page/2body.php";
	
	try{
		require "assets/php/get_setting.php";
		$setting = get_setting();
		$con = get_con();
	}
	catch(Exception $e){
		$con = false;
		
	}
	if($con){
		$link = $con->prepare("SELECT count(*) as num FROM `products` WHERE enable = 1");
		$link->execute();
		$result = $link->fetch();
		$num = $result['num'];

		/* Num of row that come back from the query*/
		$offset = 2;		
		
		$query ='SELECT * FROM `products` WHERE enable = 1 ORDER BY name ';
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
		$link->execute();
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
			
			echo "<br>";
		}
		
		echo "<div style='max-width:1000px;display:block;margin:0 auto;'>";
		
		if($num == 0 OR ($_GET['page']-1)*$offset >= $num){
			echo "<div class='product'>
			<span class='prod_title' style='font-size:25px'>Nothing to se here</span>
			<img alert='nothing' src='./assets/img/no.png'>
			
			</div>";
		}
		$page = $_GET['page'];
		if((($_GET['page']-1)*$offset)-$offset > $num)
			$page = (int)($num/$offset)+1;
		if($page>1)
			echo "<a style='float:left;' href='".$_SERVER['PHP_SELF']."?page=".($page-1)."'>BACK</a>";
		

		if($_GET['page']*$offset<$num)
			echo "<a style='float:right;' href='".$_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."'>NEXT</a>";
		
		echo "</div>";
	}
include "assets/page/4end.php";
?>