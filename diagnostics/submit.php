<?php
include __DIR__ . '/template/head.php';

// --------------------------------------

$to = "michelle@engineeredcomfort.net, christie@engineeredcomfort.net, diagnostic@engineeredcomfort.net, carter@engineeredcomfort.net"; // Email address(es) to which form submissions will be sent.
$time = 86400; // Time period during which a user may not exceed a certain number of submissions.
$submissions = 2; // Number of submissions that the user may not exceed during the time period.

// -------------------------------------- Do not edit below this line unless you know what you are doing.

// All of the user's input will first be assigned to the variables below.
$symptoms = array("c0" => $_POST["c0"], "c1" => $_POST["c1"], "c2" => $_POST["c2"], "c3" => $_POST["c3"], "c4" => $_POST["c4"], "c5" => $_POST["c5"], "c6" => $_POST["c6"], "c7" => $_POST["c7"], "c8" => $_POST["c8"], "c9" => $_POST["c9"], "c10" => $_POST["c10"], "c11" => $_POST["c11"]);
$other = "empty";
if(strlen($_POST['other']) > 0) // $other will be set to 'empty' unless the user typed something into the box. If he did, $other will be equal to what he typed.
{
	$other = clean($_POST['other']);
}
$name = clean($_POST["name"]);
$company = clean($_POST["company"]);
$email = clean($_POST["email"]);
$areacode = pure_int($_POST["areacode"]);
$phone = pure_int($_POST["phone"]);
$squareFeet = pure_int($_POST["squareFeet"]);
$HVACUnits = pure_int($_POST["HVACUnits"]);
$referredBy = clean($_POST["referredBy"]);

$txt = ""; // Html content of the panel on the page. (Leave this blank here.)

// This function sends the email and tells the user that it has been sent.
function sendEmail()
{
	global $symptoms, $other, $name, $company, $email, $areacode, $phone, $squareFeet, $HVACUnits, $referredBy, $to;
	
	$ACLine = "";
	if(strlen($areacode) == 3)
	{
		$ACLine = "(" . $areacode . ")-";
	}
	
	$subject = "Diagnostic: " . $name . " has submitted home symptoms to be diagnosed";
	$message = $name . " has submitted home symptoms to be diagnosed.\n ";
	$message .=
	"\n Name: " . $name . 
	"\n Company: " . $company . 
	"\n Email: " . $email . 
	"\n Phone: " . $ACLine . substr($phone, 0, 3) . "-" . substr($phone, 3, 4) . 
	"\n Conditioned Square Footage: " . $squareFeet . 
	"\n Number of HVAC Units: " . $HVACUnits;
	if(strlen($referredBy) > 0)
	{
		$message .= "\n 
		" . $name . " was referred by: " . $referredBy;
	}
	$message .= "\n \n Symptoms Include:\n ";
	if($symptoms['c0'] == true)
	{
		$message .= " - High Utility Bills\n ";
	}
	if($symptoms['c1'] == true)
	{
		$message .= " - Uncomfortable Rooms\n ";
	}
	if($symptoms['c2'] == true)
	{
		$message .= " - Mold Visible / Smellable\n ";
	}
	if($symptoms['c3'] == true)
	{
		$message .= " - Unhealthy Indoor Air\n ";
	}
	if($symptoms['c4'] == true)
	{
		$message .= " - Crawl Space Problems\n ";
	}
	if($symptoms['c5'] == true)
	{
		$message .= " - Extremely Hot Attic\n ";
	}
	if($symptoms['c6'] == true)
	{
		$message .= " - Drafty House In Winter\n ";
	}
	if($symptoms['c7'] == true)
	{
		$message .= " - Humidity Problem\n ";
	}
	if($symptoms['c8'] == true)
	{
		$message .= " - Hardwood Floors Cupping\n ";
	}
	if($symptoms['c9'] == true)
	{
		$message .= " - Room Over Garage Problems\n ";
	}
	if($symptoms['c10'] == true)
	{
		$message .= " - Old HVAC Equipment\n ";
	}
	if($other != "empty")
	{
		$message .= "\n Other Symptoms:
		" . $other;
	}
	
	
	if($symptoms['c11'] == true)
	{
		$message .= "\n \n " . $name . " has also expressed an interest in Geothermal Heat Pumps.";
	}
	
	//$headers = "CC: " . $Cc . "\n";
	
	if(mail($to, $subject, $message))
	//if(mail($to, $subject, $message, $headers))
	{		
		$printout = "<b><span style='color:black;'>Your home symptoms have been sent for diagnosis.</span></b><br />
		Here is a printout of your submission:<br /><br />" . 
		"<span style='color:black;'>" . 
		str_replace("\n", "<br />", $message) . 
		"</span>";
		
		if($_POST["emailCopy"] == true)
		{
			$subject = "Copy of '" . $subject . "'";
			$message = "The following is a copy of the submission you sent to Engineered Comfort, Inc. - \n \n" . $message;
			mail($email, $subject, $message);
			$printout = $printout . "<br /><br />A copy of your submission has been sent to you at:<br />" . $email;
		}
		
		$txt = $printout;
	}
	else
	{
		$txt = "<b><span>ERROR</span>:</b><br /><br />Your service call could not be submitted. There has been an unexpected error. We apologize for the inconvenience. Please try to submit your service call again. If you continue to receive this error, you can instead call us at:<br /><br /><b>901-382-6005</b> or <b>877-382-6005</b>";
	}
	return $txt;
}

// Establish a connection to the database, MySQL. Return an error if a connection cannot be made. Otherwise, attempt to send the email.
$con = mysql_connect("secrethost","secretuser","secretpassword");
if (!$con)
{
	$txt = "An unexpected error has occured. Your service call has not been submitted. Please try to submit your service call again. If you continue to receive this error, you can instead call us at:<br /><br /><b>901-382-6005</b> or <b>877-382-6005</b>";
}
else
{
	// These commented mysql_query lines have been used for testing.
	/*mysql_query("DROP DATABASE Form_IPs",$con);
	mysql_query("DROP DATABASE ExistingHomeDiagnostic_IPs",$con);
	mysql_query("DROP DATABASE ExistingHomeDiagnostic_IPs",$con);*/
	
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
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$areacode = pure_int($areacode);
		$phone = pure_int($phone);
		
		// Make sure that the name field is not empty.
		if(strlen($name) == 0)
		{
			$txt .= "<br /><br /> - To request a home diagnostic, you must provide your name.";
			$pass = false;
		}
		if(strlen($email) == 0)
		{	
			// An email address must be provided. If it was not given, then send the user back to the submission page.
			$txt .= "<br /><br /> - To request a home diagnostic, you must provide your email.";
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
		else
		{
			$txt .= "<br /><br /> - To request a home diagnostic, you must provide your phone number.";
			$pass = false;
		}
		
		// The submitted square footage must be a positive integer.
		if(!(intval($squareFeet) > 0))
		{
			$txt .= "<br /><br /> - Please include the square footage of your home." . intval($squareFeet) . "-" . $squareFeet;
			$pass = false;
		}
		
		// The submitted number of HVAC units must be a positive integer.
		if(!(intval($HVACUnits) > 0))
		{
			$txt .= "<br /><br /> - Please include the number of HVAC units at your home." . intval($HVACUnits) . "-" . $HVACUnits;
			$pass = false;
		}
		
		// By this point, if $pass is still true, then the submitted information is valid.
		if($pass)
		{
			mysql_query('DESC ExistingHomeDiagnostic_IPs;', $con);
			if(mysql_errno() == 1146)
			{
				// The table doesn't exist yet. Create it.
				
				$table = "CREATE TABLE ExistingHomeDiagnostic_IPs
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
			$visitor = mysql_query("SELECT * FROM ExistingHomeDiagnostic_IPs
			WHERE IP_Address='" . $_SERVER['REMOTE_ADDR'] . "'");
			
			/* The addresses variable will be used to ensure that the visitor's IP Address isn't somehow entered into the database
			more than once. After the WHILE loop below has completed, the addresses variable will be equal to the number of
			lines in the database table corresponding to the visitor's IP address.*/
			$addresses = 0;
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
							$txt = "<b><span>ERROR</span>:</b><br /><br />The server has detected too many recent attempts to submit a home diagnostics request from this IP address:<br /><br /><b>"
							 . $_SERVER['REMOTE_ADDR'] . "</b><br /><br />To help prevent spam, the server does not accept more that " . $submissions . 
							 " home diagnostics request from the same IP address over any " . round($time/3600) . 
							 " hour period.  However, if you need to speak to us in person, you can contact us at:<br /><br /><b>901-382-6005</b> or <b>877-382-6005</b>";
						}
						else
						{
							// The user has not exceeded his submission limit. Send his message.
							$txt = sendEmail();
							
							// If the user's time limit is up, then reset his submission time and his submission count.
							if((time() - $row['Submission_Time']) >= $time)
							{
								mysql_query("UPDATE ExistingHomeDiagnostic_IPs SET Submission_Time = " . time() . ", Submissions = 0
								WHERE IP_Address = '" . $_SERVER['REMOTE_ADDR'] . "'");						
							}
						}
						
						mysql_query("UPDATE ExistingHomeDiagnostic_IPs SET Submissions = Submissions + 1
						WHERE IP_Address = '" . $_SERVER['REMOTE_ADDR'] . "'");
					}
					elseif($addresses > 1)
					{
						// If an IP address appears in the database table more than once for any reason, delete the address from the table.
						mysql_query("DELETE FROM ExistingHomeDiagnostic_IPs
						WHERE IP_Address = '" . $row['IP_Address'] . "'");
					}
				}
			}
			
			/*If, after the WHILE loop, the number of addresses is still equal to 0, then the visitor's IP address was not found.
			Insert a new line in the database table for the visitor.*/
			if($addresses == 0)
			{
				mysql_query("INSERT INTO ExistingHomeDiagnostic_IPs (IP_Address, Submission_Time, Submissions)
				VALUES ('" . $_SERVER['REMOTE_ADDR'] . "', " . time() . ", 1)");
				$txt = sendEmail();
			}
		}
		else
		{
			$txt = "<b><span>ERROR</span>:</b>" . $txt;
		}
	}
}
?>
<title>Engineered Comfort, Inc : Diagnostics Submission</title>
<link rel="stylesheet" type="text/css" href="/template/css/diagnostics.css" />
<link rel="stylesheet" type="text/css" href="/template/css/form.css" />
</head>

<body>
<?php include __DIR__ . '/template/header.php'; ?>
<div class="panel" <?php if($pass){echo "style='min-height:500px;'";} ?>>
	<div id='text' style='padding:100px 200px 100px 200px;<?php if(!$pass){echo "padding:30px 200px 30px 200px;";}?>'>
	<?php echo $txt; ?>
	</div>
</div>
<?php
if(!$pass)
{
	include __DIR__ . '/diagnostics/diagnostics.php';
}
include __DIR__ . '/template/footer.php'; ?>