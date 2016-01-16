<?php
include __DIR__ . '/template/head.php';
include __DIR__ . '/login/logout_required.php';

$txt = ""; // Html content of the panel on the page. (Leave this blank here.)
$pass = true; /* If this variable makes it all the way through the checks without being set to false, it is because the
submitted information is valid.*/

// Store the detected id of the user.
$id = $_POST['id'];

$visitor = mysql_query("SELECT * FROM Members
WHERE id='" . $id . "'");
while($row = mysql_fetch_array($visitor))
{
	// Record all of the user's security questions.
	$answer1 = $row['answer1'];
	$answer2 = $row['answer2'];
	$answer3 = $row['answer3'];
}
// Check to make sure that the user's answers match the ones in the database.
if(!((md5($_POST['a1']) === $answer1) && (md5($_POST['a2']) === $answer2) && (md5($_POST['a3']) === $answer3)))
{
	$txt .= "<br /><br /> - Security answers do not match database records.  Remember that your answers are case-sensitive and must be typed EXACTLY as they where when you first submitted them.";
	$pass = false;
}
// Confirm that the user entered his new password correctly and that it is a valid password.
include __DIR__ . '/validate_password.php';

if(!$pass)
{
	$txt = "<b><span>ERROR</span>:</b>" . $txt;
}
?>

<title>Engineered Comfort, Inc : Login - Security Question Verification</title>
<link rel="stylesheet" type="text/css" href="/template/css/form.css" />
</head>

<body>
<?php include __DIR__ . '/template/header.php'; ?>
<div class="panel" <?php if($pass){echo "style='min-height:500px;'";} ?>>
	<div id='text' style='padding:100px 200px 100px 200px;<?php if(!$pass){echo "padding:30px 200px 30px 200px;";}?>'>
	<?php
	if($pass)
	{
		if(mysql_select_db("Accounts", $con)) // Select the Accounts database.
		{
			if(mysql_query("UPDATE Members SET password = '" . md5($password) . "'
			WHERE id = " . $id))
			{
				$txt = "Your password has successfully been updated.";
			}
			else
			{
				$txt = "<b><span>ERROR</span>:</b><br /><br /> - An unexpected error has occured.  Your password has not been updated.  Please refresh your browser to try again.";
			}
		}
		else
		{
			$txt = "<b><span>ERROR</span>:</b><br /><br /> - An unexpected error has occured.  Your password has not been updated.  Please refresh your browser to try again.";
		}
	}
	echo $txt;
	?>
	</div>
</div>
<?php
if(!$pass)
{
	include __DIR__ . '/ssl/password/security/security.php';
}
include __DIR__ . '/template/footer.php'; ?>