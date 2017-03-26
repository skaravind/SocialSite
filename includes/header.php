<header>
<style>

.navbar-default {
    background-color: #36465d; border-color: #36465d;
}
.navbar-inverse {
    background-color: #36465d!important;
    border-color: #F1F1F1!important;
}
 .logoname{
	   color: inherit;
	   display: block;
	   padding:15px ;
	      font-size:3rem;
    line-height: 1.75rem;
    font-family: "Guardian Egyptian Web","Guardian Text Egyptian Web",Georgia,serif;
    font-weight: 900;
  }
  .logoname .usertitle{fontsize:10px;}
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
</style>


<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <a class="navbar-brand logoname" href="welcome.php">the<font color=" #6db4ff">tweaks</font></a>
	    
    </div>
    <div class="navbar-collapse collapse" style="height: 1px;">
      	   <ul class="nav navbar-nav navbar-right">
            <li><a href="profile/index.php">Profile</a></li>
            <li><a href="about.php">About</a></li>
            <li class="dropdown" class="hidden-md">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" title="Only for mobile">
			  Category <span class="caret"></span></a>
              <ul class="dropdown-menu" style="background:#36465d;">
			<li><a href="search.php?category=academics">#Academics</a></li>
         <li><a href="search.php?category=admission">#Admission</a></li>
         <li><a href="search.php?category=placements">#Placements</a></li>
		 <li><a href="search.php?category=internship">#Internship</a></li>
		 <li><a href="search.php?category=study">#Education</a></li>
		    <li><a href="search.php?category=society">#Society</a></li>
			<li><a href="search.php?category=business">#Business</a></li>
			<li><a href="search.php?category=sports">#Sports</a></li>
			<li><a href="search.php?category=lifestyle">#Lifestyle</a></li>
			
			<li><a href="search.php?category=development">#Development</a></li>
			<li><a href="search.php?category=innovative">#Innovation</a></li>
			
			
			
			<li><a href="search.php?category=others">#Others</a></li>
              </ul>
            </li>
			<?php if($_SESSION['user_id']==1){ ?>
			<li class="dropdown1"><a href= "adminpanel.php">Admin Panel </a></li>
			<?php } ?>
            <li><a href= "insert_view.php">WriteTweak</a></li>
            <li class=""><a href="logout.php">Logout</a></li>
			
          </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>
		
</header>
     