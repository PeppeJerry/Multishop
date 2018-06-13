<?php

session_start();
require "assets/php/check_session.php";

if(!(isset($_SESSION['a_a']) AND $_SESSION['a_a'] AND $_SESSION['priority'] == 1)){
	header('Location: ./');
	exit();
}

$con = get_con();
$link = $con->prepare("SELECT * FROM prod_transictions ORDER BY time_action DESC");
$link->execute();
while($result = $link->fetch()){
	echo $result['action']." - ".$result['time_action']."<hr>";
}