<?php require_once('startsession.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thetweaks | Users</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
 .navbar-default {
    background-color: #36465d;border-color: #36465d;
}
body{
	   background:#FFFFFF;
}

  </style>
</head>
 <body>
         <?php include_once("analyticstracking.php") ?>
         <div><?php include("includes/header.php");?> </div> 
		 <br>
		 <br>
		 <br>
		 <div class="container-fluid col-md-offset-1 col-md-6 col-sm-6 col-xs-12" >  
		 
           <h4>People to follow</h4>
   <br>
    <?php 
     require_once('connectvars.php');   
     $show_users = "select * from users";
	 $run_users = mysqli_query($dbc,$show_users)  or die(mysqli_error($dbc));
	 while($row12 = mysqli_fetch_array($run_users)){
		 $user_id = $row12['user_id'];
		 $user_pic = $row12['picture'];
		 $user_firstname = $row12['first_name'];
		 $user_lastname = $row12['last_name'];
 ?>
		<div class="media">
    <div class="media-left">
	 <a href="http://thetweaks.com/profile/index.php?user_id=<?php echo $row12['user_id']; ?>">
      <img src="profile/images/<?php if(!empty($user_pic)){echo $row12['picture'] ;} else{ echo 'iconimage.jpg';}?>" class="media-object img-rounded" width="60" height="60"></a>
    </div>
    <div class="media-body">
      <h4 class="media-heading"><a href="http://thetweaks.com/profile/index.php?user_id=<?php echo $row12['user_id']; ?>">
	 <span style="color:black;"> <?php echo "$user_firstname  $user_lastname " ;?></span></a> <small style="padding-left:5px;">Since <?php echo date('d M',strtotime($row12['join_date']));?></small></h4>
      <p><?php if(!empty($row12['Bio'])) {echo $row12['Bio'];} else {echo  $row12['username'];}?></p>
    </div>
  </div>  
 <?php } ?>		 
		 </div>
		
   
   
 </body>
 </html>