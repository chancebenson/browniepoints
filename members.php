<?php
/*
WHMCS Brownie Points
Created: Jan 26 2015
By: Chance Benson
Version 1.0.0
*/

include('conn.php');
if (isset($_POST['action'])) 
{
	if ($_POST['action']=='add') 
	{
		$user = mysqli_real_escape_string($connection,$_POST['name']);
		$points = mysqli_real_escape_string($connection,$_POST['points']);
		$for = mysqli_query($connection,"select name from users where name='".$name."'");
		$insert = mysqli_fetch_array($for);
		if (count($insert)>=1) 
		{
			mysqli_query("insert into points(name,points,whom) values('".$for."','".$points."','".$whom."')");
			$message = $insert['points']." have been added to $user";
			die($message);
		}
		else
		{
			$message = "$points were not added to $user";
			die($message);
		}
	}
}

$query = mysqli_query("select name from users");

echo '
<html>
<head>
 <h1>Add points to the user who deserves them</h1>
</head>
<body>
 <b>'.$message.'</b>
<div id="points" style="width: 480px;">
	<form action="" method="post">
		<select name="name">
			<?php while ($option = $query->fetch_object()) { ?>
				<option><?php echo $option->name; ?></option>
			<?php } ?>
	<input type="text" name="points" value="How many points to give">
		<select id="for" name="for">
			<option value="none" selected>--Select who its for--</option>
			<option value="$for">
		</select>
	<input type="submit" value="Add the points">
	</form>
</div>
</body>
</html>';
?>	