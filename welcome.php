<?php require_once('startsession.php');
	 if (!isset($_SESSION['user_id'])) {   
  echo '<p class="login">Please <a href="index.php">log in</a> to access this page.</p>';	
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'index.php';  
  echo '<script>location.assign("'.$home_url.'");</script>';   
  exit();   
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Thetweaks - What's your idea of the problem you're facing?</title>
<meta name="description" content="Welcome To Thetweaks. Follow your friends,teachers,co-workers to know what and how do they want to change the Society to make batter.connect the best brains">
<meta charset="UTF-8" />	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
<link rel="stylesheet" type="text/css" href="style.css" /> 
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/customcss.css" /> 
<style>
.navbar-default {
    background-color: #36465d;border-color: #36465d;
}
body{
	    background: #F1F1F1;
}
</style>
</head>
<body>
<?php include_once("analyticstracking.php") ?>
   <div><?php include("includes/header.php");?> </div>
   <div class ="container">
   <div><?php include("includes/searchbox.php");?> </div>
   </div>
   <section>
   <div class ="container">
     <div class="row">
   <div id="" class="col-md-2 col-sm-12 ">
   <div class="hidden-xs hidden-sm"><?php include("includes/sidbar.php");?></div>
    <div  class="hidden-xs hidden-sm"><h4>NOTIFICATION</h4>
	
	<?php 
	require_once('connectvars.php');
$query_user11 = mysqli_query($dbc, "SELECT recentpost_date,recentupvote_date FROM tbl_notification WHERE user_id = '".$_SESSION['user_id']."' order by tbl_id DESC") or die(mysqli_error($dbc)) ;
$result_user11 = mysqli_fetch_array($query_user11);

$query_notification1 =  mysqli_query($dbc, "SELECT count(*) FROM posts WHERE post_date >= '".$result_user11[0]."' and user_id IN (select user_id_liked from tbl_userpost_like where user_id='".$_SESSION['user_id']."' and status='1')") or die(mysqli_error($dbc)) ;
$result_notification1 = mysqli_fetch_array($query_notification1);

$query_notification2 = mysqli_query($dbc, "SELECT count(*) FROM tbl_postupdown_votes WHERE date_created >= '".$result_user11[1]."' and vote_status=1 and type='vup' and user_id !='".$_SESSION['user_id']."'")  or die(mysqli_error($dbc)) ;
$result_notification2 = mysqli_fetch_array($query_notification2);

$notice='';

if($result_notification1[0]!=0){$notice.='Post('.$result_notification1[0].') - ';}
if($result_notification2[0]!=0){$notice.='Upvote('.$result_notification2[0].')';}

?>
<p style="color:grey;"><a href="welcome.php">Notification <?php echo $notice;?></a></p>
	
	
	</div>
   </div>
   <div class="col-md-6 col-sm-12 col-xs-12 content1"> <?php include("includes/main_body.php");?></div>
   <div class="col-md-4 col-sm-12 col-xs-12"><?php include("includes/sidebar_post.php");?></div> 
    </div>
   </div>
   </section>
   <div id="footer-text"><?php include("includes/footer.php");?> </div>
</body>
</html>