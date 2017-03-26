<?php
   include("includes/connect.php");
   $get_post_id = $_GET['id'];
   $query = "SELECT * FROM posts where post_id = '$get_post_id' ";
   $data = mysql_query($query);
?>