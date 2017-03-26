<?php      require_once('startsession.php');
	 if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="welcome.php">log in</a> to access this page.</p>';
	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/welcome.php';
    header('Location: ' . $home_url);
    exit();
   }
?>
<!DOCTYPE html>
<html>
<head>
<title>changer-write to change</title>
   <meta charset="UTF-8" />	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
<link rel="stylesheet" type="text/css" href="style.css" /> 
<link rel="stylesheet" type="text/css" href="profile/profile_style.css" />

<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/customcss.css" /> 
</head>
<body>
   <div><?php include("includes/header.php");?> </div>
   <div class ="container">
      <div><?php include("includes/searchbox.php");?> </div>
	  <?php  
   require_once('appvars.php');
   require_once('connectvars.php');
   if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
   }
   if (!isset($_GET['user_id'])) {
    $query = "SELECT * FROM users WHERE user_id = '" . $_SESSION['user_id'] . "'";
  }
  else {
    $query = "SELECT * FROM users WHERE user_id = '" . $_GET['user_id'] . "'";
  }
  $data = mysqli_query($dbc, $query);
   if (mysqli_num_rows($data) == 1) {
	   $query21 = mysqli_query($dbc,"SELECT count(user_id) FROM users WHERE join_date = '".date('Y-m-d')."'") or die(mysqli_error($dbc));
		$row21 = mysqli_fetch_array($query21);		
		$row = mysqli_fetch_array($data);
	
	   $query_visitor = mysqli_query($dbc,"SELECT count(visitors_id) FROM tbl_daliy_visitors WHERE created_date = '".date('Y-m-d')."'") or die(mysqli_error($dbc));
		$row_visitor = mysqli_fetch_array($query_visitor);
		
		
	
	?>
<div id ="profile_sidebar"  class="col-md-4 col-sm-4 col-xs-12">
    <div class ="profile_image">
          <div class="polaroid">
                 <img src="images/<?php echo $row['picture'];?>" alt="Profile photo" style="width:100%; min-height:280px; ">
           <div class="image_container">
            <br />
  		   </div>
         </div>
    </div>
</div>
	 <div> <div id ="profile_body" class="col-md-8 col-sm-8 col-xs-12">
	  <div><div class = "body_nav">
		  <ul>
            <li><a>Admin Panel Management</a></li>
            
         </ul>
     </div></div>
 <div class ="body_main" style="padding-bottom:10px;">
   <div id ="bio_body">

   <table>
   <tr><th ><h3>Show Daily New User Registration :  <?php   echo $row21[0];?></h3></th></tr>
   <tr><th ><h3>Daily Visitor of Website :  <?php   echo $row_visitor[0];?></h3></th></tr>
	
	</table>
</div>
 </div> 
</div></div>
  
   <?php   } // End of check for a single row of user results
  else {
    echo '<p class="error">There was a problem accessing your profile.</p>';
  }

  mysqli_close($dbc);
?>
   </div>
   <div id ="footer-text"><?php include("includes/footer.php");?> </div>
   
</body>
</html>