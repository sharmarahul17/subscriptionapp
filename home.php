<?php 
	include('functions.php');

	if (!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Subscription System: Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
	.header {
		background-color: SteelBlue;
	}
	button[name=register_btn] {
		background-color: SteelBlue;
	}
	ul {
	  list-style-type: none;
	  margin: 0;
	  padding: 0;
	  overflow: hidden;
	  background-color: SteelBlue;
	}

	li {
	  float: left;
	}

	li a {
	  display: block;
	  color: white;
	  text-align: center;
	  padding: 16px;
	  text-decoration: none;
	}

	li a:hover {
	  background-color: LightSteelBlue;
	}

	</style>
</head>
<body>
	<div class="header">
		<h2>Administrator - Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<div class="right">
		<a href="home.php?logout='1'" style="color: red;">Sign out</a>
		</div>
		<!-- logged in user information -->
		<div class="profile_info">
			<img src="admin_profile.png"  >
			<div>
				<?php  if (isset($_SESSION['user'])) : ?>				
					<strong><?php echo $_SESSION['user']['username']; ?></strong>
					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
					</small>
				<?php endif ?>
			</div>
		</div>
	</div>
	
		<div class="content">
		<ul>
			<li><a href="create_user.php"> Add New User</a></li>
			<li><a href="delete_user.php"> Delete existing User</a></li>
			<li><a href="view_users.php"> View All Users</a></li>
		</ul>
		</div>
		
</body>
</html>