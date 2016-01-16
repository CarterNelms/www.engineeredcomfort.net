<?php
//include "/login/set_secure_cookie.php"; // Begin a session if the connection is secure (https)
session_start();

// Some useful variables
$err = ""; // This will NOT be blank if an error has occured (i.e. user's submitted username and password do not match)
$mobile = false; // This will change to true if it is determined that the user is browsing with a mobile device.
$logout = isset($_GET['logout']) && $_GET['logout']; // This will be true if the user has logged out.
$logtime = 7200; // This is the amount of time in seconds that the user may remain inactive before being forced to log off.
$dynamic_link = "onmouseover=\"this.style.textDecoration='underline'\" onmouseout=\"this.style.textDecoration='none'\""; // Printing this variable into the attributes of an <a> tag with create a link that has no underline unless the mouse hovers over it.
$dynamic_link_inverted = "onmouseover=\"this.style.textDecoration='none'\" onmouseout=\"this.style.textDecoration='underline'\""; // The opposite of dynamic_link. Printing this variable into the attributes of an <a> tag with create a link that has an underline unless the mouse hovers over it.
$menu_highlight = "onmouseover=\"this.style.backgroundColor='#47b865'; this.style.color='#ffffff';\" onmouseout=\"this.style.backgroundColor=''; this.style.color='';\""; // Printing this variable into the attributes of any tag with set it's background color to white when untouched and light green when hovered over.
$backtotop = "<div align='right'><a href='#top'><img src='/images/backtotop.png' class='backtotop' /></a></div>"; // This text will create a back-to-top button wherever it is printed.
$L_letters = array( // This array is used for filtering. It was originally included to ensure that a password contains at least one letter.
'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
$U_letters = array( // This array is used for filtering. It was originally included to ensure that a password contains at least one letter.
'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
$numbers = array( // This array is used for filtering. It was originally included to ensure that a password contains at least one number.
'0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$legal_password_characters = array( // This array is used for filtering. It was originally included to ensure that a password does not contain illegal characters.
'!', '@', '#', '$', '%', '&', '*', '?', '-', '_', '+');
$legal_username_characters = array( // This array is used for filtering. It was originally included to ensure that a username does not contain illegal characters.
'-', '_');

// Universal PHP Functions
function logout($id) // This function runs every time a user logs out or is logged out.
{
	session_destroy();
	session_unset();
	unset($_SESSION);
	$mysqli->query("UPDATE Members SET logged_in = 0
	WHERE id = " . $id);
}
function pure_int($num) // This function removes all characters other than numbers from a string.
{
	$num = filter_var($num, FILTER_SANITIZE_NUMBER_INT);
	$num = str_replace(array("+", "-"), "", $num);
	return $num;
}
function remove_chars($str, $chars) // This function removes selected characters from a string. Used for filtering.
{
	$str = str_replace($chars, "", $str);
	return $str;
}
function clean($str) // This function removes slashes and unwanted tags from a string.
{
	$str = filter_var(stripslashes($str), FILTER_SANITIZE_STRING);
	return $str;
}
// This function will generate a 16-charcter salt string. It will use all letters, numbers, and valid password characters to do so.
function generateSalt()
{
	global $U_letters, $L_letters, $numbers, $legal_password_characters;
	$test = array("This", "must", "work");
	$characters = array_merge($U_letters, $L_letters, $numbers, $legal_password_characters); //array_merge($U_letters, $L_letters, $numbers, $legal_password_characters);
	$salt = "";
	for($n = 0; $n < 16; $n++)
	{
		shuffle($characters);
		$salt .= $characters[0];
	}
	return $salt;
}
//------

// First of all, check to see whether the user is browsing with a mobile device.
include __DIR__ . '/../mobile_devices.php'; // Get the list of mobile devices. Set $mobile to true if the visitor is using a device from this list.

if (false) {
	$mysqli = new mysqli("secrethost","secretuser","secretpassword", "Accounts"); // Connect to the database.
	// Check to see if the user is not yet logged in.
	if(!isset($_SESSION['username']) || !isset($_SESSION['id']))
	{
		// If he is not yet logged in, check to see if he has just now submitted his login information.
		// If he has just now logged in, then verify that his login information is valid.
		if(!isset($_POST['login']) && ($mobile == true)) // If the user is browsing with a mobile device, check to see if this IP address should be logged on.
		//(By this point, his session cookie cannot be read or doesn't exist, he is on a mobile device, and he has NOT just now logged in.)
		{
			$visitor = $mysqli->query("SELECT * FROM Members
			WHERE ip='" . $_SERVER['REMOTE_ADDR'] . "'");
			$x = 0;
			while($row = $mysqli->fetch_assoc($visitor))
			{
				if($row['logged_in'] == true)
				{
					$x++;
					// If $x == 1, start a session.
					// If $x == 2, too many people are logged in through the same IP address. Log them all out and end the session.
					// If $x >= 2, too many people are logged in through the same IP address. Log the account on this loop out.
					if($x == 1)
					{
						session_start();
						$_SESSION['id'] = $row['id'];
						$_SESSION['username'] = $row['username'];
					}
					elseif($x == 2)
					{
						logout($row['id']);
						$err = "mult_log";
					}
					if($x >= 2)
					{
						$mysqli->query("UPDATE Members SET logged_in = 0
						WHERE id = " . $row['id']);
					}
				}
			}
		}
	}

	// If the user is currently logged in, make sure that a) he is logged in through only one IP address and b) he has not been inactive for too long.
	if(isset($_SESSION['id']) && isset($_SESSION['username']) && ($logout != true))
	{
		$visitor = $mysqli->query("SELECT * FROM Members
		WHERE username='" . $_SESSION['username'] . "' AND id='" . $_SESSION['id'] . "'");
		while($row = $mysqli->fetch_assoc($visitor))
		{
			// Ensure that the user's IP address is the one recorded in the database. If it is not, then tell him so and sign him out.
			if($row['ip'] != $_SERVER['REMOTE_ADDR'])
			{
				logout($_SESSION['id']);
			}
			// Ensure that the user has not been inactive for an extended period of time ($logtime is the number of seconds that he is permitted to be inactive before being logged out automatically).
			elseif(time() - $row['lastvisit'] > $logtime)
			{
				logout($_SESSION['id']);
			}
			// Ensure that the user is not recorded as having logged out. If he is, then log him out.
			elseif($row['logged_in'] == false)
			{
				logout($_SESSION['id']);
			}
			// If the user is not being forcibly logged out, then reset his last visit time to the current time.
			else
			{
				$mysqli->query("UPDATE Members SET lastvisit = '" . time() . "'
				WHERE username = '" . $row['username'] . "' AND id = '" . $row['id'] . "'");
			}
		}
	}

	// If the user is logged in but is not using a secure connection (https), then redirect to the secure version of this page.
	//if($_SERVER['SERVER_NAME'] == 'www.engineeredcomfort.net')
	if($_SERVER['SERVER_PORT'] != 443)
	{
		// Search for a user logged in with this IP address.
		$visitor = $mysqli->query("SELECT * FROM Members
		WHERE ip='" . $_SERVER['REMOTE_ADDR'] . "' AND logged_in=1");
		while($row = $mysqli->fetch_assoc($visitor))
		{
			/* Since someone is logged in on this machine and is using an unsecure connection (http), redirect him so that he is using
			a secure connection instead (https) */
			$pg = $_SERVER['SCRIPT_NAME'];
			// If any variables are stored in the URL, pass them to the next page.
			$varStartPos = strpos($_SERVER['REQUEST_URI'], '?');
			$URLvars = "";
			if(!($varStartPos === false))
			{
				$URLvars = "&" . substr($_SERVER['REQUEST_URI'], $varStartPos + 1, strlen($_SERVER['REQUEST_URI']) - $varStartPos);
			}
			// Redirect to a secure connection.
			header("Location: https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/index.php?pg=" . $pg . $URLvars);
			break 1;
		}
	}
	/* The user IS using a secure connection. If he has just now logged out, and if the page he is on can be viewed without a secure 
	connection, then redirect him to the non-secure version of this page. */
	elseif(($logout == true) && (strpos($_GET['pg'], '/ssl/') == false))
	{
		// Search for a user logged in with this IP address.
		$visitor = $mysqli->query("SELECT * FROM Members
		WHERE ip='" . $_SERVER['REMOTE_ADDR'] . "' AND logged_in=1");
		// Count the number of logged in users found with this IP address.
		/*$logged_in = 0;
		while($row = $mysqli->fetch_assoc($visitor))
		{
			$logged_in++;
		}
		// If no one is logged in, then redirect to an unsecure http connection.
		if($logged_in == 0)*/
		//{
			// If any variables are stored in the URL, pass them to the next page.
			$varStartPos = strpos($_SERVER['REQUEST_URI'], '?');
			$URLvars = "";
			if(!($varStartPos === false))
			{
				$URLvars = "?" . substr($_SERVER['REQUEST_URI'], $varStartPos + 1, strlen($_SERVER['REQUEST_URI']) - $varStartPos);
			}
			// Redirect
			header("Location: /" . $_GET['pg'] . $URLvars);
		//}
		//header("Location: www.engineeredcomfort.net" . $_GET['pg'] . $URLvars);
	}
}
?>
<!DOCTYPE html>

<!-- For reference, Engineered Comfort, Inc.'s blue and green colors are:
Blue: #082983
Green: #148f36
Background Blue: #afc2ff
Secondary Green: #47b865
Extra Links Blue: #3a5cc9
-->

<html>
<head>
<link rel="icon" type="image/x-icon" href="/images/logo-icon.ico" />
<link rel="shortcut icon" type="image/x-icon" href="/images/logo-icon.ico" />
<link rel="stylesheet" type="text/css" href="/template/css/engineered_comfort_css.css" />
<!--[if gte IE 1]>
<link rel="stylesheet" type="text/css" href="/template/css/engineered_comfort_ie_css.css" />
<![endif]-->
<meta name="keywords" content="Engineered, Comfort, Green, Efficient, Comfortable, Healthy, Memphis, Nashville, TN, Tennessee, HVAC, Heating, Ventilation, Air Conditioning, Air, Conditioning, AC, Cellulose, Insulation, Home, House, Houses, Efficiency, Health, Building, Buildings, Residential, Commercial" />
<meta name="description" content="Engineered Comfort: Making Homes Efficient, Comfortable, And Healthy - Engineered Comfort, Inc. is a Heating, Ventilation, and Air Conditioning (HVAC) company in Tennessee. Engineered Comfort, Inc. is in business to make new and existing homes more efficient, more comfortable and healthier. Based in Memphis, TN, Engineered Comfort, Inc. has had operations in the Memphis, TN area since 2001 and in the Nashville, TN area since 2007. Every aspect of our business, our people, our product and our services is for the purpose of creating high performance indoor environments that are efficient, comfortable and healthy. Engineered Comfort, Inc. has multiple EPA Energy Star rated and MLGW Eco-Build Certified homes and three USGBC LEED certified homes in operation." />
<meta name="author" content="Carter Nelms" />
<meta name="abstract" content="Engineered Comfort: Making Homes Efficient, Comfortable, And Healthy - Engineered Comfort, Inc. is a Heating, Ventilation, and Air Conditioning (HVAC) company in Tennessee. Engineered Comfort, Inc. is in business to make new and existing homes more efficient, more comfortable and healthier. Based in Memphis, TN, Engineered Comfort, Inc. has had operations in the Memphis, TN area since 2001 and in the Nashville, TN area since 2007. Every aspect of our business, our people, our product and our services is for the purpose of creating high performance indoor environments that are efficient, comfortable and healthy. Engineered Comfort, Inc. has multiple EPA Energy Star rated and MLGW Eco-Build Certified homes and three USGBC LEED certified homes in operation." />
<meta name="owner" content="Engineered Comfort, Inc." />
<meta name="robots" content="ALL" />
<script language="javascript">
<!--
// Universal Javascript Functions
function dropdown_menu_display(buttonID, menuID, arrowID, display) // This function causes a dropdown / popup menu to appear when the mouse hovers over the button to activate it. (arrowID refers to the ID of the small arrow image.)
{	
	var button = document.getElementById(buttonID);
	var menu = document.getElementById(menuID);
	var arrow = document.getElementById(arrowID);
	if(display == true)
	{
		button.style.backgroundColor="#47b865";
		button.style.color="#ffffff";
		menu.style.visibility="visible";
		arrow.src = "/images/menu_arrow_highlighted.png";
		clearTimeout(dropdown_timer);
		if(hide != "dropdown_hide('" + buttonID + "', '" + menuID + "', '" + arrowID + "');")
		{
			setTimeout(hide, 0);
		}
	}
	else
	{
		hide = "dropdown_hide('" + buttonID + "', '" + menuID + "', '" + arrowID + "');";
		dropdown_timer=setTimeout(hide, 750);
	}
}
function dropdown_hide(buttonID, menuID, arrowID) // This function ties in with the function dropdown_menu_display. It will run when the Timeout determines that a menu should vanish.
{
	var button = document.getElementById(buttonID);
	var menu = document.getElementById(menuID);
	var arrow = document.getElementById(arrowID);
	button.style.backgroundColor="";
	button.style.color="";
	menu.style.visibility="hidden";
	arrow.src = "/images/menu_arrow.png";
}
//-->
</script>
<?php
// If there was an error in the user's login information, then return him to the login page.
if(strlen($err) > 0)
{
	echo "<script language='javascript'>window.location = '/login?err=" . $err . "&des=" . $_SERVER['SCRIPT_NAME'] . "';</script>";
}
?>
