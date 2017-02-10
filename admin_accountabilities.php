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
    <script src="build/js/select2.min.js"></script>

    <script src="build/js/metro.js"></script>

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
            <button class="button success place-right" onclick="showMetroDialog('#uploadCSV');">Import CSV</button>
            <div id="history_request_div"  style="display:none;"></div>

            <!--pre loader-->
            <center>
              <div class="cell auto-size padding20" style="height:77.5vh;" data-role="preloader" data-type="cycle" data-style="color"  id="history_loader"></div>
            </center>
          </div>
        <!-- <h1 class="text-light fg-lightBlue">My Request<span class="mif-notification place-right text-light"></span></h1>
        <hr class="thin bg-grayLighter">
        <div class="cell auto-size padding20 grid container" style="display:none;padding-top:0;" id="cell-content"></div> -->


        <div data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-height="80%" data-width="50%" data-overlay-click-close="true" id="adminAccountabilityDialog" data-close-button="true" style="overflow-y:scroll;">
          <h3 class="padding20 text-light header">Property Information</h3>
          <div class="padding20" id="adminInformation" style="padding-top:0;" ></div>
        </div>
        <div data-role="dialog" class="padding20" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="uploadCSV" data-close-button="true">
          <h3 class="padding20 text-light header">Upload CSV</h3>
          <p class='text-light'><small><b>Column Order:</b> Property Code, Serial Number, Description, Brand, Model, UOM, Cost, Date Aquired, OR Number, Quantity</small></p>
          <form action="build/ajax/uploadProperty.php" method="POST" enctype="multipart/form-data">
              <div class="input-control file full-size" data-role="input">
                  <input type="file" name="physical">
                  <button class="button" type="button"><span class="mif-folder"></span></button>
              </div>
              <div class="input-control" style="width:300px;" data-role="select">
                <select name="accountability" style="display:none">
                  <option value="0" selected disabled>Choose Accountability</option>
                  <?php

                    $accountDatas = $db->select("account_table",["last_name" , "first_name" , "emp_id" , "department"] , ["status[!]" => 0]);
                    foreach($accountDatas as $accountData)
                    {
                      echo "

                      <option value=".$accountData['emp_id']." > ".$accountData['last_name'] .", ". $accountData['first_name'] ." - ".$accountData['department']."  </option>

                      ";
                    }

                  ?>
                </select>
              </div>
              <br/>

              <div class="input-control" style="width:300px;" data-role="select">
                <select name="minorcategory" style="display:none">
                  <option value="0" selected disabled>Choose Minor Category</option>

                  <?php

                    $minorDatas = $db->select("minor_category",["id" , "description"] );
                    foreach($minorDatas as $minorData)
                    {
                      echo "

                      <option value=".$minorData['id']." > ".$minorData['description'] ."  </option>

                      ";
                    }

                  ?>
                </select>
              </div>
              <br/>
              <div class="input-control" style="width:300px;" data-role="select">

                <select name="location" style="display:none">
                  <option value="0" selected disabled>Choose location</option>

                  <?php

                    $locationDatas = $db->select("location",["id" , "location"] );
                    foreach($locationDatas as $locationData)
                    {
                      echo "

                      <option value=".$locationData['id']." > ".$locationData['location'] ."  </option>

                      ";
                    }

                  ?>
                </select>
              </div>
              <br/>
              <div class="input-control" style="width:300px;" data-role="select">

                <select name="condition" style="display:none">
                  <option value="0" selected disabled>Choose Condition</option>

                  <?php

                    $conditionDatas = $db->select("condition_info",["id" , "condition_info"] );
                    foreach($conditionDatas as $conditionData)
                    {
                      echo "
                      <option value=".$conditionData['id']." > ".$conditionData['condition_info'] ."  </option>

                      ";
                    }

                  ?>
                </select>
              </div>
              <br />
              <button class="button warning" type="submit">Upload File</button>
          </form>
        </div>
    </div>
  </div>
  </body>

  <script src="build/js/jquery.dataTables.min.js"></script>
  <script src='build/js/admin_accountability.js'></script>
  <script src="build/js/admin.js"></script>
</html>
