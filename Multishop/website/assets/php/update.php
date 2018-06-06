<?php

function update($query){
	try{
		$con = get_con();
		$link = $con->prepare($query);
		$link->execute();
		return true;
	}
	catch(Exception $e){
		return false;
	}
}
