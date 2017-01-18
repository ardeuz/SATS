<?php
  session_start();
  require_once('connection.php');
  include('config.php');
  include('validatePage.php');
  $thisPage="TransferRequest";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Admin Module</title>
    <link rel="icon" href="logo/logo.png" type="image/png" sizes="16x22">
    <link href="build/css/metro.css" rel="stylesheet">
    <link href="build/css/backend.css" rel="stylesheet">
    <link href="build/css/admin.css" rel="stylesheet">
    <link href="build/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="build/css/metro-icons.css" rel="stylesheet">
    <link href="build/css/metro-responsive.css" rel="stylesheet">
    <link href="build/css/metro-schemes.min.css" rel="stylesheet">
    <link href="build/css/metro-colors.min.css" rel="stylesheet">

    <script src="build/js/jquery-2-1-3.min.js"></script>
    <script src="build/js/metro.js"></script>

  </head>
  <body style="overflow:hidden;">
    <div class="flex-grid no-responsive-feature" style="height:100%;">
        <div class="row" style="height: 100%;">
        <?php include_once('admin_navigation.php'); ?>
          <div class="cell auto-size padding20 no-margin-top grid container place-right" style="overflow-y:scroll;height:100%;">
            <h1 class="text-light fg-green">Approved Request<span class="mif-notification place-right text-light"></span></h1>
            <hr class="thin bg-grayLighter">
            <div id="approved_request_div"  style="display:none;"></div>
            <br/>
            <center>
              <div class="cell auto-size padding20" style="height:77.5vh;" data-role="preloader" data-type="cycle" data-style="color"  id="approved_loader"></div>
            </center>
            <h1 class="text-light fg-brown">Transfer Request History<span class="mif-notification place-right text-light"></span></h1>
            <hr class="thin bg-grayLighter">
            <div id="history_request_div"  style="display:none;"></div>

            <!--pre loader-->
            <center>
              <div class="cell auto-size padding20" style="height:77.5vh;" data-role="preloader" data-type="cycle" data-style="color"  id="history_loader"></div>
            </center>
          </div>
        <!-- <h1 class="text-light fg-lightBlue">My Request<span class="mif-notification place-right text-light"></span></h1>
        <hr class="thin bg-grayLighter">
        <div class="cell auto-size padding20 grid container" style="display:none;padding-top:0;" id="cell-content"></div> -->



    </div>
  </div>
  </body>
  <script src="build/js/jquery.dataTables.min.js"></script>
  <script src='build/js/adminRequest.js'></script>
  <script src="build/js/select2.min.js"></script>
  <script src="build/js/admin.js"></script>
</html>
