<?php require_once('startsession.php');?>
<?php require_once('connectvars.php'); ?>
<!DOCTYPE html>
<head>
<title> <?php 
    $page_id = $_GET['id'];
	$query = "select * from posts where post_id = '".$page_id."'";
	$run = mysqli_query($dbc,$query) or die(mysqli_error($dbc));
	$row = mysqli_fetch_array($run);
		$post_id = $row['post_id'];
		$title = $row['post_title'];
	$query21 = mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '".$row['user_id']."'") or die(mysqli_error($dbc));
    $row12 = mysqli_fetch_array($query21);
	

     echo $row12['first_name'].' '.$row12['last_name'];?> - <?php echo $title;?></title>
   <meta charset="UTF-8" />	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
<link rel="stylesheet" type="text/css" href="style.css" />
 <link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/customcss.css" />
<link href="assets/css/summernote.css" rel="stylesheet">
<style>
body{background-color:#F1F1F1;}
</style> 
</head>
<body>
<?php include_once("analyticstracking.php") ?>
   <div><?php include("includes/header.php");?> </div>
   <div class ="container">
   <div><?php include("includes/searchbox.php");?> </div>   </div>
   <section>    <div class ="container">    <div class="row"><div id="" class="col-md-2 col-sm-12 ">	<div class="hidden-xs hidden-sm"><?php include("includes/sidbar.php");?></div> </div>
   <div class="col-md-6 col-sm-12 col-xs-12 content1"> <?php include("includes/page_content.php");?></div> <div class="col-md-4 col-sm-12 col-xs-12"><?php include("includes/sidebar_post.php");?></div>
  </div> </div> </section>
   <div id ="footer-text"><?php include("includes/footer.php");?> </div>
   </body>
</html>