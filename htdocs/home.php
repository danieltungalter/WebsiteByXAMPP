<?php
session_start();
require_once 'connect.php';
//echo "<H1>Welcome! ".$_SESSION["login_user"].".</H1>";

?>
<head>
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <meta charset="iso-8859-1">
	<link rel="stylesheet" href="styles/layout.css" type="text/css">
<title>
	Online Manufacturing - Home
</title>
</head>

<style>
* {box-sizing:border-box}

/* Slideshow container */
.slideshow-container {
  max-width: 700px;
  position: relative;
  margin: auto;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: Black;
  font-size: 20px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

#gotop {
    position:fixed;
    font-weight: bold;
    font-size: 30px;
    z-index:90;
    right:30px;
    bottom:31px;
    display:none;
    width:50px;
    height:50px;
    color:#fff;
    background:#ff9900;
    line-height:50px;
    border-radius:50%;
    transition:all 0.5s;
    text-align: center;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
}
#gotop :hover{
    background:#0099CC;
}
</style>

<body>
<div id='cssmenu'>
<ul>
	<li class='welmess'>
   <?php
   if (isset($_SESSION["login_user"]) && !empty($_SESSION["login_user"])) {
   echo "<a><H1>Welcome! ".$_SESSION["login_user"].".</H1></a>";
 } else {
   echo "<a><H1>Please login in the account!</H1></a>";
 }
   ?>
   </li>
</ul>
</div>
<div class="wrapper row1">
  <header id="header" class="clear">
    <div id="hgroup">
      <h1><a href="home.php">Best Manufacturer</a></h1>
      <h2>The Best Manufacturing</h2>
    </div>
    <nav>
      <ul>
        <form action="search_result.php" id="searchform" method="get" class="searchbox-container">
        <input type="text" id="searchbox" name="searchbox" class="searchbox" />
        <input type="submit" class="searchbox-btn" value="Search" />
        <input type="hidden" name="action" value="search" />
        <li><a href="home.php">Home</a></li>
        <li><a href="product.php">Products</a></li>
        <li><a href="cart.php">Cart</a></li>
        <li class="last"><a href="logout.php">Log out</a></li>
      </ul>
    </nav>
  </header>
</div>

<div class="wrapper row2">
  <div id="container" class="clear">
    <!-- Slider -->
    <div class="slideshow-container">

<div class="mySlides fade">
  <img src="images/iphoneX.jpg" style="width:100%">
  <div class="text">iPhone X</div>
</div>

<div class="mySlides fade">
  <img src="img/iphoneX.jpg" style="width:100%">
  <div class="text">iPhone X</div>
</div>

<div class="mySlides fade">
  <img src="images/iphone7.jpg" style="width:100%">
  <div class="text">iPhone 7</div>
</div>

<div class="mySlides fade">
  <img src="img/iphone7.jpg" style="width:100%">
  <div class="text">iPhone 7</div>
</div>

<div class="mySlides fade">
  <img src="images/iphone8.jpg" style="width:100%">
  <div class="text">iPhone 8</div>
</div>

<div class="mySlides fade">
  <img src="images/iphone8p.jpg" style="width:100%">
  <div class="text">iPhone 8 Plus</div>
</div>

<div class="mySlides fade">
  <img src="img/iphone8.jpg" style="width:100%">
  <div class="text" style="color:white;">iPhone 8</div>
</div>

<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
<span class="dot" onclick="currentSlide(1)"></span>
<span class="dot" onclick="currentSlide(2)"></span>
<span class="dot" onclick="currentSlide(3)"></span>
<span class="dot" onclick="currentSlide(4)"></span>
<span class="dot" onclick="currentSlide(5)"></span>
<span class="dot" onclick="currentSlide(6)"></span>
<span class="dot" onclick="currentSlide(7)"></span>
</div>
<br><br>
<script>
var slideIndex = 1;
showSlides(slideIndex);
var myTimer;
myTimer = setInterval(function(){plusSlides(1);}, 5000);

function plusSlides(n) {
  clearInterval(myTimer);
  showSlides(slideIndex += n);
  if (n = -1){
    myTimer = setInterval(function(){plusSlides(n + 2);}, 5000);
  } else {
    myTimer = setInterval(function(){plusSlides(n + 1);}, 5000);
  }
}

function currentSlide(n) {
  clearInterval(myTimer);
  showSlides(slideIndex = n);
  if (n = -1){
    myTimer = setInterval(function(){plusSlides(n + 2);}, 5000);
  } else {
    myTimer = setInterval(function(){plusSlides(n + 1);}, 5000);
  }
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
</script>
    <!-- main content -->
    <div id="homepage">
      <section id="latest">
        <article>
          <figure>
            <ul class="clear">
              <li class="one_third"><img src="images/iphone7.jpg" width="290" height="250" alt=""></li>
              <li class="one_third"><img src="images/iphone8.jpg" width="290" height="250" alt=""></li>
              <li class="one_third lastbox"><img src="images/iphone8p.jpg" width="290" height="250" alt=""></li>
            </ul>
            <br><br>
            <ul class="clear">
              <li class="one_third"><img src="img/iphone7.jpg" width="290" height="250" alt=""></li>
              <li class="one_third"><img src="img/iphone8.jpg" width="290" height="250" alt=""></li>
              <li class="one_third lastbox"><img src="img/iphoneX.jpg" width="290" height="250" alt=""></li>
            </ul>
            <figcaption><a href="product.php">View All Our Products &raquo;</a></figcaption>
          </figure>
        </article>
      </section>
      <!-- / latest work -->
    </div>
    <div style="background-color:#ff9900;color:black;font-size: 1vw;text-align:center;padding:10px;margin-top:7px;">© copyright bestmanufacturer.com</div>
  </div>
</div>

<a href="home.php" id="gotop"> ^
   <i class="fa fa-angle-up"></i>
</a>

<script type="text/javascript">
$(function() {
    /* 按下GoTop按鈕時的事件 */
    $('#gotop').click(function(){
        $('html,body').animate({ scrollTop: 0 }, 'slow');   /* 返回到最頂上 */
        return false;
    });

    /* 偵測卷軸滑動時，往下滑超過400px就讓GoTop按鈕出現 */
    $(window).scroll(function() {
        if ( $(this).scrollTop() > 400){
            $('#gotop').fadeIn();
        } else {
            $('#gotop').fadeOut();
        }
    });
});
</script>

</body>
<html>
