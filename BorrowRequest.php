<?php
    session_start();
    require_once('connection.php');
    include 'validatePage.php';

    $thisPage='Borrow Request';
?>
<!DOCTYPE html>
<html charset="UTF-8" lang="en">
  <head>
    <title>Borrow Requests</title>
    <link rel="icon" href="logo/logo.png" type="image/png" sizes="16x22">
    <link href="build/css/metro.css" rel="stylesheet">
    <link href="build/css/backend.css" rel="stylesheet">
    <link href="build/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="build/css/metro-icons.css" rel="stylesheet">
    <link href="build/css/metro-responsive.css" rel="stylesheet">
    <link href="build/css/inventory.css" rel="stylesheet">
    <script src="build/js/jquery-2-1-3.min.js"></script>
    <script src="build/js/jquery.dataTables.min.js"></script>
    <script src="build/js/metro.js"></script>
  </head>

  <body>
    <?php include('navigation.php'); ?>

    <div class="cell full-size padding50 bg-white" id="cell-content" style="width:100%;">
      <h1 class="text-light fg-amber">Pending Request<span class="mif-notification place-right text-light"></span></h1>
      <hr class="thin bg-grayLighter">
      <center>
        <div class="container grid padding10" id="requestForm"></div>
      </center>
    </div>

    <div class="cell full-size padding50 bg-white" id="cell-content" style="width:100%;">
      <h1 class="text-light fg-green">Approved Request<span class="mif-checkmark place-right"></span></h1>
      <hr class="thin bg-grayLighter">
      <center>
        <div class="container grid padding10" id="approvedRequest"></div>
      </center>
    </div>
  </body>
  <script src="build/js/BorrowRequest.js"></script>

</html>
