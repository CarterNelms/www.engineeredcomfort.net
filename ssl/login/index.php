<?php include __DIR__ . '/template/head.php';
include __DIR__ . '/login/logout_required.php';
?>
<title>Engineered Comfort, Inc : Login</title>
<style type="text/css">
span{color:red;}
li{list-style:none;}
</style>
</head>

<body>
<?php
if(isset($_GET['err'])) // Display any error messages if there are any to display.
{
	$err = "";
	if($_GET['err'] == "userpass")
	{
		$err = "Invalid username or password.";
	}
	elseif($_GET['err'] == "blank")
	{
		$err = "Please log in with both your username and password.";
	}
	elseif($_GET['err'] == "mult_log")
	{
		$err = "An error has occurred.  Multiple accounts are logged in through this IP address.  All of these accounts have been logged out.  Please try to log in again.  If you continue to receive this error, please enable the use of cookies in your browser.";
	}
	elseif($_GET['err'] == "cookies")
	{
		$err = "Cookies are not enabled in your browser.  Cookies must be enabled in order to log in.";
	}
	elseif($_GET['err'] == "inactive")
	{
		$err = "Your account has not yet been activated.  We will contact you to let you know when your account has been approved.";
	}
	elseif($_GET['err'] == "unexpected")
	{
		$err = "An unexpected error has occured.  Please try logging in again.";
	}
	elseif($_GET['err'] == "out")
	{
		if($_GET['logout'] == true) // If an un-logged-in user tried to visit a page requiring that he be logged in, tell him so unless the reason is that he has just now logged out. In that case, redirect him home.
		{
			echo "<script language='javascript'>window.location = 'https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/index.php?pg=/&logout=" . true . "';</script>";
		}
		else
		{
			$err = "You must be logged in to view that page.";
		}
	}
	elseif(isset($_SESSION['id']) && isset($_SESSION['username']) && ($_GET['logout'] != true)) // If a user who is logged in tries to go to the login page (which he should not be able to do), redirect him to his account page.
	{
		echo "<script language='javascript'>window.location = 'https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/account?id=" . $_SESSION['id'] . "';</script>";
	}
	else
	{
		$err = "An error has occured.";
	}
}
include __DIR__ . '/template/header.php'; ?>
<div class="panel">
	<div style="text-align:center;margin-top:50px;">
		<span><?php echo $err; ?><br /></span>
		<span style="font-weight:bold;font-size:20px;">This page is currently under construction and is not yet in service.<br /></span><br /><br />
	</div>
	<?php $style = "padding:0px 30px 50px 30px;text-align:left;width:380px;"; include __DIR__ . '/ssl/login/login_form.php'; // Login Form ?>
</div>
<?php include __DIR__ . '/template/footer.php'; ?>