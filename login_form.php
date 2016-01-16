<table align="center">
	<tr>
		<td>
			<h2 style="text-align:center;">Welcome Back</h2>
		</td>
		<td>
			<h2 style="text-align:center;">Don't have an account?</h2>
		</td>
	</tr>
	<tr>
		<td>
			<div style="border-right:3px solid #082983;">
				<p style="text-indent:30px;color:#148f36;font-weight:bold;">Please sign in here:<br />&nbsp;</p>
				<form enctype='multipart/form-data' method='post' align='center' action='https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/login/secure_login<?php
					// If a destination is provided, then check to see that it is one that he may redirect to after logging in. If it is, then go to that page when the user submits him information. Otherwise, go home instead.
					include __DIR__ . '/login/no_login_pages.php';
					if(isset($_GET['des']) && !in_array($_GET['des'], $no_login_pages) && (substr($_GET['des'], 0, 5) != '/ssl/'))
					{
						echo "?des=" . $_GET['des'];
					}
					elseif(!in_array($_SERVER['SCRIPT_NAME'], $no_login_pages) && ($_SERVER['HTTP_HOST'] == "www.engineeredcomfort.net")) // If no destination was specified, then stay on this page, unless this is one that the user may not be redirected to after a login. If it is, then go to the home page.
					{
						echo "?des=" . $_SERVER['SCRIPT_NAME'];
					}
					?>' style='<?php echo $style; ?>'>
					<ul>
						<li>
							<label for="username">Username:</label>
							<div>
								<input id="username" name="username" style='width:80%;' type="text" autocomplete="off" required="required" />
							</div>
						</li>
						<li>
							<label for="password">Password:</label>
							<div>
								<input id="password" name="password" style='width:80%;' type="password" autocomplete="off" required="required" />
							</div>
						</li>
						<li ><!--style="text-align:center;margin-right:15%;"-->
							<br />
							<a href="https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/password" style="text-decoration:none;font-size:12px;">Forgot Password?</a>
						</li>
						<input id="login" name="login" value="true" type="hidden" />
					</ul>
					<div align="center">
						<input style="background-image:url('/images/submit_bg.png');border:none;background-color:transparent;width:85px;height:35px;color:white;font-weight:bold;font:18px arial;margin:0px;border:0px;text-align:center;padding-bottom:5px;" value="Sign In" type="submit" />
					</div>
				</form>
			</div>
		</td>
		<td>
			<div style="margin:10px;">
				<u>Architects</u> and <u>Builders</u> can register at EngineeredComfort.net to access extra features reserved specifically for them. Upon creating an account, we at Engineered Comfort will review your request to access the members-only portions of the site. You will receive an email notification once your account is approved.
			</div>
		</td>
	</tr>
</table>