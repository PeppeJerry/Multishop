<?php
include "assets/page/1head.php";

?>

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
		$link = $con->prepare("SELECT id,name FROM categories");
		$link->execute();
		$category;
		while($result = $link->fetch()){
			$category[$result['id']] = $result['name'];
		}
		$link = $con->prepare("SELECT count(*) as num FROM `products` WHERE enable = 1");
		$link->execute();
		$result = $link->fetch();
		$num = $result['num'];
		

		/* Num of row that come back from the query*/
		$offset = 12;		
		
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
			echo "<a style='float:left;' href='".$_SERVER['PHP_SELF']."?page=".($page-1)."'><img style='width:50px;margin-top:20px' src='./assets/img/left-arrow.png'></a>";
		
		if($_GET['page']*$offset<$num)
			echo "<a style='float:right;' href='".$_SERVER['PHP_SELF']."?page=".($_GET['page']+1)."'><img style='width:50px;margin-top:20px' src='./assets/img/right-arrow.png'></a>";
		
		if($num == 0){
			echo "<p class='h1'>Ops, there is nothing to see here</p>";
		}
	}
	else{
		echo "<p class='h1'>Ops, there is no connection</p>";
	}
	
	
include "assets/page/4end.php";
?>