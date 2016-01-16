<?php
if($_SERVER['SERVER_PORT'] == 443)
{
	session_set_cookie_params(
		0, // Lifetime
		'/', // Path
		.hostingprod.com, // Domain
		true, // Secure (T/F)
		true // Server-side only (T/F)
	);
	session_start();
}
?>