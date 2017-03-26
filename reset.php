<?php

// Connect to MySQL
    $username = "root"; 
    $password = ""; 
    $host = "localhost:3306"; 
    $dbname = "thetweaks_nitrr";
	$con = mysql_connect($host,$username,$password);
	mysql_select_db($dbname); 
    
// Was the form submitted?
if (isset($_POST["ResetPasswordForm"]))
{
	// Gather the post data
	$email = $_POST["email"];
	$password = $_POST["password"];
	$confirmpassword = $_POST["confirmpassword"];
	$hash = $_POST["q"];

	// Use the same salt from the forgot_password.php file
	$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

	// Generate the reset key
	$resetkey = hash('SHA1', $salt.$email);

	// Does the new reset key match the old one?
	if ($resetkey == $hash)
	{
		if ($password == $confirmpassword)
		{

			// Update the user's password
				$query = "UPDATE users SET password = SHA('$password') WHERE username = '$email'";
				$result = mysql_query($query, $con);
				$conn = null;
			echo "Your password has been successfully reset.";
		}
		else
			echo "Your password's do not match.";
	}
	else
		echo "Your password reset key is invalid.";
}

?>