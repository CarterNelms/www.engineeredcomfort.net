<?php
// session_start();
include __DIR__ . '/../../template/head.php'; ?>
<title>Engineered Comfort, Inc : Architects</title>
<style type="text/css">
div.panel a{
	text-decoration:none;
}

div.architects_panel{
	background-image:url('/images/architects/architects_panel.png');
	width:130px;
	height:60px;
	padding:25px 15px 20px 15px;
	text-align:center;
	color:white;
	font:18px comic sans ms;
	font-weight:bold;
	background-size:100% 100%;
}

span{
	color:red;
}
</style>
</head>

<body>
<?php include __DIR__ . '/../../template/header.php'; ?>
<div style="background-image:url('/images/architects/architects-header.png');width:800px;height:200px;margin-top:30px;border:3px solid #148f36;"></div>
<div class="panel">
	<?php
	
	// Check to see if, by this point, the user is logged in. Also, check to make sure that he has access to this particular section of the website. (Otherwise, he could hack into the architects section after logging in through the builders section, or vice versa.)
	// Set the user's permission to false.
	$permission = false;
	if(isset($_SESSION['username']))
	{
		$visitor = mysql_query("SELECT * FROM Members
		WHERE username='" . $_SESSION['username'] . "' AND id='" . $_SESSION['id'] . "'");
		$x = 0;
		while($row = mysql_fetch_array($visitor))
		{
			$x++;
			// If the user has permission to access this section of the site, then set his permission to true.
			if($row['architect'] == true)
			{
				$permission = true;
			}
		}
		// If the 'while' loop ran any number of times other than 1, then set the user's permission to false. (It may be false already.)
		if($x != 1)
		{
			$permission = false;
		}
	}
	// Check to see if the user is now logged in.
	if(isset($_SESSION['username']))
	{
		// Check to see if the user has attemped to log out.
		// If he has, then end his session and log him out.
		if($logout == true)
		{
			session_destroy();
		}
		else
		// If the user is logged in, check his permission to access this page. If he does not have permission, tell him so.
		if($permission != true)
		{
			echo "<span>" . $_SESSION['username'] . ", you have not been granted access to the Architects section of EngineeredComfort.net.</span>";
		}
	}
	?>
	<br />
	<span>The Architects section of engineeredcomfort.net is currently under construction.</span>
	<table align="center">
	<tr style="text-indent:50px;"><td colspan="4">
		To access all downloadable files in this section, you must have a username and password. If you do not have a username and password, <a href="/signup">click here</a> to apply for access to these files. Once you are approved, you will have access to the files below.
	</td></tr>
	<tr style="margin:40px;">
	<td>
		<div style="margin:30px;"><a href="
		<?php
		if($permission == true)
		{
			echo "/download?name=test.pdf";
		}
		else
		{
			echo "javascript:;";
		}
		?>
		"><div class="architects_panel">Download Detail PDFs</div></a></div>
	</td>
	<td>
		<div style="margin:30px;"><a href="javascript:;"><div class="architects_panel" style="font-size:16px;height:70px;padding-top:15px;">Download High- Performance Specifications</div></a></div>
	</td>
	<td>
		<div style="margin:30px;"><a href="javascript:;"><div class="architects_panel">Schedule Lunch n' Learn</div></a></div>
	</td>
	<td>
		<div style="margin:30px;"><a href="javascript:;"><div class="architects_panel">Request Proposal</div></a></div>
	</td>
	</tr>
	</table>
</div>&nbsp;
<?php include __DIR__ . '/../../template/footer.php'; ?>