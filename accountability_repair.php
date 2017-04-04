<?php
  session_start();
  require_once('connection.php');
  include('config.php');
  include('validatePage.php');

  $thisPage="Repair";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Manage Repair</title>
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
    <script src="build/js/select2.min.js"></script>
    <script src="build/js/metro.js"></script>
  </head>
  <body style="overflow:hidden;">
    <div class="flex-grid no-responsive-feature" style="height:100%;">
        <div class="row" style="height: 100%;">
        <?php include_once('admin_navigation.php'); ?>
          <div class="cell auto-size padding20 no-margin-top grid container place-right" id="style-4" style="overflow-y:scroll;height:100%;">
            <h1 class="text-light fg-darkBrown">Repair Item<span class="mif-ani-fast mif-ani-shuttle
              mif-wrench place-right text-light"></span></h1>

            <hr class="thin bg-grayLighter">
            <div id="history_request_div"  style="display:none;"></div>

            <!--pre loader-->
            <center>
              <div class="cell auto-size padding20" style="height:77.5vh;" data-role="preloader" data-type="cycle" data-style="color"  id="history_loader"></div>
            </center>
          </div>
          <div data-role="dialog" data-overlay="true" class="padding30" data-place="top-center"data-overlay-color="op-dark" data-height="90%" data-width="85%" data-overlay-click-close="true" id="adminAddRecommendation" data-close-button="true" style="overflow-y:scroll;">
            <input type="hidden" id="audit_id"/>
            <h3 class="text-light">Maintenance
              <button class="button cycle-button place-right shadow" onCLick="addNewRepairHistories();">+</button>
            </h3>
            <div class="padding20 bd-black" id="showAddHistory" style="display:none;">
              <h5 class="text-light">Add History</h5>
              <div class="input-control full-size">
                <input type="text" placeholder="Remarks" id="remarks"/>
              </div>
              <div class="input-control full-size">
                <input type="text" placeholder="Recommendation" id="recommendation"/>
              </div>
              <div class="input-control full-size">
                <input type="text" placeholder="Cost" id="cost"/>
              </div>
              <div class="input-control full-size">
                <input type="datetime-local" placeholder="Date" id="date"/>
              </div>
              <button class="button" onClick="addAnotherHistory();" >Add History</button>
            </div>
            <div  id="adminEditRepairHistory"></div>
          </div>
        </div>
    </div>

  </body>
  <script src="build/js/jquery.dataTables.min.js"></script>
  <script src="build/js/accountability_repair.js"></script>
</html>
