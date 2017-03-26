<?php require_once('startsession.php');
 if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="welcome.php">log in</a> to access this page.</p>';
	$home_url = 'http://thetweaks.com/index.php';
    echo '<script>location.assign("'.$home_url.'");</script>';
    exit();
	}
?>
 <!DOCTYPE html>
<head>
     <title>Thetweaks | Autobiography</title>
  <meta charset="UTF-8" />	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">		
  <meta name=viewport content="width=device-width,initial-scale=1,user-scalable=no">
<link href="../css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="profile_style.css" />
 <style>
body{width:610;}
.demo-table {width: 100%;border-spacing: initial;margin: 20px 0px;word-break: break-word;table-layout: auto;line-height:1.8em;color:#333;}
.demo-table th {background: #999;padding: 5px;text-align: left;color:#FFF;}
.demo-table td {border-bottom: #f0f0f0 1px solid;background-color: #ffffff;padding: 5px;}
.demo-table td div.feed_title{text-decoration: none;color:#00d4ff;font-weight:bold;}
.demo-table ul{margin:0;padding:0;}
.demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
.demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
.rating {
    width: 300px;
    height: 34px;
    background-color: #f6f3f3;
}
 
.rating label {
    text-indent: -100px;
    width: 40px !important;
    height: 30px;
    overflow: hidden;
    cursor: pointer;
}
 
.label {
    float: left;
    padding-top: 3px;
}
         
input[type="radio"] {
    padding-right: 4px;
    position: absolute;
    left: 340px;
    margin-top: 10px;
}
                 
input[type="radio"], .rating label.stars {
    float: left;
    line-height: 30px;
    height: 30px;
}
 
span + input[type=radio] + label, legend + input[type=radio] + label {
    clear: right;
    margin-right: 80px;
    counter-reset: checkbox;
}
 
.rating label.stars {
    background: transparent url('images/star_off.png') no-repeat center center;
}
 
.rating label.stars:hover ~ label.stars, 
.rating label.stars:hover, 
.rating input[type=radio][name=stars]:checked ~ label.stars {
    background-image: url('images/star.png');
    counter-increment: checkbox;
}
 
.rating input[type=radio][name=stars]:required + label.stars:after {
    content: counter(checkbox) " stars!";
}
</style>
</head>
<body>
      <div><?php include("includes/header.php");?> </div>
     <div class="container">
      <div><?php include("includes/searchbox.php");?> </div>
	 <?php
   require_once('appvars.php');
   require_once('connectvars.php');
   $user_id='';
   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
   if (!isset($_GET['user_id'])) {
    $query = "SELECT * FROM users WHERE user_id = '" . $_SESSION['user_id'] . "'";
	 $user_id=$_SESSION['user_id'];
  }
  else {
    $query = "SELECT * FROM users WHERE user_id = '" . $_GET['user_id'] . "'";
	 $user_id=$_GET['user_id'];
  }
    $data = mysqli_query($dbc, $query);
    if (mysqli_num_rows($data) == 1) {
    $row = mysqli_fetch_array($data);
	$query21 = mysqli_query($dbc,"SELECT count(tbl_like_id) FROM tbl_userpost_like WHERE user_id = '".$user_id."' and status!=0") or die(mysqli_error($dbc));
	$row21 = mysqli_fetch_array($query21);

	$queryrate = mysqli_query($dbc,"SELECT * FROM tbl_rate_autobiography WHERE user_id = '".$user_id."'") or die(mysqli_error($dbc));
	$rowrate = mysqli_fetch_array($queryrate);
		
   if(!empty($_POST["rating"])) {
   if(mysqli_num_rows($queryrate)==0) {
		mysqli_query($dbc, "insert tbl_rate_autobiography value(null,'".$user_id."','".$_POST["rating"]."',NOW())");
		}
   else {
		mysqli_query($dbc, "UPDATE tbl_rate_autobiography SET ratingnum='" . $user_id . "' WHERE user_id = '".$user_id."'");
		}
	}
	
	$queryrate = mysqli_query($dbc,"SELECT * FROM tbl_rate_autobiography WHERE user_id = '".$user_id."'") or die(mysqli_error($dbc));
	$rowrate = mysqli_fetch_array($queryrate);
	
	$out='';
if(mysqli_num_rows($queryrate)!=0){$out=$rowrate['ratingnum'];}
 $query = "SELECT * FROM users WHERE user_id = '" . $user_id . "'" ;
	  $result = mysqli_query($dbc, $query);
	  $row = mysqli_fetch_array($result);
	    if($row != NULL) {
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
	    }
	
	?>
<div id ="profile_sidebar"  class="col-md-4 col-sm-4 col-xs-12">
    <div class ="profile_image">
          <div class="thumbnail">
                 <img src="images/<?php echo $row['picture'];?>" class="img-responsive" alt="Profile photo" style="width:100%; max-height:380px; ">
            <div class="caption">
           <div class="text-center"><button class="user_liked" datavalue="<?php echo $_SESSION['user_id'];?>">Follow <?php echo $row21[0] ;?></button></div><br /><br />
   <div style="padding-left:14px; color:#36465D;"><h3><b><?php echo $first_name.' '.$last_name; ?></b></h3></div>
   <div class="col-md-12 col-sm-12 col-xs-12"><p><?php if(!empty($row['Bio'])) echo $row['Bio'];  ?></p></div><br />
   <div  class="col-md-12 col-sm-12 col-xs-12"><p><?php if(!empty($row['contactemail'])) echo $row['contactemail'];  ?></p></div><br />
   <label  class="col-md-12 col-sm-12 col-xs-12 biocontainer">
   <div class="row">
   <?php if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
      echo '<button><a href="editprofile.php">Edit Profile</a></button>';
	  echo '<button><a href="editstory.php">Edit Autobiography</a></button>';
    }?> </div>
	</label><br />
  		   </div>
         </div>
    </div>
</div>   
   <div id ="profile_body"  class="col-md-8 col-sm-8 col-xs-12">
	      <div><?php include("includes/profile_body_nav.php");?></div>
   <div class ="body_main" style="min-height:345px;">
   <h3 align="center">Autobiography</h3>
   <?php
    
  if (!empty($row['story'])) {
      echo '<p class="autobio">' . $row['story'] . '</p>';
    }
}	
else {
    echo '<p class="error">There was a problem accessing your biography.</p>';
  }
?>	<div class="container">
  
  
   <p>Please rate this Story:</p>
    <fieldset class="rating">     
        <input type="radio" name="stars" id="4_stars" value="4" >
        <label class="stars" for="4_stars">4 stars</label>
        <input type="radio" name="stars" id="3_stars" value="3" >
        <label class="stars" for="3_stars">3 stars</label>
        <input type="radio" name="stars" id="2_stars" value="2" >
        <label class="stars" for="2_stars">2 stars</label>
        <input type="radio" name="stars" id="1_stars" value="1" >
        <label class="stars" for="1_stars">1 star</label>
        <input type="radio" name="stars" id="0_stars" value="0" required>
        <label class="stars" for="0_stars">0 star</label>
    </fieldset>
	 <form name="formrate" action="" method="post">
   <input type="hidden" name="rating" id="rating"  value="<?php echo $out;?> ">  
   
   </form>
 </div> 
 </div>
</div>
</div>
   <div id="footer-text"><?php include("includes/footer.php");?> </div>
</body>
</html> 
   
   
   
 