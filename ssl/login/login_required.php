<?php
if(!isset($_SESSION['id']) || !isset($_SESSION['username']))
{
	// Redirect the user from this page if he is not logged in.
	echo "<script language='javascript'>window.location = 'https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/login/?err=out&des=" . $_SERVER['SCRIPT_NAME'];
	if($_GET['logout'] == true)
	{
		echo "&logout=" . true;
	}
	echo "';</script>";
}
?>