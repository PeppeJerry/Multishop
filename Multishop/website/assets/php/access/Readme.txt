LocalUser.php must contain:

	1- Two variables with name and password of a user
		1.1- The user must have the following permission in the database:
			- Select
			- Insert
			- Update
			- Delete
			- File
			- Create
			- Create Temporaly Tables
			- Show View
		
		1.2- Connection to localhost
		
	2- Password should be generated randomly
		2.1- Password is not an optional for your security
		
Structure of LocalUser.php:

<?php

$user = "(Choose a name)";
$pwd = "(Choose a password)";

?>