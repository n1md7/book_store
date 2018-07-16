<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/md/css/mdb.min.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/md/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/md/css/style.css">
    <script src="<?php echo ROOT_PATH; ?>assets/js/entoka.js"></script>
    <script src="<?php echo ROOT_PATH; ?>assets/md/js/jquery-3.2.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo ROOT_PATH; ?>assets/md/js/popper.min.js"></script>
    <title>Webstore</title>
  </head>
  <body>
    <script>
    // Tooltips Initialization
    $(function () {$('[data-toggle="tooltip"]').tooltip();});

    var ajax_url = "<?php echo AJAX; ?>"
    </script>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark primary-color animated slideInDown fixed-top">
      <!-- Navbar brand -->
      <a class="navbar-brand" href="<?php echo ROOT_PATH; ?>">Webstore</a>
      <!-- Collapse button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Collapsible content -->
      <div class="collapse navbar-collapse" id="basicExampleNav">
        <!-- Links -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo ROOT_PATH; ?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php if(!isset($_SESSION['is_loggedin'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo USER_SIGN_IN; ?>">Sign In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo USER_SIGN_UP; ?>">Sign Up</a>
          </li>
          <?php endif; ?>
          <?php if(isset($_SESSION['user_data']['is_admin']) && 
                    $_SESSION['user_data']['is_admin'] == 1): ?>
          <!-- Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="<?php echo USER_CATEGORIES; ?>"><i class="fa fa-tags"></i> Categories</a>
              <a class="dropdown-item" href="<?php echo USER_SEARCH; ?>"><i class="fa fa-users"></i> Users</a>
              <a class="dropdown-item" href="<?php echo USER_UPLOAD; ?>"><i class="fa fa-plus"></i> new Book</a>
            </div>
          </li>
        <?php endif; ?>
        </ul>
        <!-- Links -->
        <?php if(isset($_SESSION['is_loggedin'])): ?>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="<?php echo ADDBALANCE; ?>" data-toggle='tooltip' title="Click to add money" class="btn btn-primary">
                <span class="badge user-money">...</span> <i class="fa fa-euro"></i>
              </a>
            </li>
            <li>
              <a href="<?php echo USER_CART; ?>" title="Go to your cart" data-toggle='tooltip' class="btn btn-primary">
                <span class="badge cart-counter">...</span> <i class="fa fa-cart-plus"></i>
              </a>
            </li>
            <li>
              <a href="<?php echo USER_PROFILE; ?>" data-toggle='tooltip' title="Your profile" class="btn btn-primary"><i class="fa fa-user-o"></i> <?php echo $_SESSION['user_data']['username']; ?></a>
            </li>
            <li>
              <a href="<?php echo USER_SIGN_OUT; ?> " data-toggle='tooltip' title="User Sign Out" class="btn btn-danger"><i class="fa fa-sign-out"></i></a>
            </li>
          </ul>
        <?php endif; ?>
      </div>
      <!-- Collapsible content -->
    </nav>
    <!--/.Navbar-->

    <?php
      if( (($_GET['controller'] == 'home' && $_GET['action'] == 'index') ||
          ($_GET['controller'] == '' && $_GET['action'] == '')
          )&& !isset($_POST['search'])
        ):
    ?>
      
    <!--Carousel Wrapper-->
    <div id="carousel-example-2" class="carousel slide carousel-fade mt-4" data-ride="carousel">
        <!--Indicators-->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-2" data-slide-to="1"></li>
            <li data-target="#carousel-example-2" data-slide-to="2"></li>
            <li data-target="#carousel-example-2" data-slide-to="3"></li>
            <li data-target="#carousel-example-2" data-slide-to="4"></li>
        </ol>
        <!--/.Indicators-->
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="view">
                    <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(68).jpg" alt="First slide">
                    <div class="mask rgba-black-light"></div>
                </div>
                <div class="carousel-caption">
                    <h3 class="h3-responsive">Light mask</h3>
                    <p>First text</p>
                </div>
            </div>
            <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                    <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(6).jpg" alt="Second slide">
                    <div class="mask rgba-black-strong"></div>
                </div>
                <div class="carousel-caption">
                    <h3 class="h3-responsive">Strong mask</h3>
                    <p>Secondary text</p>
                </div>
            </div>
            <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                    <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(9).jpg" alt="Third slide">
                    <div class="mask rgba-black-slight"></div>
                </div>
                <div class="carousel-caption">
                    <h3 class="h3-responsive">Slight mask</h3>
                    <p>Third text</p>
                </div>
            </div>
            <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                    <img class="d-block w-100" src="<?php echo ROOT_URL;?>/assets/img/book1.jpg" alt="Third slide">
                    <div class="mask rgba-black-slight"></div>
                </div>
                <div class="carousel-caption">
                    <h3 class="h3-responsive">Slight mask</h3>
                    <p>Third text</p>
                </div>
            </div>
            <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                    <img class="d-block w-100" src="<?php echo ROOT_URL;?>/assets/img/book2.jpg" alt="Third slide">
                    <div class="mask rgba-black-slight"></div>
                </div>
                <div class="carousel-caption">
                    <h3 class="h3-responsive">Slight mask</h3>
                    <p>Third text</p>
                </div>
            </div>
            <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                    <img class="d-block w-100" src="<?php echo ROOT_URL;?>/assets/img/book3.jpg" alt="Third slide">
                    <div class="mask rgba-black-slight"></div>
                </div>
                <div class="carousel-caption">
                    <h3 class="h3-responsive">Slight mask</h3>
                    <p>Third text</p>
                </div>
            </div>
        </div>
        <!--/.Slides-->
        <!--Controls-->
        <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <!--/.Controls-->
    </div>
    <!--/.Carousel Wrapper-->
                    
    <?php endif; ?>

    <div class="container-fluid">
      <?php Messages::display(); ?>
      <?php require($view); ?>
      
      <!-- footer start -->
      <?php require('./views/footer.html'); ?>
      <!-- footer end -->
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo ROOT_PATH; ?>assets/md/js/bootstrap.min.js"></script>
    <script src="<?php echo ROOT_PATH; ?>assets/md/js/mdb.min.js"></script>
    <?php if( isset($_SESSION["is_loggedin"]) ): ?>
      <script src="<?php echo ROOT_PATH; ?>assets/js/reload_balance.js"></script>
    <?php endif; ?>
  </body>
</html>