<?php
    include_once 'config/init.php';

    $pageName = basename($_SERVER['PHP_SELF'], '.php');
    $pageTitle = ucwords(str_replace("-"," ", $pageName));

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Management | <?=$pageTitle; ?></title>

  <link rel="icon" href="images/icon/title_icon.png" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!--Krajee File input-->
  <link rel="stylesheet" href="plugins/krajee-bs-file-input/css/fileinput.min.css">
  <link rel="stylesheet" href="plugins/krajee-bs-file-input/themes/explorer-fas/theme.min.css">
    <!-- bootstrap tags input -->
    <link rel="stylesheet" href="plugins/bstagsinput/bootstrap-tagsinput.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables_latest/dataTables.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="stylesheet" href="custom-assets/css/style.css">

</head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">