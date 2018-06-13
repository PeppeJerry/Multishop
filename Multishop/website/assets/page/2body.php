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
			<form action="./search.php?page=1" method="GET">
				<input style="font-size:16px;" name="search" type="search" placeholder="Search product..." required>
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
						if(isset($_SESSION['a_a']) AND $_SESSION['a_a'] AND $_SESSION['priority'] == 1){
							echo '<li><a href="log.php">Log</a></li>';
						}
						?>
					</ul>
				</li>
			</ul>
		</nav>
	</header>

	<main class="cd-main-content">
		<nav class="cd-side-nav">
			<ul>
				<li class="cd-label">Product Reserch</li>
				<li class="has-children">
					<a class="nav-style" href="#0">Search</a>
					
					<ul>
						<li><a href="category.php?page=1">Search by Category</a></li>
						<li><a href="sorted.php?page=1">Search A to Z</a></li>
					</ul>
				</li>

			</ul>
			<?php if(isset($_SESSION['a_p'])){
							echo '
			<ul>
				<li class="cd-label">Product Operation</li>
				<li class="has-children comments">
					<a class="nav-style" href="#0">Product</a>
					
					<ul>
					<li><a href="./newcategory.php">Add, List, Delete category</a></li>
						';
						if($_SESSION['a_p'])
						echo '
						<li><a href="./newproduct.php">Add product</a></li>';
						
			}
							?>
			<?php
			echo '
					</ul>
				</li>

			</ul>';
			?>

			
			<?php
			if(isset($_SESSION['a_a'])){
				echo '
				<ul>
					<li class="cd-label">User operation</li>
					<li class="nav-style has-children users">
					
						<a href="#0">Users</a>
					
						<ul>
						<li><a href="./newadmin.php">New Admin / List Admin</a></li>
						<li><a href="./changepassword.php">Change Password</a></li>
						';
						if(isset($_SESSION['a_p']) AND $_SESSION['a_p'] AND $_SESSION['priority'] == 1)
							echo '<li><a href="./deleteadmin.php">Delete Admin</a></li>';
						echo'
						</ul>
					</li>
				</ul>
				';
			}
			?>
			

		</nav>

		<div class="content-wrapper">