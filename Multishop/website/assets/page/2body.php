<body>
	<header class="cd-main-header">
		<a href="#0" class="cd-logo"></a>
		
		<div class="cd-search is-hidden">
			<form action="#0">
				<input type="search" placeholder="Search product...">
			</form>
		</div>

		<a href="#0" class="cd-nav-trigger">Menu<span></span></a>

		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<li class="has-children account">
					<a href="#0">
					<?php
					if(isset($_SESSION['user']))
						 echo '<img src="assets/img/logged.png" alt="avatar">Admin';
					 else
						 echo '<img src="assets/img/guest.png" alt="avatar">Guest';
					 
						?>
					</a>

					<ul>
					<?php
						if(isset($_SESSION['user']))
						echo '
						<li><a href="#0">My Account</a></li>
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
				<li class="cd-label">Guest Pannel</li>
				<li class="has-children">
					<a href="#0">Product</a>
					
					<ul>
						<li><a href="#0">Categories</a></li>
						<li><a href="#0">A to Z</a></li>
					</ul>
				</li>

				<li class="has-children comments">
					<a href="#0">Comments</a>
					
					<ul>
						<li><a href="#0">All Comments</a></li>
						<li><a href="#0">Edit Comment</a></li>
						<li><a href="#0">Delete Comment</a></li>
						<li><a href="#0">Peppe Comment</a></li>
					</ul>
				</li>
			</ul>

			<ul>
				<li class="cd-label">Secondary</li>
				<li class="has-children bookmarks">
					<a href="#0">Bookmarks</a>
					
					<ul>
						<li><a href="#0">All Bookmarks</a></li>
						<li><a href="#0">Edit Bookmark</a></li>
						<li><a href="#0">Import Bookmark</a></li>
					</ul>
				</li>
				<li class="has-children images">
					<a href="#0">Images</a>
					
					<ul>
						<li><a href="#0">All Images</a></li>
						<li><a href="#0">Edit Image</a></li>
					</ul>
				</li>

				<li class="has-children users">
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