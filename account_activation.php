<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Subscription System: Account Verification</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <!-- start header div --> 
    <div class="header">
        <h3>New user Account Verification</h3>
    </div>
    <!-- end header div -->   
     
    <!-- start wrap div -->   
    <div id="wrap">
        <!-- start PHP code -->
        <?php
         
            mysql_connect("localhost", "root", "tvisha16") or die(mysql_error()); // Connect to database server(localhost) with username and password.
            mysql_select_db("mydatabase2") or die(mysql_error()); // Select registration database.
             
			if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
			// Verify data
			$email = mysql_escape_string($_GET['email']); // Set email variable
			$hash = mysql_escape_string($_GET['hash']); // Set hash variable
						 
			$search = mysql_query("SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error()); 
			$match  = mysql_num_rows($search);
						 
			if($match > 0){
				// We have a match, activate the account
				mysql_query("UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error());
				echo '<div class="input-group">Your account has been activated. <br><br>Please click here to login: <a href="https://sharmar.ursse.org">Subscription System</a> <br><br> Thank you.</div>';
			}else{
				// No match -> invalid url or account has already been activated.
				echo '<div class="input-group">Invalid URL or your account Already Activated. <br><br>Please click here to login: <a href="https://sharmar.ursse.org">Subscription System</a> <br><br> Thank you.</div>';
			}
						 
		}else{
			// Invalid approach
			echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
		}
        ?>
        <!-- stop PHP Code -->
 
         
    </div>
    <!-- end wrap div --> 
</body>
</html>