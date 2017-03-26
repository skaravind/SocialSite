<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body {
      font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;
  }
  h2 {
      font-size: 24px;
      color: #6db4ff;
      font-weight: 600;
      margin-bottom: 30px;
  }
  h4 {
      font-size: 19px;
      line-height: 1.375em;
      color: #303030;
      font-weight: 400;
      margin-bottom: 30px;
  }  
  .jumbotron {
      background-color:#36465D;
      color: #6db4ff;
      padding: 150px 2px;
      font-family: Montserrat, sans-serif;
  }
  .jumbotron h2 {
	    color: inherit;
	   display: block;
	   padding:15px ;
	      font-size:3rem;
    line-height: 1.75rem;
    font-family: "Guardian Egyptian Web","Guardian Text Egyptian Web",Georgia,serif;
    font-weight: 800;
  }
   .jumbotron p {
	    color: inherit;
	   display: block;
    font-family: "Guardian Egyptian Web","Guardian Text Egyptian Web",Georgia,serif;
   
  }
  .container-fluid {
      padding:60px 40px;
  }
  .logo-small {
      color: #36465D ;
      font-size: 50px;
  }
  .logo {
      color: #36465D;
      font-size: 150px;
  }
 
  .carousel-control.right, .carousel-control.left {
      background-image: none;
      color: #f4511e;
  }
  .carousel-indicators li {
      border-color: #f4511e;
  }
  .carousel-indicators li.active {
      background-color: #f4511e;
  }
  .item h4 {
      font-size: 19px;
      line-height: 1.375em;
      font-weight: 400;
      font-style: italic;
      margin: 70px 0;
  }
  .item span {
      font-style: normal;
  }
  .panel {
      border: 1px solid #f4511e; 
      border-radius:0 !important;
      transition: box-shadow 0.5s;
  }
  .panel:hover {
      box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
      border: 1px solid #f4511e;
      background-color: #fff !important;
      color: #f4511e;
  }
  .panel-heading {
      color: #fff !important;
      background-color: #f4511e !important;
      padding: 25px;
      border-bottom: 1px solid transparent;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
  }
  .panel-footer {
      background-color: white !important;
  }
  .panel-footer h3 {
      font-size: 32px;
  }
  .panel-footer h4 {
      color: #aaa;
      font-size: 14px;
  }
  .panel-footer .btn {
      margin: 15px 0;
      background-color: #f4511e;
      color: #fff;
  }
  .navbar {
      margin-bottom: 0;
      background-color:#36465D ;
      z-index: 9999;
      border: 0;
      font-size: 12px !important;
      line-height: 1.42857143 !important;
      
      border-radius: 0;
      font-family: Montserrat, sans-serif;
	  box-shadow:0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #f4511e !important;
      background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
  }
  .logoname{
	   color: inherit;
	   display: block;
	   padding:15px ;
	      font-size:3rem;
    line-height: 1.75rem;
    font-family: "Guardian Egyptian Web","Guardian Text Egyptian Web",Georgia,serif;
    font-weight: 800;
  }
  footer .glyphicon {
      font-size: 20px;
      margin-bottom: 20px;
      color: #f4511e;
  }
  .slideanim {visibility:hidden;}
  .slide {
      animation-name: slide;
      -webkit-animation-name: slide;
      animation-duration: 1s;
      -webkit-animation-duration: 1s;
      visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
        width: 100%;
        margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
        font-size: 150px;
    }
  }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand logoname" href="index.php">the<font color=" #6db4ff">tweaks</font></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
	    <li><a href="#mission">Mission</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#services">More</a></li>
		<li><a href="#team">Team</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h2>thetweaks believes</h2> 
  <p>an idea that can change the course of the system can come from anywhere,anybody.</p> 

</div>
<div id="portfolio" class="container-fluid text-center bg-grey">
  <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
	  <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <h4>"DO you have the habit of finding flaws in the system? "</h4>
      </div>
      <div class="item">
       <h4>"Do you keep suggesting people when you find them lousy?"</h4>
      </div>
	  <div class="item">
       <h4>"Do you keep ideas within yourself and keep cussing the system?"</h4>
      </div>
      <div class="item">
        <h4>" Do you find yourself helpless in playing your part to change the system?"<br><span style="font-style:normal;">If any of your answers is in <b>YES</b>, then <b>THETWEAKS</b> is for you.</span></h4>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  </div>
  <div id="mission" class="container-fluid bg-grey">
  <div class="row">
  <h2>Our Mission</h2><br>
    <div class="col-sm-4">
	 
      <span class="glyphicon glyphicon-globe logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h4><strong>Our Mission:</strong> To give everyone the power to create and share ideas so each of you can help,create the change you want to see in the World.</h4><br>
    </div>
  </div>
</div>

<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2>About thetweaks</h2><br>
      <h4>Give voice to the problems you face in your daily life and suggest solutions alongwith it. 
	  Thetweaks provides you a platform to publish your creative ideas and have some healthy discussion over it. Connect with right people,discuss with them and find a viable solution. You can upvote,comment,share the ideas by passing on your ideas to that organisation concerned.</h4><br>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-pencil logo"></span>
    </div>
  </div>
</div>


<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">
  <div class="row slideanim">
    <div class="col-sm-6">
      <span class="glyphicon glyphicon-fast-forward logo-small"></span>
     <h4>Will the system change by my ideas ?</h4>
  <p>We don't guarantee that but we hope that whatever ideas the organisation will find applicable, they will definitely bring it into their system.</p>
    </div>
    <div class="col-sm-6">
      <span class="glyphicon glyphicon-heart logo-small"></span>
      <h4>So in a Nutshell:</h4>
      <p>We provide you the platform to discuss your ideas, make it more practical and then serve as a channel of transmission of your ideas to that particular organisation.</p>
    </div>
</div>

<!-- Container (Portfolio Section) -->
<div id="team" class="container-fluid">
  <h2  class="text-left">Executive People</h2><br>
  <h4>Who created thetweaks?</h4>
  <div class="row text-center slideanim">
    <div class="col-sm-4">
      <div class="thumbnail">
        <p><strong>Rajesh Kumar</strong></p>
        <p>Founder</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        
        <p><strong>Deepanshu Pal</strong></p>
        <p>Co-Founder</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <p><strong>Sushil Prabhat</strong></p>
        <p>Co-Founder</p>
      </div>
    </div>
  </div><br>
</div>
 <div class="text-center">
 <p>See everyone what's tweaking...</p>
 <a href="signup.php"><button class="btn btn-default btn-lg">JOIN NOW</button></a>
</div>
<hr>
<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p><a href="about.php">About</a>&nbsp; | &nbsp;<a href="contact.php">Contact</a> &nbsp;| &nbsp;<a href="contact.php">FAQ</a>&nbsp; |&nbsp; Thetweaks &copy; 2017</p>
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>
</body>
</html>
