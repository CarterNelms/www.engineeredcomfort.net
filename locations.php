<?php include __DIR__ . '/template/head.php'; ?>
<title>Engineered Comfort, Inc : Locations</title>
<script language="javascript" src="/scripts/locations.js"></script>
<script language="javascript">
var locations = cities();
function printLocations()
{
	col_count = 3;
	var col_length = Math.ceil(locations.length/col_count);
	var n = 0;
	var printout = "<table align='center' style='text-align:left;'><tr>";
	for(n = 0; n < col_count; n++)
	{
		printout += "<td><ul style='list-style:none;'>";
		if((n+1) == col_count)
		{
			last_col_length = locations.length - col_length*n;
			for(m = 0; m < col_length; m++)
			{
				if(m < last_col_length)
				{
					printout += "<li>" + locations[m+(col_length)*n];
				}
				printout += "<br />";
			}
		}
		else
		{
			for(m = 0; m < col_length; m++)
			{
				printout += "<li>" + locations[m+(col_length)*n];
				if((col_length-m)>1)
				{
					printout += "<br />";
				}
			}
		}
		printout += "</ul></td>";
	}
	printout += "</tr></table>";
	
	document.getElementById('locations').innerHTML = printout;
}
</script>
</head>

<body onload="printLocations();">
<?php include __DIR__ . '/template/header.php'; ?>
<h1>Locations</h1>
<div class="panel" style="text-align:center;">
	<img src="/images/locations_map.png" style="width:600px;height:auto;margin:30px;border:3px solid #082983" align="center" />
	<div style="margin:30px;text-align:left;">
		Engineered Comfort, Inc. services homes and buildings in and around the Memphis and Nashvilles areas. We span across most of Tennessee and even into Arkansas and Mississippi. Below is a list of many of the cities and areas where we have worked.
	</div>
	<div id="locations"></div>
</div>
<?php include __DIR__ . '/template/footer.php'; ?>