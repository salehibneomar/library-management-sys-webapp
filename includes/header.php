<?php
    include_once 'config/init.php';
    $pageName = basename($_SERVER['PHP_SELF'], '.php');
    $pageTitle = ucwords(str_replace("-"," ", $pageName));

    $pageTitle = ($pageTitle=="Index" || $pageTitle=="") ? "Home" : $pageTitle;

    $hasLoggedInMember = false;
    if(isset($_SESSION['loggedInMember'])
        && !empty($_SESSION['loggedInMember'])
        && !empty(trim($_SESSION['loggedInMember']['u_email']))
        && !empty(trim($_SESSION['loggedInMember']['u_pass']))){

          $hasLoggedInMember = true;
    }

    if($hasLoggedInMember && ($pageTitle=="Login" || $pageTitle=="Register")){
        header("Location: index.php");
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="management/images/icon/title_icon.png" type="image/x-icon">
    <link href="assets/css/fonts.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" >
    <!--Krajee File input-->
    <link rel="stylesheet" href="assets/plugins/krajee-bs-file-input/css/fileinput.min.css">
    <link rel="stylesheet" href="assets/plugins/krajee-bs-file-input/themes/explorer-fas/theme.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="assets/css/style.css">

    <title>SIO-LIBMS | <?=$pageTitle; ?></title>
  </head>
  <body>
    
    <header class="bg-light p-2 navbar-section">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-11 mx-auto">
                    <nav class="navbar navbar-expand-lg navbar-light ">
                        <a class="navbar-brand" href="index.php">SIO-LIBMS</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarText">
                          <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                              <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">About</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">Contact</a>
                            </li>
                          </ul>
                          <?php if($hasLoggedInMember){
                            $totalCartValue = 0;
                            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
                              $totalCartValue = count($_SESSION['cart']['book_id']);
                            }
                          ?>
                          <ul class="navbar-nav">

                            <li class="nav-item dropdown mr-3">
                                <a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="badge badge-info"><?=$totalCartValue;?></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" >
                                  <a class="dropdown-item" href="view-cart.php">View Cart</a>
                                </div>
                              </li>
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown">
                                  <?=$_SESSION['loggedInMember']['u_name']; ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" >
                                  <a class="dropdown-item" href="profile.php">Profile</a>
                                  <a class="dropdown-item" href="user-book-log.php">Book Log</a>
                                  <a class="dropdown-item" href="logout.php">Log out</a>
                                </div>
                              </li>
                          </ul>

                          <?php }else{ ?>
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="login.php" class="btn btn-outline-dark">Login</a>
                            <a href="register.php" class="btn btn-dark">Register</a>
                          </div>
                          <?php } ?>
                        </div>
                      </nav>
                </div>
            </div>
        </div>

    </header>