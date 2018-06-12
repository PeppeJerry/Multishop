<?php
include "assets/page/1head.php";
include "assets/page/2body.php";

if(!isset($_SESSION['a_a'])){
	header("Location: ./");
	exit();
}

$con = get_con();
$link = $con->prepare('SELECT priority FROM users WHERE userid = :name');
$link->bindParam(":name",$_SESSION['user']);
$link->execute();
$priority = $link->fetch();
$priority = $priority['priority'];

$link = $con->prepare('SELECT * FROM priorities ORDER BY lvl');
$link->execute();
$list;
while($result = $link->fetch())
	$list[$result['lvl']] = $result['name'];

$list[1] .= " (Be careful with this)";


if(isset($_GET['error'])){
	echo '<p style="font-size:18px;text-align:center;background:white;display:block;max-width:300px;padding:10px;margin:0 auto;margin-top:20px">';
	switch ($_GET['error']){
		case (1):
		echo "Missing Privilage";
		break;
		
		case (2):
		echo "Missing Parameters";
		break;
		
		case (3):
		echo "Bad Form";
		break;
		
		case (4):
		echo "User Already Exist";
		break;
		
		case (5):
		echo "New Admin Added!";
		break;
		
		default:
		echo "Bad Error";
	}
	echo '</p>';
}
?>
<div style="margin-top:20px;font-size:16px;" class="container">
<?php
if(($priority == 1 OR $priority == 2) AND $_SESSION['a_a']){
	echo '<p style="background:white;display:block;max-width:300px;padding:10px;margin:0 auto;margin-top:20px">Admin must be:<br>8 to 20 letters <br>Numbers are OPTIONAL<br>With 1 CAPS and 1 letter<br>No other chars are allowed!<br><br>Password must be:<br>10 to 30 letters<br>With 1 CAPS and 1 letter<br>With a special char:<br><span style="font-size:15px;">< > ! " \' $ % & / ( ) = # ?</span><br>OPTIONAL<br>You can put also space!</p>


  <form style="margin-top:20px;" enctype="multipart/form-data" action="add_admin.php" method="POST">
  
  
	<div class="form-group">
      <input type="text" class="form-control" placeholder="Admin Name" name="name" required/>
    </div>
	
	<div class="form-group">
		<input type="password" class="form-control" placeholder="Password" name="pwd" required/>
    </div>
	
	<div class="form-group">
		<input type="password" class="form-control" placeholder="Confirm password" name="c_pwd" required/>
    </div>';
}

?>



	
	<?php 
	
	
	
	if(($priority == 1 OR $priority == 2) AND $_SESSION['a_a']){
		echo '
		<div class="form-group">
			<select class="form-control" name="priority">
		';
				
		
		echo $priority;
		foreach($list as $key=>$value)
			if(!($priority != 1 AND ($key == 1 OR $key == 2)))
				echo '<option value="'.$key.'">'.$value.'</option>';
		echo '
			</select>
		</div>
		';
	}
	
	if(($priority == 1 OR $priority == 2) AND $_SESSION['a_a'])
		echo '<input type="checkbox" name="a_a" value="1">Admin Permission
	 <br>
	 <input type="checkbox" name="a_p" value="1">Product Permission
	 <input style="font-size:20px;display:block; margin:0 auto;" value="Confirm" type="submit" class="btn btn-default">
  </form>';
	
	?>
	 

  <p> List of Users </p>

<?php

$link = $con->prepare("SELECT userid FROM users");
$link->execute();
while($result = $link->fetch()){
	echo $result['userid']."<br>";
}
?>
</div>
<?php
include "assets/page/4end.php";
?>
