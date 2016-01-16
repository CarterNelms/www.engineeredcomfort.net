<div align="center" id="top">

<div align="center" id="header_bg">
	<div id='header'>
		<div id='logo'>
			<a href='/'><img id='logo' src='/images/header_logo.png' alt='Engineered Comfort, Inc.'/></a>
		</div>
		<div id='header_phone'>
			901.382.6005 or 877.382.6005<br />&nbsp;
		</div><br />
		<div id='header_txt'>
			<b>Making Homes <i>Efficient</i>, <i>Comfortable</i>, and <i>Healthy!</i></b>
		</div>
		<?php
		echo "<div class='log' style='font-size:12px;line-height:12px;text-align:right;top:91px;right:";
		if(!isset($_SESSION['id']) || ($logout == true)) // If the user is not logged in, give him the Log In option.
		{
			echo "135px;'>";
			if($logout == true)
			{
				// Log the user out if he has just now logged out.
				logout($_SESSION['id']); // NOTE: The session variable 'id' will be set if $logout == true. If it somehow is not, this will not cause a problem.
				
				//echo "You have logged out - ";
			}
			else
			{
				// If the user did not just now log out, go ahead and end the session anyway.
				session_destroy();
				session_unset();
				unset($_SESSION);
			}
			/* echo "</div>
			<div style='position:absolute;top:86px;right:82px;float:left;'>
				<div onmouseover='dropdown_menu_display(\"Login_button\", \"Login_menu\", \"Login_arrow\", true);' onmouseout='dropdown_menu_display(\"Login_button\", \"Login_menu\", \"Login_arrow\", false);'>
					<a href='/login/?des=" . $_SERVER['SCRIPT_NAME'] . "'>
						<div id='Login_button' class='dropdown_button'>
							Log In
							<img id='Login_arrow' src='/images/menu_arrow.png' style='margin-top:8px;' />
						</div>
					</a>
					<div id='Login_menu' class='dropdown_menu'>"; */
			echo "</div>
			<div style='position:absolute;top:86px;right:64px;float:left;'>
				<div style='margin-top:0px;'>
					<a class='quicklink' href='https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/login/?des=" . $_SERVER['SCRIPT_NAME'] . "'>
						<div id='Login_button' class='dropdown_button'>
							Log In
							<img src='/images/menu_blank_spacer.png' style='margin-top:8px;' />
						</div>
					</a>
					<div id='Login_menu' class='dropdown_menu'>";
			$style = "text-align:left;width:250px;padding-bottom:20px;"; include __DIR__ . '/login/login_form.php'; // Login Form
			echo	"</div>
				</div>
			</div>
			<div style='position:absolute;top:86px;right:-2px;'>
				<div style='margin-top:0px;'>
					or 
					<a class='quicklink' href='https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/signup'>
						Sign Up
						<img src='/images/menu_blank_spacer.png' style='margin-top:8px;' />
					</a>
				</div>
			</div>";
		}
		else
		{
			echo "95px;'><div>Welcome, " . $_SESSION['username'] . "&nbsp;&nbsp;- </div></div>
			<div style='position:absolute;top:86px;right:5px;'>
				<div onmouseover='dropdown_menu_display(\"Account_button\", \"Account_menu\", \"Account_arrow\", true);' onmouseout='dropdown_menu_display(\"Account_button\", \"Account_menu\", \"Account_arrow\", false);' onclick='dropdown_menu_display(\"Account_button\", \"Account_menu\", \"Account_arrow\", false);'>
					<a href='/account'>
						<div id='Account_button' class='dropdown_button'>
							Account
							<img id='Account_arrow' src='/images/menu_arrow.png' style='margin-top:8px;' />
						</div>
					</a>
					<div id='Account_menu' class='dropdown_menu'>
						<a class='quicklink' href='https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/account'><div class='header_menu' " . $menu_highlight . ">
							My Account
						</div></a>
						<a class='quicklink' href='https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/account/settings'><div class='header_menu' " . $menu_highlight . ">
							Settings
						</div></a>
						<a class='quicklink' href='https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/index.php?pg=" . $_GET['pg'] . "&logout=" . true . "'><div class='header_menu' " . $menu_highlight . ">
							Log Out
						</div></a>
					</div>
				</div>
			</div>";
		}
		?>
		
		<div id='quicklinks'>
			<a class='quicklink' <?php echo $dynamic_link;?> href='/'>Home</a> | 
			<a class='quicklink' <?php echo $dynamic_link;?> href='/#services'>Products & Services</a> | 
			<a class='quicklink' <?php echo $dynamic_link;?> href='/#about-us'>About Us</a> | 
			<a class='quicklink' <?php echo $dynamic_link;?> href='/contact_us.html'>Contact Us</a> |
			<a class='quicklink' <?php echo $dynamic_link;?> href='/locations.html'>Locations</a> | 
			<a class='quicklink' <?php echo $dynamic_link;?> href='/construction.html'>Resource Center</a> | 
			<div style='position:absolute;top:0px;right:-82px;'>
				<div style="float:left;" onmouseover='dropdown_menu_display("Members_button", "Members_menu", "Members_arrow", true);' onmouseout='dropdown_menu_display("Members_button", "Members_menu", "Members_arrow", false);' onclick='dropdown_menu_display("Members_button", "Members_menu", "Members_arrow", false);'>
					<a href='/members/'>
						<div id='Members_button' class='dropdown_button'>
							Members
							<img id='Members_arrow' src='/images/menu_arrow.png' style='margin-top:8px;' />
						</div>
					</a>
					<div id='Members_menu' class='dropdown_menu'>
						<a class='quicklink' href='/members/'><div class='header_menu' <?php echo $menu_highlight; ?>>
							About
						</div></a>
						<a class='quicklink' href='/members/architects'><div class='header_menu' <?php echo $menu_highlight; ?>>
							Architects
						</div></a>
						<a class='quicklink' href='/construction.html'><div class='header_menu' <?php echo $menu_highlight; ?>>
							Builders
						</div></a>
					</div>
				</div>
				<div style="float:left;margin-top:3px;"> | </div>
			</div>
			<div style='position:absolute;top:0px;right:-138px;'>
				<div style="float:left;" onmouseover='dropdown_menu_display("Links_button", "Links_menu", "Links_arrow", true);' onmouseout='dropdown_menu_display("Links_button", "Links_menu", "Links_arrow", false);' onclick='dropdown_menu_display("Links_button", "Links_menu", "Links_arrow", false);'>
					<a href='/#extralinks'>
						<div id='Links_button' class='dropdown_button'>
							Links
							<img id='Links_arrow' src='/images/menu_arrow.png' style='margin-top:8px;' />
						</div>
					</a>
					<div id='Links_menu' class='dropdown_menu'>
						<a class='quicklink' href='https://www.facebook.com/pages/Engineered-Comfort-Inc/112815144094' target="_blank"><div class='header_menu' <?php echo $menu_highlight; ?>>
							<table>
								<tr>
									<td>
										<img src="/images/blue-icon.png" />
									</td>
									<td style="min-width:125px;">
										Facebook
									</td>
								</tr>
							</table>
						</div></a>
						<a class='quicklink' href='/in_the_news.html'><div class='header_menu' <?php echo $menu_highlight; ?>>
							<table>
								<tr>
									<td>
										<img src="/images/news-icon.png" />
									</td>
									<td style="min-width:125px;">
										In The News
									</td>
								</tr>
							</table>
						</div></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="main" align="center">