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

if(!isset($_GET['id']) OR !is_numeric($_GET['id'])){
	echo "<p style='margin-top:20px;font-size:17px;'>Ops, wrong id</p>";
}

$link = $con->prepare('SELECT count(*) as num from products WHERE id="'.$_GET['id'].'"');
$link->execute();
$num = $link->fetch();
$num = $num['num'];

if($num < 1){
	header("Location: ./");
	exit();
}
$link = $con->prepare('SELECT * from products WHERE id="'.$_GET['id'].'"');
$link->execute();
$result = $link->fetch();

$category = $result['category'];

?>
  

<div style="font-size:20px; margin-top:20px" class="container">
<?php
	echo "Name [".$result['name'].']';
?>
  <form enctype="multipart/form-data" action="modify_product.php" method="POST">
  <input name="id" value="<?php echo $_GET['id'];?>" hidden>
  <input name="name" value="<?php echo $result['name'];?>" hidden>
  <?php
  if(isset($result['url_img']))
	  echo '<img style="width:200px;margin-bottom:20px;" src="'.$result['url_img'].'">';
  else
	  echo '<img style="width:200px;margin-bottom:20px;" src="./assets/img/no.png">'
  ?>
	<div class="form-group">
		<input type="number" step=".01" class="form-control" value="<?php if(isset($result['price'])) echo $result['price']?>" placeholder="Price (Optional)" name="price"/>
    </div>
	
	<div class="form-group">
			<input type="text" class="form-control" placeholder="Description (Optional)" name="description" value="<?php if(isset($result['description'])) echo $result['description'];?>"/>
	</div>
	
	<div class="form-group">
		<input type="number" class="form-control" value="<?php if(isset($result['quantity'])) echo $result['quantity']?>" placeholder="Quantity (Optional)" name="quantity"/>
    </div>
	<div class="form-group">
		Category
	</div>
	<?php 
	
	$link = $con->prepare("SELECT id,name FROM categories");
	$link->execute();
	
	echo "<select style='margin-bottom:10px' name='category'>";
	while($result3 = $link->fetch()){
		echo '<option value="'.$result3['id'].'"';
		if($result3['id'] == $category)
			echo " selected ";
		echo '>'.$result3['name'].'</option>';
	}
	echo "</select>";
	?>
	<br>
	<input type="hidden" name="MAX_FILE_SIZE" value="30000000">
  Upload IMG: <input name="userfile" type="file"></br>
  <input name="previous_IMG" value="<?php if(isset($result['url_img'])) echo $result['url_img']; else
  echo "./assets/img/no.png"?>" hidden>
  <input type="submit" value="Load">
	
  </form>
</div>
<?php
include "assets/page/4end.php";
?>