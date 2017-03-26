<?php session_start();
  require_once('connectvars.php'); 
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Thetweaks - Login and Signup</title>
<meta name="description" content="Welcome To Thetweaks.A global platform for everyone answering a simple question:What's your idea of the problem you're facing? follow your friends,teachers.">
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1">
 <link rel="stylesheet" type="text/css" href="welcome_style.css" />  
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
<style>
.navbar-default {
    background-color: #36465d;border-color: #36465d;
}
body{
	    background:white;
}
  .navbar {
      margin-bottom:0;
      background-color:#36465D;
      z-index: 9999;
      border: 0; 
      border: 0; 
      font-size: 14px !important;
      line-height: 1.42857143 !important;
      border-radius: 0;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #F1F1F1 !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #36465D !important;
      background-color: #F1F1F1 !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #F1F1F1 !important;
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
  .tagline {font-size:16px; color:#36465D;}
  
  .nav-tabs li a {
      color: #777;
  }
  .tab-pane {
	   margin-top:40px;
  }
  .contact {
	  font: 400 15px/1.8 Lato, sans-serif;
      color: #777;
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
			   <li><a href="index.php">Login</a></li>
			   <li><a href="signup.php">Sign Up</a></li>
          </ul>
           </div><!--/.nav-collapse -->
      </div>
    </nav>
	<?php
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grab the user-entered log-in data
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT user_id, username FROM users WHERE username = '$user_username' AND password = SHA('$user_password')";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['username'];
		  
         /*  setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/welcome.php';
          header('Location: ' . $home_url); */
		  
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your username and password to log in.';
      }
    }
  }
  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['user_id'])) {
    echo '<p class="error">' . $error_msg . '</p>';
?>
	
	<div class="container"  style="margin-top:60px;">
<div class="row">
    <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1"> 
	  <div id ="welcome" class="col-md-12 col-sm-12 col-xs-12"><h1 style="text-align:center;"><b>Welcome To <font color="#487ec5">thetweaks</font></b></h1></div>
	  <div class="col-md-10 col-sm-10 col-xs-12" style="margin-top:20px; padding-left:20px;"><p>A platform to share your ideas and tweak the world becoz <b>"Its not about you, Its about us" !</b></p> </div>  
       <div id ="" class="col-md-5 col-sm-5 col-xs-12">
				
				    <div id ="login" class="col-md-12 col-sm-12 col-xs-12">
					     <h3>Login</h3>


  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
     
      <label for="username" id ="name-text">Email</label><br />
      <input type="text" name="username" class="col-md-12 col-sm-12 col-xs-12" placeholder = "Email" value="<?php if (!empty($user_username)) echo $user_username; ?>" /><br />
      <label for="password" id = "name-text">Password</label><br />
      <input type="password" class="col-md-12 col-sm-12 col-xs-12" name="password" placeholder ="Password" /><br />
      <input type="submit" value="Log In" name="submit" />
	  <br>
	  <br>
	  <p><a href ="forgot_password.php"> Reset Password</a></p>
	  <p><a href ="contact.php">Need help? </a></p>
  </form>

<?php
  }
  else {
	   echo '<script>location.assign("welcome.php");</script>';
    // Confirm the successful log-in
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '. go to <a href="welcome.php">home </a> page</p>');
  }
?>
 				 </div>
		 </div>
				 <div class="col-md-6 col-sm-6 col-xs-12">
				  <div id="contact">  
                   <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">WHAT</a></li>
                    <li><a data-toggle="tab" href="#menu1">WHY</a></li>
                    <li><a data-toggle="tab" href="#menu2">HOW</a></li>
					<li><a  href="about.php">MORE</a></li>
                 </ul>

            <div class="tab-content text-center">
             <div id="home" class="tab-pane fade in active">
             <h5><strong>WHAT IS THETWEAKS</strong></h5>
             <p>Thetweaks is an online social platform where you can publish your ideas on any problem you face in your daily life and suggest solutions alongwith it if you have any.</p>
           </div>
          <div id="menu1" class="tab-pane fade">
         <h5><strong>WHY THETWEAKS</strong></h5>
        <p>Thetweaks gives wings to your ideas. The ideas which would have buried in your mind forever is shared to the world. People discuss on your ideas and give their suggestions to make it more applicable.</p>
        </div>
         <div id="menu2" class="tab-pane fade">
        <h5><strong>HOW MY IDEAS FLOAT INTO THE SYSTEM</strong></h5>
       <p>Thetweaks will make sure that your ideas reaches to that particular organisation concerned. We will have the organisation connected to our platform such that it reaches to their ears as soon as possible . We are currently working on to add more and more organisation on our system.</p>
         </div>
      </div>
  </div>
				</div>
				  <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;" align="center">
				 <p class="col-md-5 col-sm-5 col-xs-12 col-sm-offset-3"> New to thetweaks ?</p>
				  <br>
				 <a id="signup1" class="col-md-5 col-sm-5 col-xs-12 col-sm-offset-3" href="signup.php">Get Started- Join!</a>
				 </div><br>				 
			</div>
		 </div>
	</div>
	<br/>
	<hr>
	  <footer class="container-fluid text-center">
  <p><a href="about.php">About</a>&nbsp; | &nbsp;<a href="contact.php">Contact</a> &nbsp;| &nbsp;<a href="contact.php">FAQ</a>&nbsp; |&nbsp; Thetweaks &copy; 2017</p>
</footer>
<br/>

	  <script src="js/jquery-1.12.3.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>
</body>
</html>

  