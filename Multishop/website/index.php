<?php
session_start();
require "./assets/php/check_session.php";
?>

<html>

<head>
</head>

<body>
<?php
if(isset($_SESSION))
	echo $_SESSION['user'];
?>
</body>

</html>