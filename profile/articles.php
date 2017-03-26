<?php require_once('startsession.php');
 if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="../index.php">log in</a> to access this page.</p>';
	$home_url = 'http://thetweaks.com/index.php';
    echo '<script>location.assign("'.$home_url.'");</script>';
    exit();
	}
?>
<!DOCTYPE html>
<head>
     <title>Thetweaks - Articles</title> <meta charset="UTF-8" />	
	 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">		
	 <meta name=viewport content="width=device-width,initial-scale=1,user-scalable=no">
<link rel="stylesheet" type="text/css" href="../style.css" /> 
   <link rel="stylesheet" type="text/css" href="profile_style.css" />
   <link rel="stylesheet" type="text/css" href="../css/customcss.css" /> 
<link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
          <div><?php include("includes/header.php");?> </div>
          <div class="container">
		  <div><?php include("includes/searchbox.php");?> </div>
		  <?php  
   require_once('appvars.php');
   require_once('connectvars.php');
     $user_id='';
 
    if (!isset($_GET['user_id'])) {
		  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="../login.php">log in</a> to access this page.</p>';
    exit();
   }
   else{
	   $user_id=$_SESSION['user_id'];
   }
     
  }
  else {
    $user_id=$_GET['user_id'];
  }
  
   $query = "SELECT * FROM users WHERE user_id = '" . $user_id . "'";
  
  $data = mysqli_query($dbc, $query);
  
    // The user row was found so display the user data
    $row = mysqli_fetch_array($data);
	$query21 = mysqli_query($dbc,"SELECT count(tbl_like_id) FROM tbl_userpost_like WHERE user_id = '".$user_id."' and status!=0") or die(mysqli_error($dbc));
		$row21 = mysqli_fetch_array($query21);
		$query = "SELECT * FROM users WHERE user_id = '" . $user_id . "'" ;
	  $result = mysqli_query($dbc, $query);
	  $row = mysqli_fetch_array($result);
	    if($row != NULL) {
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
	    }
	?>
<div id ="profile_sidebar"  class="col-md-4 col-sm-4 col-xs-12">
    <div class ="profile_image">
          <div class="thumbnail">
                 <img src="images/<?php echo $row['picture'];?>" class="img-responsive" alt="Profile photo" style="width:100%; max-height:380px; ">
           <div class="caption">
             <div class="text-center"><button class="user_liked" datavalue="<?php echo $_SESSION['user_id'];?>">Follow <?php echo $row21[0] ;?></button></div><br /><br />
   <div style="padding-left:14px; color:#36465D;"><h3><b><?php echo $first_name.' '.$last_name; ?></b></h3></div>
   <div class="col-md-12 col-sm-12 col-xs-12"><p><?php if(!empty($row['Bio'])) echo $row['Bio'];  ?></p></div><br />
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
   
     <div id ="profile_body" class="col-md-8 col-sm-8 col-xs-12">
	    <div><?php include("includes/profile_body_nav.php");?></div>  
		<div class="col-md-12 col-sm-12 col-xs-12 content1">
		<div class="main_body" >
<?php

	$query = "select * from posts where user_id ='".$user_id."' ORDER by post_id DESC ";
	$run = mysqli_query($dbc,$query) or die(mysqli_error($dbc));
	while($row = mysqli_fetch_array($run)){
		$post_id = $row['post_id'];
		$title = $row['post_title'];
		$date = $row['post_date'];
		$author = $row['post_author'];
		$post_date = $row['post_date'];
		$image = $row['post_image'];
		$content = substr($row['post_content'],0,600);
		
$query21 = mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '".$row['user_id']."'") or die(mysqli_error($dbc));
$row12 = mysqli_fetch_array($query21);

$query2 = mysqli_query($dbc,"SELECT count(tbl_updown_id) FROM tbl_postupdown_votes WHERE post_id = '".$post_id."' and vote_status!=0 and type='vup'") or die(mysqli_error($dbc));
$row2 = mysqli_fetch_array($query2);

$query3 = mysqli_query($dbc,"SELECT count(tbl_updown_id) FROM tbl_postupdown_votes WHERE post_id = '".$post_id."' and vote_status!=0 and type='vdw'") or die(mysqli_error($dbc));
$row3 = mysqli_fetch_array($query3);

$queryuser1 = mysqli_query($dbc,"SELECT vote_status FROM tbl_postupdown_votes WHERE type='vup' and post_id = '".$post_id."' and user_id='".$user_id."'") or die(mysqli_error($dbc));
$rowuser1 = mysqli_fetch_array($queryuser1);

$queryuser2 = mysqli_query($dbc,"SELECT vote_status FROM tbl_postupdown_votes WHERE type='vdw' and post_id = '".$post_id."' and user_id='".$user_id."'") or die(mysqli_error($dbc));
$rowuser2 = mysqli_fetch_array($queryuser2);

$datastatus_up=0;$datastatus_dw=0;$Upvote='Upvote';$dwvote='Downvote';
if($rowuser1[0]!=0){$datastatus_up=1;$Upvote='Upvote';}
if($rowuser2[0]!=0){$datastatus_dw=1;$dwvote='Downvote';}


?>      
          <div class ="userpost">
		   <div id ="pro-pic" class="userpost"><p><img src ="images/<?php echo $row12['picture'] ;?>"></p></div>
           <div id ="post-title" class="userpost"> 
		           <h5 class="posttags" style="color:#2398D6;"> <?php echo $row['tags'] ;?></h5>
		           <h2 class="posttitle"><strong><a href ="../pages.php?id=<?php echo $post_id ;?>"><?php echo $title ;?></a></strong></h2>
		           <P class="postwritten">By <b style="color:#2398D6;"><?php echo $row12['first_name'].' '.$row12['last_name']; ?></b> <span style="color:#797373; font-size:12px;"><?php echo date('d M', strtotime($post_date)); ?></span></P>
		           </div>
	       <div id ="post-image" class="userpost" class="col-md-12 col-sm-12 col-xs-12">
		   <?php if(!empty($image)){
			   echo '<div>
	                  <img src ="../images/' . $image . '" class="col-md-12 col-sm-12 col-xs-12"></div>';
		   }?>
		   </div>
	<div id="post-content" class="userpost"><p><?php echo $content;?> <a href ="../pages.php?id=<?php echo $post_id ;?>">[See More...]</a></p>
	     
		    <div class="col-md-7 col-sm-7 col-xs-12 postbutton">
		    <a class="upvote" datastatus="<?php echo $datastatus_up;?>" datatype="upvote" datavalue="<?php echo $post_id;?>">[<?php echo $Upvote.' '.$row2[0];?>]</a>
			<a class="downvote" datastatus="<?php echo $datastatus_dw;?>"  datatype="downvote" datavalue="<?php echo $post_id;?>">&nbsp;[<?php echo  $dwvote.' '.$row3[0];?> ]</a>
			<a class="comment" href="../pages.php?id=<?php echo $post_id ;?>"><b> &nbsp;Comments</b></a>
			</div>
			
		  <div class="col-md-5 col-sm-5 col-xs-12 postsharebutton">
		 <span class='st_sharethis_large' displayText='ShareThis'></span>
			<span class='st_facebook_large' displayText='Facebook'></span>
			<span class='st_linkedin_large' displayText='LinkedIn'></span>
			<span class='st_twitter_large' displayText='Tweet'></span>
		  </div>
		  
		   </div>
		   <br>
		   <hr>
		   </div>
		   
<?php } ?>
</div> 
		
		
		
		
		</div>
  
  </div>
  </div>
  
   <div id ="footer-text"><?php include("includes/footer.php");?> </div>
   
  </body>
  </html>