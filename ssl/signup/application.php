<h1>Site Access Application</h1>
<div id="architects_application_form" class="panel">
	<form enctype="multipart/form-data" method="post" align="center" action="https://p4.secure.hostingprod.com/@www.engineeredcomfort.net/ssl/signup/submit" style="padding:20px 20px 0px 20px;text-align:left;">
	<ul>
		<span>This application is currently under construction.<br /></span>
		Fill out the form below to apply for access to the members-only sections of www.engineeredcomfort.net.<br /><br />
		<span>*</span>Denotes a required field.<br />
		<li>
			<label for="firstname">First Name: <span>*</span></label>
			<div>
				<input id="firstname" name="firstname" size="30" type="text" value="<?php echo $_POST['firstname']?>" required="required" />
			</div>
		</li>
		<li>
			<label for="lastname">Last Name: <span>*</span></label>
			<div>
				<input id="lastname" name="lastname" size="30" type="text" value="<?php echo $_POST['lastname']?>" required="required" />
			</div>
		</li>
		<li>
			<label for="firm">Firm: <span>*</span></label>
			<div>
				<input id="firm" name="firm" size="30" type="text" value="<?php echo $_POST['firm']?>" required="required" />
			</div>
		</li>
		<li>
			<label for="email">Email: <span>*</span></label>
			<div>
				<input id="email" name="email" size="30" type="text" value="<?php echo $_POST['email']?>" required="required" />
			</div>
		</li>
		<li>
			<label for="phone">Phone: <span>*</span></label>
			<div>
				(<input id="areacode" name="areacode" size="3" maxlength="3" type="text" value="<?php echo $_POST['areacode']?>" required="required" />)-
				<input id="phone" name="phone" size="19" maxlength="8" type="text" value="<?php echo $_POST['phone']?>" required="required" />
			</div>
		</li>
		<li>
			&nbsp;<br />Once your account is confirmed, you can sign in with your username and password.<br />
			Usernames must have between 6 and 30 characters and may contain letters, numbers, hyphens ( - ) and underscores ( _ )<br />
			<!--&nbsp;
			<?php
			/*
			for($n = 1, $size = sizeof($legal_username_characters); $n < $size; $n++) // Note that the loop begins at $n = 1. This avoids printing the space with the legal symbols.
			{
				if($n > 1)
				{
					echo " ";
				}
				echo $legal_username_characters[$n];
			}
			*/
			?>
			<br /><br /-->
			Passwords must have between 6 and 20 characters and must contain characters from at least 2 of the following 3 categories:<br /><br />- Letters (upper or lower case)<br />- Numbers<br />- Legal Symbols &nbsp;&nbsp;&nbsp;
			<?php
			for($n = 0, $size = sizeof($legal_password_characters); $n < $size; $n++)
			{
				if($n > 0)
				{
					echo " ";
				}
				echo $legal_password_characters[$n];
			}
			?>
			&nbsp;&nbsp;&nbsp;<br />&nbsp;
		</li>
		<li>
			<label for="username">Username: <span>*</span></label>
			<div>
				<input id="username" name="username" size="30" type="text" maxlength="30" value="<?php echo $_POST['username']?>" required="required" />
			</div>
		</li>
		<li>
			<label for="password">Password: <span>*</span></label>
			<div>
				<input id="password" name="password" size="30" type="password" maxlength="20" value="<?php echo $_POST['password']?>" required="required" autocomplete="off" />
			</div>
		</li>
		<li>
			<label for="retype">Retype Password: <span>*</span></label>
			<div>
				<input id="retype" name="retype" size="30" type="password" maxlength="20" required="required" autocomplete="off" />
			</div>
		</li>
		<li>
			<br />Which section(s) of the site are you applying to access? <span>*</span>
			<br /><input id="architects" name="architects" type="checkbox" <?php if($_POST['architects']){echo "checked='checked'";}?> /><label for="architects">Architects</label>
			<br /><input id="builders" name="builders" type="checkbox" <?php if($_POST['builders']){echo "checked='checked'";}?> /><label for="builders">Builders</label>
		</li>
		<li>
			<br />Secutiry Questions:
			<br />These secuirity questions will allow you to reset your password in the case that you forget it.  Select three questions and record your answers.  Answers are case-sensitive. Minimum length of 5 characters.
			<div>
				<ul>
					<li>
						<br />Question 1
						<select name="question1" style="width:80%;">
							<option value="What is your mother's maiden name?" <?php if(stripslashes($_POST['question1']) == "What is your mother's maiden name?"){echo 'selected="selected"';} ?>>What is your mother's maiden name?</option>
							<option value="Where did you meet your spouse?" <?php if(stripslashes($_POST['question1']) == "Where did you meet your spouse?"){echo 'selected="selected"';} ?>>Where did you meet your spouse?</option>
							<option value="What is your oldest cousin's first name?" <?php if(stripslashes($_POST['question1']) == "What is your oldest cousin's first name?"){echo 'selected="selected"';} ?>>What is your oldest cousin's first name?</option>
						</select>
					</li>
					<li>
						<label for="answer1">Answer 1: <span>*</span></label>
						<input id="answer1" name="answer1" size="30" type="text" value="<?php echo $_POST['answer1']?>" autocomplete="off" required="required" />
					</li>
					<li>
						<br />Question 2
						<select name="question2" style="width:80%;">
							<option value="Where did you parents meet?" <?php if(stripslashes($_POST['question2']) == "Where did your parents meet?"){echo 'selected="selected"';} ?>>Where did your parents meet?</option>
							<option value="Where were you when you had your first kiss?" <?php if(stripslashes($_POST['question2']) == "Where were you when you had your first kiss?"){echo 'selected="selected"';} ?>>Where were you when you had your first kiss?</option>
							<option value="What is the name of your best childhood friend?" <?php if(stripslashes($_POST['question2']) == "What is the name of your best childhood friend?"){echo 'selected="selected"';} ?>>What is the name of your best childhood friend?</option>
						</select>
					</li>
					<li>
						<label for="answer2">Answer 2: <span>*</span></label>
						<input id="answer2" name="answer2" size="30" type="text" value="<?php echo $_POST['answer2']?>" autocomplete="off" required="required" />
					</li>
					<li>
						<br />Question 3
						<select name="question3" style="width:80%;">
							<option value="What school did you attend for sixth grade?" <?php if(stripslashes($_POST['question3']) == "What school did you attend for sixth grade?"){echo 'selected="selected"';} ?>>What school did you attend for sixth grade?</option>
							<option value="Where did you go on your honeymoon?" <?php if(stripslashes($_POST['question3']) == "Where did you go on your honeymoon?"){echo 'selected="selected"';} ?>>Where did you go on your honeymoon?</option>
							<option value="What is the name of a college you applied to but didn't attend?" <?php if(stripslashes($_POST['question3']) == "What is the name of a college you applied to but didn't attend?"){echo 'selected="selected"';} ?>>What is the name of a college you applied to but didn't attend?</option>
						</select>
					</li>
					<li>
						<label for="answer3">Answer 3: <span>*</span></label>
						<input id="answer3" name="answer3" size="30" type="text" value="<?php echo $_POST['answer3']?>" autocomplete="off" required="required" />
					</li>
				</ul>
			</div>
		</li>
		<li>
			<br />
			<label for="body">Comments:</label>
			<div>
				<textarea id="body" name="body" cols="45" rows="10" ><?php echo stripslashes($_POST['body']);?></textarea>
			</div>
		</li>
		<li>
			<br />
			<input id="emailCopy" name="emailCopy" type="checkbox" <?php if($_POST['emailCopy']){echo "checked='checked'";}?> />
			<label for="emailCopy">Send a copy of this application to my email address</label>
		</li>
	</ul>
	<div align="center">
		<input value="Submit Application" type="submit" />
	</div>
	</form>
</div>