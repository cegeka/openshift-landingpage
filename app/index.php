<!DOCTYPE html>
<html class="no-js">
  <head>
	<meta name="generator" content="Hugo 0.48" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cegeka MCP OpenShift Product Landing Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="" content="">

    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

    <link rel="preload" href="https://fonts.googleapis.com/css?family=Droid+Serif:400i|Source+Sans+Pro:300,400,600,700" as="style" onload="this.rel='stylesheet'">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700" as="style" onload="this.rel='stylesheet'">
`
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="themefisher-fonts.css">
    <link rel="stylesheet" type="text/css" href="owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet" type="text/css" href="responsive.css">
  </head>

  <body id="body">

  	<div id="preloader-wrapper">
  		<div class="pre-loader"></div>
  	</div>
    <div class="container">
      <nav class="navbar navigation" id="top-nav">
        <a class="navbar-brand logo" href="#">
          <h1><?php if (getenv('CUSTOMER')) { echo 'Landing page for ' . getenv('CUSTOMER'); } ?></h1>
        </a>

        <button class="navbar-toggler hidden-lg-up float-lg-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" >
          <i class="tf-ion-android-menu"></i>
        </button>
        <div class="collapse navbar-toggleable-md" id="navbarResponsive">
        </div>
      </nav>
    </div>


    <section class="hero-area">
      <div class="container">
        <div class="row">
          <div class="col-md-6 text-center">
            <img src="open-shift-logo.png" alt="Watch">
          </div>
          <div class="col-md-6">
            <div class="block">
              <h1 class="">Cegeka</h1>
              <h2 class="">Your trusted partner in times of digital transformation</h2>
              <p>Cegeka’s mission is to help customers survive and thrive in a world where the rules of the game are constantly changing. We do this by ‘unburdening’ C-level decision makers and helping them become digital to the core.</p>
              <a class="btn btn-success" href="https://www.cegeka.com" role="button">www.cegeka.com</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer>
      <div class="container text-center">
        <div class="row">
          <div class="col-md-12">
            <div class="block">
              <a href="" class="footer-logo"><?php $start = microtime(true); $end = microtime(true); $hostname = gethostname(); printf("Page was generated in %f seconds on $hostname", $end - $start); ?></a>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="js/vendor/jquery-2.1.1.min.js"></script>
    <script src="js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/main.js"></script>

  </body>
</html>
