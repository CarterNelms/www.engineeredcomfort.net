<?php
if(isset($_SESSION['id']) && isset($_SESSION['username']))
{
	// Redirect the user from this page if he IS logged in.
	echo "<script language='javascript'>window.location = 'https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/index.php?pg=/';</script>";
}
?>