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
