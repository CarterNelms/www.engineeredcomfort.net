<?php
// This list was originally taken from the technique posted at http://forums.macrumors.com/archive/index.php/t-205417.html
$mobile_devices = array(
'Blazer' ,
'Palm' ,
'Handspring' ,
'Nokia' ,
'Kyocera',
'Samsung' ,
'Motorola' ,
'Smartphone',
'Windows CE' ,
'Blackberry' ,
'WAP' ,
'SonyEricsson',
'PlayStation Portable',
'LG',
'MMP',
'OPWV',
'Symbian',
'EPOC',
);

foreach($mobile_devices as $device) // Check to see if any of these match with the user's device
{
	if(strpos($_SERVER['HTTP_USER_AGENT'], $device)) // If any of them do, then set $mobile to true.
	{
		$mobile = true;
		break;
	}
}
?>