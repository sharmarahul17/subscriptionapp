<?php 
	session_start();

	// connect to database
	$db = mysqli_connect('localhost', 'root', 'tvisha16', 'mydatabase2');

	// variable declaration
	$username = "";
	$email    = "";
	$errors   = array(); 

	// call the register() function if register_btn is clicked
	if (isset($_POST['register_btn'])) {
		register();
	}

	// call the login() function if register_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location:  login.php");
	}	
	
    if(isset($_POST["submit"])){
        $countryarr=$_POST["Country"];
        $newvalues=  implode(",", $countryarr);
		addtoDatabase($newvalues);
    }
	
	if(isset($_POST["delete_btn"])){
        $useridarr=$_POST["userid"];
        $newvalues=  implode(",", $useridarr);
		deleteDatabase($newvalues);
    }

	// REGISTER USER
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		}
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$hash = md5( rand(0,1000) );
			
			if (isset($_POST['user_type'])) {
				$user_type = e($_POST['user_type']);
				$query = "INSERT INTO users (username, email, user_type, password, hash) 
						  VALUES('$username', '$email', '$user_type', '$password', '$hash')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";
				//header('location: home.php');
				header('location: home.php');
			}else{
				$query = "INSERT INTO users (username, email, user_type, password, hash) 
						  VALUES('$username', '$email', 'user', '$password', '$hash')";
				mysqli_query($db, $query);

				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				//header('location: index.php');
				header('location: login.php');				
			}

			{				
				$to      = $email; // Send email to our user
				$subject = 'Signup | Account Verification'; // Give the email a subject 
				$message = '				 
				Hello,
				
				Your account has been created, you can login with your credentials after activating your account.
								
				Username: '.$username.'
								 
				Please click on the following link to activate your account:
				https://sharmar.ursse.org/account_activation.php?email='.$email.'&hash='.$hash.'
				
				Thank you !
				Subscription Team
				'; 
									 
				$headers = 'From:rsharma@sharmar.ursse.org' . "\r\n"; // Set from headers
				mail($to, $subject, $message, $headers); // Send our email
			}
		}

	}
	
	function deleteDatabase($value){
		global $db;
		$val = explode (",", $value); 
		foreach($val as $v){
			$update="delete from users WHERE id='$v'";
			mysqli_query($db, $update);
		}
    }
	
	function addtoDatabase($value){
		global $db;
		$user_id=$_SESSION['user']['id'];
		error_log("$user_id", 0);
		$update="UPDATE users SET subscription_values='$value' WHERE id='$user_id'";

		if (mysqli_query($db, $update)) {
			return "<h2 class='text-success'>Updated</h2>";
		}else{
			return "<h2 class='text-danger'>Not updated</h2>";
		}
    }
	
	function listCheckbox(){
		global $db;
		$user_id=$_SESSION['user']['id'];
        $query1="select subscription_values from users WHERE id='$user_id'";
		$result=mysqli_query($db, $query1);
      			
		while($row = mysqli_fetch_array($result))
		{
			$arr = explode (",", $row['subscription_values']);  
		}
		return $arr;
    }
	
	function listUsers(){
		global $db;
		
        $query1="SELECT * FROM users where user_type !='admin'";
		$result=mysqli_query($db, $query1);
		
		$arr=array();
      	while($row = mysqli_fetch_array($result))
		{
			$str = $row['id'].",".$row['username'].",".$row['email'];
			array_push($arr, $str);
		}
		
		return $arr;
    }
	
	function viewUsers(){
		global $db;
		$query1="SELECT * FROM users";
		$result=mysqli_query($db, $query1);		
		$arr=array();
      	while($row = mysqli_fetch_array($result))
		{
			$str = $row['id']."###".$row['username']."###".$row['user_type']."###".$row['email']."###".($row['active'] ? 'Yes' : 'No')."###".$row['subscription_values'];
			array_push($arr, $str);
		}
		
		return $arr;
    }
	

	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM users WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
			error_log(print_r($results,true));

				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['active'] == '0'){
					array_push($errors, "Please Activate Your Account by clicking the Activation link sent to your email.");
				}else{
					if ($logged_in_user['user_type'] == 'admin') {
						$_SESSION['user'] = $logged_in_user;
						$_SESSION['success']  = "You are now logged in as Admin";
						header('location: home.php');		  
					}else{
						$_SESSION['user'] = $logged_in_user;
						$_SESSION['success']  = "You are now logged in as Regular User";

						header('location: index.php');
					}
				}
			}else {
				array_push($errors, "Wrong Username or Password");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

?>