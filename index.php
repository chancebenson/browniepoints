<?php
/*
WHMCS Brownie Points
Created: Jan 26 2015
By: Chance Benson
Version 1.0.0
*/

//Start the session
session_start();

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

// Lets say hello to our users

$time=date('H');

function sayhello($time)
{
	if ($time<12) {
		return "Good morning!";
	}
	elseif ($time<18) {
		return "Good afternoon!";
	}
	else {
		return "Good evening!";
	}
}

$greeting = sayhello($time);

if (match_found_in_database()) {
	$_SESSION['loggedin'] = true;
	$_SESSION['username'] = $username;
}
echo "$greeting $username, How are you?";

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
<body>
 <b>'.$message.'</b>
<div id="tabs" style="width: 480px;">
	<ul>
    	<li><a href="#tabs-1">Login</a></li>
    	<li><a href="#tabs-2" class="active">SignUp</a></li>
    </ul>
	<div id="tabs-1">
		<form action="" method="post">
			<p><input id="email" type="text" placeholder="Your Email"></p>
			<p><input id="password" type="password" placeholder="Your Pass">
			<input name="action" type="hidden" value="Login" /></p>
			<p><input type="submit" value="Enter if you dare" /></p>
		</form>
	</div>
	<div id="tabs-2">
		<form action="" method="post">
			<p><input id="name" name="name" type="text" placeholder="Your Name"></p>
    		<p><input id="email" name="email" type="text" placeholder="Your Email"></p>
    		<p><input id="password" name="password" type="password" placeholder="Your Pass">
    		<input name="action" type="hidden" value="signup" /></p>
    		<p><input type="submit" value="Signup" /></p>
		</form>
	</div>
</div>';
?>