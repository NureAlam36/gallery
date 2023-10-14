<?php
  // Enable error reporting
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="google-signin-client_id" content="242897207837-vqtjv1e7vnrnj9k6cu5b624mo9lsrl0b.apps.googleusercontent.com">
  <link rel="icon" href="icon/favicon.png" type="image/gif" sizes="16x16">
  <title>Photo Gallery</title>

  <!-- All All Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">


  <!-- All Included Css -->
  <link rel="stylesheet" href="lib/css/bootstrap.min.css" />
  <link rel="stylesheet" href="lib/css/font-awesome.min.css">
  <link rel="stylesheet" href="lib/css/style.css" />
  <link href="lib/css/pagination.css" rel="stylesheet" type="text/css">

  <!-- All Included JavaScript -->
  <script src="lib/js/jquery.min.js"></script>
  <script src="lib/js/custom.js"></script>
  <script src="lib/js/f1bf2637dc.js" type="text/javascript"></script>
  <script src="lib/js/pagination.js"></script>
  <script src="lib/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="lib/css/simple-lightbox.min.css?v2.8.0" />
</head>

<!-- Header Section -->
<header>
  <div class="header-wrapper">
    <div class="container">
      <div class="phoca-header">
        <div class="logo">
          <a href="/mypics"><img src="img/<?php echo Helper::get_option('site-logo') ?>" alt=""></a>
        </div>
        <div class="wrap">
          <div class="search">
            <form action="search.php" method="get" class="d-flex">
              <input type="text" name="keyword" class="searchTerm" placeholder="Search...">
              <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Breadcrumbs -->
<div class="header_nav">
  <div class="container">
    <div id="breadcrumbs">
      <div class="breadcrumbs">
        <span class="showHere mr-2">You are here: </span><a href="/mypics" class="pathway">Home</a> <?php echo Helper::breadcrumbs(); ?>
      </div>
    </div>
  </div>
</div>

<!-- Main Section -->
<div class="main-sec">