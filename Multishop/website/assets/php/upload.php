<?php


function upload($uploaddir){
require "check_image.php";

	if (!isset($_FILES['userfile']) || !is_uploaded_file($_FILES['userfile']['tmp_name'])) {
		return false;
	}

	$userfile_tmp = $_FILES['userfile']['tmp_name'];

	$path = $_FILES['userfile']['name'];
	$ext = pathinfo($path, PATHINFO_EXTENSION);

	if(!is_image($userfile_tmp))
		return false;

	$userfile_name = md5($_FILES['userfile']['name'].md5_file($_FILES['userfile']['tmp_name'])).".".$ext;

	if(file_exists($uploaddir.$userfile_name)){
		return $userfile_name;
	}
	
	if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name))
		return $userfile_name;
	else
		return false;
}