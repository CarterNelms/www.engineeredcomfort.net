<div class="panel" id="diagnostics-header" style="margin-top:0px;border-top:none;">
	<!--div align="center">
		<img src="/images/home/existing_homes.png" />
	</div-->
	<div>
		<div style="font-weight:bold;font-size:28px;padding-top:20px;color:#082983;line-height:50px;">
			<div style="text-indent:50px;">Does your home have uncomfortable areas?</div>
				<div style="text-indent:100px;">Are your energy bills higher than they should be?</div>
					<div style="text-indent:150px;">Does your home seem to make you sick or have mold growth?</div>
		</div>
		<div style="margin:20px 50px 0px 50px;line-height:30px;">
			<p>
				These are a few of the problems with existing homes that the Engineered Comfort Home Diagnostic addresses.  Some companies want to sell you a product; Engineered Comfort wants to provide a Solution.  Some want to walk through and tell you what’s wrong, but having 10 years experience testing homes for performance related issues, we know there is simply no substitute for the complete set of home diagnostic tests.
			</p>
			<aside><img align="left" style="margin-right:10px;" src="/images/diagnostics/blowerdoor.png"></aside>
			<p>
				Once these tests are conducted on the home, the sources for your problem will be known so that they can be repaired - <b>NO GUESSWORK!!!</b>  By investing a little to get the right answer, you don’t waste your money buying expensive windows that provide little savings or installing attic fans that suck the energy (and dollars) out of your home.
			</p>
			<aside><img align="right" style="margin-left:10px;" src="/images/diagnostics/therm_img.png"></aside>
			<p>
				In some homes, we have literally cut the energy bills in half by conducting the test, developing a solution and implementing the recommended plan.  Not to mention, the house is far more comfortable ALL of the time.
				The answer is simple; have the Engineered Comfort Home Diagnostic Test conducted to determine what needs to be done to your home before throwing money at products that don’t solve your problem.				
			</p>
			<br /><br /><span style="color:#148f36;font-weight:bold;font-size:20px;text-align:center;">Please fill out the form below and send us your information to get your solution underway.</span>
		</div>
	</div>
	<form enctype="multipart/form-data" method="post" align="center" id="diagnostic_form" action="/diagnostics/submit" style="padding:20px 0px 0px 12%;text-align:left;width:76%;">
		<table>
			<tr>
				<td style="padding-right:5%;" colspan="2">
					<!--Review the list of home symptoms below and check all that apply.  If your home has symptoms that are not listed below, specify them in the section labelled "other".<br /><br />-->
					<table class="symptoms" style="background-color:#148f36;width:675px;" align="center">
						<tr>
							<td colspan="3" style="text-align:center;font:24px comic sans ms;color:#082983;">
								Interests or Specific Problems<br />
								<span style="font-size:18px;">Indicate All That Apply, then fill out the form below and submit.</span>
							</td>
						</td>
						<tr>
							<td>
								<input id="c0" name="c0" type="checkbox" <?php if(isset($_POST['c0']) && $_POST['c0']){echo "checked='checked'";}?> /><label for="c0">High Utility Bills</label>
							</td>
							<td>
								<input id="c4" name="c4" type="checkbox" <?php if(isset($_POST['c4']) && $_POST['c4']){echo "checked='checked'";}?> /><label for="c4">Crawl Space Problems</label>
							</td>
							<td>
								<input id="c8" name="c8" type="checkbox" <?php if(isset($_POST['c8']) && $_POST['c8']){echo "checked='checked'";}?> /><label for="c8">Hardwood Floors Cupping</label>
							</td>
						</tr>
						<tr>
							<td>
								<input id="c1" name="c1" type="checkbox" <?php if(isset($_POST['c1']) && $_POST['c1']){echo "checked='checked'";}?> /><label for="c1">Uncomfortable Rooms</label>
							</td>
							<td>
								<input id="c5" name="c5" type="checkbox" <?php if(isset($_POST['c5']) && $_POST['c5']){echo "checked='checked'";}?> /><label for="c5">Extremely Hot Attic</label>
							</td>
							<td>
								<input id="c9" name="c9" type="checkbox" <?php if(isset($_POST['c9']) && $_POST['c9']){echo "checked='checked'";}?> /><label for="c9">Room Over Garage Problems</label>
							</td>
						</tr>
						<tr>
							<td>
								<input id="c2" name="c2" type="checkbox" <?php if(isset($_POST['c2']) && $_POST['c2']){echo "checked='checked'";}?> /><label for="c2">Mold Visible / Smellable</label>
							</td>
							<td>
								<input id="c6" name="c6" type="checkbox" <?php if(isset($_POST['c6']) && $_POST['c6']){echo "checked='checked'";}?> /><label for="c6">Drafty House In Winter</label>
							</td>
							<td>
								<input id="c10" name="c10" type="checkbox" <?php if(isset($_POST['c10']) && $_POST['c10']){echo "checked='checked'";}?> /><label for="c10">Old HVAC Equipment</label>
							</td>
						</tr>
						<tr>
							<td>
								<input id="c3" name="c3" type="checkbox" <?php if(isset($_POST['c3']) && $_POST['c3']){echo "checked='checked'";}?> /><label for="c3">Unhealthy Indoor Air</label>
							</td>
							<td>
								<input id="c7" name="c7" type="checkbox" <?php if(isset($_POST['c7']) && $_POST['c7']){echo "checked='checked'";}?> /><label for="c7">Humidity Problem</label>
							</td>
							<td>
								<input id="c11" name="c11" type="checkbox" <?php if(isset($_POST['c11']) && $_POST['c11']){echo "checked='checked'";}?> /><label for="c11">Geothermal Heat Pump</label>
							</td>
						</tr>
						<tr>
							<td colspan="3">
								<label for="other">&nbsp;- Other -</label><br />
								<textarea id="other" name="other" style="width:98.75%;height:60px;" ><?php echo stripslashes(isset($_POST['other']) ? $_POST['other'] : '');?></textarea>
							</td>
						</tr>
					</table><br />
				</td>
			</tr>
			<tr>
				<td style="vertical-align:top;">
					<span>*</span> Denotes a required field.<br />
					<span>**</span> Please let us know who referred you to our site. If you heard about us through some other means, please tell us how.
					<ul>
						<li>
							<label for="name">Name: <span>*</span></label>
							<div>
								<input id="name" name="name" size="30" type="text" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required="required" />
							</div>
						</li>
						<li>
							<label for="company">Company:</label>
							<div>
								<input id="company" name="company" size="30" type="text" value="<?php echo isset($_POST['company']) ? $_POST['company'] : ''; ?>" />
							</div>
						</li>
						<li>
							<label for="email">Email: <span>*</span></label>
							<div>
								<input id="email" name="email" size="30" type="text" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required="required" />
							</div>
						</li>
						<li>
							<label for="phone">Phone: <span>*</span></label>
							<div>
								(<input id="areacode" name="areacode" size="3" maxlength="3" type="text" value="<?php echo isset($_POST['areacode']) ? $_POST['areacode'] : ''; ?>" />)-
								<input id="phone" name="phone" size="19" maxlength="8" type="text" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" required="required" />
							</div>
						</li>
						<li>
							<label for="squareFeet">Conditioned Square Footage: <span>*</span></label>
							<div>
								<input id="squareFeet" name="squareFeet" size="30" maxlength="6" type="text" value="<?php echo isset($_POST['squareFeet']) ? $_POST['squareFeet'] : ''; ?>" required="required" />
							</div>
						</li>
						<li>
							<label for="HVACUnits">Number of HVAC Units: <span>*</span></label>
							<div>
								<input id="HVACUnits" name="HVACUnits" size="30" maxlength="2" type="text" value="<?php echo isset($_POST['HVACUnits']) ? $_POST['HVACUnits'] : ''; ?>" required="required" />
							</div>
						</li>
						<li>
							<label for="referredBy">Referred By: <span>**</span></label>
							<div>
								<input id="referredBy" name="referredBy" size="30" type="text" value="<?php echo isset($_POST['referredBy']) ? $_POST['referredBy'] : ''; ?>" />
							</div>
						</li>
						<li>
							<br />
							<input id="emailCopy" name="emailCopy" type="checkbox" <?php if(isset($_POST['emailCopy']) && $_POST['emailCopy']){echo "checked='checked'";}?> />
							<label for="emailCopy">Send a copy of this submission to my email address</label>
						</li>
					</ul>
				</td>
				<td class="buttons">
					<div align="center">
						<button value="Submit Diagnostic Request" type="submit" style="font-size:18px;">Submit Diagnostic Request</button>
					</div>
					<div align="center">
						<a href="/diagnostics/2010_video"><button value="Video" type="button">Video</button></a>
					</div>
					<div align="center">
						<button value="Resources" type="button">Resources</button>
					</div>
				</td>
			<tr>
		</table>
	</form>
</div>