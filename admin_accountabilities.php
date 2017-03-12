<?php

  session_start();
  require_once('connection.php');
  include('config.php');
  include('validatePage.php');

  $thisPage="PropertyAccountability";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Property Accountability</title>
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
    <script src="build/js/select2.min.js"></script>
    <script src="build/js/jquery.dataTables.min.js"></script>

  </head>
  <body style="overflow:hidden;">
    <div class="flex-grid no-responsive-feature" style="height:100%;">
      <div class="row" style="height:100%;">
        <?php include_once('admin_navigation.php'); ?>
        <div class="cell auto-size padding20 no-margin-top grid container place-right" id="style-4" style="overflow-y:scroll;height:100%;">

          <h1 class="text-light fg-brown">Property Accountability<span class="mif-notification place-right text-light"></span></h1>
          <small class='text-normal fg-brown'>with Accountabilities</small>
          <p class='text-normal fg-brown'>Colored Rows are depreciated or scrap.</p>
          <hr class="thin bg-grayLighter">
          <a href='build/ajax/exportProperty.php' class="button warning">Export Property List</a>
          <button class="button success" onclick="showMetroDialog('#uploadCSVSub');">Import CSV w/Sub Property</button>
          <button class="button success" onclick="showMetroDialog('#uploadCSV');">Import CSV</button>
          <div id="history_request_div"  style="display:none;"></div>

          <!--pre loader-->
          <center>
            <div class="cell auto-size padding20" style="height:77.5vh;" data-role="preloader" data-type="cycle" data-style="color"  id="history_loader"></div>
          </center>
          <div data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-height="80%" data-width="50%" data-overlay-click-close="true" id="adminAccountabilityDialog" data-close-button="true" style="overflow-y:scroll;">
            <div class="tabcontrol padding20" data-role="tabcontrol">
              <ul class="tabs">
                  <li><a href="#propertyInformation">Property Information</a></li>
                  <li><a href="#repairHistory">Repair History</a></li>
              </ul>
                <div class="frames">
                    <div class="frame bg-white" id="propertyInformation">
                      <div class="padding20" id="adminInformation" style="padding-top:0;" ></div>
                    </div>
                    <div class="frame bg-white" id="repairHistory">
                      <div class="" id="adminRepairHistory" style="padding-top:0;" ></div>
                    </div>
                </div>
            </div>
          </div>
          <div data-role="dialog" class="padding20" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="uploadCSVSub" data-close-button="true">
            <h3 class="padding20 text-light header">Upload CSV with Subproperty</h3>
            <p class='text-light'><small><b>Column Order:</b> Parent Code, Sub Property</small></p>
            <form action="build/ajax/uploadPropertySub.php" method="POST" enctype="multipart/form-data">
                <div class="input-control file full-size" data-role="input">
                    <input type="file" name="physical">
                    <button class="button" type="button"><span class="mif-folder"></span></button>
                </div>
                <br />
                <button class="button warning" type="submit">Upload File</button>
            </form>
          </div>
          <div data-role="dialog" class="padding20" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="uploadCSV" data-close-button="true">
            <h3 class="padding20 text-light header">Upload CSV</h3>
            <p class='text-light'><small><b>Column Order:</b><br/> <br/>Accountability of, Property Code, Serial Number, Description, Brand, Model, UOM, Cost, Date Aquired, <br/>P.O. Number, Quantity, , Major Category, Minor Category, Location, Condition</small>
            <br/><br/><small><b>NOTE : </b>property description must not containing an apostrophe instend use ( ` )<small></p>
            <form action="build/ajax/uploadProperty.php" method="POST" enctype="multipart/form-data">
                <div class="input-control file full-size" data-role="input">
                    <input type="file" name="physical">
                    <button class="button" type="button"><span class="mif-folder"></span></button>
                </div>
                <br />
                <button type="submit" class="button" id="uploadBulky">Upload File</button>
            </form>
          </div>
        </div>
      <!-- <h1 class="text-light fg-lightBlue">My Request<span class="mif-notification place-right text-light"></span></h1>
      <hr class="thin bg-grayLighter">
      <div class="cell auto-size padding20 grid container" style="display:none;padding-top:0;" id="cell-content"></div> -->
    </div>
  </div>
</body>

  <script src='build/js/admin_accountability.js'></script>
  <script src="build/js/admin.js"></script>
</html>
