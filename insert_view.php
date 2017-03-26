<?php require_once('startsession.php');?>
 <?php 
    include("connectvars.php");?>
<!DOCTYPE html>
  <head> 
  <meta charset="UTF-8" />	
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
  <meta name=viewport content="width=device-width,initial-scale=1,user-scalable=no">
      <title>Thetweaks | Write Tweak</title>
	  <link rel="stylesheet" type="text/css" href="style.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
 <style>
.navbar-default {
    background-color: #36465d;border-color: #36465d;
}
body{
	   background:#F1F1F1;
}
</style>
 </head>
  
 <body>
 <?php include_once("analyticstracking.php") ?>
   <div><?php include("includes/header.php");?> </div> 
   <div class="container">
   <div class="row">
   <div id = "insert" class="col-md-offset-3 col-md-6 col-sm-6 col-xs-12" class="tweaksbord">
   <form method="post" action="insert_view.php" enctype="multipart/form-data">
    
	<table align ="center" class="table table-striped  table-bordered dt-responsive nowrap">
	<tr>
	    <th colspan ="2" bgcolor ="#F9F9F9" class=" col-md-12 col-sm-12 col-xs-12"><h2 align="center">Write new tweak<h2></th>
	</tr> 
	<tr>
	<td><select name ="categories" class="">
		    <option value="">Select Categories</option>
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
		</select></td>
	</tr>
	<tr>
	    
		<td><input type="text" name="title" placeholder="Headline" class=" col-md-12 col-sm-10 col-xs-12"></td>
	</tr> 
	<tr style="display:none;">
	  
		<td><input type="text" name="author" placeholder="Author Name" class="col-md-offset-2 col-md-10 col-sm-10 col-xs-12"></td>
	</tr> 
	<tr>
	    
		<td><input type="file" name="image" class=" "></td>
	</tr> 
	<tr>
	    
		<td><input type="text" name="tags" placeholder="Hashtags: #DigitalIndia #SocietyDevelopment" class=" col-md-12 col-sm-10 col-xs-12"></td>
	</tr> 
	<tr>
	   
		<td><textarea name ="content" cols ="50" rows="10" placeholder="What's tweaking..." class=" col-md-12 col-sm-10 col-xs-12"></textarea></td>
	</tr>
	<tr>
		<td align ="center" colspan ="5"><input type="submit" align="center" name="submit" value="Publish Now"></td>
	</tr>  
  </table>
  </form><br>
  </div>
 
 <?php
    require_once('startsession.php');
    require_once('appvars.php');
	
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
		else{
			echo "<script>alert('your image is not in gif, png,jpeg,pjpeg select in these format.')</script>";
		}
	if(!empty($image_name)) {
	 $query = "insert into posts (user_id,post_title,post_date,post_author,post_image,post_content,tags,categories)
	           values('$user_id','$title',now(),'$author','$image_name','$content','$tags','$categories')"	;
	}
	else{
		 $query = "insert into posts (user_id,post_title,post_date,post_author,post_content,tags,categories)
	           values('$user_id','$title',now(),'$author','$content','$tags','$categories')"	;
	}
	  if(mysqli_query($dbc,$query)) {
		  echo "<div class='col-md-12 col-sm-12 col-xs-12'><center><p>Post has been published, Go to homepage.</p></centre></div>";
	  }
  }
  if (!isset($_SESSION['user_id'])) {   
  echo '<p class="login">Please <a href="index.php">log in</a> to access this page.</p>';	
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'index.php';  
  echo '<script>location.assign("'.$home_url.'");</script>';   
  exit();   
  }

?> 
 </div>
 </div>
    <div id ="footer-text"><?php include("includes/footer.php");?> </div>   
	</body> 
	</html>