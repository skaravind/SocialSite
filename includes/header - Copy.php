<header>

<?php require_once('connectvars.php');
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
     <div class ="navbar">
     <ul>
	    <li class="dropdown1"><a href= "welcome.php">Home</a></li>
		<li class="dropdown1"><a href= "profile/index.php">Profile</a></li>
		<li class="dropdown"><a href= "#" >Categories</a></li>
		<li class="dropdown1"><a href= "welcome.php">Notification <?php echo $notice;?></a></li>
		<?php if($_SESSION['user_id']==1){ ?>
		<li class="dropdown1"><a href= "adminpanel.php">Admin Panel </a></li>
		<?php } ?>
		<li class="dropdown1" style="float:right;"><a href="logout.php">Logout</a></li>
		<li class="dropdown1" style ="float:right;"><a href= "insert_view.php">WriteView</a></li>
	 </ul>
	 </div>
	 <div class="navbar navbar1" style="display:none;">
	 <ul class="dropdown-content" style="background:#36465d;">		    
			<li><a href="search.php?category=makeinindia">Make In India</a></li>
		    <li><a href="search.php?category=politics">Politics</a></li>
		    <li><a href="search.php?category=society">Society</a></li>
			<li><a href="search.php?category=business">Business</a></li>
			<li><a href="search.php?category=sports">Sports</a></li>
			<li><a href="search.php?category=lifestyle">Lifestyle</a></li>
			<li><a href="search.php?category=reform">Reform</a></li>
			<li><a href="search.php?category=development">Development</a></li>
			<li><a href="search.php?category=innovative">Innovative</a></li>
			<li><a href="search.php?category=engineering">Engineering</a></li>
			<li><a href="search.php?category=study">Study</a></li>
			<li><a href="search.php?category=genral">General</a></li>
		</ul>
	 </div>
  <style>
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>

</header>
