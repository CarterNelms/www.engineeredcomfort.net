<?php
$err = ""; // This will NOT be blank if an error has occured (i.e. user's submitted username and password do not match)

if(strlen($_POST['username']) > 0)
{
	$con = mysql_connect("secrethost","secretuser","secretpassword"); // Connect to the database.
	mysql_select_db("Accounts", $con); // Select the Accounts database.
	$visitor = mysql_query("SELECT * FROM Members
	WHERE username='" . $_POST['username'] . "'");
	$x = 0;
	while($row = mysql_fetch_array($visitor))
	{
		$x++;
		// If his information is valid, then store it as session variables.
		// First check to see that his username is on record.
		if($row['username'] == $_POST['username'])
		{
			// If his username is on record, then check to see that he entered his password correctly.
			if($row['password'] == sha1($_POST['password'] . $row['salt']))
			{
				if(!(($row['architect'] == 0) && ($row['builder'] == 0))) // If this account has not yet been granted any permissions, then the user cannot yet log in.
				{
					// If his password is correct, then update his database info and prepare to send his login info to the next script.
					// Record the current IP address of this user. Each account may be used on only one IP address at a time.
					mysql_query("UPDATE Members SET ip = '" . $_SERVER['REMOTE_ADDR'] . "'
					WHERE username = '" . $row['username'] . "' AND id = '" . $row['id'] . "'");
					// Record the login time of this user.
					mysql_query("UPDATE Members SET lastvisit = '" . time() . "'
					WHERE username = '" . $row['username'] . "' AND id = '" . $row['id'] . "'");
					// Make note in the database that this user is currently logged in.
					mysql_query("UPDATE Members SET logged_in = '" . true . "'
					WHERE username = '" . $row['username'] . "' AND id = '" . $row['id'] . "'");
					$id = $row['id'];
				}
				else
				{
					$err = "inactive";
				}
			}
			else
			{
				$err = "userpass";
			}
		}
		else
		{
			$err = "userpass";
		}
		break;
	}
	// If the 'while' loop was never run, then the username is not in the database.
	if($x != 1)
	{
		$err = "userpass";
	}
}
else
{
	$err = "blank";
}

if($err == "")
{
	$loc = "https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/login/set_session_cookie?id=" . $id;
	if(isset($_GET['des']))
	{
		$loc .= "&des=" . $_GET['des'];
	}
	header("Location: " . $loc); // The user will be redirected to his last destination if his login is approved.
}
else
{
	header('Location: https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/login/?des=/ssl/login/?des=' . $_GET['des'] . '&err=' . $err); // The user will sent to the login form if his login is not approved.
}
?>