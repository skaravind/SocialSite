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

?><style>
.navbar-default {
    background-color: #36465d; border-color: #36465d;
}
body{
	    background: #F1F1F1;
}
.navbar {
      margin-bottom:0;
      background-color:#36465D;
      z-index: 9999;
      border: 0; 
      border: 0; 
      font-size: 14px !important;
      line-height: 1.42857143 !important;
      border-radius: 0;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #F1F1F1 !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #36465D !important;
      background-color: #F1F1F1 !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #F1F1F1 !important;
  }
body{background: #F1F1F1;}
 .logoname{
	   color: inherit;
	   display: block;
	   padding:15px ;
	      font-size:3rem;
    line-height: 1.75rem;
    font-family: "Guardian Egyptian Web","Guardian Text Egyptian Web",Georgia,serif;
    font-weight: 900;
  }
</style>
		
     <nav class="navbar navbar-default navbar-fixed-top">  
	 <div class="container">      
	 <div class="navbar-header">      
	 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">     
	 <span class="sr-only">Toggle navigation</span>       
     <span class="icon-bar"></span>          
	 <span class="icon-bar"></span>          
	 <span class="icon-bar"></span></button>  
	 <a class="navbar-brand logoname" href="../welcome.php">the<font color=" #6db4ff">tweaks</font></a></div>      
	 <div id="navbar" class="navbar-collapse collapse">      
	 <ul class="nav navbar-nav navbar-right">
	 <li><a href="index.php">Profile</a></li>      
	 <li><a href="../about.php">About </a></li>         
	 <li clas