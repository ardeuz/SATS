<?php
  session_start();

  ini_set('max_execution_time', 300); //300 seconds = 5 minutes
  ini_set('memory_limit', '256M');
  set_time_limit(30);

  require_once('connection.php');
  include('config.php');
  include('validatePage.php');

  $thisPage="BackupAndRestor";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Manage Accounts</title>
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
    <script src="build/js/jquery.dataTables.min.js"></script>
    <script src="build/js/select2.min.js"></script>
    <script src="build/js/metro.js"></script>
  </head>
  <body style="overflow:hidden;">
    <div class="flex-grid no-responsive-feature" style="height:100%;">
        <div class="row" style="height: 100%;">
        <?php include_once('admin_navigation.php'); ?>
          <div class="cell auto-size padding20 no-margin-top grid container place-right" id="style-4" style="overflow-y:scroll;height:100%;">
            <h1 class="text-light fg-brown">Backup and Restore<span class="mif-database place-right text-light"></span></h1>
            <!-- <p class='text-normal fg-red'>Colored Rows are locked.</p> -->
            <!-- <button class="button warning" onclick="showMetroDialog('#addNewUser')"><span class="mi-usert icon"></span> Add User</button> -->
            <button onClick="showMetroDialog('#backupCurrentData');" class="button warning">Backup Current Database</button>
            <!-- <button class="button success place-right" onclick="showMetroDialog('#importUsers')"><span class="mi-usert icon"></span> Import User</button> -->

            <hr class="thin bg-grayLighter">
            <div id="history_request_div" style="display:none;"></div>

            <!--pre loader-->
            <center>
              <div class="cell auto-size padding20" style="height:77.5vh;" data-role="preloader" data-type="cycle" data-style="color"  id="history_loader"></div>
            </center>
          </div>
        </div>
        <div data-role="dialog" data-overlay="true" class="padding20" data-overlay-color="op-dark" data-overlay-click-close="true" id="backupCurrentData" data-close-button="true">
          <div class="input-control textarea full-size">
            <textarea type="text" id="backupRemarks" placeholder="Backup Remarks"></textarea>
          </div>
          <button class="button" onClick="backupDb();">Backup Database</button>
        </div>
  </div>
  </body>
  <script src="build/js/admin_backup_restore.js"></script>
</html>
