<html>

<head>

<title>Configuration</title>

<!-- JQuery -->
<script src="website/assets/js/jquery.js"></script>

<link rel="icon" href="website/assets/img/config.png" type="image/png" sizes="16x16">
<link rel="stylesheet" href="website/assets/css/configuration.css" type="text/css">
<link rel="stylesheet" href="website/assets/css/general.css" type="text/css">
<script src="website/assets/js/configuration.js"></script>
<script src="website/assets/js/support_function.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

<body>
<div class="box"> 

<div id="Display" ></div>

  <form id="settings" class="container" method="POST">
    <h3>Database configuration</h3>
    <h4>Make sure you put the correct setting</h4>
    <fieldset>
      <input placeholder="Database name" class="chars" name="datab" id="database" type="text" required autofocus>
    </fieldset>
	
	<fieldset>
      <input placeholder="Admin name" class="chars" name="admin" type="text" required>
    </fieldset>
	
	<fieldset>
      <input placeholder="Admin password" class="password" name="pwd" type="password" required>
    </fieldset>
	
	<fieldset>
      <input placeholder="Confirm password" class="password" name="c_pwd" type="password" required>
	  <div class="help-tip"><p>Password must be:<br>8 to 20 letter<br>With 1 CAPS and 1 letter<br>With a special char:<br><span style="font-size:15px;">< > ! " ' $ % & / ( ) = # ?</span><br>OPTIONAL<br>You can put also space!</p></div>
    </fieldset>
	<hr/>
	<h2 style="text-align:center;">Platform Setting</h2>
	<fieldset>
	<hr/>
	<h4>Product with price<input type="checkbox" name="price" value="1"/></h4><hr/>
	<h4>Stock information<input type="checkbox" name="stock" value="1"/></h4><hr/>
	<h4>Stockist information<input type="checkbox" name="stockl" value="1"/></h4><hr/>
	</fieldset>
	  <button name="check" type="button" id="connection">Connection</button>
      <button name="submit" type="submit" style="visibility: hidden;" id="settings-submit">Submit</button>
	  
    </fieldset>
	</form>
</div>
</body>

</html>