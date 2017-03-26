<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip({
        placement : 'top'
    });
});
</script>
<div id="sidebar_post" > 
 <h5 style="padding-left:5px;">People to follow</h5>
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
 <div class="container-fluid">
 <div class="row">
 <?php if(!empty($user_pic)){
	 echo '<div class="col-md-3 col-sm-3 col-xs-3">
	  <a href="http://thetweaks.com/profile/index.php?user_id= ' . $user_id .'" data-toggle="tooltip" title=" '. $user_firstname .' '. $user_lastname .'">
	 <img src ="profile/images/' . $user_pic . '" class="img-rounded" style="padding-bottom:5px;" width="70" height="70"></a></div>';
	 }
 } ?>
 </div>
 <br>
  <a href="users.php">[See more...]</a>
 </div>
 <hr />
   <div class="popular"> 
<h5>Most Popular</h5>
<?php
	$query1 = mysqli_query($dbc,"select post_id,count(post_id) as maxid from tbl_postupdown_votes where type='vup' and vote_status=1 group by post_id order by maxid DESC LIMIT 0,20") or die(mysqli_error($dbc));
	
	while($row1 = mysqli_fetch_array($query1)){
	$query = "select * from posts where post_id ='".$row1['post_id']."'";
	$run = mysqli_query($dbc,$query) or die(mysqli_error($dbc));
	$row = mysqli_fetch_array($run);
		$post_id = $row['post_id'];
		$title = $row['post_title'];
		$author = $row['post_author'];
		$image = $row['post_image'];
		$post_date = $row['post_date'];
		
$query21 = mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '".$row['user_id']."'") or die(mysqli_error($dbc));
$row12 = mysqli_fetch_array($query21);

?>
  <div class="row">
  <div class="col-xs-4">
  <img src = "images/<?php if(!empty($image)){echo  $image  ;} else { echo 'default.png';}?>"></div>
  <div class="col-xs-8 details"><h4><a href ="pages.php?id=<?php echo $post_id ;?>"><?php echo $title ;?></a></h4>
  <p class="sideview">By&nbsp <b style="color:#4E5357;"><a href="http://thetweaks.com/profile/index.php?user_id=<?php echo $row['user_id'];?>">
  <?php echo $row12['first_name'].' '.$row12['last_name']; ?></b></a></span>
   <span style="color:#797373; font-size:10px;">  <?php echo date('d M', strtotime($post_date)); ?></span><br>
	<span class="sideview">[Upvoted &nbsp<?php echo $row1['maxid'];?>] </span>
   </div>
 </div>  <hr>
	<?php } ?>
	</div>
</div> 