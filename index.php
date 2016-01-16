<?php include __DIR__ . '/template/head.php'; ?>
<title>Engineered Comfort, Inc : Home</title>
<style type="text/css">
#subjects a{
	text-decoration:underline;
}
#subjects a:visited{
	color:#082983;
}
p{
	margin:0px 4% 10px 4%;
	text-align:left;
}
</style>
<script language="javascript" src="/scripts/testimonies.js"></script>
<script language="javascript" src="/scripts/locations.js"></script>
<script language="javascript">
//<!--
if(!Array.indexOf){
	Array.prototype.indexOf = function(obj){
		for(var i=0; i<this.length; i++){
			if(this[i]==obj){
				return i;
			}
		}
		return -1;
	}
}

<!--// This function changes the testimony in the panel on the side of the screen every few seconds.
function testify()
{
// This is a list of the people who have testified for Engineered Comfort.
var testifyers = getTestifyers();

// This is a list of the corresponding testimonies from the 'testifyers' array.
var testimonies = getTestimonies();

// Generate a random integer between 0 and the number of arrays minus 1. Make sure that the testimony chosen is not currently being displayed.
do{
	var num = Math.floor(Math.random()*(testifyers.length-0.0000000000000001));
}
while(document.getElementById("witness").innerHTML == testifyers[num] + " -");

// Replace the testimony and the testifyer on the web page with the new randomly selected ones.
document.getElementById("witness").innerHTML = testifyers[num] + " -";
document.getElementById("testimonial").innerHTML = "- " + testimonies[num];
// Set the color to a dark grey. Some browsers will change to the wrong color if the color isn't reset in this script.
document.getElementById("testimony-panel").style.color = "#111111";

// Change to a different testimony every 15 seconds.
setTimeout('testify();',15000);
//-->
}

/* This function will scroll though the efficient, comfortable, and healthy pages in the box on the home page.
It will also change to one of the three categories when one of the three buttons is pressed. */
// This is a list of all 3 images that will display.
var images = new Array();
images[0] = "/images/home/efficient.jpg";
images[1] = "/images/home/comfortable.jpg";
images[2] = "/images/home/healthy.jpg";
var num;
// Standard button colors
var ECGreen = '#47b865';
var ECBlue =  '#082983';
var ECHighlight = '#ffffff';
var ech_whichIsWhite = 0; // This tells which button is highlighted. 1=efficient, 2=comfortable, 3=healthy, 0 (or anything else)=nothing
function ech_pages(count)
{
	// If the number provided was greater than 2, this indicates that the panel should rotate to the next panel in the queue.
	if(count > 2){num = images.indexOf(document.getElementById('ech_pic').src) + 1;}
	// If the number provided was less than 2, this indicates that a specific panel has been selected. That panel should be shown.
	else{num = count;}

	// Make sure the number for the next panel is a 0, 1, or 2.
	if((num > 2) || (num < 0)){num = 0;}
	// Change the image source to the one for the current category.
	document.getElementById('ech_pic').src = images[num];
	
	// Set all borders to light green
	var eff_brdr_clr = ECGreen;
	var com_brdr_clr = ECGreen;
	var hea_brdr_clr = ECGreen;
	// Change any hovered-over borders to white
	switch(ech_whichIsWhite)
	{
		case 1:
			var eff_brdr_clr = ECHighlight;
			break;
		case 2:
			var com_brdr_clr = ECHighlight;
			break;
		case 3:
			var hea_brdr_clr = ECHighlight;
			break;
		default:
			break;
	}
	
	if(num == 0)
	{
		eff_brdr_clr = ECBlue;
		document.getElementById('ech_panel').style.maxWidth = '100px';
		document.getElementById('ech_panel').style.minHeight = '85px';
		document.getElementById('ech_panel').style.left = '160px';
		document.getElementById('ech_panel').style.top = '20px';
		document.getElementById('ech_panel').innerHTML = "Utility Bills 30% to 50% Less Than Typical Housing";
		document.getElementById('ech').href = "#efficient_narrative";
	}
	else if(num == 1)
	{
		com_brdr_clr = ECBlue;
		document.getElementById('ech_panel').style.maxWidth = '246px';
		document.getElementById('ech_panel').style.minHeight = '45px';
		document.getElementById('ech_panel').style.left = '25px';
		document.getElementById('ech_panel').style.top = '15px';
		document.getElementById('ech_panel').innerHTML = "Every Room In The House Comfortable At The Same Time";
		document.getElementById('ech').href = "#comfortable_narrative";
	}
	else if(num == 2)
	{
		hea_brdr_clr = ECBlue;
		document.getElementById('ech_panel').style.maxWidth = '235px';
		document.getElementById('ech_panel').style.minHeight = '45px';
		document.getElementById('ech_panel').style.left = '25px';
		document.getElementById('ech_panel').style.top = '135px';
		document.getElementById('ech_panel').innerHTML = "Superior Indoor Air Quality To Promote A Healthy Lifestyle";
		document.getElementById('ech').href = "#healthy_narrative";
	}

	document.getElementById('eff_button').style.borderColor = eff_brdr_clr;
	document.getElementById('com_button').style.borderColor = com_brdr_clr;
	document.getElementById('hea_button').style.borderColor = hea_brdr_clr;


	if((count < 3) && (count >= 0))
	{
		clearTimeout(timer);
	}
	timer=setTimeout('ech_pages(3);', 10000);
}

// This function will set the borders of the efficient, comfortable, and healthy buttons back to green or blue, depending on which image is currently being shown.
function ech_borders()
{
	// Nothing is hovered over
	ech_whichIsWhite = 0;
	
	// Set all borders to light green
	var eff_brdr_clr = ECGreen;
	var com_brdr_clr = ECGreen;
	var hea_brdr_clr = ECGreen;
	
	var narrative = document.getElementById('ech').href.split('#');
	
	if(narrative[1] == "efficient_narrative")
	{
		eff_brdr_clr = ECBlue;
	}
	else if(narrative[1] == "comfortable_narrative")
	{
		com_brdr_clr = ECBlue;
	}
	else
	{
		hea_brdr_clr = ECBlue;
	}
	
	// Set the border colors ccordingly
	document.getElementById('eff_button').style.borderColor = eff_brdr_clr;
	document.getElementById('com_button').style.borderColor = com_brdr_clr;
	document.getElementById('hea_button').style.borderColor = hea_brdr_clr;
}

// This function will get all of the locations from the external javascript file and insert them into the scrolling text in the New Homes section.
function getLocations(){
var locations = cities();
var printout = "";
var n = 0;
for(n = 0; n < locations.length; n++)
{
	printout += locations[n];
	if(n < (locations.length - 1))
	{
		printout += " - ";
	}
}
document.getElementById('locations').innerHTML = printout;
}

var sections = new Array();
sections[0] = 'newHomeShade';
sections[1] = 'echShade';
sections[2] = 'diagnosticShade';
sections[3] = 'serviceShade';
// This function will shade unselected regions on the screen to highlight a selected area.
function highlight(sectionID){
var n = 0;
for(n = 0; n < sections.length; n++)
{
	var shade_img = "url(/images/shade.png)";
	if(sections[n] == sectionID)
	{
		shade_img = "url()";
	}
	document.getElementById(sections[n]).style.backgroundImage = shade_img;
}
}
// This function will shade all sections that can be shaded.
function shadeAll(){
var n = 0;
for(n = 0; n < sections.length; n++)
{
	document.getElementById(sections[n]).style.backgroundImage = "url(/images/shade.png)";
}
//alert("shade");
}
// This function will restore highlights to all sections when no one section is selected.
function unshadeAll(){
var n = 0;
for(n = 0; n < sections.length; n++)
{
	document.getElementById(sections[n]).style.backgroundImage = "url()";
}
//alert("unshade");
}
//-->
</script>
</head>

<body onload="testify();ech_pages(-1);getLocations();">
<?php include __DIR__ . '/template/header.php'; ?>
<div id="home-top">
	<div class="home_top">
		<div style="width:735px;height:536px;position:absolute;" onmouseover="shadeAll();" onmouseout="unshadeAll();"></div>
		<table>
			<tr>
				<td>
					<div style="height:271px;position:absolute;" onmouseover="highlight('newHomeShade');" onmouseout="unshadeAll();">
						<a href="/construction.html" style="text-decoration:none;color:white;position:absolute;">
							<img id="new_homes" src="/images/home/new_homes.jpg" alt="High-Performance New Homes" style="width:408px;height:271px;position:absolute;"/>	
							<div id="newHomeShade" style="width:408px;height:271px;position:relative;"></div>
							<!--<div style="background-color:red;z-index:1000;background-image:url(/images/home/efficient.jpg');width:408px;height:271px;position:relative;">&nbsp;</div>-->
							
							<div class="tg_header" style="width:408px;height:35px;position:relative;top:-271px;font:20px comic sans ms;text-align:center;">
								High-Performance New Homes
							</div>
							<div style="background-image:url('/images/trans_green/trans_green_panel.png');background-repeat:repeat;color:white;width:150px;height:190px;font-weight:bold;text-align:center;padding:5px;position:relative;left:10px;top:-261px;">
								Engineered Comfort New Homes - <br /><br />Designed, Installed, And Verified To Produce A<br />High-Perfomance Indoor Environment
							</div>
						</a>
						<a href="/locations" style="text-decoration:none;position:absolute;">
							<div style="background-image:url('/images/trans_green/trans_green_header.png');background-repeat:repeat;color:white;width:408px;height:20px;font-size:14px;font-weight:bold;text-align:left;position:relative;top:251px;">
								<span style="padding-left:10px;color:white;">Working In: </span>
								<div style="color:white;width:308px;height:20px;position:relative;top:-18px;left:95px;font-size:14px;font-weight:bold;overflow:hidden;">
									<marquee id="locations" behavior="scroll" direction="left" scrollamount="5"></marquee>
								</div>
							</div>
						</a>
					</div>
					
					<div id="ech_div" style="width:315px;height:271px;background-color:#148f36;position:relative;left:411px;padding:0px 1px 0px 1px;" onmouseover="highlight('echShade');" onmouseout="unshadeAll();">
						<table>
						<tr style="padding:0px;margin:0px;"><td colspan="3" style="padding:0px;margin:0px;">
							<a id="ech" href="#efficient_narrative" style="text-decoration:none;color:white;"><div style="height:203px;"><img id="ech_pic" src="/images/home/efficient.jpg" alt="Efficient, Comfortable, Healthy" style="width:311px;height:201px;margin-top:1px;"/><div id="echShade" style="width:311px;height:201px;position:absolute;top:3px;"></div><div id="ech_panel" style="background-image:url('/images/trans_green/trans_green_header.png');background-repeat:repeat;color:white;font-weight:bold;padding:5px 10px 5px 10px;margin-right:20px;text-align:center;position:absolute;overflow:hidden;max-width:100px;min-height:85px;left:160px;top:20px;">Utility Bills 30% to 50% Less Than Typical Housing</div></div></a>
						</td></tr>
						<tr style="padding:0px;margin:0px;" onmouseout="ech_borders()">
							<td id="eff_button" class="ech_border" style="padding:0px;margin:0px;border-color:#082983;" onmouseover="this.style.borderColor=ECHighlight; ech_whichIsWhite = 1;">
								<a href="javascript:;" style="text-decoration:none;" onclick="ech_pages(0)"><div class="ech_button">Efficient</div></a>
							</td>
							<td id="com_button" class="ech_border" style="padding:0px;margin:0px;" onmouseover="this.style.borderColor=ECHighlight; ech_whichIsWhite = 2;">
								<a href="javascript:;" style="text-decoration:none;" onclick="ech_pages(1)"><div class="ech_button">Comfortable</div></a>
							</td>
							<td id="hea_button" class="ech_border" style="padding:0px;margin:0px;" onmouseover="this.style.borderColor=ECHighlight; ech_whichIsWhite = 3;">
								<a href="javascript:;" style="text-decoration:none;" onclick="ech_pages(2)"><div class="ech_button">Healthy</div></a>
							</td>
						</tr>
						</table>
					</div>
				</td>
				<td>
					<div id="links" style="font-style:italic;text-align:left;background-image:url('/images/panel_bg.png');background-repeat:repeat;background-position:center;border-style:solid;border-color:#148f36;border-width:3px;font:18px times new roman;line-height:120%;width:281px;height:245px;padding-top:20px;padding-bottom:0px;overflow:hidden;">
						<ul id="subjects" style="color:082983;margin:0px 0px 0px 0px;list-style-image:url('/images/contour-icon.png');">
							<li><a <?php echo $dynamic_link_inverted;?> href="#geothermal-heat-pumps" target="_self">Geothermal Heat Pumps</a></li>
							<li><a <?php echo $dynamic_link_inverted;?> href="#dual-fuel-heat-pumps" target="_self">Dual Fuel Heat Pumps</a></li>
							<li><a <?php echo $dynamic_link_inverted;?> href="#cellulose-insulation" target="_self">Cellulose Insulation</a></li>
							<li><a <?php echo $dynamic_link_inverted;?> href="#foam-insulation" target="_self">Foam Insulation</a></li>
							<li><a <?php echo $dynamic_link_inverted;?> href="#crawl-space-systems" target="_self">Crawl Space Systems</a></li>
							<li><a <?php echo $dynamic_link_inverted;?> href="#blower-door-test" target="_self">Blower Door Test</a></li>
							<li><a <?php echo $dynamic_link_inverted;?> href="#blower-door-test" target="_self">Thermal Imaging</a></li>
							<li><a <?php echo $dynamic_link_inverted;?> href="#HVAC-system-service-and-maintenance" target="_self">HVAC System Servive & Maintenance</a></li>
							<li><a <?php echo $dynamic_link_inverted;?> href="#consulting-services" target="_self">Consulting Services</a></li>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<td style="margin:0px;padding:0px;">
					<div style="border-style:solid;border-color:#082983;border-width:3px;background-color:#082983;width:724px;height:253px;">
						<div onmouseover="highlight('diagnosticShade');" onmouseout="unshadeAll();">
							<a href="/diagnostics/" style="color:#082983">
								<div style="position:absolute;"><img id="existing_img" src="/images/home/existing_homes_diagnostics.png" alt="Diagnostics for Existing Homes" style="width:724px;height:125px;" /></div>
								<div style="width:724px;height:125px;position:absolute;font:16px comic sans ms;">
									<div style="position:relative;left:290px;top:0px;">
										<span style="text-decoration:underline;font-size:22px;font-weight:bold;">Diagnostics for Existing Homes</span>
										<table style="position:relative;left:50px;font:16px comic sans ms;color:#082983;">
											<tr>
												<td style="vertical-align:top;width:150px;">
													Solutions For:
												</td>
												<td rowspan="2">
													<li>
														High Utility Bills
													</li>
													<li>
														Uncomfortable Rooms
													</li>
													<li>
														Unhealthy Indoor Air
													</li>
												</td>
											</tr>
											<tr>
												<td>
													<!--Starting At:<br />
													$120 / Test-->
												</td>
											</tr>
										</table>
									</div>
								</div>
								<!--div style="position:absolute;top:0px;left:0px;width:150px;height:20px;border:2px solid #148f36;">
									Test
								</div-->
								<div id="diagnosticShade" style="width:724px;height:125px;position:relative;"></div>
							</a>
						</div>
						<div onmouseover="highlight('serviceShade');" style="margin-top:3px;" onmouseout="unshadeAll();">
							<a href="/service_call"><img id="service_img" src="/images/home/service_call.png" alt="HVAC System Service & Maintenance" style="width:724px;height:125px;position:absolute;"/>
								<div id="serviceShade" style="width:724px;height:125px;position:absolute;"></div></a>
								<a href="/service_call" style="text-decoration:none;"><div id="service_button1" class="service_button">Request<br /> Service Call</div></a>
								<a href="/construction.html" style="text-decoration:none;"><div id="service_button2" class="service_button">Preventive<br /> Maintenance</div></a>
						</div>
					</div>
				</td>
				<td>
					<a href="/testimonies.html" style="color:#082983;text-decoration:none;position:absolute;top:392px;overflow:hidden;" alt="Testimonies">
						<div id="testimony-panel" style="text-align:left;background-image:url('/images/panel_bg.png');background-repeat:repeat;background-position:bottom right;border-style:solid;border-color:#148f36;border-width:3px;font:16px times new roman;line-height:120%;width:281px;height:243px;padding:10px 0px 0px 0px;overflow:hidden;color:#111111;">
							<div style="position:absolute;overflow:hidden;">
								<h3>Testimonies</h3>
								<p style="margin:0px 0px 0px 0px;text-align:center;width:100%;font-style:italic;color:#082983">Click here for more</p>
								<b>
								<p id="witness">Suzanne - </p>
								<p id="testimonial" style="text-indent:10%;">- In 39 years of marriage we have <em><i>never</i></em> had anyone respond <em><i>so</i></em> promptly and do such a GREAT job of getting our air conditioning up and running. <u>Thank</u> <u>you</u> <u>so</u> much. </p>
								</b>
							</div>
							<div style='width:281px;height:20px;position:relative;left:3px;top:226px;'><img src="/images/testimonies_panel_fade.png" /></div>
						</div>
					</a>
				</td>
			</tr>
		</table>
		<table>
			<tr><td colspan="2">
				<div id="extralinks">
				<table class="extralinks" align="center">
					<tr>
						<td style="width:341px;">
							<a class="extralink" href="https://www.facebook.com/pages/Engineered-Comfort-Inc/112815144094" target="_blank"><div <?php echo $dynamic_link;?>><table>
								<tr><td><img src="/images/blue-icon.png" /></td>
								<td>Facebook</td></tr>
							</table></div></a>
							<a class="extralink" href="/construction.html" target="_self"><div <?php echo $dynamic_link;?>><table>
								<tr><td><img src="/images/cyan-icon.png" /></td>
								<td>Twitter</td></tr>
							</table></div></a>
							<a class="extralink" href="/construction.html" target="_self"><div <?php echo $dynamic_link;?>><table>
								<tr><td><img src="/images/red-icon.png" /></td>
								<td>YouTube</td></tr>
							</table></div></a>
							<a class="extralink" href="/construction.html" target="_self"><div <?php echo $dynamic_link;?>><table>
								<tr><td><img src="/images/logo-icon.png" /></td>
								<td>Blog</td></tr>
							</table></div></a>
						</td>
						<td style="width:341px;">
							<a class="extralink" href="/construction.html" target="_self"><div <?php echo $dynamic_link;?>><table>
								<tr><td><img src="/images/logo-icon.png" /></td>
								<td>Vendors</td></tr>
							</table></div></a>
							<a class="extralink" href="/construction.html" target="_self"><div <?php echo $dynamic_link;?>><table>
								<tr><td><img src="/images/logo-icon.png" /></td>
								<td>Associations</td></tr>
							</table></div></a>
							<a class="extralink" href="/construction.html" target="_self"><div <?php echo $dynamic_link;?>><table>
								<tr><td><img src="/images/logo-icon.png" /></td>
								<td>Newsletters</td></tr>
							</table></div></a>
							<a class="extralink" href="/in_the_news.html" target="_self"><div <?php echo $dynamic_link;?>><table>
								<tr><td><img src="/images/news-icon.png" /></td>
								<td>In The News</td></tr>
							</table></div></a>
						</td>
						<td style="width:341px;">
							<a class="extralink" href="/construction.html" target="_self"><div <?php echo $dynamic_link;?>><table>
								<tr><td><img src="/images/logo-icon.png" /></td>
								<td>Corporate</td></tr>
							</table></div></a>
							<a class="extralink" href="/construction.html" target="_self"><div <?php echo $dynamic_link;?>><table>
								<tr><td><img src="/images/links-icon.png" /></td>
								<td>Links</td></tr>
							</table></div></a>
							<a class="extralink" href="/construction.html" target="_self"><div <?php echo $dynamic_link;?>><table>
								<tr><td><img src="/images/site_map-icon.png" /></td>
								<td>Site Map</td></tr>
							</table></div></a>
							<a class="extralink" href="/construction.html" target="_self"><div <?php echo $dynamic_link;?>><table>
								<tr><td><img src="/images/copyright-icon.png" /></td>
								<td>Copyright</td></tr>
							</table></div></a>
						</td>
					</tr>
				</table>
				</div>
			</td></tr>
		</table>
	</div>
</div>
<div id="content">
	<div id="services" class="panel">
		<h2>
			Products & Services
		</h2>
		<p>
			In order to produce the High Performance Homes that we do, Engineered Comfort, Inc. must perform the work.  Except in limited and specialized situations (such as earthwork or vertical bore drilling), all aspects of Engineered Comfort, Inc.'s products are installed by Engineered Comfort, Inc.'s direct employees.  This provides security to our customers and quality control for our projects.  Our Products and Services including the following:
		</p>
		<p id="geothermal-heat-pumps">
		<span class="inline_ttl">Geothermal Heat Pumps</span>
			- Geothermal Heat Pumps are heating and air conditioning systems that use the energy stored in the earth's crust to heat and cool a building more efficiently.  The energy required to cool a home in our geographic region is approximately 50% of the energy required from a standard 13 "SEER" system.  The energy required to heat a home is 20% to 25% of the energy required to heat a home using natural gas or LP furnaces.  The net effective is that geothermal heat pumps cost about 45% of what standard air conditioning systems cost to operate and have a 4 year to 7 year simple payback once the 30% Federal Tax Credit is considered.
		</p>
		<p id="dual-fuel-heat-pumps">
		<span class="inline_ttl">Dual Fuel Heat Pumps and Standard Heating and Air Conditioning Systems</span>
			- Since June 2009, Engineered Comfort, Inc. has installed only heat pumps, either dual fuel or geothermal, in new home construction and most existing homes, where applicable.  The dual fuel heat pump cools the home just like a typical air conditioning system when cooling is needed.  In the heating mode, when the outside temperature is between 35 degrees and 65 degrees, the system operates in the heat pump mode, which is about three times more efficient than a gas furnace.  There are approximately 3,700 hours of operation in this temperature bin.   Below 35 degrees, the heat pump is de-energized and the gas or LP furnace heats the home, hence the name Dual Fuel Heat Pump.  There are approximately 900 hours of operation in this temperature bin.  The net effect is that the investment in the Dual Fuel Heat Pump technology pays itself back in 2 years or better, netting a 50% Return on Investment.				
		</p>
		<p id="cellulose-insulation">
		<span class="inline_ttl">Cellulose Insulation Systems</span>
			- Engineered Comfort, Inc. began insulating homes in 2001 with Cellulose Insulation and we have never insulated a home using fiberglass.  Cellulose Insulation is recycled, uncirculated newsprint and cardboard that has been treated with Boric Acid to prevent the product from burning and with wheat starch to act as glue when mixed with water.  In open stud walls, Engineered Comfort, Inc. sprays the Cellulose Insulation in the wall cavity with water to a 35% moisture content.  Over the course of a couple of days, the moisture content dries to below 20% where the wallboard can be installed.  In open and netted ceilings, Engineered Comfort, Inc. installs dry Cellulose Insulation to the proper thickness plus 20% to allow for settling.  When properly installed, the dry-blown Cellulose Insulation will settle at approximately 15% and the wall application of wet spray will not settle.  As we have worked with the product for 10 years, we know that it is simply the best and most economical means of obtaining a properly insulated envelope.
		</p>
		<?php echo $backtotop; ?>
		<p id="foam-insulation">
		<span class="inline_ttl">Open and Closed Cell Foam Insulation Systems</span>
			- Within the past 5 years, open and closed cell foam products have become more mainstream due to the desire to become more efficient.  Foam based insulations are very expensive and require specialized training and equipment to properly apply.  We see an approximate 5% to 8% increase in energy efficiency over the Cellulose Insulation system for a 100% to 150% premium in price.  The typical payback period for foam insulation is 20 to 30 years when compared to our Cellulose Insulation System.  As compared to fiberglass, the payback is in the 5 year to 8 year time period, at best.  There are projects that have low slope roofs where the payback is quicker; some complex projects dictate a foam solution and there are clients that want the large semi-conditioned attic space to store their things in, and that is nice.  However, buying foam specifically for the purpose of energy efficiency may have an extended payback period.
		</p>
		<p id="crawl-space-systems">
		<span class="inline_ttl">Crawl Space Encapsulation Systems and Solutions</span>
			- The crawl space of a home built on a conventional foundation is, unfortunately, part of the indoor environment in most cases.  This moist, contaminated air makes its way into the home, creating an unhealthy indoor environment.  Crawl Space Solutions involve more than simply putting down a vapor barrier.  Engineered Comfort, Inc. makes sure that liquid moisture does not enter or accumulate in the crawl space, seals the crawl space from the outdoors, installs a 100% sealed 12 mil or 20 mil vapor barrier, insulates the walls, and provides climate control of the space to insure that it is a semi-conditioned space.  Solutions to Crawl Space problems can often be complex in nature, but Engineered Comfort, Ins.'s ability to manage the moisture will create a much healthier environment both in the crawl space and in the home.
		</p>
		<aside style="float:right;"><img src="/images/thermal_img.jpg" alt="Thermal Imaging"/></aside>
		<p id="blower-door-test">
		<span class="inline_ttl">Blower Door Testing</span>
			- The term 'Blower Door Testing' encompasses many aspects of what Engineered Comfort, Inc. calls "Existing Home Diagnostics".  The Blower Door Test, the <b>Thermal Imaging</b>, the Forensic Approach to Problem Resolution, the Insulation and Envelope Inspection and the Building Heat Gain/Heat Loss Analysis provide a detailed approach to problem solving.  The Room over the Garage is uncomfortable; Engineered Comfort, Inc. can fix that.  The home is drafty in the winter; Engineered Comfort, Inc. can fix that.  Your home seems to make you and your family sick; Engineered Comfort, Inc. can fix that.  Mold is growing on the grilles or in the home; Engineered Comfort, Inc. can stop that.  The utility bill is almost as much as or more than the mortgage; Engineered Comfort, Inc. can fix that too.  If the problem is related to the indoor environment, then Engineered Comfort, Inc.'s Existing Home Diagnostics program can find the source and fix the problem.  Many businesses promote a "Home Energy Inspection", including local utility companies that do so for free.  Engineered Comfort, Inc.'s Existing Home Diagnostics offers much more than a Home Energy Audit or Inspection.  Engineered Comfort, Inc. finds the source of the problem so that the source itself can be eliminated.
		</p>
		<p>
		<span class="inline_ttl">Duct Leakage and House Leakage Remediation</span>
			- One of the most prevalent issues associated with existing and new house construction is the presence of Duct Leakage.  New Homes built in the Memphis, TN and Nashville, TN market areas are built with 25% to 40% Duct Leakage, FROM THE BEGINNING!!!  Though the energy codes call for the ducts to be sealed, there is very little enforcement of this code as many of the "Heat and Air Guys" have no concept of what it takes to properly seal a duct system.  Duct Leakage is a primary source for high energy bills, houses that dry out in the winter time, dust in homes, air conditioning systems that don't keep the house cool during the peak summer hot days, and poor indoor air quality.  ALL of these problems can effectively be eliminated by dealing with this one common deficiency in the building trades and code inspection process.  It seems so simple, doesn't it?  But the 'devil is in the details.'
		</p>
		<?php echo $backtotop; ?>
		<p id="consulting-services">
		<span class="inline_ttl">Mechanical Engineering in a Design and Build Environment</span>
			- Engineered Comfort, Inc. does not provide design of any kind to be bid on or installed by other entities.  Our designs are our property and are associated with our installations.  On light commercial related projects, Engineered Comfort, Inc. can provide stamped drawings as required for work done in the state of Tennessee.  We will work with the architect to provide the design and systems as required to meet the clients' needs.
		</p>
		<p>
		<span class="inline_ttl">Green Building Certification Assistance</span>
			- There are many Green Building programs throughout the United States.  USGBC has the LEED Certification Process.  The National Home Builders Association has their National Green Building Program.  There is the EarthCraft program from the Southface Institute group in Atlanta, and there is the EPA's Energy Star program, which, though not a green certification, is the basis for most of the energy efficiency criteria for the other Green Building programs.  Engineered Comfort, Inc., has participated in most of these programs and others several times and we are well acquainted with the points systems associated with each program.  Beginning this process early, obtaining an Architect that knows the ropes, and employing a Green Rater that is certified in the program you desire to achieve are key to the success of these projects.  Engineered Comfort, Inc. makes it easy on the Green or HERS Rater; Green Building and Energy Efficient Homes are all that we have ever done for 10 years, so we understand what is required.  Engineered Comfort, Inc. was helping to produce Green Homes before Green Home programs were established.
		</p>
		<aside style="float:right;"><img src="/images/radiant_floor.jpg" alt="Radiant Floor Heating"/></aside>
		<p>
		<span class="inline_ttl">Radiant Floor Heating</span>
			- Heating homes with radiant floor tubing systems is one of the most effective means of heating a home.  In this region of the country, if purchasing a radiant floor heating system, the client is usually purchasing two heating systems, as one heating system is typically available with the cooling system and ducting.  Radiant Floor Heating is very comfortable and the home stays at a very even temperature all over.  If the budget allows, Radiant Floor Heating, especially with Geothermal Heat Pump System technology, is a very efficient, very comfortable way to heat a home.
		</p>
		<p id="HVAC-system-service-and-maintenance">
		<span class="inline_ttl">HVAC System Service and Maintenance</span>
			- Air Conditioning and Heating Systems Service is a key element of the program at Engineered Comfort, Inc.  Air Conditioning Systems are expensive, and when they break, they need to be repaired by someone who knows how they were designed and installed to operate.  Engineered Comfort, Inc. provides Service and Repair for all makes of Air Conditioning Systems for homes where we installed the original equipment and for other homes as well.  We desire a relationship with the client and the systems so that Engineered Comfort, Inc. technicians know what is required before they even arrive at the client's home.  Our desire is to implement the Engineered Comfort, inc. Equipment and Efficiency (Preventive) Maintenance Program for every home we touch.  No one can guarantee that a system will not fail, because these are mechanical devices.  However, conducting a twice-per-year Equipment and Efficiency Maintenance Program will significantly reduce the chances of failure while keeping the equipment operating in Like New Condition.  The programs are scalable to your needs and your budget, but having the equipment maintained regularly will save you money on your utility bill, insure the manufacturer's warranty is good, make your systems heat and cool more effectively and reduce the down time associated with failure.  Also, maintenance customers have access to our weekend and after-hours service availability.
		</p>
		<?php echo $backtotop; ?>
		<h2>Things we do not do and why:</h2>
		<p>
		<span class="inline_ttl">HERS Testing and Certification</span>
			- The Home Energy Rating System (HERS) Testing and Certification that is required for Energy Star, LEED and other Green Building Programs needs to be accomplished by a third party to the project; that is, by someone who isn't associated with the actual installation of the work.  Many of these programs require that the testing entity be third party.  It makes a lot of sense and brings credibility to our work and the job as a whole.  Walter Nelms and Engineered Comfort, Inc. were some of the first certified HERS Raters in the state of Tennessee in 2001, but dropped the accreditation in 2005 due to the increasing prevalence of the third party aspect.  We still conduct the same tests that are sanctioned by HERS, Energy Star and LEED on our homes in order to insure compliance with our standards, but if you want a home to be certified under one of these programs, then a third party is required.
		</p>
		<p>
		<span class="inline_ttl">Mold Testing and Remediation</span>
			- Engineered Comfort, Inc. is involved in the forensic testing and remediation of the causes for mold growth in many homes.  We are in a mixed-humidity environment, and the leaking homes and over-sized air conditioning systems that have been built since the early 1950's have a propensity to grow mold.  However, the identification and removal of the mold itself must be done by an entity certified to do that type of work.  They have specific training in the area of mold remediation and the tools, equipment and expertise to remove the mold.  They also have the necessary insurance to cover your liability in the area of mold remediation.  Once the source of the mold is determined and the mold is removed, Engineered Comfort, Inc. can make the necessary remediation to limit the ability of the mold to return.  It takes food (which is everywhere), the right temperature (which is our comfort temperatures), and a high enough moisture level for mold to grow.  It takes all three.  The aspect that we can control is moisture and we know how to do that.
		</p>
		<p>
		<span class="inline_ttl">Vertical Bore Drilling/Major Earthwork</span>
			- Due to the limited number of days per year that we involve this service and the high expense of man and machinery to do this type work, Engineered Comfort, Inc. has key subcontractors that we use to accomplish this critical level of work.   All subcontractors are licensed and insured businesses.
		</p>
		<p>
		<span class="inline_ttl">Bid and Spec Projects</span>
			- By its nature, Engineered Comfort, Inc. is a design and build entity where we produce our own designs for a project and then install the systems that we design.   Since our designs and installations exceed the building, mechanical and energy codes, typical bid and spec projects don't achieve the performance that our systems provide and are generally a bit less expensive.  When other air conditioning contractors that don't have our High Performance ideals are bidding a job to see who can get the cheapest, the only entity that loses in the deal is the client.  We opt out of this environment as we cannot produce our level of work in an environment that is, by its nature, designed to be adversarial and cheap.   We elect to compete with our ideas, our character and the performance of our systems.
		</p>
		<?php echo $backtotop; ?>
	</div>
	<div id="about-us" class="panel">
		<h2>
			About Us
		</h2>
		<p>
			Engineered Comfort, Inc. is in business to make new and existing homes more efficient, more comfortable and healthier.  Based in Memphis, TN, Engineered Comfort, Inc. has had operations in the Memphis, TN area since 2001 and in the Nashville, TN area since 2007.  Every aspect of our business, our people, our product and our services is for the purpose of creating high performance indoor environments that are efficient, comfortable and healthy.    Engineered Comfort, Inc. has multiple EPA Energy Star rated and MLGW Eco-Build Certified homes and three USGBC LEED certified homes in operation.
		</p>
		<p>
			We achieve High Performance Homes by:
		</p>
		<ul style="margin-left:50px;">
			<li>Engineering excellence coupled to installation quality control</li>
			<li>Mechanical (HVAC) Contracting - - installing the HVAC and Geothermal Heat Pump Systems</li>
			<li>Geothermal Heat Pump Systems, complete to include ground and lake loop design and installation</li>
			<li>Installation of Cellulose Insulation Systems</li>
			<li>Installation of Open Cell Foam Insulation Systems including Encapsulated Attic Spaces</li>
			<li>Crawl Space Solutions - Vapor Barrier, Encapsulated Crawl Spaces and Moisture Control</li>
			<li>Indoor Air Quality Solutions - Duct sealing, high MERV filtration, HEPA Filtration</li>
			<li>Blower Door Testing - Forensic Home Diagnostics for existing homes, Quality Control for new homes</li>
		</ul>
		<p>
			By High Performance, the homes that we help produce are more comfortable indoors and have better indoor air quality, as well as lower energy costs.  Typical homes have one ton of air conditioning for every 400 to 500 square feet of conditioned space.  Engineered Comfort High Performance Homes typically have one ton of air conditioning for every 650 to 800 square feet of conditioned space.  Our most efficient design has a single 5 ton unit serving a 5,300 square foot home with a projected energy bill of $75.00 per month average.  That's 1,060 square feet of conditioned space per ton of air conditioning.  This home will use 33% of the energy that a typical home uses for heating and cooling, with less than one half of the air conditioning capacity, AND it will be totally comfortable in every room.    THAT'S High Performance.
		</p>
		<p>
			Whether you are building a New Home or New Building or if you have an Existing Home or Existing Building that is inefficient, uncomfortable or unhealthy, Engineered Comfort, Inc. can provide the information you need to make an informed decision and the services necessary to deliver the end product, which is a High Performance Indoor Environment.
		</p>
		<p>
			A High Performance Indoor Environment is more comfortable, durable, efficient and healthy by design.
			<ul style="margin-left:50px;">
				<li>High Performance Homes are obtained by first meeting, then exceeding the requirements of the local building, mechanical and energy codes.</li>
				<li>Every room is engineered for comfort, efficiency and health.</li>
				<li>The building envelope (that which separates indoors from outdoors) is sealed and properly insulated with insulation that actually works.  We do NOT use fiberglass as insulation.</li>
				<li>The HVAC Systems are engineered by a Licensed Mechanical Engineer to work with the building envelope that we can create, to include walls, ceilings, orientations, windows, etc.  With an existing home, an initial blower door test is the essential starting point to determining the system design.</li>
				<li>Once the system is designed, the implementation of the construction process is monitored and managed to meet the design and tight specification standards.  One of our competitors once told a potential client of ours, "if you are going to let Engineered Comfort do the job, then everything has to be right".  We took his comment as a complement for us as well as an indictment of our industry.</li>
				<li>When the construction is near completion, the home is tested by blower door testing, visual inspection and thermal imaging to insure that the design standards have been met.</li>
				<li>Once the new or existing home construction is completed, Engineered Comfort, Inc.'s Equipment and Efficiency Maintenance Program keeps the systems in Like New condition.</li>
			</ul>
		</p>
		<?php echo $backtotop; ?>
	</div>
	<div id="efficient_narrative" class="panel">
		<h2>
			Efficient
		</h2>
		<p>
			When we speak of Efficiency, it is in context of the entire indoor environment that we are creating to separate us from the outdoor environment.  Efficiency of the homes and buildings that we are constructing is becoming ever more important.  As the United States has limited resources in the production of energy, the impact we are having in the environment needs to be better managed, and the economics of the inefficient home are just going to cost too much to afford in the future.  The aspect of comfort and health must influence the decisions around Efficiency.  For example, one could make a home extremely efficient by not installing a mechanical air conditioning system at all.  That would save A LOT of money.  However, the home would then be uncomfortable and would not provide the desired balance of Efficiency, Comfort and Health.
		</p>
		<p>
			To obtain Efficiency, the building envelope must be as tight as possible and a superior insulation system must be attached to this tight air barrier that separates indoors from outdoors.  If fresh air is needed, then it is mechanically provided to the air conditioning system and filtered before it is introduced into the indoor air space.  Once the envelope is complete and the insulation system contiguous with the envelope, then the air conditioning system must be properly sized and designed and then installed with duct leakage of less than 5% to the outdoors, preferably between 2% and 3%.  At this point, the home or building is an efficient home and the selection of the equipment efficiency can then be made.
		</p>
		<p>
			Equipment Efficiency has some degree of impact on the performance of the home as a system, but less of an impact than sealing the home and duct systems and properly insulating the building envelope.  The SEER (Seasonal Energy Efficiency Ratio) rating for an air conditioning system is, for the most part, misleading.  For instance, a 3 ton 13 "SEER" unit has an Energy Efficiency Ratio (the real number) of 11.50 at 95 degrees outdoors.  The 3 ton 21 "SEER" unit has an Energy Efficiency Ratio of 13.20 at 95 degrees outdoors.  That's a 15% percent improvement for a very high premium first cost.  The payback is in excess of 15 years, which is the life of the appliance.  The 3 ton Geothermal Heat Pump System has a full load EER of 18.0, which is nearly 40% more efficient than the 13 "SEER" equipment.  The Geothermal Heat Pump Systems are installed for about the same price as the "21 SEER" equipment after the Federal Tax Credit is taken into account.
		</p>
		<p>
			Our philosophy is to make the home and duct system efficient first, then select which equipment efficiency best fits your budget and investment strategies.  
		</p>
		<?php echo $backtotop; ?>
	</div>
	
	<div id="comfortable_narrative" class="panel">
		<h2>
			Comfortable
		</h2>
		<p>
			Now, what is the reason that people even install air conditioning and heating systems in their homes?  COMFORT.  We all want to go inside and have a comfortable living space to live in with our families.  Though efficiency is important, our view is, 'What is the optimal energy use to achieve the desired comfort level.'  You could simple cut the air conditioning system off when it is 95 degrees outside to save energy , but the comfort level would be horrible.  So, if you are going to keep an indoor environment comfortable, how can it be installed to minimize the energy required while also keeping the indoor environment healthy?
		</p>
		<p>
			Sealing the house up, sealing the duct up, properly sizing the air conditioning systems and installing better filters will prevent both low and high humidity conditions and make your home more comfortable.   One key element of this statement is 'Properly Sized Air Conditioners.'  Most 'Heat and Air Guys' size the air conditioning equipment on a square foot per ton method, which is ridiculous.  If your contractor approaches your design in this fashion, find another contractor immediately.  Running a heat and cooling load calculation, such as the Air Conditioning Contractors Association Manual J Calculations, is essential.  Engineered Comfort, Inc. uses the American Society of Heating Refrigeration and Air Conditioning Engineers CLTD method and bases the load design on the insulation and air leakage numbers that we know are going to occur in the home.  These calculations are key to the design and comfort control as over-sized air conditioning units can create bad indoor air environments and make you uncomfortable.
		</p>
		<p>
			The purpose of the systems we install is to make you comfortable.  Most of the time, less capacity will make your indoor environment more comfortable.    Our philosophy is to make the home and duct system efficient first, then select which equipment efficiency best fits your budget and investment strategies.
		</p>
		<?php echo $backtotop; ?>
	</div>
	
	<div id="healthy_narrative" class="panel">
		<h2>
			Healthy
		</h2>
		<p>
			The Indoor Air Quality and the Health of the Indoor Environments that we are building are becoming ever more important in the United States.  Though Engineered Comfort, Inc. and the systems we install cannot heal someone of an illness, the proper implementation of our systems can make the environment that one is living in far healthier in some key areas.
		</p>
		<p>
			<b>Humidity</b> - Most 'Heat and Air Guys' don't really understand how to properly control temperature within a home, much less how to control the humidity.  Their approach is to install bandages such as humidifiers and dehumidifiers in the home to try to cover up the mistakes that they make in the installation process.  If the humidity in the home gets too high in the summer, molds can grow.  If the humidity in the home gets too low in the winter, then viruses flourish.  Both conditions are bad for your health and both conditions are specifically created by poor installation of the air conditioning and heating systems and the insulation.  The summer of 2010 exacerbated these installation flaws, and mold was growing in homes everywhere.  Sealing the house up, sealing the duct up, properly sizing the air conditioning systems and installing better filters will prevent both low and high humidity conditions and will make your home more comfortable.
		</p>
		<p>
			<b>Dust</b> - In order to have an air leak that brings duct into a home, there must be a hole and either a temperature or a pressure difference.  We can't control the temperature and pressure differences as they are ever changing.  We can, however, control the hole.  Sealing the house up, sealing the duct up, properly sizing the air conditioning systems and installing better filters will prevent dust and pollen conditions within the home and will make your home more comfortable.
		</p>
		<p>
			<b>Filtration Efficiency</b> - The standard filter track that is installed by Engineered Comfort, Inc. will hold up to a 4" thick filter which can have as high as a MERV 13 efficiency.  This is an efficient filter that removes most of the dust that can travel in the air stream.   If further filtration or air treatment is needed, MERV 16 filters, air purifying filters and HEPA filter systems are available as options to any system.
		</p>
		<p>
			Our philosophy is to make the home and duct system efficient first, then select which equipment efficiency best fits your budget and investment strategies.  
		</p>
		<?php echo $backtotop; ?>
	</div>
</div>
<?php
if(isset($_GET['msg']))
{
	if($_GET['msg'] == 'logged_in')
	{
		$alert = 'You are already logged in.';
	}
	elseif($_GET['msg'] == 'logged_in_as_other')
	{
		$alert = 'Please log out of your current session (' . $_SESSION['username'] . ') before changing sessions.';
	}
	else
	{
		$alert = 'Not allowed.';
	}
	echo "<script language='javascript'>
		alert('" . $alert . "');
	</script>";
}
?>
<?php include __DIR__ . '/template/footer.php'; ?>