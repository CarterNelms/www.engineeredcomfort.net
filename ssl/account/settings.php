<?php include __DIR__ . '/template/head.php'; ?>
<title>Engineered Comfort, Inc : <?php echo $_SESSION['username']; ?>'s Account Settings</title>
<link rel="stylesheet" type="text/css" href="/template/css/accounts.css" />
</head>

<body>
<?php include __DIR__ . '/template/header.php';
include __DIR__ . '/ssl/login/login_required.php';
?>
<h1>Account Settings</h1>
<div class="panel">
	<?php include __DIR__ . '/ssl/account/account_links.php';
	$visitor = mysql_query("SELECT * FROM Members
	WHERE id='" . $_SESSION['id'] . "'");
	while($row = mysql_fetch_array($visitor))
	{
		echo "<table align='center' class='info_display'>
		<tr><td>Change Username</td></tr>
		<tr><td>Change Password</td></tr>
		<tr><td>Last Name:</td></tr>
		<tr><td>Firm:</td></tr>
		<tr><td>Update Email Address</td></tr>
		<tr><td>Update Phone Number</td></tr>
		</table>";
	}
	?>
</div>
<?php include __DIR__ . '/template/footer.php'; ?>