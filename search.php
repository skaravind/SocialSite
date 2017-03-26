<?php require_once('startsession.php');?> 
<!DOCTYPE html>
<head>     
 <meta charset="UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
 <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>Thetweaks - My Search</title>
	<link rel="stylesheet" type="text/css" href="style.css" />  
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/customcss.css" /> 
</head>
<style>
body{background-color:#F1F1F1;}
</style>
<body>
<?php include_once("analyticstracking.php") ?>
   <div><?php include("includes/header.php");?> </div>
   <div class="container">
   <div><?php include("includes/searchbox.php");?> </div>
   </div>
   <section>
   <div class ="container">
     <div class="row">
	 <div id="" class="col-md-2 col-sm-12 ">
   <div class="hidden-xs hidden-sm"><?php include("includes/sidbar.php");?></div>
   </div>
    <div class="col-md-6 col-sm-12 col-xs-12 content1"> 
   <div class="main_body">
   
 <?php
    require_once('connectvars.php');
     if(isset($_GET['submit']) && $_GET['search']!=''){
		 $search_id = $_GET['search'];
		 /* $run = mysqli_query($dbc,$query) or die(mysqli_error($dbc));
		 
		 $query1 = "";
		 $run1 = mysqli_query($dbc,$query1) or die(mysqli_error($dbc));
		 
		 if(mysqli_num_rows($run1)>0){
			 while($row = mysqli_fetch_array($run1)){
				 $query = mysqli_query($dbc,"select * from posts where user_id = '".$row['user_id']."'");
				 $row2 = mysqli_fetch_array($query);
				array_push($out,$row2['post_id']);
			 }			 
		 }
		 
		 if(mysqli_num_rows($run)>0){
			 while($row1 = mysqli_fetch_array($run)){
				array_push($out,$row1['post_id']);
			 }	
		 }  
		 $out1 = array_unique($out);
		 */
		 
		
		
/* Coded by Jain software. Developer Rahul Rajak. */
 
		  $query = "select * from posts where post_id IN (select post_id from posts where post_title like '%$search_id%' or tags like '%$search_id%' or user_id IN (select user_id from users where first_name like '%$search_id%' or last_name like '%$search_id%'))";
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

$queryuser1 = mysqli_query($dbc,"SELECT vote_status FROM tbl_postupdown_votes WHERE type='vup' and post_id = '".$post_id."' and user_id='".$_SESSION['user_id']."'") or die(mysqli_error($dbc));
$rowuser1 = mysqli_fetch_array($queryuser1);

$queryuser2 = mysqli_query($dbc,"SELECT vote_status FROM tbl_postupdown_votes WHERE type='vdw' and post_id = '".$post_id."' and user_id='".$_SESSION['user_id']."'") or die(mysqli_error($dbc));
$rowuser2 = mysqli_fetch_array($queryuser2);

$datastatus_up=0;$datastatus_dw=0;$Upvote='Upvote';$dwvote='Downvote';
if($rowuser1[0]!=0){$datastatus_up=1;$Upvote='Upvote';}
if($rowuser2[0]!=0){$datastatus_dw=1;$dwvote='Downvote';}
?>	
   <div class ="userpost">
		   <div id ="pro-pic" class="userpost"><a href="http://thetweaks.com/profile/index.php?user_id=<?php echo $row['user_id'];?>">
		   <p><img src ="profile/images/<?php echo $row12['picture'] ;?>"></p></a></div>
           <div id ="post-title" class="userpost"> 
		         <h5 class="posttags"> <?php echo $row['tags'] ;?></h5>
		           <h2 class="posttitle"><strong><a href ="pages.php?id=<?php echo $post_id ;?>"><?php echo $title ;?></a></strong></h2>
		          <a href="http://thetweaks.com/profile/index.php?user_id=<?php echo $row['user_id'];?>">  
				  <P class="postwritten">Written By : <b style="color:#2398D6;"><?php echo $row12['first_name'].' '.$row12['last_name']; ?></b>
 				  <span style="color:#797373; font-size:12px;"><?php echo date('d M', strtotime($post_date)); ?></span></P>
		          </a> </div>
	       <div id ="post-image" class="userpost" class="col-md-12 col-sm-12 col-xs-12">
		   <?php if(!empty($image)){
			   echo '<div>
	                  <img src ="images/' . $image . '" class="col-md-12 col-sm-12 col-xs-12"></div>';
		   }?>
		   </div>
	<div id="post-content" class="userpost"><p><?php echo $content;?> <a href ="pages.php?id=<?php echo $post_id ;?>">[See More...]</a></p>
	     
		    <div class="col-md-7 col-sm-7 col-xs-12 postbutton">
		    <a class="upvote" datastatus="<?php echo $datastatus_up;?>" datatype="upvote" datavalue="<?php echo $post_id;?>">[<?php echo $Upvote.' '.$row2[0];?>]</a>
			<a class="downvote" datastatus="<?php echo $datastatus_dw;?>"  datatype="downvote" datavalue="<?php echo $post_id;?>">[<?php echo  $dwvote.' '.$row3[0];?> ]</a>
			<a class="comment" href="pages.php?id=<?php echo $post_id ;?>">Comment </a>
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

 <?php }} ?>   
 <?php
     if(isset($_GET['category'])){
		 $category = $_GET['category'];
		 $query = "select * from posts where categories ='$category'";
		 $run = mysqli_query($dbc,$query);
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

$queryuser1 = mysqli_query($dbc,"SELECT vote_status FROM tbl_postupdown_votes WHERE type='vup' and post_id = '".$post_id."' and user_id='".$_SESSION['user_id']."'") or die(mysqli_error($dbc));
$rowuser1 = mysqli_fetch_array($queryuser1);

$queryuser2 = mysqli_query($dbc,"SELECT vote_status FROM tbl_postupdown_votes WHERE type='vdw' and post_id = '".$post_id."' and user_id='".$_SESSION['user_id']."'") or die(mysqli_error($dbc));
$rowuser2 = mysqli_fetch_array($queryuser2);

$datastatus_up=0;$datastatus_dw=0;$Upvote='Upvote';$dwvote='Downvote';
if($rowuser1[0]!=0){$datastatus_up=1;$Upvote='Upvote';}
if($rowuser2[0]!=0){$datastatus_dw=1;$dwvote='Downvote';}

?>			 	 
	<div class ="userpost">
		   <div id ="pro-pic" class="userpost"><a href="http://thetweaks.com/profile/index.php?user_id=<?php echo $row['user_id'];?>"><p><img src ="profile/images/<?php echo $row12['picture'] ;?>"></p></a></div>
           <div id ="post-title" class="userpost"> 
		         <h5 class="posttags" style="color:#2398D6;"> <?php echo $row['tags'] ;?></h5>
		           <h2 class="posttitle"><strong><a href ="pages.php?id=<?php echo $post_id ;?>"><?php echo $title ;?></a></strong></h2>
		          <a href="http://thetweaks.com/profile/index.php?user_id=<?php echo $row['user_id'];?>">  
				  <P class="postwritten">By <span style="color:#2398D6;"><?php echo $row12['first_name'].' '.$row12['last_name']; ?></span></a>
 				  <span style="color:#797373; font-size:12px;"><?php echo date('d M', strtotime($post_date)); ?></span></P>
		         </div>
	       <div id ="post-image" class="userpost" class="col-md-12 col-sm-12 col-xs-12">
		   <?php if(!empty($image)){
			   echo '<div>
	                  <img src ="images/' . $image . '" class="col-md-12 col-sm-12 col-xs-12"></div>';
		   }?>
		   </div>
	<div id="post-content" class="userpost"><p><?php echo $content;?>... <a href ="pages.php?id=<?php echo $post_id ;?>"><span style="color:#808080;">[See More]</span></a></p>
	     <div class ="row">
		    <div class="col-md-7 col-sm-7 col-xs-12 postbutton">
		    <h5><a class="upvote" datastatus="<?php echo $datastatus_up;?>" datatype="upvote" datavalue="<?php echo $post_id;?>">[<?php echo $Upvote.' '.$row2[0];?>]</a>
			<a class="downvote" datastatus="<?php echo $datastatus_dw;?>"  datatype="downvote" datavalue="<?php echo $post_id;?>">&nbsp;&nbsp;[<?php echo  $dwvote.' '.$row3[0];?> ]</a>
			<a class="comment" href="pages.php?id=<?php echo $post_id ;?>"><b>&nbsp; &nbsp;Comments</b></a></h5>
			</div>
			
		  <div class="col-md-5 col-sm-5 col-xs-12 postsharebutton">
		 <span class='st_sharethis_large' displayText='ShareThis'></span>
			<span class='st_facebook_large' displayText='Facebook'></span>
			<span class='st_linkedin_large' displayText='LinkedIn'></span>
			<span class='st_twitter_large' displayText='Tweet'></span>
		  </div>
		</div>  
		   </div>
		   <hr>
		   </div>
 <?php }}  ?>
 
    </div>
	</div>
   <div class="col-md-4 col-sm-12 col-xs-12"><?php include("includes/sidebar_post.php");?></div> 
    </div>
   </div>
   </section>
   <div id="footer-text"><?php include("includes/footer.php");?> </div>
   
</body>
</html>