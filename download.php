<?php
session_start(); // Begin a session.
//--------------------------------

/* The array below is a multidimensional array.
The first column is the name that will be given to the file sent to the user.  This is what it will be called when saved on his computer and does not neccessarily have to be the same as the name of the original file in the server.
The second column contains the locations of all downloadable files (INCLUDING the name and file type).
The next two columns give the corresponding permissions of the files. (More specifically, who has permission to download the file.)
The last column contains an array that lists all directories and subdirectories that need to have access restrictions removed. They are included in a separate list to prevent placing restrictions on directories that were not meant to be restricted.
**NOTE** Make sure that all subdirectories in this array are listed AFTER their parent directories. This IS important!

Permissions:
1st column indicates whether the file requires that the visitor be an architects member. (1/0)
2nd column indicates whether the file requires that the visitor be a builders member. (1/0)
*/

// To add a file, enter it in the array below as such:
// array([file_location], [architects_perm(1/0)], [builders_perm(1/0)])

// Files
$files = array(
array("test.pdf", '/downloads/pdf/test.pdf', 1, 0, array('/downloads', '/downloads/pdf'))
);

//--------------------------------

// Functions --------
function logout($id) // This function runs ever time a user logs out or is logged out.
{
	session_destroy();
	session_unset();
	unset($_SESSION);
	mysql_query("UPDATE Members SET logged_in = 0
	WHERE id = " . $id);
}

function error($err, $file) // Runs if the user cannot download the selected file/
{
	switch($err)
	{
		case 'logged out':
			header("HTTP/1.0 401 Unauthorized");
			//header("WWW-Authenticate: Basic realm=\"Secure Area\"");
			echo "<h1>Error 401: Unauthorized: <br /><em>$file</em><br />The file you requested is available with permission.  If you have permission to view this file, please log in first.</h1>";
			break;
		case 'permission denied':
			header("HTTP/1.0 401 Unauthorized");
			//header("WWW-Authenticate: Basic realm=\"Secure Area\"");
			echo "<h1>Error 401: Unauthorized: <br /><em>$file</em><br />The file you requested is available with permission.  You can apply for the permission needed to view this file at www.engineeredcomfort.net.</h1>";
			break;
		case 'mobile':
			header("HTTP/1.0 403 Forbidden");
			echo "<h1>Error 403: Forbidden: <br /><em>$file</em><br />For security purposes, secure files cannot be downloaded on any mobile device. The server has detected that you are browsing with a mobile device.</h1>";
			break;
		case '404':
			header("HTTP/1.0 404 Not Found");
			echo "<h1>Error 404: File Not Found: <br /><em>$file</em></h1>";
			break;
		default:
			header("HTTP/1.0 500 Internal Server Error");
			echo "<h1>Error 500: Internal Server Error: <br /><em>$file</em></h1>";
			break;
	}
}
// --------

// First of all, check to see whether the user is browsing with a mobile device.
$mobile = false;
include __DIR__ . '/mobile_devices.php'; // Get the list of mobile devices. Set $mobile to true if the visitor is using a device from this list.
// The perm variables tell whether the visitor needs to have special permission to download his requested file. Default is true.
$arch_perm = true;
$build_perm = true;
// $file_found will be set to true if the file is found in the files list. Default is false.
$file_found = false;
$logtime = 1800; // This is the amount of time in seconds that the user may remain inactive before being forced to log off.
$directory_perms = 0775; // This is the octal expression for the perms to be granted to directories and subdirectories when downloading a file.

// Get the name of the file requested for download.
$name = $_GET['name'];

// Run a loop to check to see if that file is in the list of available files.
for($n = 0, $size = sizeof($files); $n < $size; $n++)
{
	if($name == $files[$n][0]) // If that file is found, record the permissions, set $file_found to true, and break out of the for loop.
	{
		$file = $files[$n][1];
		$arch_perm = $files[$n][2];
		$build_perm = $files[$n][3];
		$directories = $files[$n][4];
		$file_found = true;
		break;
	}
}

// If the file was found, check to see if the visitor has the proper permissions.
if($file_found == true)
{
	// If the visitor needs no permissions for this particular file, then allow him to download it.
	if(($arch_perm == false) && ($build_perm == false))
	{
		//--download--
		// Remove all restrictions from the neccessary directories.
		for($n = 0, $size = sizeof($directories); $n < $size; $n++)
		{
			chmod($directories[$n], $directory_perms);
		}
		if(fileperms($file)) // Get and record the perms of the file to be downloaded.
		{
			$perms = fileperms($file);
			if(chmod($file, 0664)) // Attemt to change the permissions of the file.
			{
				if(file_exists($file) && is_readable($file) && preg_match('/\.pdf$/',$file)) // If the file can be downloaded, then download it.
				{
					header('Content-type: application/pdf');
					header("Content-Disposition: attachment; filename=\"$name\"");
					readfile($file);
				}
				else
				{
					error('404', $file);
				}
				chmod($file, $perms); // Restore the original permissions to the file.
				break;
			}
			else
			{
				error('404', $file);
			}
		}
		else
		{
			error('404', $file);
		}
		// Restore all restrictions to the neccessary directories.
		for($n = sizeof($directories)-1; $n >= 0; $n--)
		{
			chmod($directories[$n], 0000);
		}
	}
	elseif($mobile == false)
	// If the user isn't browsing with a mobile device, then he may download secure files. If he is, he may not.
	{
		// If the file requires some form of permission, check to see if this user has that permission.
		// First, check to see if the user is logged in. (If he isn't, then he cannot download the file.)
		if(isset($_SESSION['username']) && isset($_SESSION['id']) && ($logout != true))
		{
			$con = mysql_connect("secrethost","secretuser","secretpassword"); // Connect to the database.
			mysql_select_db("Accounts", $con); // Select the Accounts database.
			
			$visitor = mysql_query("SELECT * FROM Members
			WHERE username='" . $_SESSION['username'] . "' AND id='" . $_SESSION['id'] . "'");
			while($row = mysql_fetch_array($visitor))
			{
				// Ensure that the user's IP address is the one recorded in the database. If it is not, then tell him so and sign him out.
				if($row['ip'] != $_SERVER['REMOTE_ADDR'])
				{
					logout($_SESSION['id']);
					error('logged out', $file);
				}
				// Ensure that the user has not been inactive for an extended period of time ($logtime is the number of seconds that he is permitted to be inactive before being logged out automatically).
				elseif(time() - $row['lastvisit'] > $logtime)
				{
					logout($_SESSION['id']);
					error('logged out', $file);
				}
				// Ensure that the user is not recorded as having logged out. If he is, then log him out.
				elseif($row['logged_in'] == false)
				{
					logout($_SESSION['id']);
					error('logged out', $file);
				}
				// If the user is not being forcibly logged out, then check to see if he has the proper permissions to download the file.
				// Also reset his last visit time to the current time.
				else
				{
					mysql_query("UPDATE Members SET lastvisit = '" . time() . "'
					WHERE username = '" . $row['username'] . "' AND id = '" . $row['id'] . "'");
					
					// If the permissions in the databse grant him access to this file, then give it to him.
					if(($row['architect'] >= $arch_perm) && ($row['builder'] >= $build_perm))
					{
						//--download--
						// Remove all restrictions from the neccessary directories.
						for($n = 0, $size = sizeof($directories); $n < $size; $n++)
						{
							chmod($directories[$n], $directory_perms);
						}
						if(fileperms($file)) // Get and record the perms of the file to be downloaded.
						{
							$perms = fileperms($file);
							if(chmod($file, 0664)) // Attemt to change the permissions of the file.
							{
								if(file_exists($file) && is_readable($file) && preg_match('/\.pdf$/',$file)) // If the file can be downloaded, then download it.
								{
									header('Content-type: application/pdf');
									header("Content-Disposition: attachment; filename=\"$name\"");
									readfile($file);
								}
								else
								{
									error('404', $file);
								}
								chmod($file, $perms); // Restore the original permissions to the file.
								break;
							}
							else
							{
								error('404', $file);
							}
						}
						else
						{
							error('404', $file);
						}
						// Restore all restrictions to the neccessary directories.
						for($n = sizeof($directories)-1; $n >= 0; $n--)
						{
							chmod($directories[$n], 0000);
						}
					}
					else
					{
						error('permission denied', $file);
					}
				}
			}
		}
		else
		{
			error('logged out', $file);
		}
	}
	else
	{
		error('mobile', $file);
	}
}
else
{
	error('404', $file);
}
?>