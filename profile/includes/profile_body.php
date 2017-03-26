 <div id ="profile_body" class="col-md-8 col-sm-8 col-xs-12">
	 <div><?php include("profile_body_nav.php");?></div>
 <div class ="body_main"  style="padding-bottom:10px;">
   <div id ="bio_body" class="col-md-12 col-sm-12 col-xs-12">
 <?php
    echo '<div class="table-responsive"><table class="col-md-12 col-sm-12 col-xs-12">';
    echo '<tr><th><h4>Basic Info</h4></th></tr>';
	if (!empty($row['first_name']) || !empty($row['last_name'])) {
      echo '<tr><div class="col-md-5 col-sm-5 col-xs-6 col-md-offset-1"><td>Full name </td></div>
	            <div class="col-md-5 col-sm-5 col-xs-6"><td class="basicfill">' . $row['first_name'] . ' &nbsp' . $row['last_name'] . '</td></div></tr>';
    }
	 if (!empty($row['username'])) {
      echo '<tr><div class="col-md-4 col-sm-4 col-xs-6"><td>Username:</td></div>
	            <div class="col-md-4 col-sm-4 col-xs-6"><td class="basicfill">' . $row['username'] . '</td></div></tr>';
    }
	if (!empty($row['gender'])) {
      echo '<tr><div class="col-md-4 col-sm-4 col-xs-6"><td>Gender </td></div><td>';
      if ($row['gender'] == 'M') {
        echo '<div class="basicfill">Male</div>';
      }
      else if ($row['gender'] == 'F') {
        echo '<div class="basicfill">Female</div>';
      }
      else {
        echo '?';
      }
      echo '</td></tr>'; 
    }
    if (!empty($row['birthdate'])) {
      if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
        // Show the user their own birthdate
        echo '<tr><div class="col-md-4 col-sm-4 col-xs-6"><td>Birthday</td></div>
		          <div class="col-md-4 col-sm-4 col-xs-6"><td class="basicfill">' . date('d-m-Y',strtotime($row['birthdate'])) . '</td></div></tr>';
      }
      else {
        // Show only the birth year for everyone else
        list($year, $month, $day) = explode('-', $row['birthdate']);
        echo '<tr><div class="col-md-4 col-sm-4 col-xs-6"><td>Birthdate</td></div>
		<div class="col-md-4 col-sm-4 col-xs-6"><td class="basicfill">' . $year . '</td></div></tr>';
      }
    }
	
    if (!empty($row['city']) || !empty($row['state']) || !empty($row['country'])) {
      echo '<tr><div class="col-md-4 col-sm-4 col-xs-6"><td>Lives In</td></div>
	  <div class="col-md-4 col-sm-4 col-xs-6"><td class="basicfill">' . $row['city'] . ',&nbsp' . $row['state'] . ',&nbsp' . $row['country'] . '</td></div></tr>';
    }
	if (!empty($row['join_date'])) {
      echo '<tr><div class="col-md-4 col-sm-4 col-xs-6"><td>Member Since</td></div>
	  <div class="col-md-4 col-sm-4 col-xs-6"><td class="basicfill">' . date('d-m-Y',strtotime($row['join_date'])) . '</td></div></tr>';
    }
	echo '<tr><th><h4>Extended Info</h4></th></tr>';
	if (!empty($row['next_five'])) {
      echo '<tr><td>Where are you looking for next 5 years?</td>
	        <td class="basicfill">' . $row['next_five'] . '</td></tr>';
    }
	if (!empty($row['political_views'])) {
      echo '<tr><td>Political Views</td><td class="basicfill">' . $row['political_views'] . '</td></tr>';
    }
	if (!empty($row['movies'])) {
      echo '<tr><td>Favorite film list(at least 3)</td><td class="basicfill">' . $row['movies'] . '</td></tr>';
    }
	if (!empty($row['intrests'])) {
      echo '<tr><td>Intrests </td><td class="basicfill">' . $row['intrests'] . '</td></tr>';
    }
	if (!empty($row['status'])) {
      echo '<tr><td>Relationship Status</td><td class="basicfill">' . $row['status'] . '</td></tr>';
    }
    if (!empty($row['picture'])) {
      echo '<tr><td>Picture</td><td class="basicfill"><img src="' . MM_UPLOADPATH . $row['picture'] .
        '" alt="Profile Picture" width="80" height="80"/></td></tr>';
	}
	echo '</table></div>';
    
?>
</div>
 </div> 
</div>