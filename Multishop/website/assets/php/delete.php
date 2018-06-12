<?php

function delete_product($id){
	require "get_con.php";
	$con = get_con();
	$link = $con->prepare('SELECT COUNT(*) as num FROM products WHERE id = '.$id);
	$link->execute();
	$result = $link->fetch();
	$num = $result['num'];
	if($num != 1){
		return false;
	}
	$link = $con->prepare('DELETE FROM products WHERE id = '.$id);
	$link->execute();

	return true;
}