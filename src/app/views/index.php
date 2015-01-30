<!DOCTYPE html>
<html lang="en" ng-app="ecommerceApp">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home :: Vazar</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700,800|Roboto:400,100,300,300italic,400italic,700,900|Abel' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
  </head><!--/head-->

  <body ng-cloak="">
    <header id="header"><!--header-->
      <div class="header_top"><!--header_top-->
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <div class="contactinfo">
                <ul class="nav nav-pills">								
                  <li><a href="#"><i class="icon-envelope"></i> info@domain.com</a></li>
                  <li><a href="#"><i class="icon-phone"></i> +2 95 01 88 821</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="social-icons pull-right">
                <ul class="nav navbar-nav">
                  <li><a href="#"><i class="icon-facebook"></i></a></li>
                  <li><a href="#"><i class="icon-twitter"></i></a></li>
                  <li><a href="#"><i class="icon-linkedin"></i></a></li>
                  <li><a href="#"><i class="icon-dribbble"></i></a></li>
                  <li><a href="#"><i class="icon-google-plus"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div><!--/header_top-->

      <div class="header-middle"><!--header-middle-->
        <div class="container">
          <div class="row">
            <div class="col-sm-3">
              <div class="logo pull-left">
                <a href="#/"><img src="images/home/logo.png" alt="" /></a>
              </div>
            </div>
            <div class="col-sm-5">
              <form class="form search_box" action="#" method="get">
                <div class="input-group input-group-lg">                  
                  <input type="text" class="form-control" placeholder="Laptop,Car,TV..." name="q">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-default" type="button"><i class="icon-search icon-1x"></i></button>                    
                  </span>
                </div><!-- /input-group -->
              </form>
            </div>
            <div class="col-sm-4">
              <div class="shop-menu pull-right">
                <ul class="nav navbar-nav">								
                  <li><a href="#"><i class="icon-star"></i> Wishlist</a></li>								
                  <li><a href="#/cart"><i class="icon-shopping-cart"></i> Cart</a></li>
                  <li><a href="#/user"><i class="icon-lock"></i> Login</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div><!--/header-middle-->
    </header><!--/header-->
    <section id="conaten-area">
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <div class="left-sidebar">
                <h2>Category</h2>
              <div class="panel-group category-products" id="accordian"  ng-controller="CategoryShowCtrl"><!--category-productsr-->
                <div class="panel panel-default" ng-repeat="category in categories">                    
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordian" href="#{{category.code}}">
                        <span class="badge pull-right"><i class="icon-plus"></i></span>
                       {{category.name}}
                      </a>
                    </h4>
                  </div>
                  <div id="{{category.code}}" class="panel-collapse collapse">
                    <div class="panel-body">
                      <ul>
                        <li ng-repeat="item in category.child"><a href="#/category/{{category.code}}/sub/{{item.code}}">{{item.name}} </a></li>

                      </ul>
                    </div>
                  </div>
                </div>

              </div><!--/category-products-->

              <div class="brands_products"><!--brands_products-->
                <h2>Brands</h2>
                <div class="brands-name">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                    <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                    <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                    <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                    <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                    <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                    <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                  </ul>
                </div>
              </div><!--/brands_products-->

              <div class="price-range"><!--price-range-->
                <h2>Price Range</h2>
                <div class="well text-center">
                  <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                  <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                </div>
              </div><!--/price-range-->

              <div class="shipping text-center"><!--shipping-->
                <img src="images/home/shipping.jpg" alt="" />
              </div><!--/shipping-->

            </div>
          </div>

          <div class="col-sm-9 padding-right">
           <div data-ng-view="" id="ng-view" class="slide-animation"></div>            


          </div>
        </div>
      </div>
    </section>

    <footer id="footer"><!--Footer-->      

      <div class="footer-widget">
        <div class="container">
          <div class="row">
            <div class="col-sm-2">
              <div class="single-widget">
                <h2>Service</h2>
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="#">Online Help</a></li>
                  <li><a href="#">Contact Us</a></li>
                  <li><a href="#">Order Status</a></li>
                  <li><a href="#">Change Location</a></li>
                  <li><a href="#">FAQ’s</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="single-widget">
                <h2>Quock Shop</h2>
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="#">T-Shirt</a></li>
                  <li><a href="#">Mens</a></li>
                  <li><a href="#">Womens</a></li>
                  <li><a href="#">Gift Cards</a></li>
                  <li><a href="#">Shoes</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="single-widget">
                <h2>Policies</h2>
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="#">Terms of Use</a></li>
                  <li><a href="#">Privecy Policy</a></li>
                  <li><a href="#">Refund Policy</a></li>
                  <li><a href="#">Billing System</a></li>
                  <li><a href="#">Ticket System</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="single-widget">
                <h2>About Shopper</h2>
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="#">Company Information</a></li>
                  <li><a href="#">Careers</a></li>
                  <li><a href="#">Store Location</a></li>
                  <li><a href="#">Affillate Program</a></li>
                  <li><a href="#">Copyright</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-3 col-sm-offset-1">
              <div class="single-widget">
                <h2>About Shopper</h2>
                <form action="#" class="searchform">
                  <input type="text" placeholder="Your email address" />
                  <button type="submit" class="btn btn-default"><i class="icon-arrow-circle-o-right"></i></button>
                  <p>Get the most recent updates from <br />our site and be updated your self...</p>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <div class="container">
          <div class="row">
            <p class="pull-left">Copyright © 2015 Vazar. All rights reserved.</p>
            <p class="pull-right">Designed by <span><a target="_blank" href="http://www.ergov.com">Ergo Ventures Ltd.</a></span></p>
          </div>
        </div>
      </div>

    </footer><!--/Footer-->



  <script type="text/javascript" src="js/lib/angular/angular.min.js"></script>
  <script type="text/javascript" src="js/lib/angular/angular-resource.min.js"></script>
  <script type="text/javascript" src="js/lib/angular/angular-route.min.js"></script>
  <script type="text/javascript" src="js/lib/angular/angular-file-upload.js"></script>
  <script type="text/javascript" src="js/lib/angular/ui-bootstrap-tpls-0.12.0.js"></script>

  <script type="text/javascript" src="js/angular/app.js"></script>
  <script type="text/javascript" src="js/angular/routes.js"></script>
  <script type="text/javascript" src="js/angular/controllers.js"></script>
  <script type="text/javascript" src="js/angular/services.js"></script>
  <script type="text/javascript" src="js/angular/directives.js"></script>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/price-range.js"></script>
  <script type="text/javascript" src="js/jquery.scrollUp.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>