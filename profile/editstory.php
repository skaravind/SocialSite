<?php require_once('startsession.php');
 if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="../index.php">log in</a> to access this page.</p>';
	$home_url = 'http://thetweaks.com/index.php';
    echo '<script>location.assign("'.$home_url.'");</script>';
    exit();
	}
?>
 <html>
<head>
    <title>Thetweaks | Edit Autobiobraphy</title> <meta charset="UTF-8" />	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">		  <meta name=viewport content="width=device-width,initial-scale=1,user-scalable=no"><link rel="stylesheet" type="text/css" href="../style.css" /> <link rel="stylesheet" type="text/css" href="profile_style.css" /><link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body> 
     <div><?php include("includes/header.php");?> </div>
     <div class="container">
      <div><?php include("includes/searchbox.php");?> </div>
	  
<?php
    require_once('appvars.php');
	require_once('connectvars.php');
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if(isset($_POST['submit'])){
		$story = $_POST['story'];
		if(!empty($story)) {
	    $query ="UPDATE users SET story = '$story' WHERE user_id = '" . $_SESSION['user_id'] . "'";
		}
		  mysqli_query($dbc, $query);
	      $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/story.php';
          echo '<script>location.assign("'.$home_url.'");</script>';
          mysqli_close($dbc); 		
		  exit();
	 }
	 else{
	  $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	  $query = "SELECT story FROM users WHERE user_id = '" . $_SESSION['user_id'] . "'" ;
	  $run = mysqli_query($dbc, $query);
	  $row = mysqli_fetch_array($run);
	    if($row != NULL) {
			$story = $row['story'];
           }
	 }
	 mysqli_close($dbc); 
?>
	 <div id ="story" class="col-md-12 col-sm-12 col-xs-12">
           <form method= "post" action ="editstory.php"  enctype ="multipart/form-data"> <h3>Write Your Autobiobraphy</h3>
		   <textarea name ="story" class="col-md-12 col-sm-12 col-xs-12" cols ="155" rows="22" style="padding:10px;" ><?php if(!empty($story)) echo $story;  ?></textarea>
		   <input type ="submit" name ="submit" value="Save Now">
	       </form>
	 </div>
	 </div>
	 
   <div id="footer-text"><?php include("includes/footer.php");?> </div>
</body>
</html>

	
	
	
	
	
	
	
	
	
	
	