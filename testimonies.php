<?php include __DIR__ . '/template/head.php'; ?>
<title>Engineered Comfort, Inc : Testimonies</title>
<script language="javascript" src="/scripts/testimonies.js"></script>
<script language="javascript">
function printTestimonies(){
// This is a list of the people who have testified for Engineered Comfort.
var testifyers = getTestifyers();
// This is a list of the corresponding testimonies from the 'testifyers' array.
var testimonies = getTestimonies();
var num = 0;
var printout = "";
var start_quote = "<blockquote id='testimonial' style='text-indent:5%;'>-";
var newPara = "</blockquote><blockquote id='testimonial' style='text-indent:5%;'> ";
var end_quote = "</blockquote><p style='text-align:right;'>- ";
for(num = 0; num<testifyers.length; num++)
{
	if((num != 0) && (testifyers[num] != testifyers[num-1]))
	{
		printout += "<hr />";
	}
	if((testifyers[num] == testifyers[num+1]) && (num != testifyers.length-1))
	{
		if((testifyers[num] != testifyers[num-1]) && (num != 0))
		{
			printout += start_quote;
		}
		else
		{
			printout += newPara;
		}
		printout += " " + testimonies[num];
	}
	else if(testifyers[num] == testifyers[num-1])
	{
		printout += newPara + testimonies[num] + end_quote + testifyers[num] + "</p>";
	}
	else
	{
		printout += start_quote + " " + testimonies[num] + end_quote + testifyers[num] + "</p>";
	}
}
document.getElementById("testimonies").innerHTML = printout;
}
</script>
</head>

<body id="top" align="center" onload="printTestimonies();">
<?php include __DIR__ . '/template/header.php'; ?>
<h1>
	Testimonies
</h1>
<div id="testimonial" class="content" align="left">
	<div id="testimonies" class="panel" style="padding:3% 10% 0px 10%;margin:50px 25% 30px 25%;">
	</div>
</div>
<?php include __DIR__ . '/template/footer.php'; ?>