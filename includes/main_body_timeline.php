<style>
.postsharebutton .sharesize{
    width: 2px;
    height: 2px;
    background-size: 5px 5px;}
.writepost{margin:0px 20px;}
.userhi{margin-left:30px; margin-top:20px; padding-left:10px;}

</style>
<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
</script>
<?php
    require_once('startsession.php');
    require_once('appvars.php');
	require_once('connectvars.php');
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if(isset($_POST['submit'])) {
		$user_id = $_SESSION['user_id'];
		$title = addslashes($_POST['title']);
		$categories = addslashes($_POST['categories']);
		$tags = addslashes($_POST['tags']);
		$author = $_SESSION['username'];
		$content = addslashes($_POST['content']);
		$image_name = $_FILES['image']['name'];
		$image_type = $_FILES['image']['type'];
		$image_size = $_FILES['image']['size'];
		$image_tmp = $_FILES['image']['tmp_name'];
		
		if($title =='' or $content ==''){
			echo "<script>alert('Any field is empty, title and textarea must fill')</script>";
			exit();
		}
		
		if($image_type =="image/jpeg" or $image_type =="image/png" or $image_type =="image/gif" or $image_type =="image/pjpeg" ) {
				move_uploaded_file($image_tmp,"images/$image_name");
		}
	if(!empty($image_name)) {
	 $query = "insert into posts (user_id,post_title,post_date,post_author,post_image,post_content,tags,categories)
	           values('$user_id','$title',now(),'$author','$image_name','$content','$tags','$categories')"	;
	}
	else{
		 $query = "insert into posts (user_id,post_title,post_date,post_author,post_content,tags,categories)
	           values('$user_id','$title',now(),'$author','$content','$tags','$categories')"	;
	}
	 echo "<script>alert('Your post has been published,go to homepage,)</script>";
  }
  if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
     $query = "SELECT * FROM users WHERE user_id = '" . $_SESSION['user_id'] . "'";
	 $result = mysqli_query($dbc, $query);
	 $rownamepic = mysqli_fetch_array($result);
	 $picture = $rownamepic['picture'];
    } 
?>
<div class="main_body"> 
<ul class="nav nav-tabs">
  <li role="presentation"><a href="welcome.php"><b>Home</b></a></li>
  <li role="presentation" class="active"><a href="timeline.php"><b>Timeline</b></a></li>
   <li role="presentation"><a href="profile/index.php"><b>Profile</b></a></li>
</ul>  
<p class="alert alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Home-</strong> See tweaks of all Users.
  </p>
 <p class="alert alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Timeline-</strong> See the tweaks of people you follow.
 </p>
 <div class="writepost">
 <div class ="row">
 <div id ="pro-pic"><p><img class="img-responsive" src ="profile/images/<?php if(!empty($picture)){echo $rownamepic['picture'];} else { echo 'user.png';}?>"></p></div>
 <div><h4 class="userhi">Hi <?php echo $rownamepic['first_name'].' '.$rownamepic['last_name']; ?> !</h4></div>
 </div>
 <div class="row">
 <p>What's your idea of the problem you're facing? &nbsp;&nbsp;&nbsp;
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Write Tweak
 </button> </p>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="color:#FFFFFF; background:#286090;">
        <h3 class="modal-title" id="exampleModalLongTitle" style="text-align:center;">Write new tweak</h3>
      </div>
      <div class="modal-body">
        <form method="post" action ="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
           <div class="form-group">
               <input type="text" class="form-control" id="title" name="title" placeholder="Headline" aria-describedby="emailHelp" required>
           </div>
           <div class="form-group">
               <input type="text" name="tags" class="form-control" id="tags"  placeholder="Hashtags: #MakeInIndia #Reform">
           </div>
           <div class="form-group">
               <label for="exampleSelect1">Select Category</label>
            <select  name ="categories" class="form-control" id="categories">
		    <option value="academics">Academics</option>
		    <option value="admission">Admission</option>
			<option value="internship">Internship & Training</option>
			<option value="study">Education</option>
		    <option value="society">Society</option>
			<option value="business">Business</option>
			<option value="sports">Sports</option>
			<option value="lifestyle">Lifestyle</option>
			<option value="development">Development</option>
			<option value="Innovative">Innovation</option>
			<option value="placements">Placements</option>
			<option value="others">Others</option>
    </select>
  </div>
  <div class="form-group">
    <textarea name ="content" rows="10" placeholder="What's tweaking..." class="form-control" id="content" required></textarea>
  </div>
  <div class="form-group">
    <input type="file" class="form-control-file" name="image" id="image" aria-describedby="fileHelp">
    <small id="fileHelp" class="form-text text-muted">You can add image with your post. It's optional.</small>
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="submit" class="btn btn-primary" value="Publish Now">
      </div>
	  </form>
    </div>
  </div>
</div>
</div>
</div>

<hr>



<?php
   
   
	$query = "select * from posts where user_id IN (select user_id_liked from tbl_userpost_like where user_id='".$_SESSION['user_id']."' and status='1') or user_id='".$_SESSION['user_id']."' ORDER by post_id DESC ";
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
$pro_picture = $row12['picture'];

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
		   <p><img class="img-responsive" src ="profile/images/<?php if(!empty($pro_picture)){echo $row12['picture'] ;} else { echo 'user.png';}?>"></p></a></div>
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
	<div id="post-content" class="userpost"><p> <?php echo substr($content,0,200);?>... <a href ="pages.php?id=<?php echo $post_id ;?>"><span style="color:#808080;">[See More]</span></a></p>	    
		<div class ="row">
		    <div class="col-md-7 col-sm-7 col-xs-12 postbutton">
		    <h5><a class="upvote" datastatus="<?php echo $datastatus_up;?>" datatype="upvote" datavalue="<?php echo $post_id;?>">[<?php echo $Upvote.' '.$row2[0];?>]</a>
			<a class="downvote" datastatus="<?php echo $datastatus_dw;?>"  datatype="downvote" datavalue="<?php echo $post_id;?>">&nbsp;&nbsp;[<?php echo  $dwvote.' '.$row3[0];?>]</a>
			<a class="comment" href="pages.php?id=<?php echo $post_id ;?>"><b>&nbsp; &nbsp;Comments</b></a><h5>
			</div>
			
		  <div class="col-md-5 col-sm-5 col-xs-12 postsharebutton">
		    <span class='st_sharethis_large sharesize' displayText='ShareThis'></span>
			<span class='st_facebook_large sharesize' displayText='Facebook'></span>
			<span class='st_linkedin_large sharesize' displayText='LinkedIn'></span>
			<span class='st_twitter_large sharesize' displayText='Tweet'></span>
		  </div>
		  </div>
		  
		   </div>
		   </div>
		   <hr>
<?php } ?>
</div> 
