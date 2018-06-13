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
?>
  

<div style="font-size:20px; margin-top:20px" class="container">
  <form enctype="multipart/form-data" action="add_product.php" method="POST">
  
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Product name" name="name" required/>
    </div>
	
	<div class="form-group">
		<input type="number" step=".01" class="form-control" placeholder="Price (Optional)" name="price"/>
    </div>
	<div class="form-group">
		Category
	</div>
	<?php
	$link = $con->prepare("SELECT id,name FROM categories");
	$link->execute();
	
	echo "<select style='margin-bottom:10px' name='category'>";
	while($result = $link->fetch()){
		echo '<option value='.$result['id'].'>'.$result['name'].'</option>';
	}
	echo "</select>";
	
	?>
	<div class="form-group">
			<input type="text" class="form-control" placeholder="Description (Optional)" name="description" />
	</div>
	<div class="form-group">
		<input type="number" class="form-control" placeholder="Quantity (Optional)" name="quantity"/>
    </div>
	
	<input type="hidden" name="MAX_FILE_SIZE" value="30000000">
  Upload IMG: <input name="userfile" type="file"></br>
  <input type="submit" value="Load">
	
  </form>
</div>
<?php
include "assets/page/4end.php";
?>