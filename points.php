<?php
/*
WHMCS Brownie Points
Created: Jan 26 2015
By: Chance Benson
Version 1.0.0
*/

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

echo "$greeting How are you?";

##### End of Hello #####