<?php
include "assets/page/1head.php";
include "assets/page/2body.php";


?>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin:0 auto;
  margin-top:30px;
  text-align: center;
  font-family: arial;
  border:1px solid black;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>

<div class="card">
<span style="font-size:30px"><?php echo $_SESSION['user']; ?></span>
  <img src="assets/img/logged.png" alt="Admin" style="width:100%">
  <div style="text-align:left;margin: 24px 0;">
  <div style="text-align:center;font-size:40px;">Privilage</div><br>
  <?php
  if($_SESSION['a_p'])
	  echo "<span style='margin:10;margin-bottom:10px;color:Blue;font-size:25px;'>Admin control: <span style='color:Green'>Yes</span></span><br>";
  else
	  echo "<span style='margin:10;margin-bottom:10px;color:Blue;font-size:25px;'>Admin control: <span style='color:Red'>No</span></span><br>";
  
  if($_SESSION['a_a'])
	  echo "<span style='margin:10;margin-bottom:10px;color:Blue;font-size:25px;'>Product control: <span style='color:Green'>Yes</span></span><br>";
  else
	  echo "<span style='margin:10;margin-bottom:10px;color:Blue;font-size:25px;'>Procuct control: <span style='color:Red'>No</span></span><br>";
  ?>
 </div>
</div>

<?php


include "assets/page/4end.php";
?>