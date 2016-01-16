<div class="panel">
<?php
// Store the user's provided username and email.
$username = $_POST['username'];
$email = $_POST['email'];
$id;
// Declare the variables for the user's security questions
$q1 = "";
$q2 = "";
$q3 = "";
// Make sure that the user has given both a username and an email address.
if(isset($_POST['username']) && isset($_POST['email']))
{
	$visitor = mysql_query("SELECT * FROM Members
	WHERE username='" . $username . "' AND email='" . $email . "'");
	while($row = mysql_fetch_array($visitor))
	{
		// Record all of the user's security questions.
		$q1 = $row['question1'];
		$q2 = $row['question2'];
		$q3 = $row['question3'];
		// Also record his id.
		$id = $row['id'];
	}
	// If the questions are not set, then the user was not found in the database.
	if($q1 == "")
	{
		echo "Username or email not found";
		include __DIR__ . '/ssl/password/password.php';
	}
	else
	{
		include __DIR__ . '/ssl/password/questions.php';
	}
}
else
{
}
?>
</div>&nbsp;