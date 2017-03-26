<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8" />	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	<meta name=viewport content="width=device-width,initial-scale=1,user-scalable=no">		
      <title>Signup to Thetweaks</title>
	  <link rel="stylesheet" type="text/css" href="welcome_style.css" />
  
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
.navbar-default {
    background-color: #36465d;border-color: #36465d;
}
body{
	    background: #F1F1F1;
}
 .logoname{
	   color: inherit;
	   display: block;
	   padding:15px ;
	   font-size:3rem;
    line-height: 1.75rem;
    font-family: "Guardian Egyptian Web","Guardian Text Egyptian Web",Georgia,serif;
    font-weight: 900;
  }
</style>
	  </head>
<body>
<?php include_once("analyticstracking.php") ?>
     <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand logoname" href="index.php">the<font color=" #6db4ff">tweaks</font></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
          <ul class="nav navbar-nav navbar-right">
		       <li><a href="about.php">About</a></li>
			    <li><a href="contact.php">Contact</a></li>    
			   <li><a href="signup.php">Signup</a></li>
			   <li><a href="index.php">Login</a></li>
          </ul>
           </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="container"  style="margin-top:130px;">
<div class="row">
        <div class="col-md-5 col-sm-5 col-xs-12 col-md-offset-3 col-sm-offset-3" style=" background: #fff;">
            <div id ="sign_head"><h1 align ="center">Sign up<h1></div>
 <?php
   require_once('appvars.php');
   require_once('connectvars.php');
   
if(isset($_POST['submit'])) {
	$first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
	$last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
	$username = mysqli_real_escape_string($dbc, trim($_POST['username'])); 
	$password1 = mysqli_real_escape_string($dbc, trim($_POST['password1'])); 
	$password2 = mysqli_real_escape_string($dbc, trim($_POST['password2'])); 
	
  
  
   if(!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
     $query = mysqli_query($dbc,"SELECT * FROM users WHERE username = '".$username."'") or die(mysqli_error($dbc)); 
	 
	  if(mysqli_num_rows($query)==0){
		  
		  $query = "INSERT INTO users(first_name,last_name,username,password,join_date) VALUES('$first_name','$last_name','$username',SHA('$password1'),NOW())";  
		  
		  $result = mysqli_query($dbc,$query) or die(mysqli_error($dbc));
		  $id=mysqli_insert_id($dbc);
		  mysqli_query($dbc,"INSERT INTO tbl_notification VALUES(null,NOW(),NOW(),'".$id."')") or die(mysqli_error($dbc));
		     echo '<p style="color:green;">Once you join, the first thing you will want to do is go to edit profile,update profile image ,Update bio etc.</p><br>
			       <p>Your account has been successfully created.You\'re now ready to <a href ="index.php"> <button>Login</button></a>.</p> ';
	      mysqli_close($dbc);
		  exit();
      }
	  else {
		     echo '<p class ="error">An Account already exists for this email.please use a different email.</P>';
			 $username = "";
	       }
   }
   else {
	   echo '<p class ="error">Sorry,You must enter both are equal password or fill correctly.</p>';
        }
} 
   mysqli_close($dbc);
?>
   <div id ="bord" class="">
   <p>Please enter Name,email,password and profile image for join to Thetweaks.</p>
   <form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
     
	 <div class="col-md-12 col-sm-12 col-xs-12">
	 <div class="row">
     <input type ="text" id = "firstname" name ="firstname" placeholder="First Name" value ="<?php if(!empty($first_name)) echo $first_name;  ?>" />
	  <input type ="text" id = "lastname" name ="lastname" placeholder="Last Name" value ="<?php if(!empty($last_name)) echo $last_name;  ?>" />
      </div>  
</div>	  
	<input type="text" id ="username" name ="username" value ="<?php if(!empty($username)) echo $username; ?>" placeholder ="Email" /><br />
     <input type ="password" id ="password1" name ="password1" placeholder="Password" /><br />
     <input type ="password" id ="password2" name ="password2" placeholder="Confirm Password"/><br>
     <input type ="submit" value ="Sign me up !" name ="submit" />
     </form>
	 </div>
	 </div>
	 </div>
	 </div>
	  <script src="js/jquery-1.12.3.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>
</body>
</html>	 