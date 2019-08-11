<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Subscription System: View user</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
		.header {
			background: SteelBlue;
		}
		button[name=admin_btn] {
			background: SteelBlue;
		}
		
		table { 
            border-collapse: collapse; 
            width: 100%; 
        } 
          
        th, td { 
            text-align: center; 
            padding: 8px; 
        } 
          
        tr:nth-child(even) { 
            background: LightSteelBlue;
        } 
	</style>
</head>
<body>
	<div class="header">
		<h2>Administrator - View user</h2>
	</div>
	
	<form method="post" action="home.php">

		<?php echo display_error(); ?>

		<?php
			$list=viewUsers();
			echo "<table width='90%'>
			<tr>
			<th>Database Id</th>
			<th>UserName</th>
			<th>User Type</th>
			<th>Email Id</th>
			<th>Account Verified</th>
			<th>Subscription Values</th>
			</tr>";

			foreach($list as $value){
				echo "<tr>";
				$val = explode ("###", $value); 						
				foreach($val as $v){					
					echo "<td>" . $v . "</td>";					
				}
				echo "</tr>";
			}
			echo "</table>";
		?>
		<div class="input-group">
			<button type="submit" class="btn" name="admin_btn"> Admin Home Page</button>
		</div>
	</form>
</body>
</html>