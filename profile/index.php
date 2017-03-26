<?php require_once('startsession.php');
 
?>
<!DOCTYPE html>
<html>
<head>
<title>Thetweaks | Profile</title>
 <meta charset="UTF-8" />	
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
<link rel="stylesheet" type="text/css" href="../style.css" /> 
<link rel="stylesheet" type="text/css" href="profile_style.css" />

<link href="../css/bootstrap.min.css" rel="stylesheet">
<style>
.basicfill {color:#236AAD;
             padding-left:15px;}
.nav .activa { padding-left:5px;}
.nav .activa ul li a{color:white;}
.text-center button {background-color:#36465D; color:#FFFFFF;  padding: 7px 15px;
    margin: 5px 0px 0px 0px;
    border: none;
    border-radius: 4px;
    cursor: pointer;}
</style>
</head>
<body>
<?php include_once("../analyticstracking.php") ?>
   <div><?php include("includes/header.php");?> </div>
   <div class ="container">
      <div><?php include("includes/searchbox.php");?> </div>
	  <?php  
   require_once('appvars.php');
   require_once('connectvars.php');
   
   if (!isset($_GET['user_id'])) {
    $query = "SELECT * FROM users WHERE user_id = '" . $_SESSION['user_id'] . "'";
	
	   $query21 = mysqli_query($dbc,"SELECT count(tbl_like_id) FROM tbl_userpost_like WHERE user_id_liked = '".$_SESSION['user_id']."' and status!=0") or die(mysqli_error($dbc));
		$row21 = mysqli_fetch_array($query21);
  }
  else {
    $query = "SELECT * FROM users WHERE user_id = '" . $_GET['user_id'] . "'";
	
	   $query21 = mysqli_query($dbc,"SELECT count(tbl_like_id) FROM tbl_userpost_like WHERE user_id_liked='".$_GET['user_id']."' and status!=0") or die(mysqli_error($dbc));
		$row21 = mysqli_fetch_array($query21);
  }
  $data = mysqli_query($dbc, $query);
   if (mysqli_num_rows($data) == 1) {
		
    // The user row was found so display the user data
	  $result = mysqli_query($dbc, $query);
	  $row = mysqli_fetch_array($result);
	    if($row != NULL) {
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$picture = $row['picture'];
	    }
	
	?>
	
<div class="col-md-4 col-sm-4 col-xs-12"  id ="profile_sidebar">
    <div class ="profile_image">
          <div class="thumbnail">
                 <img src="images/<?php if(!empty($picture)){echo $row['picture'];} else { echo 'iconimage.jpg';}?>" class="img-responsive" alt="Profile photo" style="width:100%; max-height:380px; ">
           <div class="caption">
             <div class="text-center">
			 <?php if (!isset($_GET['user_id'])) {
				 echo '<button>Follower '.$row21[0].'</button>';
			 }
			 else{
					$query21 = mysqli_query($dbc,"SELECT * FROM tbl_userpost_like WHERE user_id_liked='".$_GET['user_id']."' and user_id = '".$_SESSION['user_id']."' and status!=0") or die(mysqli_error($dbc));
					if (mysqli_num_rows($query21)>0) {
					echo '<button >Follower '.$row21[0].'</button>';
					}
					else{
				echo '<button class="user_liked1">Follower '.$row21[0].'</button>';
				 echo '<button class="user_liked" datavalue="'.$row['user_id'].'">Follow</button>';
					}
			 } 
				 ?>
			 </div>
   <div style="padding-left:14px; color:#36465D;"><h3><b><?php echo $first_name.' '.$last_name; ?></b></h3></div>
   <div class="col-md-12 col-sm-12 col-xs-12"><p><?php if(!empty($row['Bio'])) {echo $row['Bio'];} else {echo '<h4>Bio : Not Updated</h4>';}  ?></p></div><br />
   <div  class="col-md-12 col-sm-12 col-xs-12"><p><?php if(!empty($row['contactemail'])) echo $row['contactemail'];  ?></p></div><br />
   <label  class="col-md-12 col-sm-12 col-xs-12 biocontainer">
   <div class="row">
   <?php if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
      echo '<button><a href="editprofile.php">Edit Profile</a></button>';
	  echo '<button><a href="editstory.php">Edit Autobiography</a></button>';
    }?> </div>
	</label><br />
  		   </div>
         </div>
    </div>
</div>

	 <div><?php include("includes/profile_body.php");?></div>
  
   <?php   } // End of check for a single row of user results
  else {
    echo '<p class="error">There was a problem accessing your profile.</p>';
  }

  mysqli_close($dbc);
?>
   </div>
   </div>
   <div id ="footer-text"><?php include("includes/footer.php");?> </div>
   
</body>
</html>