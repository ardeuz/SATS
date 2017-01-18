<?php
  session_start();
  require_once('connection.php');
  include('config.php');
  include('validatePage.php');
  $thisPage="Admin";
?>
<html>
  <head>
    <link rel="icon" href="logo/logo.png" type="image/png" sizes="16x22">
    <link href="build/css/metro-colors.min.css" rel="stylesheet">
    <link href="build/css/metro-schemes.min.css" rel="stylesheet">
    <link href="build/css/metro.css" rel="stylesheet">
    <link href="build/css/backend.css" rel="stylesheet">
    <link href="build/css/admin.css" rel="stylesheet">
    <link href="build/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="build/css/metro-icons.css" rel="stylesheet">
    <link href="build/css/metro-responsive.css" rel="stylesheet">

  </head>

  <body>
    <div class="contaner flex-grid no-responsive-feature" style="height:100%:">
      <div class="row" style="height:100%:">
        <?php require_once 'admin_navigation.php'; ?>
      </div>
    </div>
  </body>
  <script src="build/js/jquery-2-1-3.min.js"></script>
  <script src="build/js/jquery.dataTables.min.js"></script>
  <script src="build/js/metro.js"></script>
</html>
