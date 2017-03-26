<div class="main_body">
  <?php 
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
		
		$query2 = mysqli_query($dbc,"SELECT count(tbl_updown_id) FROM tbl_postupdown_votes WHERE post_id = '".$post_id."' and vote_status!=0 and type='vup'") or die(mysqli_error($dbc));
$row2 = mysqli_fetch_array($query2);

$query3 = mysqli_query($dbc,"SELECT count(tbl_updown_id) FROM tbl_postupdown_votes WHERE post_id = '".$post_id."' and vote_status!=0 and type='vdw'") or die(mysqli_error($dbc));
$row3 = mysqli_fetch_array($query3);

$queryuser1 = mysqli_query($dbc,"SELECT vote_status FROM tbl_postupdown_votes WHERE type='vup' and post_id = '".$post_id."' and user_id='".$_SESSION['user_id']."'") or die(mysqli_error($dbc));
$rowuser1 = mysqli_fetch_array($queryuser1);

$queryuser2 = mysqli_query($dbc,"SELECT vote_status FROM tbl_postupdown_votes WHERE type='vdw' and post_id = '".$post_id."' and user_id='".$_SESSION['user_id']."'") or die(mysqli_error($dbc));
$rowuser2 = mysqli_fetch_array($queryuser2);

$datastatus_up=0;$datastatus_dw=0;$Upvote='Upvote';$dwvote='Downvote';
if($rowuser1[0]!=0){$datastatus_up=1;$Upvote='Upvoted';}
if($rowuser2[0]!=0){$datastatus_dw=1;$dwvote='Downvoted';}

 ?>
           <div class ="userpost">
		   <div id ="pro-pic" class="userpost"><p><img src ="images/hed.jpg"></p></div>
           <div id ="post-title" class="userpost"> 
		   <h5 class="posttags">Tags:#test,</h5>
		           <h2 class="posttitle"><a href ="pages.php?id=<?php echo $post_id ;?>"><?php echo $title ;?></a></h2>
		           <P class="postwritten">written by : <b><?php echo $author; ?></b> <span style="color:#797373;"><?php echo date('d M', strtotime($post_date)); ?></span></P>
		           </div>
	       <div id ="post-image" class="userpost"><img src = "images/<?php echo $image ;?>"></div>
           <div id="post-content" class="userpost" ><p><?php echo $content;?></p>
		   <div class="col-md-8 col-sm-8 col-xs-8 postbutton">
		    <a class="upvote" datastatus="<?php echo $datastatus_up;?>" datatype="upvote" datavalue="<?php echo $post_id;?>">[<?php echo $Upvote.' '.$row2[0];?>]</a>
			<a class="downvote" datastatus="<?php echo $datastatus_dw;?>"  datatype="downvote" datavalue="<?php echo $post_id;?>"><?php echo  $dwvote.' '.$row3[0];?> </a>
			<a class="comment" href="pages.php?id=<?php echo $post_id ;?>">Comment </a>
			</div>
			
		  <div class="col-md-4 col-sm-4 col-xs-4 postsharebutton">
		  <a><img src="images/share.jpg" /></a>
		  <a><img src="images/fb.jpg" /></a>
		  <a><img src="images/twitter.jpg" /></a>
		  <a><img src="images/linked.jpg" /></a>
		  </div>
		  <br>
		   <?php 
   if($_POST){	   
		  $comment = mysqli_real_escape_string($dbc, trim($_POST['comment'])); 
		  $query = "INSERT INTO comments VALUES( null,'".$page_id."','".$_SESSION['user_id']."','$comment',NOW())";
		  $result = mysqli_query($dbc,$query) or die(mysqli_error($dbc));

		  }
   ?>
		<div class="col-md-12 col-sm-12 col-xs-12 commentpost">
				<form action="" method="post">
				<input type="text" name="comment" class="col-md-7 col-sm-7 col-xs-7" placeholder="Enter Your Comment..." required >
                <input type="submit" name="submit" class="col-md-2 col-sm-2 col-xs-2" value="Post">
				</form>		   
		   </div>
		   	<?php 
			$querycomm = mysqli_query($dbc,"SELECT * FROM comments left join users on comments.user_id=users.user_id WHERE comments.post_id = '".$post_id."' order by comments.comment_date DESC") or die(mysqli_error($dbc));
			WHILE($rowcomm = mysqli_fetch_array($querycomm)){
			?>
		   <div id ="pro-pic" class="userpost"><p><img src ="images/hed.jpg"></p></div>
           <div id ="post-title" class="userpost"> 
		   <h5 class="posttags"><?php echo $rowcomm['first_name'].' '.$rowcomm['last_name'] ;?> <span><?php echo date('d M Y',strtotime($rowcomm['comment_date'])) ;?><span></h5>
		   <P class="postwritten"><?php echo $rowcomm['comment'] ;?></P>
		   </div>
			<hr>
			<?php }?>
		   </div>
		   </div>
   </div>
   