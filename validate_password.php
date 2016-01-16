<?php
$password = clean($_POST["password"]);
$filtered_password = remove_chars(remove_chars(remove_chars(remove_chars($password, $U_letters), $L_letters), $numbers), $legal_password_characters);
// Make sure that the requested password was not changed when filtered.
if(($password != $_POST['password']) || (strlen($filtered_password) > 0))
{
	$txt .= "<br /><br /> - Your password contains illegal characters.";
	$pass = false;
}
else
{
	// Make sure that the user retyped his password exactly as he typed it in the first place.
	if($password != stripslashes($_POST["retype"]))
	{
		$txt .= "<br /><br /> - Retype your password exactly as you first typed it.";
		$pass = false;
	}
}

// Make sure that the user's password contains at least 2 of the 3: at least 1 letter; at least 1 number; at least one legal symbol.
$char_types = 0; // This is the number of character types in the password.
// Check for letters...
if(strlen(remove_chars(remove_chars($password, $U_letters), $L_letters)) < strlen($password))
{
	$char_types++;
}
// Check for numbers...
if(strlen(remove_chars($password, $numbers)) < strlen($password))
{
	$char_types++;
}
// Check for symbols...
if(strlen(remove_chars($password, $legal_password_characters)) < strlen($password))
{
	$char_types++;
}
// Now, if $char_types is less than 2, the password doesn't contain enough symbol types.
if($char_types < 2)
{
	$txt .= "<br /><br /> - Passwords must contain characters from at least 2 of the following 3 categories:<br /><br />- Letters (upper or lower case)<br />- Numbers<br />- Legal Symbols &nbsp;&nbsp;&nbsp;";
	for($n = 0, $size = sizeof($legal_password_characters); $n < $size; $n++)
	{
		if($n > 0)
		{
			$txt .= ", ";
		}
		$txt .= $legal_password_characters[$n];
	}
	$txt .= "&nbsp;&nbsp;&nbsp;";
	$pass = false;
}

// Make sure that the user's password is between 6 and 20 characters.
if((strlen($password) < 6) || (strlen($password) > 20))
{
	$txt .= "<br /><br /> - Passwords must contain between 6 and 20 characters.";
	$pass = false;
}
?>