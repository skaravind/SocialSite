<?php require_once('startsession.php'); define('DB_HOST', 'localhost');	  define('DB_USER', 'thetweaks_nitrr');	  define('DB_PASSWORD', 'Nitrr12!');	  define('DB_NAME', 'thetweaks_nitrr');   $dbc = mysqli_connect( DB_HOST,DB_USER,DB_PASSWORD,DB_NAME );  
 if($_POST["rating"]) {
	   $user_id=$_POST["user_id"];
 	   $queryrate = mysqli_query($dbc,"SELECT * FROM tbl_rate_autobiography WHERE user_id = '".$user_id."' and touser_id='".$_SESSION['user_id']."'") or die(mysqli_error($dbc));
   if(mysqli_num_rows($queryrate)==0) {
		mysqli_query($dbc, "insert tbl_rate_autobiography value(null,'".$_SESSION['user_id']."','".$_POST["rating"]."',NOW(),'".$user_id."')");
		}
   else {
		mysqli_query($dbc, "UPDATE tbl_rate_autobiography SET ratingnum='" . $_POST["rating"] . "' WHERE user_id = '".$user_id."' and touser_id='".$_SESSION['user_id']."'");
		} 
	}
	echo $_POST["rating"].$user_id;
/* Coded by Jain software. Developer Rahul Rajak. */
?>