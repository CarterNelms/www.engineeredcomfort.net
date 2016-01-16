<?php
include __DIR__ . '/template/head.php';

// --------------------------------------

$to = /*"walter@engineeredcomfort.net, */"carter@engineeredcomfort.net"; // Email address to which form submissions will be sent.
$time = 86400; // Time period during which a user may not exceed a certain number of submissions.
$submissions = 200; // Number of submissions that the user may not exceed during the time period.

// -------------------------------------- Do not edit below this line unless you know what you are doing.

// All of the user's input will first be assigned to the variables below.
$firstname = clean($_POST["firstname"]);
$lastname = clean($_POST["lastname"]);
$firm = clean($_POST["firm"]);
$email = clean($_POST["email"]);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$areacode = clean($_POST["areacode"]);
$phone = clean($_POST["phone"]);
$phone = pure_int($phone);
$username = clean($_POST["username"]);

$q1 = clean($_POST['question1']);
$q2 = clean($_POST['question2']);
$q3 = clean($_POST['question3']);

$body = clean($_POST["body"]);

$txt = ""; // Html content of the panel on the page. (Leave this blank here.)

// This function sends the email and tells the user that it has been sent.
function sendEmail()
{
	global $password, $salt, $Qsalt, $firstname, $lastname, $firm, $email, $areacode, $phone, $username, $q1, $a1, $q2, $a2, $q3, $a3, $body, $to, $pass;
	
	$ACLine = "";
	if(strlen($areacode) == 3)
	{
		$ACLine = "(" . $areacode . ")-";
	}
	
	$subject = "Site Access Application from " . $firstname . " " . $lastname;
	$message = $firstname . " " . $lastname . " has applied for access to the private sections of www.engineeredcomfort.net.\n 
	First Name: " . $firstname .  "
	Last Name: " . $lastname .  "
	Firm: " . $firm . "
	Email: " . $email . "
	Phone: " . $ACLine . substr($phone, 0, 3) . "-" . substr($phone, 3, 4) . "\n
	Username: " . $username . "\n \n" . 
	$firstname . " " . $lastname . " would like access to the following sections of www.engineeredcomfort.net:\n ";
	if($_POST['architects'] == true)
	{
		$message .= "- Architects\n ";
	}
	if($_POST['builders'] == true)
	{
		$message .= "- Builders\n ";
	}
	$message .= "\n Comments: \n" . $body;
	//$headers = "CC: " . $Cc . "\n";
	
	// Now it's time to record the applicant's information into the member's database. Although he will technically have an existing account, he will not yet have access to anything requiring special permission.
	$con = mysql_connect("secrethost","secretuser","secretpassword"); // Connect to the database.
	if(mysql_select_db("Accounts", $con)) // Select the Accounts database.
	{		
		if(mysql_query('INSERT INTO Members (username, password, salt, qsalt, firstname, lastname, firm, email, phone, architect, builder, ip, lastvisit, logged_in, question1, answer1, question2, answer2, question3, answer3)
		VALUES ("' . $username . '", "' . $password . '", "' . $salt . '", "' . $Qsalt . '", "' . $firstname . '", "' . $lastname . '", "' . $firm . '", "' . $email . '", ' . $areacode . $phone . ', 0, 0, "' . $_SERVER["REMOTE_ADDR"] . '", ' . time() . ', 0, "' . $q1 . '", "' . $a1 . '", "' . $q2 . '", "' . $a2 . '", "' . $q3 . '", "' . $a3 . '")'))
		{
			if(mail($to, $subject, $message))
			//if(mail($to, $subject, $message, $headers))
			{
				$printout = "<b><span style='color:black;'>Your application has been submitted</span></b><br />
				Here is a printout of your application:<br /><br />" . 
				"<span style='color:black;'>" . 
				str_replace("\n", "<br />", $message) . "</span>";
				
				if($_POST["emailCopy"] == true)
				{
					$subject = "Copy of '" . $subject . "'";
					$message = "The following is a copy of the message you sent to Engineered Comfort, Inc. - \n \n" . $message;
					mail($email, $subject, $message);
					$printout .= "<br /><br />A copy of your application has been sent to you at:<br />" . $email;
				}
				
				$txt = $printout;
			}
			else
			{
				mysql_query("DELETE FROM Members
				WHERE username = '" . $username . "'");
				$txt = "<b><span>ERROR</span>:</b><br /><br />Your application could not be submitted.  An unexpected error has occured.  We apologize for the inconvenience. Please try to submit your application again. If you continue to receive this error, you can instead call us at:<br /><br /><b>901-382-6005</b> or <b>877-382-6005</b>";
			}
		}
		else
		{
			if(substr(mysql_error(), 0, 15) == "Duplicate entry")
			{
				$txt = "<b><span>ERROR</span>:</b><br /><br /> - That username is already in use.";
				$pass = false;
			}
			else
			{
				$txt = "<b><span>ERROR</span>:</b><br /><br />Your application could not be submitted.  An unexpected error has occured.  We apologize for the inconvenience. Please try to submit your application again. If you continue to receive this error, you can instead call us at:<br /><br /><b>901-382-6005</b> or <b>877-382-6005</b>";
			}
		}
	}
	else
	{
		$txt = "<b><span>ERROR</span>:</b><br /><br />Your application could not be submitted.  An unexpected error has occured.  We apologize for the inconvenience. Please try to submit your application again. If you continue to receive this error, you can instead call us at:<br /><br /><b>901-382-6005</b> or <b>877-382-6005</b>";
	}
	
	return $txt;
}

// These commented mysql_query lines have been used for testing.
/*mysql_query("DROP DATABASE Form_IPs",$con);
mysql_query("DROP DATABASE serviceCall_IPs",$con);
mysql_query("DROP DATABASE SiteApp_IPs",$con);*/

// If the database that stores the IP addresses of users who fill out forms does not exist, then create it.
if(!mysql_select_db("Form_IPs", $con))
{
	if(!mysql_query("CREATE DATABASE Form_IPs",$con))
	{
		$txt = mysql_error() . "<br />";
	}
}
// Access the database
if(mysql_select_db("Form_IPs", $con))
{
	/* Before checking the databases to see if the visitor is able to send any more submissions through this form, check to
	make sure that the information that he has submitted is valid.*/
	$pass = true; /* If this variable makes it all the way through the checks without being set to false, it is because the
	submitted information is valid.*/
	
	// Make sure that the first name field is not empty.
	if(strlen($firstname) == 0)
	{
		$txt .= "<br /><br /> - To submit an application, you must provide your first name.";
		$pass = false;
	}
	
	// Make sure that the last name field is not empty.
	if(strlen($lastname) == 0)
	{
		$txt .= "<br /><br /> - To submit an application, you must provide your last name.";
		$pass = false;
	}
	
	// Make sure that the firm field is not empty.
	if(strlen($firm) == 0)
	{
		$txt .= "<br /><br /> - To submit an application, you must provide the name of your firm.";
		$pass = false;
	}
	
	// Make sure that the email field is not empty.
	if(strlen($email) == 0)
	{
		$txt .= "<br /><br /> - To submit an application, you must provide a valid email address.";
		$pass = false;
	}
	else
	{
		// If an email address was provided, make sure that it is valid.
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$txt .= "<br /><br /> - The email address that you submitted is not valid.<br />Email: " . $email;
			$pass = false;
		}
	}
	
	// If a phone number is provided, it must have at least 7 digits.
	if(strlen($phone) == 7)
	{
		// It must also be a valid integer.
		if(!filter_var($phone, FILTER_VALIDATE_INT))
		{
			$txt .= "<br /><br /> - The phone number that you submitted is not valid.<br />Phone Number: ";
			if(strlen($areacode) > 0)
			{
				$txt .= "(" . $areacode . ")-";
			}
			$txt .= $phone;
			$pass = false;
		}
		
		// If a phone number was provided, the area code must have either 3 digits or none at all.
		if(strlen($areacode) == 3)
		{
			if(!filter_var($areacode, FILTER_VALIDATE_INT))
			{
				$txt .= "<br /><br /> - The area code that you submitted is not valid.<br />Area Code: " . $areacode;
				$pass = false;
			}
		}
		elseif(strlen($areacode) != 0)
		{
			$txt .= "<br /><br /> - The area code that you submitted is not valid.<br />Area Code: " . $areacode;
			$pass = false;
		}
	}
	elseif(strlen($phone) != 0)
	{
		$txt .= "<br /><br /> - The phone number that you submitted is not valid.<br />Phone Number: ";
		if(strlen($areacode) > 0)
		{
			$txt .= "(" . $areacode . ")-";
		}
		$txt .= $phone;
		$pass = false;
	}
	else
	{
		$txt .= "<br /><br /> - To submit an application, you must provide a valid phone number.";
		$pass = false;
	}
	
	// Make sure that the requested username was not changed when filtered.
	$filtered_username = remove_chars(remove_chars(remove_chars(remove_chars($username, $U_letters), $L_letters), $numbers), $legal_username_characters);
	if(($username != $_POST['username']) || (strlen($filtered_username) > 0))
	{
		$txt .= "<br /><br /> - Your username contains illegal characters.";
		$pass = false;
	}
	else
	{
		// Make sure that the requested username is not already taken.
		if(mysql_select_db("Accounts", $con))
		{
			$visitor = mysql_query("SELECT * FROM Members
			WHERE username='" . $username . "'");
			while($row = mysql_fetch_array($visitor))
			{
				if($row['username'] == $username)
				{
					$txt .= "<br /><br /> - The username you have selected has already been taken.";
					$pass = false;
					break;
				}
			}
			if(!mysql_select_db("Form_IPs", $con))
			{
				$txt .= "<br /><br /> - <b>The server is having trouble connecting to the database. Please try to resubmit your application.</b>";
				$pass = false;
			}
		}
		else
		{
			$txt .= "<br /><br /> - <b>The server is having trouble connecting to the database. Please try to resubmit your application.</b>";
			$pass = false;
		}
	}
	// Make sure that the visitor's username is between 6 and 30 characters.
	if((strlen($username) < 6) || (strlen($username) > 30))
	{
		$txt .= "<br /><br /> - Usernames must contain between 6 and 30 characters.";
		$pass = false;
	}
	
	// Confirm that the user's password is valid.
	include "/validate_password.php";
	
	// At least one of the checkboxes for site access must be selected.
	if(($_POST['architects'] == false) && ($_POST['builders'] == false))
	{
		$txt .= "<br /><br /> - You must apply for access to at least one section of www.engineeredcomfort.net.";
		$pass = false;
	}
	
	// The security answers must all be at least 5 characters long.
	if((strlen($_POST["answer1"]) < 5) || (strlen($_POST["answer2"]) < 5) || (strlen($_POST["answer3"]) < 5))
	{
		$txt .= "<br /><br /> - All answers to security questions must be at least 5 characters long.";
		$pass = false;
	}
	
	// By this point, if $pass is still true, then the submitted information is valid.
	if($pass)
	{
		mysql_query('DESC SiteApp_IPs;', $con);
		if(mysql_errno() == 1146)
		{
			// The table doesn't exist yet. Create it.
			
			$table = "CREATE TABLE SiteApp_IPs
			(
			IP_Address tinytext,
			Submission_Time int,
			Submissions int
			)";
			
			if(!mysql_query($table,$con))
			{
				$txt = mysql_error() . "<br />";
			}
		}
		
		// Retrieve the visitor's last visit time from the database.
		// If he is not in the database, then add him to it.
		// Visitors are denoted by their IP addresses.
		$visitor = mysql_query("SELECT * FROM SiteApp_IPs
		WHERE IP_Address='" . $_SERVER['REMOTE_ADDR'] . "'");
		
		/* The addresses variable will be used to ensure that the visitor's IP Address isn't somehow entered into the database
		more than once. After the WHILE loop below has completed, the addresses variable will be equal to the number of
		lines in the database table corresponding to the visitor's IP address.*/
		$addresses = 0;
		
		// Go ahead and store the encrypted password for the user, as well as the salt to go with it.
		$salt = "1234"; // for password
		$Qsalt = "12345"; // for security questions
		$password = sha1(clean($_POST['password']) . $salt);
		// The answers to the security questions will need to be salted too.
		$a1 = sha1(clean($_POST['answer1']) . $Qsalt);
		$a2 = sha1(clean($_POST['answer2']) . $Qsalt);
		$a3 = sha1(clean($_POST['answer3']) . $Qsalt);
		
		while($row = mysql_fetch_array($visitor))
		{
			if($row['IP_Address'] == strval($_SERVER['REMOTE_ADDR']))
			{
				// The visitor's IP address has been found in the database table. Add 1 to the addresses counter.
				$addresses++;
				// If this is the first time the visitor's IP address has been found, then check to see if his email can go through.
				if($addresses == 1)
				{
					// If he has made too many submissions in too little time, then restrict his use of this form.
					if(((time() - $row['Submission_Time']) < $time) && ($row['Submissions'] >= $submissions))
					{
						$txt = "<b><span>ERROR</span>:</b><br /><br />The server has detected too many recent attempts to submit an application from this IP address:<br /><br /><b>"
						 . $_SERVER['REMOTE_ADDR'] . "</b><br /><br />To help prevent spam, the server does not accept more that " . $submissions . 
						 " application submissions from the same IP address over any " . round($time/3600) . 
						 " hour period.  If you need to speak to us in person about your last submissions, you can contact us at:<br /><br /><b>901-382-6005</b> or <b>877-382-6005</b>";
					}
					else
					{
						// The user has not exceeded his submission limit. Send his message.
						$txt = sendEmail();
						
						// If the user's time limit is up, then reset his submission time and his submission count.
						if((time() - $row['Submission_Time']) >= $time)
						{
							mysql_query("UPDATE SiteApp_IPs SET Submission_Time = " . time() . ", Submissions = 0
							WHERE IP_Address = '" . $_SERVER['REMOTE_ADDR'] . "'");						
						}
					}
					
					mysql_query("UPDATE SiteApp_IPs SET Submissions = Submissions + 1
					WHERE IP_Address = '" . $_SERVER['REMOTE_ADDR'] . "'");
				}
				elseif($addresses > 1)
				{
					// If an IP address appears in the database table more than once for any reason, delete the address from the table.
					mysql_query("DELETE FROM SiteApp_IPs
					WHERE IP_Address = '" . $row['IP_Address'] . "'");
				}
			}
		}
		
		/*If, after the WHILE loop, the number of addresses is still equal to 0, then the visitor's IP address was not found.
		Insert a new line in the database table for the visitor.*/
		if($addresses == 0)
		{
			mysql_query("INSERT INTO SiteApp_IPs (IP_Address, Submission_Time, Submissions)
			VALUES ('" . $_SERVER['REMOTE_ADDR'] . "', " . time() . ", 1)");
			$txt = sendEmail();
		}
	}
	else
	{
		$txt = "<b><span>ERROR</span>:</b>" . $txt;
	}
}
?>
<title>Engineered Comfort, Inc : Site Access Application Submission</title>
<link rel="stylesheet" type="text/css" href="/template/css/form.css" />
</head>

<body>
<?php include __DIR__ . '/template/header.php'; ?>
<div class="panel" <?php if($pass){echo "style='min-height:500px;'";} ?>>
	<div id='text' style='padding:100px 200px 100px 200px;<?php if(!$pass){echo "padding:30px 200px 30px 200px;";}?>'>
	<?php echo $txt;?>
	</div>
</div>
<?php
if(!$pass)
{
	include __DIR__ . '/signup/signup.php';
}
include __DIR__ . '/template/footer.php'; ?>