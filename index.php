<?php 
	include('functions.php');

	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Subscription System: Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
/* The container1 */
.container1 {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container1 input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container1:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container1 input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container1 input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container1 .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>
<body>
	<div class="header">
		<h2>User Home Page</h2>
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
		<!-- logged in user information -->
		<div class="right">
		<a href="home.php?logout='1'" style="color: red;">Sign out</a>
		</div>
		<div class="profile_info">
			<img src="user_profile.png"  >
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
	
	<div class="container">
	<?php
        $list=listCheckbox($_SESSION['user']['id']);
	?>
		<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
			<h1>Subscribe Website(s)</h1><br/><br/>
			<small>
			<label class="container1">
				<input type="checkbox" id="Country" name="Country[]" value="Google" <?php if (in_array("Google", $list)) echo "checked='checked'"; ?>>Google<br/>
				<span class="checkmark"></span>
			</label>
			<label class="container1">
				<input type="checkbox" id="Country" name="Country[]" value="Amazon" <?php if (in_array("Amazon", $list)) echo "checked='checked'"; ?>>Amazon<br/>
				<span class="checkmark"></span>
			</label>
			<label class="container1">
				<input type="checkbox" id="Country" name="Country[]" value="Facebook" <?php if (in_array("Facebook", $list)) echo "checked='checked'"; ?>>Facebook<br/>
				<span class="checkmark"></span>
			</label>
			<label class="container1">
				<input type="checkbox" id="Country" name="Country[]" value="YouTube" <?php if (in_array("YouTube", $list)) echo "checked='checked'"; ?>>YouTube<br/>
				<span class="checkmark"></span>
			</label>
			<label class="container1">
				<input type="checkbox" id="Country" name="Country[]" value="Yahoo" <?php if (in_array("Yahoo", $list)) echo "checked='checked'"; ?>>Yahoo<br/>
				<span class="checkmark"></span>
			</label>
			<label class="container1">
				<input type="checkbox" id="Country" name="Country[]" value="Samsung" <?php if (in_array("Samsung", $list)) echo "checked='checked'"; ?>>Samsung<br/>
				<span class="checkmark"></span>
			</label>
			<label class="container1">
				<input type="checkbox" id="Country" name="Country[]" value="Apple" <?php if (in_array("Apple", $list)) echo "checked='checked'"; ?>>Apple<br/>
				<span class="checkmark"></span>
			</label>
			<label class="container1">
				<input type="checkbox" id="Country" name="Country[]" value="LinkedIn" <?php if (in_array("LinkedIn", $list)) echo "checked='checked'"; ?>>LinkedIn<br/>
				<span class="checkmark"></span>
			</label>
			
			<br/>
			</small>
			
			<input type="submit" id="submit" name="submit" value=" Subscribe " class="btn btn-primary">

		</form>
	</div> <!-- /container -->
					
</body>
</html>