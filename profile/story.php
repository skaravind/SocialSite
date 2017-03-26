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
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/starrr.css">
   <link rel="stylesheet" type="text/css" href="profile_style.css" />
 <style>

</style>
<style type='text/css'>
    img.ribbon {
      position: fixed;
      z-index: 1;
      top: 0;
      right: 0;
      border: 0;
      cursor: pointer; }


    input {
      width: 30px;
      margin: 10px 0;
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
		
 	
$queryrate = mysqli_query($dbc,"SELECT count(*),sum(ratingnum) FROM tbl_rate_autobiography WHERE touser_id = '".$user_id."'") or die(mysqli_error($dbc));
$rowrate = mysqli_fetch_array($queryrate);
	
$out=5;
	
if($rowrate[0]!=0){$out=ceil($rowrate[1]/$rowrate[0]);}
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
?>
	<div class="container col-md-12 col-sm-12 col-xs-12">
   <p class="col-md-4 col-sm-4 col-xs-12">Please rate this Story:</p>
   <div class="col-md-8 col-sm-8 col-xs-12">  
   <div class='starrr' id='star2'></div>
   <br/>
   <input type='hidden' name='rating' value='<?php echo $out;?>' id='star2_input' />
   <input type='hidden' name='user_id' value='<?php echo $user_id;?> ' id="user_id1"  />
   </div>
	 
 </div> 
 </div>
</div>
</div>
   <div id="footer-text"><?php include("includes/footer.php");?> </div>
    <script src="../js/starrr.js"></script>
  <script>

    $('#star1').starrr({
      change: function(e, value){
        if (value) {
          $('.your-choice-was').show();
          $('.choice').text(value);
        } else {
          $('.your-choice-was').hide();
        }
		
      }
    });

    var $s2input = $('#star2_input');
    $('#star2').starrr({
      max: 5,
      rating: $s2input.val(),
      change: function(e, value){
        $s2input.val(value).trigger('input');
		$.post('processrating.php',{rating:$s2input.val(),user_id:$("#user_id1").val()},function(data){});
      }	  
    });
	/* Coded by Jain software. Developer Rahul Rajak. */
  </script>
</body>
</html> 

   
   
   
 