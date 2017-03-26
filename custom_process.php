<?php require_once('startsession.php'); 
require_once('connectvars.php');

$processcode=$_POST['code'];
/* 
if($processcode=='vup' || $processcode=='vdw'){
	$postid=$_POST['postid'];
$query1 = mysqli_query($dbc,"SELECT tbl_updown_id,vote_status,type FROM tbl_postupdown_votes WHERE post_id = '".$postid."' and user_id='".$_SESSION['user_id']."'") or die(mysqli_error($dbc));
	  if(mysqli_num_rows($query1)==0){
	mysqli_query($dbc,"INSERT INTO tbl_postupdown_votes VALUES(null,'$processcode','".$_SESSION['user_id']."','".$postid."','1','".date('Y-m-d')."')") or die(mysqli_error($dbc));
	  }
	  else{
		  $row = mysqli_fetch_array($query1);
		  $vote_status=0;
		if($row['vote_status']==0){ $vote_status=1;}
		
	mysqli_query($dbc,"update tbl_postupdown_votes set type='$processcode',vote_status='".$vote_status."' where tbl_updown_id='".$row['tbl_updown_id']."'") or die(mysqli_error($dbc));
	 
	 }
$query2 = mysqli_query($dbc,"SELECT count(tbl_updown_id) FROM tbl_postupdown_votes WHERE post_id = '".$postid."' and type='$processcode'  and vote_status!=0") or die(mysqli_error($dbc));
$row2 = mysqli_fetch_array($query2);	  
	echo $row2[0];
} */

if($processcode=='vup' ){
	
$postid=$_POST['postid'];
$query1 = mysqli_query($dbc,"SELECT tbl_updown_id,vote_status FROM tbl_postupdown_votes WHERE post_id = '".$postid."' and user_id='".$_SESSION['user_id']."' and type='vup'") or die(mysqli_error($dbc));

$query2 = mysqli_query($dbc,"SELECT tbl_updown_id,vote_status FROM tbl_postupdown_votes WHERE post_id = '".$postid."' and user_id='".$_SESSION['user_id']."' and type='vdw'") or die(mysqli_error($dbc));

	  if(mysqli_num_rows($query1)==0){
	mysqli_query($dbc,"INSERT INTO tbl_postupdown_votes VALUES(null,'$processcode','".$_SESSION['user_id']."','".$postid."','1','".date('Y-m-d')."')") or die(mysqli_error($dbc));
	  }
	  else{
		  $row = mysqli_fetch_array($query1);
		  $status=1;
		if($row['vote_status']==1){ $status=0;}
	mysqli_query($dbc,"update tbl_postupdown_votes set vote_status='$status' WHERE tbl_updown_id='".$row[0]."'") or die(mysqli_error($dbc));
	if(mysqli_num_rows($query2)!=0){
		 $row1 = mysqli_fetch_array($query2);
		 $status1=0;
		  $row22 = mysqli_fetch_array($query1);
		if($row1['vote_status']==1 && $row22['vote_status']==1){ $status1=1;}
		
	mysqli_query($dbc,"update tbl_postupdown_votes set vote_status='$status1' WHERE tbl_updown_id='".$row1[0]."'") or die(mysqli_error($dbc));
		
	}
	 }
	 
$query2 = mysqli_query($dbc,"SELECT count(tbl_updown_id) FROM tbl_postupdown_votes WHERE post_id = '".$postid."' and vote_status!=0 and type='vup'") or die(mysqli_error($dbc));
$row2 = mysqli_fetch_array($query2);	  
echo $row2[0];
	
}

if($processcode=='vup1' ){
	$postid=$_POST['postid'];
	$votes=$_POST['votes'];
	$query2 = mysqli_query($dbc,"SELECT count(tbl_updown_id) FROM tbl_postupdown_votes WHERE post_id = '".$postid."' and vote_status!=0 and type='".$votes."'") or die(mysqli_error($dbc));
$row2 = mysqli_fetch_array($query2);	  
echo $row2[0];
}

if($processcode=='vdw' ){
	
$postid=$_POST['postid'];
$query1 = mysqli_query($dbc,"SELECT tbl_updown_id,vote_status FROM tbl_postupdown_votes WHERE post_id = '".$postid."' and user_id='".$_SESSION['user_id']."' and type='vup'") or die(mysqli_error($dbc));

$query2 = mysqli_query($dbc,"SELECT tbl_updown_id,vote_status FROM tbl_postupdown_votes WHERE post_id = '".$postid."' and user_id='".$_SESSION['user_id']."' and type='vdw'") or die(mysqli_error($dbc));

	  if(mysqli_num_rows($query2)==0){
	mysqli_query($dbc,"INSERT INTO tbl_postupdown_votes VALUES(null,'$processcode','".$_SESSION['user_id']."','".$postid."','1','".date('Y-m-d')."')") or die(mysqli_error($dbc));
	  }
	  else{
		  $row = mysqli_fetch_array($query2);
		  $status=1;
		if($row['vote_status']==1){ $status=0;}
	mysqli_query($dbc,"update tbl_postupdown_votes set vote_status='$status' WHERE tbl_updown_id='".$row[0]."'") or die(mysqli_error($dbc)); 
	if(mysqli_num_rows($query1)!=0){
		 $row1 = mysqli_fetch_array($query1);
		$status1=0;
		  $row22 = mysqli_fetch_array($query2);
		if($row1['vote_status']==1 && $row22['vote_status']==1){ $status1=1;}
		
	mysqli_query($dbc,"update tbl_postupdown_votes set vote_status='$status1' WHERE tbl_updown_id='".$row1[0]."'") or die(mysqli_error($dbc));
		
	}
	 }
	 
$query2 = mysqli_query($dbc,"SELECT count(tbl_updown_id) FROM tbl_postupdown_votes WHERE post_id = '".$postid."' and vote_status!=0 and type='vdw'") or die(mysqli_error($dbc));
$row2 = mysqli_fetch_array($query2);	  
echo $row2[0];
	
}

if($processcode=='likeduser'){
	$userid=$_POST['userid'];
$query1 = mysqli_query($dbc,"SELECT tbl_like_id,status FROM tbl_userpost_like WHERE user_id_liked = '".$userid."' and user_id='".$_SESSION['user_id']."'") or die(mysqli_error($dbc));
	  if(mysqli_num_rows($query1)==0){
	mysqli_query($dbc,"INSERT INTO tbl_userpost_like VALUES(null,'".$_SESSION['user_id']."','".$userid."','1','".date('Y-m-d')."')") or die(mysqli_error($dbc));
	  }
	  else{
		  $row = mysqli_fetch_array($query1);
		  $status=1;
		if($row['status']==1){ $status=0;}
	mysqli_query($dbc,"update tbl_userpost_like set status='$status' WHERE tbl_like_id='".$row[0]."'") or die(mysqli_error($dbc));
	 
	 }
	 
$query2 = mysqli_query($dbc,"SELECT count(tbl_like_id) FROM tbl_userpost_like WHERE user_id_liked = '".$userid."' and status!=0") or die(mysqli_error($dbc));
$row2 = mysqli_fetch_array($query2);	  
	echo $row2[0];
}

/* Coded by Jain software. Developer Rahul Rajak. */

?>