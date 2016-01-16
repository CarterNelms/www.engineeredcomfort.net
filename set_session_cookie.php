<?php
include "/ssl/login/set_secure_cookie.php";
//session_start();
$loc = "https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/login/confirm_login?id=" . $_GET['id'];
if(isset($_GET['des']))
{
	$loc .= "&des=" . $_GET['des'];
}
header("Location: " . $loc); // The user will be redirected to his last destination if his login is approved.
?>