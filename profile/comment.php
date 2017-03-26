<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>myview</title>
   <link rel="stylesheet" type="text/css" href="profile_style.css" />
  
</head>
<body>
 <div class="container">
         <div><?php include("includes/profile_header.php");?></div>
	     <div><?php include("includes/profile_sidebar.php");?></div>
   
     <div id ="profile_body">
	    <div><?php include("includes/profile_body_header.php");?></div>
	    <div><?php include("includes/profile_body_nav.php");?></div>
	    <div class ="body_main">
 <?php
    require_once('startsession.php');
    require_once('appvars.php');
	 if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
   }
   include("connectvars.php");
   $get_post_id = $_GET['id'];
   $query = "SELECT * FROM posts where post_id = '$get_post_id' ";
   $data = mysqli_query($dbc,$query);
   while($row = mysqli_fetch_array($data)){
		$post_id = $row['post_id'];
		$user_id = $row['user_id'];
		$title = $row['post_title'];
		$date = $row['post_date'];
		$image = $row['post_image'];
		$content = $row['post_content'];
		
       $user_query = "SELECT * FROM users WHERE user_id ='$user_id'";
	   $run = mysqli_query($dbc,$user_query);
	   $user_row = mysqli_fetch_array($run);
       $first_name = $user_row['first_name'];
	   $last_name = $user_row['last_name'];
	   $picture = $user_row['picture'];
?>	  
      <div class = "user_post">
	     <p class="profile-img"><img src = "images/<?php echo $picture;?>" width ='50' height ='50'></p>
		 <h2><?php echo $title;?></h2>
		 <h4>Posted by : <a href = 'index.php?user_id =$user_id'><?php echo "$first_name $last_name";?></a></h4>
		 <P class ="post-img"><img src = "../images/<?php echo $image;?>" width='400' height='200'></p>
		 <p class="post-content"><?php echo $content;?></p>
		 <div class ="reply">
		   <form method="post" action="comment.php?id=<?php echo $post_id;?>">
            <textarea name="reply" placeholder="Add a reply..." cols="80" rows="2"></textarea>
            <input type ="submit" name="submit" value="reply" >			
		    </form>
		  </div>
	  </div>
<?php 
		     if(isset($_POST['submit'])){
				 $reply = $_POST['reply'];
				 if(!empty($reply)){
					 $reply_query ="insert into comments (post_id,user_id,comment,comment_author,comment_date)
	                                              values('$post_id','$user_id','$reply','$first_name',Now())";
				 }
				  if(mysqli_query($dbc,$reply_query)) {
		          echo "<center><p>reply has been added.</p></centre>";
	              }	 
			 }		 
 ?>
 <?php } ?>
   <?php include("all_comment.php"); ?>
 
 
  </div>
  </div>
  </div>
  </body>
  </html>