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

?>
  

<div style="font-size:20px; margin-top:20px" class="container">
<?php
	echo "Name [".$result['name'].']';
?>
  <form enctype="multipart/form-data" action="modify_product.php" method="POST">
  <?php
  if(isset($result['url_img']))
	  echo '<img style="width:200px;margin-bottom:20px;" src="'.$result['url_img'].'">';
  else
	  echo '<img style="width:200px;margin-bottom:20px;" src="./assets/img/no.png">'
  ?>
    <div class="form-group">
	
      <input type="text" class="form-control" placeholder="Product name" name="name" value="<?php if(isset($result['name'])) echo $result['name']?>" required/>
    </div>
	
	<div class="form-group">
		<input type="number" class="form-control" value="<?php if(isset($result['price'])) echo $result['price']?>" placeholder="Price (Optional)" name="price"/>
    </div>
	
	
	<div class="form-group">
		<input type="number" class="form-control" value="<?php if(isset($result['quantity'])) echo $result['quantity']?>" placeholder="Quantity (Optional)" name="quantity"/>
    </div>
	
	<input type="hidden" name="MAX_FILE_SIZE" value="30000000">
  Upload IMG: <input name="userfile" type="file"></br>
  <input type="submit" value="Carica">
	
  </form>
</div>
<?php
include "assets/page/4end.php";
?>