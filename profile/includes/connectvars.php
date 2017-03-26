<?php define('DB_HOST', 'localhost');	  define('DB_USER', 'thetweaks_nitrr');	  define('DB_PASSWORD', 'Nitrr12!');	  define('DB_NAME', 'thetweaks_nitrr');   $dbc = mysqli_connect( DB_HOST,DB_USER,DB_PASSWORD,DB_NAME );   
$query_visitor1 = mysqli_query($dbc,"SELECT * FROM tbl_daliy_visitors WHERE tbl_ipaddress = '".$_SERVER['SERVER_ADDR']."' and created_date = '".date('Y-m-d')."'") or die(mysqli_error($dbc));

	if(mysqli_num_rows($query_visitor1)==0 || mysqli_num_rows($query_visitor1)==null){
	 mysqli_query($dbc,"INSERT INTO tbl_daliy_visitors VALUES( null,'".$_SERVER['SERVER_ADDR']."',NOW())") or die(mysqli_error($dbc));

	}
?>