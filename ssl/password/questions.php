<form enctype='multipart/form-data' method='post' align='center' action='https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/password/security/verify' style='padding:20px 300px 50px 300px;text-align:left;'>
	<ul style="list-style:none;">
		<li>
			<label for="a1"><?php echo $q1 ?></label>
			<div>
				<input id="a1" name="a1" style='width:80%;' type="text" value="<?php echo $_POST['a1']; ?>" autocomplete="off" required="required" />
			</div>
		</li>
		<li>
			<label for="a2"><?php echo $q2 ?></label>
			<div>
				<input id="a2" name="a2" style='width:80%;' type="text" value="<?php echo $_POST['a2']; ?>" autocomplete="off" required="required" />
			</div>
		</li>
		<li>
			<label for="a3"><?php echo $q3 ?></label>
			<div>
				<input id="a3" name="a3" style='width:80%;' type="text" value="<?php echo $_POST['a3']; ?>" autocomplete="off" required="required" />
			</div>
		</li>
		<li>
			<label for="password">New Password:</label>
			<div>
				<input id="password" name="password" style='width:80%;' type="password" value="<?php echo $_POST['password']; ?>" maxlength="20" autocomplete="off" required="required" />
			</div>
		</li>
		<li>
			<label for="retype">Retype New Password:</label>
			<div>
				<input id="retype" name="retype" style='width:80%;' type="password" maxlength="20" autocomplete="off" required="required" />
			</div>		
			<!--Pass on the visitor's username, email, and id-->
			<input id="username" name="username" type="hidden" value="<?php echo $username ?>">
			<input id="email" name="email" type="hidden" value="<?php echo $email ?>">
			<input id="id" name="id" type="hidden" value="<?php echo $id ?>">
		</li>
	</ul>
	<div align="center">
		<input value="Submit" type="submit" />
	</div>
</form>