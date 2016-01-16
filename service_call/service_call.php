<h1>Service Call</h1>
<div id="service_call_form" class="panel">
	<form enctype="multipart/form-data" method="post" align="center" action="/service_call/submit" style="padding:20px 200px 0px 200px;text-align:left;">
	Fill out the form below to submit a service call. We will respond promptly.<br />
	<span>*</span>A name and a method of contact (either phone or email, or both) are required.
	<ul>
	<li>
		<label for="name">Name: <span>*</span></label>
		<div>
			<input id="name" name="name" size="30" type="text" style="width:50%;" value="<?php echo $_POST['name']?>" required="required" />
		</div>
	</li>
	<li>
		<label for="company">Company:</label>
		<div>
			<input id="company" name="company" size="50" type="text" style="width:50%;" value="<?php echo $_POST['company']?>" />
		</div>
	</li>
	<li>
		<label for="email">Email:</label>
		<div>
			<input id="email" name="email" size="50" type="text" style="width:50%;" value="<?php echo $_POST['email']?>" />
		</div>
	</li>
	<li>
		<label for="phone">Phone:</label>
		<div>
			(<input id="areacode" name="areacode" size="3" maxlength="3" type="text" value="<?php echo $_POST['areacode']?>" />)-
			<input id="phone" name="phone" size="19" maxlength="8" type="text" value="<?php echo $_POST['phone']?>" />
		</div>
	</li>
	<li>
		<label for="address">Address:</label>
		<div>
			<input id="address" name="address" size="50" type="text" style="width:50%;" value="<?php echo $_POST['address']?>" />
		</div>
	</li>
	<li>
		<br />
		<label for="body">Reason for your Service Call:</label>
		<div>
			<textarea id="body" name="body" cols="45" rows="10" ><?php echo stripslashes($_POST['body']);?></textarea>
		</div>
	</li>
	<li>
		<br />
		<input id="emailCopy" name="emailCopy" type="checkbox" <?php if($_POST['emailCopy']){echo "checked='checked'";}?> />
		<label for="emailCopy">Send a copy of this service call to my email address</label>
	</li>
	</ul>
	<div align="center">
		<input value="Submit Service Call" type="submit" />
	</div>
	</form>
</div>