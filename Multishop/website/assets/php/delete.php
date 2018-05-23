<?php
function Back_to_the_future(){
	if(file_exists('database.php')){
		require 'database.php';
		$path = 'mysql:host=localhost;dbname='.$db_name;
		$con = new PDO($path,'root','');
		$link = $con->exec('DROP DATABASE '.$db_name);
		unset($con);
		unset($link);
		unlink('database.php');
	}
	if(file_exists('Created.php'))
		unlink('Created.php');
}