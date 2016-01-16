<?php
session_start(); // Begin a session.

// First of all, check to see whether the user is browsing with a mobile device.
$mobile = false; // This will change to true if it is determined that the user is browsing with a mobile device.
include __DIR__ . '/mobile_devices.php'; // Get the list of mobile devices. Set $mobile to true if the visitor is using a device from this list.

$err = ""; // This will NOT be blank if an error has occured (i.e. user's submitted username and password do not match)

// The user can log in only if he has cookies enabled and/or is browsing on a mobile device.
if(!(isset($_COOKIE['PHPSESSID']) || $mobile)) // If the user is not browsing on a mobile device and has cookies disabled, tell him so. He cannot log in until this changes.
{
	$err = "cookies";
}
elseif(isset($_GET['id']))
{
	$con = mysql_connect("secrethost","secretuser","secretpassword"); // Connect to the database.
	mysql_select_db("Accounts", $con); // Select the Accounts database.
	$visitor = mysql_query("SELECT * FROM Members
	WHERE id=" . $_GET['id']);
	$x = 0;
	while($row = mysql_fetch_array($visitor))
	{
		$x++;
		// The user has been found in the database (which should happen every time unless this page was accessed illegally).
		// Confirm that this user should be logged in on the account of the given id.
		if(($row['ip'] == $_SERVER['REMOTE_ADDR']) && ($row['logged_in'] == 1)) // Check his IP address. Also confirm that he is in fact logged in.
		{
			if(!isset($_SESSION['id'])) // If there is no session currently open, then begin one with the user logged in.
			{
				$loc = "/";
				if(isset($_GET['des']))
				{
					$loc .= $_GET['des'];
				}
				$_SESSION['id'] = $row['id'];
				$_SESSION['username'] = $row['username'];
			}
			else // If the user is already logged in, or if someone else is on his machine, then tell him so. Set the logged_in value in the databse to false if the user has tried to log in with a second account.
			{
				if($_SESSION['id'] == $row['id'])
				{
					$loc = "/?msg=logged_in";
				}
				else
				{
					mysql_query("UPDATE Members SET logged_in = '" . false . "'
						WHERE username = '" . $row['username'] . "' AND id = '" . $row['id'] . "'");
					$loc = "/?msg=logged_in_as_other";
				}
			}
		}
		else
		{
			$err = "unexpected";
		}
		break;
	}
	// If the 'while' loop was never run, then the user id is not in the database.
	if($x != 1)
	{
		$err = "unexpected";
	}
}
else
{
	$err = "unexpected";
}

if(!isset($_GET['id']))
{
	header("Location: /");
}
elseif($err == 0)
{
	header("Location: " . $loc);
}
else
{
	$loc = "/login/?&err=" . $err;
	if(isset($_GET['des']))
	{
		$loc .= '&des=' . $_GET['des'];
	}	
	header("Location: " . $loc); // The user will be sent to the login form if his login is not approved.
}
?>