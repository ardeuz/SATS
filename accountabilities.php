<?php
  session_start();
  require_once('connection.php');
  include ('validatePage.php');

  $thisPage='accountabilities';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accountabilities</title>
    <link rel="icon" href="logo/logo.png" type="image/png" sizes="16x22">
    <link href="build/css/metro.css" rel="stylesheet">
    <link href="build/css/metro-colors.min.css" rel="stylesheet">
    <link href="build/css/backend.css" rel="stylesheet">
    <link href="build/css/admin.css" rel="stylesheet">
    <link href="build/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="build/css/metro-icons.css" rel="stylesheet">
    <link href="build/css/metro-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="build/css/login.css">
    <link href="build/css/inventory.css" rel="stylesheet">
    <script src="build/js/jquery-2-1-3.min.js"></script>
    <script src="build/js/select2.min.js"></script>
    <script src="build/js/metro.js"></script>
    <script src="build/js/jquery.dataTables.min.js"></script>
    <script src="build/js/proware.js"></script>

</head>
<body>
  <?php include('navigation.php'); ?>
  <div class="cell full-size padding50 bg-white" id="cell-content" style="width:100%;">
    <h1 class="text-light">Accountabilities<span class="mif-stack2 place-right"></span></h1>
    <hr class="thin bg-grayLighter">
    <div id="tableProware"></div>
  </div>
  <div data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-height="85%" data-width="50%" data-overlay-click-close="true" id="prowaredialog" data-close-button="true" style="overflow-y:scroll;">
    <h3 class="padding20 text-light header">Property Information</h3>
    <div class="padding20" id="propertyInformations" style="padding-top:0;" ></div>
  </div>
  <div data-role="dialog" data-overlay="true" class="padding20" data-overlay-color="op-dark" data-overlay-click-close="true" data-height="auto" data-width="30%" id="propertyDistribution" data-close-button="true">
    <h3 class=" text-light header">Distribute Property</h3>
    <input type="hidden" id="propertyId"/>
    <input type="hidden" id="oldCondition"/>
    <input type="hidden" id="oldLocation"/>
    <input type="hidden" id="emp_id"/>
    <h4 class="text-light">Property : <b><span id="propertyname"></span></b></h4>
      <div>
        <br/>
        <div class="input-control number full-size" data-role="input">
          <input type="number" id="quantity" max="" min="1" value="1"/>
        </div>
        <br/>
        <div>
          <div class="input-control full-size" data-role="select">
            <select  id="itemLocation" style="display:none;">
              <?php

                $locationDatas = $db->select("location",["id","location"]);
                foreach ($locationDatas as $locationData) {
                  echo "
                    <option value=".$locationData['id'].">".$locationData['location']."</option>
                  ";
                }
              ?>
            </select>
          </div>
          <div class="input-control full-size" data-role="select">
            <select  id="itemCondition" style="display:none;">
              <?php

                $conditionDatas = $db->select("condition_info",["id","condition_info"]);
                foreach ($conditionDatas as $conditionData) {
                  echo "
                    <option value=".$conditionData['id'].">".$conditionData['condition_info']."</option>
                  ";
                }
              ?>
            </select>
          </div>
        </div>
        <br/>
        <button class="button info" onclick="itemDistribute();">Distribute</button>
      </div>
  </div>

</body>
<script>

</script>
</html>
