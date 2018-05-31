<?php
include "assets/page/1head.php";
include "assets/page/2body.php";
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
<form enctype="multipart/form-data" action="add_product.php" method="POST">
	<input name="name"/ required>
	<input name="price"/>
	<input name="stockist"/>
	<input name="stock"/>
	<input name="quantity"/>
  <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
  Invia questo file: <input name="userfile" type="file"></br>
  <input type="submit" value="Invia File">
</form>
<?php
include "assets/page/4end.php";
?>