<?php include __DIR__ . '/template/head.php'; ?>
<title>Engineered Comfort, Inc : <?php echo $_SESSION['username']; ?>'s Account</title>
<link rel="stylesheet" type="text/css" href="/template/css/accounts.css" />
</head>

<body>
<?php include __DIR__ . '/template/header.php';
include __DIR__ . '/ssl/login/login_required.php';
?>
<h1>My Account</h1>
<div class="panel">
	<?php include __DIR__ . '/ssl/account/account_links.php';
	$visitor = mysql_query("SELECT * FROM Members
	WHERE id='" . $_SESSION['id'] . "'");
	while($row = mysql_fetch_array($visitor))
	{
		echo "<table align='center' class='info_display'>
		<tr><td>Username:</td><td>" . $row['username'] . "</td></tr>
		<tr><td>First Name:</td><td>" . $row['firstname'] . "</td></tr>
		<tr><td>Last Name:</td><td>" . $row['lastname'] . "</td></tr>
		<tr><td>Firm:</td><td>" . $row['firm'] . "</td></tr>
		<tr><td>Email:</td><td>" . $row['email'] . "</td></tr>
		<tr><td>Phone:</td><td>" . $row['phone'] . "</td></tr>
		</table>";
	}
	?>
	<br />
	<p style="color:#082983;">
		This information is not available publicly. Only you and we at Engineered Comfort, Inc. are able to view or edit your account information.
	</p>
</div>
<?php include __DIR__ . '/template/footer.php'; ?>