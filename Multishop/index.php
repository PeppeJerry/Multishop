<html>

<head>

<title>Configuration</title>

<!-- JQuery -->
<script src="website/assets/js/jquery.js"></script>

<link rel="icon" href="website/assets/img/config.png" type="image/png" sizes="16x16">
<link rel="stylesheet" href="website/assets/css/configuration.css" type="text/css">
<script src="website/assets/js/configuration.js"></script>
<script src="website/assets/js/support_function.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

<body>
<div class="box"> 

<div id="Display" ></div>

	<input hidden type="text" value="CHECK_CONNECTION"/>
  <form id="settings" class="container" action="configuration/add_new_db.php" method="POST">
    <h3>Database configuration</h3>
    <h4>Make sure you put the correct setting</h4>
    <fieldset>
      <input placeholder="Database name" class="chars" name="datab" id="database" type="text" required autofocus>
    </fieldset>
	
	<fieldset>
      <input placeholder="Admin name" class="chars min_char" name="admin" type="text" required>
    </fieldset>
	
	<fieldset>
      <input placeholder="Admin password" class="chars min_char" name="pwd" type="password" required>
    </fieldset>
	
	<fieldset>
      <input placeholder="Confirm password" class="chars min" name="c_pwd" type="password" required>
    </fieldset>
	<hr/>
	<h2 style="text-align:center;">Platform Setting</h2>
	<fieldset>
	<hr/>
	<h4>Product with price<input type="checkbox" name="price" value="1"/></h4><hr/>
	<h4>Stock information<input type="checkbox" name="stock" value="1"/></h4><hr/>
	<h4>Stockist information<input type="checkbox" name="stockl" value="1"/></h4><hr/>
	</fieldset>
      <button name="submit" type="submit" id="settings-submit">Submit</button>
    </fieldset>
	</form>
</div>
</body>

</html>