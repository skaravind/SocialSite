<?php
   require_once('appvars.php');
   require_once('connectvars.php');
       $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	   $query = "SELECT * FROM users";
       $data = mysqli_query($dbc, $query);
	   
   while($row = mysqli_fetch_array($data)){
	   
   $username = $row['username'];
   $password = $row['password'];
   echo '<p> username ' . $row['username'] . '</p>';
   echo sha1('$password');
 }  
   ?>