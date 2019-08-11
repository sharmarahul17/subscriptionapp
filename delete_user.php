<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Subscription System: Delete user</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
		.header {
			background: SteelBlue;
		}
		button[name=delete_btn] {
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
		<h2>Administrator - Delete User</h2>
	</div>
	
	<form method="post" action="delete_user.php">

		<?php echo display_error(); ?>

		<?php
			$list=listUsers();
			echo "<table border='1' width='90%'>
			<tr>
			<th>Check</th>
			<th>Database Id</th>
			<th>UserName</th>
			<th>Email Id</th>
			</tr>";

			foreach($list as $value){
				echo "<tr>";
				$val = explode (",", $value); 
				echo "<td> <input type='checkbox' id='userid' name='userid[]' value=" .$val[0]. "> </td>";	
							
				foreach($val as $v){					
					echo "<td>" . $v . "</td>";					
				}
				echo "</tr>";
			}
			echo "</table>";
		?>
		<div style="color: red;">
			<br>
			<h5>*Note: Only Regular(Not Admin) users can be deleted.</h5>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="delete_btn"> Delete User </button>
			<button type="submit" class="btn" formaction="home.php" name="delete_btn"> Admin Home Page</button>
		</div>
	</form>
</body>
</html>