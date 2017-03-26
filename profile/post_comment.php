<?php 
		     if(isset($_POST['submit'])){
				 $reply = $_POST['reply'];
				 if(!empty($reply)){
					 $reply_query ="insert into comments (post_id,user_id,comment,comment_date)
	                                               values('$post_id','$user_id','$reply',Now())";
				 }
				 if(mysql_query($reply_query)) {
		          echo "<center><p>reply has been added.</p></centre>";
	             }
				 
				 
			 }
 ?>