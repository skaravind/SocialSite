<div class="body_nav col-md-12 col-sm-12 col-xs-12">
  <div class="row">
 <?php if (isset($_GET['user_id'])) { ?>
		  <ul class="nav nav-tabs">
            <li role="presentation" class="activa"><a href="index.php?user_id=<?php echo $_GET['user_id'];?>"><b>Basic</b></a></li>
            <li role="presentation" class="activa"><a href="story.php?user_id=<?php echo $_GET['user_id'];?>"><b>Autobiography</b></a></li>
            <li role="presentation" class="activa"><a href="articles.php?user_id=<?php echo $_GET['user_id'];?>"><b>Articles</b></a></li>
         </ul>
 <?php }
 else{
	 ?>
	 <ul class="nav nav-tabs">
            <li role="presentation" class="activa"><a href="index.php"><b>Basic</b></a></li>
            <li role="presentation" class="activa"><a href="story.php"><b>Autobiography</b></a></li>
            <li role="presentation" class="activa"><a href="articles.php"><b>Articles</b></a></li>
         </ul>
 <?php } ?>
     </div>
	 </div>