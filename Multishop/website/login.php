<html>

<head>

<title>Login</title>

<!-- JQuery -->
<script src="assets/js/jquery.js"></script>

<link rel="icon" href="assets/img/config.png" type="image/png" sizes="16x16">
<link rel="stylesheet" href="assets/css/configuration.css" type="text/css">
<link rel="stylesheet" href="assets/css/general.css" type="text/css">
<script src="assets/js/support_function.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

<body>
<div class="box" style="margin-top:100px;"> 

<div id="Display" ></div>

  <form id="settings" class="container" method="POST">
    <h3 style="text-align:center">Login</h3>
    <h4 style="text-align:center">Correct credentials for enter obviously</h4>
	
	<fieldset>
      <input placeholder="Admin name" class="chars" name="admin" type="text" required>
    </fieldset>
	
	<fieldset>
      <input placeholder="Admin password" class="password" name="pwd" type="password" required>
    </fieldset>
      <button name="submit" type="submit" id="settings-submit">Submit</button>
	  
    </fieldset>
	</form>
</div>
</body>

</html>