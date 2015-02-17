<?php
include('conn.php');
if(isset($_POST['action']))
{
	if ($_POST['action']=="login") {
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$password = mysqli_real_escape_string($connection,$_POST['password']);
		$strSQL = mysqli_query($connection,"SELECT name FROM users WHERE email='".$email."' and password='".md5($password)."'");
		$results = mysqli_fetch_array($strSQL);
		if (count($results)>=1)
		{
			$message = $results['name']." Login Success!!";
		}
		else
		{
			$message = "Invalid login attempt...Should you be here right now?!?!";
		}
	}
	elseif ($_POST['action']=="signup") {
		$name = mysqli_real_escape_string($connection,$_POST['name']);
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$password = mysqli_real_escape_string($connection,$_POST['password']);
		$query = "SELECT email FROM users WHERE email='".$email."'";
		$result = mysqli_query($connection,$query);
		$numresults = mysqli_num_rows($result);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) //Validate the email used
		{
			$message = "Invalid email, please check your fat fingers!";
		}
		elseif ($numresults>=1)
		{
			$message = $email." Email already exists!!";
		}
		else
		{
			mysqli_query("insert into users(name,email,password) values('".$name."','".$email."','".md5($password)."')");
			$message = "You did it correctly!";
		}
	}
}

echo '<script type="text/javascript" src="jquery-1.8.0.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<style type="text/css">
input[type=text]
{
  border: 1px solid #ccc;
  border-radius: 3px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  width:200px;
  min-height: 28px;
  padding: 4px 20px 4px 8px;
  font-size: 12px;
  -moz-transition: all .2s linear;
  -webkit-transition: all .2s linear;
  transition: all .2s linear;
}
input[type=text]:focus
{
  width: 400px;
  border-color: #51a7e8;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1),0 0 5px rgba(81,167,232,0.5);
  outline: none;
}
input[type=password]
{
  border: 1px solid #ccc;
  border-radius: 3px;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  width:200px;
  min-height: 28px;
  padding: 4px 20px 4px 8px;
  font-size: 12px;
  -moz-transition: all .2s linear;
  -webkit-transition: all .2s linear;
  transition: all .2s linear;
}
input[type=password]:focus
{
  width: 400px;
  border-color: #51a7e8;
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1),0 0 5px rgba(81,167,232,0.5);
  outline: none;
}
</style>
<script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
</head>
<body id="body-color">
 <b>'.$message.'</b>
<div id="tabs">
		<fieldset style="width:30%"><legend>LOGIN HERE</legend>
			<form method="POST" action="">
				USER: <br><input type="text" name="user" size="40"><br>
				PASS: <br><input type="password" name="pass" size="40"><br>
				<input id="button" type="submit" name="submit" value="ENTER AT YOUR OWN RISK">
			</form>
		</fieldset>
		<fieldset style="width:30%"><legend>SignUp</legend>
			<form method="POST" action="">
				Name: <br><input type="text" name="user" size="50"><br>
				Email: <br><input type="text" name="email" size="40"><br>
				Pass: <br><input type="password" name="password" size="40"><br>
				<input id="button" type="submit" name="submit" value="SignUp">
			</form>
		</fieldset>
	</div>
</body>';
?>