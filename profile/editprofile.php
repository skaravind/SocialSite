<?php require_once('startsession.php');
 if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="../index.php">log in</a> to access this page.</p>';
	$home_url = 'http://thetweaks.com/index.php';
    echo '<script>location.assign("'.$home_url.'");</script>';
    exit();
	}
?>
 <!DOCTYPE html>
<head>
<title>Thetweaks | Edit profile </title>
 <meta charset="UTF-8" />	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
 <meta name=viewport content="width=device-width,initial-scale=1,user-scalable=no">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="profile_style.css" />
<link href="../css/bootstrap.min.css" rel="stylesheet">
<style>
input[type=text] {
    padding: 5px 5px;
    margin:0px 0px 8px 0px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit] { padding: 5px 5px;
    margin:10px 0px 8px 0px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box; }
</style>
</head>
<body>
      <div><?php include("includes/header.php");?> </div>
      <div class = "container">
      <div><?php include("includes/searchbox.php");?> </div>
      
	
 <?php
    require_once('appvars.php');
	require_once('connectvars.php');
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
 if(isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
    $last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
    $gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
    $birthdate = mysqli_real_escape_string($dbc, trim($_POST['birthdate']));
    $city = mysqli_real_escape_string($dbc, trim($_POST['city']));
    $state = mysqli_real_escape_string($dbc, trim($_POST['state']));
	$country = mysqli_real_escape_string($dbc, trim($_POST['country']));
	$next_five = mysqli_real_escape_string($dbc, trim($_POST['next_five']));
	$political_views = mysqli_real_escape_string($dbc, trim($_POST['political_views']));
	$politician = mysqli_real_escape_string($dbc, trim($_POST['politician']));
	$movies = mysqli_real_escape_string($dbc, trim($_POST['movies']));
	$intrests = mysqli_real_escape_string($dbc, trim($_POST['intrests']));
	$status = mysqli_real_escape_string($dbc, trim($_POST['status']));
    $old_picture = mysqli_real_escape_string($dbc, trim($_POST['old_picture']));
    $new_picture = mysqli_real_escape_string($dbc, trim($_FILES['new_picture']['name']));
    $Bio = mysqli_real_escape_string($dbc, trim($_POST['Bio']));
    $contactemail = mysqli_real_escape_string($dbc, trim($_POST['contactemail']));
	
    $new_picture_type = $_FILES['new_picture']['type'];
    $new_picture_size = $_FILES['new_picture']['size']; 
		$image_tmp = $_FILES['new_picture']['tmp_name'];
    list($new_picture_width, $new_picture_height) = getimagesize($_FILES['new_picture']['tmp_name']);
    $error = false;
	move_uploaded_file($image_tmp,"images/$new_picture");
   if(!empty($new_picture)) {
	 if((($new_picture_type =='image/gif') || ($new_picture_type =='image/jpeg') || ($new_picture_type =='image/pjgeg') || ($new_picture_type =='image/png'))
	&& ($new_picture_size > 0) && ($new_picture_size <= MM_MAXFILESIZE) && ($new_picture_width <= MM_MAXIMGWIDTH) && ($new_picture_height <= MM_MAXIMGHEIGHT)){
		
		if($_FILES['file']['error'] == 0 ){
			$target = MM_UPLOADPATH . basename($new_picture);
			if(move_uploaded_file($image_tmp,"images/$new_picture")) {
				if(!empty($old_picture) && ($old_picture != $new_picture)) {
					@unlink(MM_UPLOADPATH . $old_picture);
				}
			}
			else{
				@unlink($_FILES['new_picture']['tmp_name']);
				$error = true;
				echo '<p class ="error">Sorry there was problem in uploading picture.</p>';
			}
		}
	}
	    else {
        @unlink($_FILES['new_picture']['tmp_name']);  
        $error = true;
      }
   }
     
		if(!empty($new_picture)) {
			$query ="UPDATE users SET  first_name ='$first_name', last_name ='$last_name', gender ='$gender', birthdate = '$birthdate', city ='$city', state ='$state',contactemail ='$contactemail', country ='$country',Bio ='$Bio',next_five ='$next_five',political_views ='$political_views',politician ='$politician',movies ='$movies',intrests ='$intrests',status ='$status', picture ='$new_picture' WHERE user_id = '" . $_SESSION['user_id'] . "'";
		}
		else{
			$query ="UPDATE users SET  first_name ='$first_name', last_name ='$last_name', gender ='$gender', birthdate = '$birthdate', city ='$city', state ='$state',contactemail ='$contactemail', country ='$country', Bio ='$Bio',next_five ='$next_five',political_views ='$political_views',politician ='$politician',movies ='$movies',intrests ='$intrests',status ='$status' WHERE user_id = '" . $_SESSION['user_id'] . "'";
		}
		mysqli_query($dbc, $query);
		
		$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
       echo '<script>location.assign("'.$home_url.'");</script>';
        mysqli_close($dbc); 		
		exit();
	
 }
  else{
	  $query = "SELECT * FROM users WHERE user_id = '" . $_SESSION['user_id'] . "'" ;
	  $result = mysqli_query($dbc, $query);
	  $row = mysqli_fetch_array($result);
	    if($row != NULL) {
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$gender = $row['gender'];
			$birthdate = $row['birthdate'];
			$city = $row['city'];
			$state = $row['state'];
			$country = $row['country'];
			$next_five = $row['next_five'];
			$political_views = $row['political_views'];
			$politician = $row['politician'];
			$movies = $row['movies'];
			$intrests= $row['intrests'];
			$status = $row['status'];
			$old_picture = $row['picture'];
		}
		else {
			echo '<p class ="error">Sorry,There was a problem in accessing your accunt.</p>';
		}
    }
	 $query = "SELECT * FROM users WHERE user_id = '" . $_SESSION['user_id'] . "'" ;
	  $result = mysqli_query($dbc, $query);
	  $row = mysqli_fetch_array($result);
	    if($row != NULL) {
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
	    }
	
		mysqli_close($dbc); 
?>
<form  enctype="multipart/form-data" method ="post" action ="<?php echo $_SERVER['PHP_SELF']; ?>">
   
<div id ="profile_sidebar"  class="col-md-4 col-sm-4 col-xs-12">
    <div class ="profile_image">
	      <div class="thumbnail">
          
                 <img src="images/<?php echo $row['picture'];?>" alt="Profile photo" style="width:100%; max-height:380px;">
           <div class="caption">
           <div class="text-center"><button class="user_liked" datavalue="<?php echo $_SESSION['user_id'];?>">Follow <?php echo $row21[0] ;?></button></div><br /><br />
          <div style="padding-left:14px; color:#36465D;"><h3><b><?php echo $first_name.' '.$last_name; ?></b></h3></div>  
  <input class="col-md-12 col-sm-12 col-xs-12 inputbio" type ="text" id = "Bio" placeholder="Add Bio: Student | NIT | Singer etc." name ="Bio" value ="<?php if(!empty($row['Bio'])) echo $row['Bio'];  ?>" /><br />
   <input class="col-md-12 col-sm-12 col-xs-12 inputbio" type ="text" id = "contactemail" placeholder="Email or Contact" name ="contactemail" value ="<?php if(!empty($row['contactemail'])) echo $row['contactemail'];  ?>" /><br />
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
     <div id ="profile_body" class="col-md-8 col-sm-8 col-xs-12">
    <div><?php include("includes/profile_body_nav.php");?></div>
 <div class ="body_main col-md-12 col-sm-12 col-xs-12" >
   <input type ="hidden" name ="MM_FILE_SIZE" value ="<?php echo MM_MAXFILESIZE; ?>" />
  <h3>Basic Info :</h3>
  <br>
   <div class="row">
   <label class="col-md-4 col-sm-4 col-xs-4 hidden-xs hidden-sm" for ="fistname">First Name: </label>
   <input class="col-md-6 col-sm-6 col-xs-12" type ="text" id = "firstname" name ="firstname" placeholder="First Name" value ="<?php if(!empty($first_name)) echo $first_name;  ?>" /><br />
   </div>
   <div class="row">
   <label class="col-md-4 col-sm-4 col-xs-4 hidden-xs hidden-sm" for ="lastname">Last Name: </label>
   <input class="col-md-6 col-sm-6 col-xs-12" type ="text" id = "lastname" name ="lastname" placeholder="Last Name" value ="<?php if(!empty($last_name)) echo $last_name;  ?>" /><br />
  </div>
  <div class="row">
   <label class="col-md-4 col-sm-4 col-xs-4" for ="gender">Gender: </label>
   <select class="col-md-3 col-sm-3 col-xs-5" id ="gender" name ="gender">
      <option value ="M" <?php if(!empty($gender) && $gender =='M') echo 'selected = "selected"'; ?>>Male</option>
	  <option value ="F" <?php if(!empty($gender) && $gender =='F') echo 'selected = "selected"'; ?>>Female</option>
    </select><br />
   </div>
   <div class="row">
   <label class="col-md-4 col-sm-4 col-xs-4" for ="birthdate">Birthdate: </label>
   <input class="col-md-3 col-sm-3 col-xs-5" type ="date" id = "birthdate" name ="birthdate" placeholder="Birthdate" value ="<?php if(!empty($birthdate)) echo $birthdate; else echo 'YYYY-MM-DD';  ?>" /><br />
   </div>
   <div class="row">
   <label class="col-md-4 col-sm-4 col-xs-4 hidden-xs hidden-sm" for ="city">City: </label>
   <input class="col-md-6 col-sm-6 col-xs-12" type ="text" id = "city" name ="city" placeholder="City" value ="<?php if(!empty($city)) echo $city;  ?>" /><br />
  </div>
  <div class="row">
   <label class="col-md-4 col-sm-4 col-xs-4 hidden-xs hidden-sm" for ="state">State: </label>
   <input class="col-md-6 col-sm-6 col-xs-12" type ="text" id = "state" name ="state" placeholder="State" value ="<?php if(!empty($state)) echo $state;  ?>" /><br />
   </div>
   <div class="row">
   <label class="col-md-4 col-sm-4 col-xs-4 hidden-xs hidden-sm" for ="state">Country: </label>
   <input class="col-md-6 col-sm-6 col-xs-12" type ="text" id = "country" name ="country" placeholder="Country" value ="<?php if(!empty($country)) echo $country;  ?>" /><br />
	</div>
   
   
   <h3>Extended Info :</h3>   
   <div class="row">
   <label class="col-md-4 col-sm-4 col-xs-4 hidden-xs hidden-sm" for ="next_five">Where you looking for next 5 years? : </label>
   <input class="col-md-6 col-sm-6 col-xs-12" type ="text" id = "next_five" name ="next_five" placeholder="Where you looking for next 5 years?" value ="<?php if(!empty($next_five)) echo $next_five;  ?>" /><br />
   </div>
   <div class="row">   
   <label class="col-md-4 col-sm-4 col-xs-4 hidden-xs hidden-sm" for ="political_views">Political Views: </label>
   <input class="col-md-6 col-sm-6 col-xs-12" type ="text" id = "political_views" name ="political_views" placeholder="Political Views" value ="<?php if(!empty($political_views)) echo $political_views;  ?>" /><br />
   </div>
   
   <div class="row">
   <label class="col-md-4 col-sm-4 col-xs-4 hidden-xs hidden-sm" for ="movies">Favorite film: </label>
   <input class="col-md-6 col-sm-6 col-xs-12" type ="text" id = "movies" name ="movies" placeholder="Favorite film list(at least 3)" value ="<?php if(!empty($movies)) echo $movies;  ?>" /><br />
   
   </div><div class="row">
   <label class="col-md-4 col-sm-4 col-xs-4 hidden-xs hidden-sm" for ="intrests">Interests: </label>
   <input class="col-md-6 col-sm-6 col-xs-12" type ="text" id = "intrests" name ="intrests" placeholder="Interests" value ="<?php if(!empty($intrests)) echo $intrests;  ?>" /><br />
   
   </div><div class="row">
   <label class="col-md-4 col-sm-4 col-xs-4 hidden-xs hidden-sm" for ="status">Relationship Status: </label>
   <input class="col-md-6 col-sm-6 col-xs-12" type ="text" id = "status" name ="status" placeholder="Relationship Status" value ="<?php if(!empty($status)) echo $status;  ?>" /><br />
   
   </div><div class="row">
   <input class="col-md-6 col-sm-6 col-xs-6" type ="hidden" name = "old_picture" value ="<?php if(!empty($old_picture)) echo $old_picture;  ?>" /><br />
   </div>
   <div class="row">
   <label class="col-md-4 col-sm-4 col-xs-8" for ="new_picture">Update Profile Picture: </label>
   <input class="col-md-6 col-sm-6 col-xs-4" type ="file" id = "new_picture" name ="new_picture" />
   <?php if(!empty($old_picture)) {
   echo '<img class ="profile" src ="' . MM_UPLOADPATH . $old_picture . '" alt ="profile picture" style="width:100px; height:80px;"/>'; }?></br /></div>
  <input class="col-md-4 col-sm-4 col-xs-4 savebutton" type ="submit" value ="Save profile" name ="submit" />
   </form>
 </div>
</div> 
</div>    <div id ="footer-text"><?php include("includes/footer.php");?> </div>
</body>
</html> 
   
   
   
 