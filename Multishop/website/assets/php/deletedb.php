<?php
function Back_to_the_future(){
	$table['a'] = 'settings';
	$table['b'] = 'prod_transictions';
	$table['c'] = 'stockists';
	$table['d'] = 'users';
	$table['e'] = 'priorities';
	$table['f'] = 'products';
	$table['g'] = 'categories';
	if(file_exists('database.php')){
		try{
			require "get_con.php";
			$con = get_con();
			
			foreach($table as $key=>$value){
				$QUERY = "DROP TABLE ".$value;
				$link = $con->prepare($QUERY);
				$link->execute();
				
			}
			
			unset($con);
			unset($link);
		}
		catch(Exception $e){
			$con = 'foo';
			unset($con);
		}
		unlink('database.php');
	}
	if(file_exists('Created.php'))
		unlink('Created.php');
}
Back_to_the_future();