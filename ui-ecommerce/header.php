<?php require_once('initialize.php'); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Bootstrap-ecommerce by Vosidiy">
 <meta property="og:url"           content="https://localhost/ecommerce/ui-ecommerce/index.php" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="Zeroone" />
  <meta property="og:description"   content="Buy products from our Zeroone website :)" />
  <meta property="og:image"         content="https://localhost/ecommerce/ui-ecommerce/images/logo.png" />

<title>Zeroone</title>

<link rel="shortcut icon" type="image/x-icon" href="images/logo.jpg">

<!-- jQuery -->
<script src="js/jquery-2.0.0.min.js" type="text/javascript"></script>

<!-- Bootstrap4 files-->
<script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">

<!-- plugin: owl carousel  -->
<link href="plugins/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="plugins/owlcarousel/assets/owl.theme.default.css" rel="stylesheet">
<script src="plugins/owlcarousel/owl.carousel.min.js"></script>

<!-- custom style -->
<link href="css/ui.css" rel="stylesheet" type="text/css"/>
<link href="css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />

<!-- custom javascript -->
<script src="js/script.js" type="text/javascript"></script>

<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
  // jQuery code

}); 
// jquery end
</script>

</head>
<body>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <script
    type="text/javascript"
    async defer
    src="//assets.pinterest.com/js/pinit.js"
></script>
<header class="section-header">

<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="index.php"><img class="logo" src="images/logo.jpg" alt="alibaba style e-commerce html template file" title="alibaba e-commerce html css theme"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop" aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTop">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">   Contact </a>
            <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="contact.php">Contact us</a></li>

            </ul>
        </li>
    <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">  About </a>
            <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="about.php">About us </a></li>
            </ul>
        </li>
    <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">   Terms </a>
            <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="terms.php">Terms & Conditions</a></li>

            </ul>
        </li>
      </ul>

      <?php
      if(isset($_SESSION['user_email'])){
        echo '

        
         <ul class="navbar-nav">
        
    <li class="nav-item"><a href="logout.php" class="nav-link" > Sign out  </a></li>
    
      </ul> <!-- navbar-nav.// -->';       
      }


      ?>
     
    </div> <!-- collapse.// -->
  </div>
</nav>
<section class="header-main shadow-sm">
  <div class="container">
<div class="row-sm align-items-center">
  <div class="col-lg-4-24 col-sm-3">
  <div class="category-wrap dropdown py-1">
    <button type="button" class="btn btn-light  dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-bars"></i> Brands</button>
    <div class="dropdown-menu">
      <?php getBrandsDropdown(); ?>
      
    </div>
  </div> 
  </div>
  <div class="col-lg-11-24 col-sm-8">
      <form action="search.php" class="py-1" method="get">
        <div class="input-group w-100">
         
            <input type="text" name="search" class="form-control" style="width:50%;" placeholder="Search">
            <div class="input-group-append">
              <button class="btn btn-warning" type="submit">
                <i class="fa fa-search"></i> Search 
              </button>
            </div>
          </div>
      </form> <!-- search-wrap .end// -->
  </div> <!-- col.// -->
<?php
    if (!isset($_SESSION['user_email'])) {
    echo '<div class="d-flex justify-content-end">
      <div class="widget-header">
        <small class="title text-muted">Welcome guest!</small>
        <div> <a href="login.php">Sign in</a> <span class="dark-transp"> | </span>
        <a href="register.php"> Register</a></div>
      </div>
      
    </div>';
    }
  ?>
  <?php 

  if (isset($_SESSION['user_email'])) {
  echo '<div class="col-lg-9-24 col-sm-12">
    <div class="widgets-wrap float-right row no-gutters py-1">
      <div class="col-auto">
      <div class="widget-header dropdown">
        <a href="#" data-toggle="dropdown" data-offset="20,10">
          <div class="icontext">
            <div class="icon-wrap"><i class="text-warning icon-sm fa fa-user"></i></div>
            <div class="text-wrap text-dark">
              
              My account <i class="fa fa-caret-down"></i>
            </div>
          </div>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="profile.php">Edit personal info</a>
            <a class="dropdown-item" href="order_history.php">My orders</a>
            <a class="dropdown-item" href="deactivate.php">Deactivate account</a>

        </div> <!--  dropdown-menu .// -->
      </div>  <!-- widget-header .// -->
      </div> <!-- col.// -->
      <div class="col-auto">
        <a href="cart.php" class="widget-header">
          <div class="icontext">
            <div class="icon-wrap"><i class="text-warning icon-sm fa fa-shopping-cart"></i></div>
            <div class="text-wrap text-dark">
              Cart
            </div>
          </div>
        </a>
      </div> <!-- col.// -->
      <div class="col-auto">
        <a href="wishlist.php" class="widget-header">
          <div class="icontext">
            <div class="icon-wrap"><i class="text-warning icon-sm  fa fa-heart"></i></div>
            <div class="text-wrap text-dark">
              <div>Favorites</div>
            </div>
          </div>
        </a>
      </div> <!-- col.// -->
    </div> <!-- widgets-wrap.// row.// -->
  </div> <!-- col.// -->';
 } 
  ?>
  </div> <!-- col.// -->
</div> <!-- row.// -->
  </div> <!-- container.// -->
</section> <!-- header-main .// -->
</header> <!-- section-header.// -->

