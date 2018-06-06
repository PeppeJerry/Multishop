</head>
<body style="background:#3399ff">

	<style>
	li a:hover{
		text-decoration:none;
		color:#1784c7;
	}
	</style>

	<header class="cd-main-header">
		<a style="margin-top:5px;" href="./" class="cd-logo"><img style="width:90px;" src="assets/img/logo.png" alt="Logo"></a>
		
		<div class="cd-search is-hidden">
			<form action="#0">
				<input style="font-size:16px;" type="search" placeholder="Search product...">
				<input type="submit" hidden>
				<input name="page" value="1" style="display:none;">
			</form>
		</div>

		<a href="#0" class="cd-nav-trigger"><span></span></a>

		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<li class="has-children account">
					<a href="#0">
					<?php
					if(isset($_SESSION['user']))
						 echo '<img src="assets/img/logged.png" alt="Admin">Admin';
					 else
						 echo '<img src="assets/img/guest.png" alt="Guest">Guest';
					 
						?>
					</a>

					<ul>
					<?php
						if(isset($_SESSION['user']))
						echo '
						<li><a href="myaccount.php">My Account</a></li>
						<li><a href="assets/php/logout.php">Logout</a></li>';
						else
							echo '<li><a href="login.php">Login</a></li>';
						?>
					</ul>
				</li>
			</ul>
		</nav>
	</header>

	<main class="cd-main-content">
		<nav class="cd-side-nav">
			<ul>
				<li class="cd-label">Product Operation</li>
				<li class="has-children">
					<a class="nav-style" href="#0">Product</a>
					
					<ul>
						<li><a href="category.php&category&page=1">Categories</a></li>
						<li><a href="sorted.php?page=1">A to Z</a></li>
						<?php if(isset($_SESSION['a_p']) AND $_SESSION['a_p'])
							echo "
						<li><a href='newproduct.php'>Add product</a></li>
						";
							?>
					</ul>
				</li>

			</ul>

			<ul>
				<li class="cd-label">Users operation</li>

				<li class="nav-style has-children users">
					<a href="#0">Users</a>
					
					<ul>
						<li><a href="#0">All Users</a></li>
						<li><a href="#0">Edit User</a></li>
						<li><a href="#0">Add User</a></li>
					</ul>
				</li>
			</ul>

		</nav>

		<div class="content-wrapper">