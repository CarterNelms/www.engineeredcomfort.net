<?php
	// This page will open any page in the domain with a secure connection (https)
	$pg = $_GET['pg'];
	if((strlen($pg) == 0) || ($pg == $_SERVER['SCRIPT_NAME']))
	{
		/*
			If $pg has no value,
			or if $pg refers back to this very page
			then go to the home page.
		*/
		$pg = "/index.php";
	}
	elseif(substr($pg, -1, 1) == "/")
	{
		$pg .= "/index.php";
	}
	include $pg;
	// header('pgation: https://p4.secure.hostingprod.com/@' . $pg);
?>