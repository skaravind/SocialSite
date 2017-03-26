<div class="main_body">
  <?php 
  
    require_once('connectvars.php');
	$page_id = $_GET['id'];
	$query = "select * from posts where post_id = '".$page_id."'";
	$run = mysqli_query($dbc,$query) or die(mysqli_error($dbc));
	$row = mysqli_fetch_array($run);
		$post_id = $row['post_id'];
		$title = $row['post_title'];
		$date = $row['post_date'];
		$author = $row['post_author'];
		$post_date = $row['post_date'];
		$image = $row['post_image'];
		$content = $row['post_content'];
$query21 = mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '".$row['user_id']."'") or die(mysqli_error($dbc));
$row12 = mysqli_fetch_array($query21);
$profile_picture = $row12['picture'];
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
		   <div id ="pro-pic" class="userpost"><p><img src ="profile/images/<?php if(!empty($profile_picture)){echo $row12['picture'] ;} else{ echo 'user.png';}?>"></p></div>
		   
           <div id ="post-title" class="userpost"> 
		    <h5 class="posttags" style="color:#2398D6;"><?php echo $row['tags'] ;?></h5>
		           <h2 class="posttitle"><strong><a href ="pages.php?id=<?php echo $post_id ;?>"><?php echo $title ;?></a></strong></h2>
				   <a href="http://thetweaks.com/profile/index.php?user_id=<?php echo $row['user_id'];?>">  
		           <P class="postwritten">By <b style="color:#2398D6;"><?php echo $row12['first_name'].' '.$row12['last_name']; ?></b></a> 
				  <span style="color:#797373; font-size:12px;"><?php echo date('d M', strtotime($post_date)); ?></span></P>
		           </div>
	       <div id ="post-image" class="userpost" class="col-md-12 col-sm-12 col-xs-12">
		  <?php if(!empty($image)){
			   echo '<div>
	                  <img src ="images/' . $image . '" class="col-md-12 col-sm-12 col-xs-12"></div>';
		   }?>
		  </div>
           <div id="post-content" class="userpost" ><p><?php echo $content;?></p> 
		   <div class="row">		
		   <div class="col-md-7 col-sm-7 col-xs-12 postbutton">
		    <h5><a class="upvote" datastatus="<?php echo $datastatus_up;?>" datatype="upvote" datavalue="<?php echo $post_id;?>"><?php echo $Upvote ;?><span class="badge"> &nbsp;&nbsp;<?php echo $row2[0] ;?></span></a>
			<a class="downvote" datastatus="<?php echo $datastatus_dw;?>"  datatype="downvote" datavalue="<?php echo $post_id;?>">&nbsp;&nbsp;<?php echo  $dwvote ;?><span class="badge"> &nbsp;&nbsp;<?php echo $row3[0];?></span></a>
			<a class="comment" href="pages.php?id=<?php echo $post_id ;?>"><b>&nbsp; &nbsp;Comments</b></a><h5>
			</div>       
			
			<div class="col-md-5 col-sm-5 col-xs-12 postsharebutton">
			<span class='st_sharethis_large' displayText='ShareThis'></span>
			<span class='st_facebook_large' displayText='Facebook'></span>
			<span class='st_linkedin_large' displayText='LinkedIn'></span>
			<span class='st_twitter_large' displayText='Tweet'></span>
			</div>          </div>					
		  <br>
		   <?php
	   require_once('startsession.php');	
        if($_POST){	   
		  $comment = mysqli_real_escape_string($dbc, trim($_POST['comment'])); 
		  $query = "INSERT INTO comments VALUES( null,'".$page_id."','".$_SESSION['user_id']."','$comment',NOW())";
		  $result = mysqli_query($dbc,$query) or die(mysqli_error($dbc));

		  }
   ?>        <div class="row">
		<div class="col-md-12  col-sm-12 col-xs-12 commentpost">               
				<form action="" method="post" role="form" >                <div class="form-group">			
				<textarea name="comment" id="comment-control" class="form-control" rows="3"  placeholder="Write Your Comment..." required ></textarea></div>
                <input type="submit" name="submit" value="Post">
				</form>	<br>	   
		   </div>          </div>
 <?php 
	$querycomm = mysqli_query($dbc,"SELECT * FROM comments left join users on comments.user_id=users.user_id WHERE comments.post_id = '".$post_id."' order by comments.comment_date DESC") or die(mysqli_error($dbc));
	WHILE($rowcomm = mysqli_fetch_array($querycomm)){
		$prof_picture = $rowcomm['picture'];
		$first_name = $rowcomm['first_name'];
		$last_name = $rowcomm['last_name'];
	?>
	<div id ="pro-pic" class="userpost"><p><img src ="profile/images/<?php if(!empty($prof_picture)){echo $rowcomm['picture'] ;} else{ echo 'user.png';}?>"></p></div>
       <div id ="post-title" class="userpost"> 
		 <h5 class="posttags">
		 <a href="http://thetweaks.com/profile/index.php?user_id=<?php echo $rowcomm['user_id'];?>"> 
		 <span style="color:#2398D6;"><?php if(!empty($first_name)){ echo $rowcomm['first_name'].' '.$rowcomm['last_name'] ;} else{ echo 'Anonymous';}?></a>  </span><span><?php echo date('d M Y',strtotime($rowcomm['comment_date'])) ;?></span></h5>
		 <P class="postwritten"><?php echo $rowcomm['comment'] ;?></P>
	  </div>
	<hr>
<?php }?>
</div>
 </div>
  </div>  
   