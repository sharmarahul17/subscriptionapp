<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Subscription System: Create user</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
		.header {
			background-color: SteelBlue;
		}
		button[name=register_btn] {
			background-color: SteelBlue;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>Administrator - Create User</h2>
	</div>
	
	<form method="post" action="create_user.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>User type</label>
			<select name="user_type" id="user_type" >
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="register_btn"> Create User </button>
			<button type="submit" class="btn" formaction="home.php" name="register_btn"> Admin Home Page</button>
		</div>
	</form>
</body>
</html>