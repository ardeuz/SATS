<?php
  session_start();
  require_once('connection.php');
  include('config.php');
  include('validatePage.php');
  $thisPage = "issueanceProperty";

?>
<html>
<head>
  <title>Admin</title>
  <link rel="icon" href="logo/logo.png" type="image/png" sizes="16x22">
  <link href="build/css/metro.css" rel="stylesheet">
  <link href="build/css/backend.css" rel="stylesheet">
  <link href="build/css/admin.css" rel="stylesheet">
  <link href="build/css/metro-icons.css" rel="stylesheet">
  <link href="build/css/metro-schemes.min.css" rel="stylesheet">
  <link href="build/css/metro-colors.min.css" rel="stylesheet">
  <link href="build/css/metro-responsive.css" rel="stylesheet">
  <link href="build/css/inventory.css" rel="stylesheet">
  <script src="build/js/jquery-2-1-3.min.js"></script>
  <script src="build/js/jquery.dataTables.min.js"></script>
  <script src="build/js/select2.min.js"></script>
  <script src="build/js/metro.js"></script>
</head>
<body>
  <div class="contaner flex-grid no-responsive-feature" style="height:100%;overflow:hidden;">
    <div class="row" style="height:100%:">
      <?php require_once 'admin_navigation.php'; ?>
      <div class="cell auto-size padding20 no-margin-top grid container place-right" id="style-4" style="overflow-y:scroll;height:100%;">
        <button id='transfer_icon_span' class="cycle-button large-button shadow fab bg-cyan fg-white" data-role="popover" data-popover-mode="mouseenter" data-popover-position="left" data-popover-text="View Property Issuance List" data-popover-shadow="true"data-popover-background="bg-cyan" data-popover-color="fg-white" onclick="showMetroDialog('#transferlist')">
            <span class='mif-tab'></span>
        </button>
        <h1 class="text-light fg-teel">Property Issuance<span class="mif-file-text place-right text-light"></span></h1>
        <label class="text-light">Filter by: </label><br/>
        <table>
          <td>
            <label class="text-light">&nbsp;&nbsp; &nbsp; Description: </label>
            <div class="input-control select" data-role="select">
              <select id="descriptionFilter" onchange="descriptionFilter()" style="display:none;">
                <option value="0">ALL</option>
                <?php

                  $locationDatas = $db->select("minor_category",["id","description"]);
                  foreach($locationDatas  as $locationData)
                  {
                    echo "<option value=".$locationData['id'].">".$locationData['description']."</option>";
                  }

                ?>
              </select>
            </div>
          </td>
          <td>
            <label class="text-light">&nbsp;&nbsp; &nbsp; Location: </label>
            <div class="input-control select" data-role="select">
              <select id="locationFilter" onchange="locationFilter()" style="display:none;">
                <option value="0">ALL</option>
                <?php
                  $locationDatas = $db->select("location",["id","location"]);
                  foreach($locationDatas  as $locationData)
                  {
                    echo "<option value=".$locationData['id'].">".$locationData['location']."</option>";
                  }
                ?>
              </select>
            </div>
          </td>
          <td>
            <label class="text-light">Condition </label>
            <div class="input-control select" data-role="select">
              <select id="conditionFilter" onchange="conditionFilter()" style="display:none;">
                <option value="0">ALL</option>
                <?php

                  $conditionDatas = $db->select("condition_info",["id","condition_info"]);
                  foreach($conditionDatas as $conditionData)
                  {
                    echo "<option value=".$conditionData['id'].">".$conditionData['condition_info']."</option>";
                  }

                ?>
              </select>
            </div>
          </td>
        </table>

        <hr class="thin bg-grayLighter">
        <div id="history_request_div"  style="display:none;"></div><br/><br/><br/><br/>
        <center>
          <div class="cell auto-size padding20" style="height:77.5vh;" data-role="preloader" data-type="cycle" data-style="color"  id="history_loader"></div>
        </center>

        <h1 class="text-light fg-brown">Issuance Request History<span class="mif-notification place-right text-light"></span></h1>
        <hr class="thin bg-grayLighter">
        <div id="history_request_div_issue"  style="display:none;"></div>
        <center>
          <div class="cell auto-size padding20" style="height:77.5vh;" data-role="preloader" data-type="cycle" data-style="color"  id="history_loader_issue"></div>
        </center>
      </div>
    </div>
  </div>
  <div  data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-height="auto" data-width="27%" data-overlay-click-close="true" id="transferdialog" data-close-button="true">
   <h3 class="padding20 text-light header">Property Transfer </h3>
     <input type="hidden" id="propertyid"/>
     <input type="hidden" id="empId"/>
     <input type="hidden" id="conditionId"/>
     <input type="hidden" id="locationId"/>
     <div class="padding20" style="padding-top:0">
     <span>Please speicify the account to be issued </span><br/>
     <div class="input-control" style="width:24.5%" data-role="select">
             <select id="accountabilitySelect" style="display:none;">
               <option selected disabled value="0">Select Account</option>
               <?php

                $accountSelects = $db->select("account_table",["last_name","first_name","middle_name","department","emp_id"]);
                foreach($accountSelects as $accountSelect){
                  echo '<option value='.$accountSelect['emp_id'].'>'.$accountSelect['last_name'].', '.$accountSelect['first_name'].' '.$accountSelect['middle_name'].' - '.$accountSelect['department'].'</option>';
                }

               ?>
             </select>
     </div>
     <span>Transfer to your new Location:</span><br/>
     <div class="input-control" style="width:24.5%" data-role="select">
             <select id="location" style="display:none;">
             </select>
     </div>
     <br>
     <br>
     <span>Quantity:</span>
     <div class="input-control text full-size">
          <input type="number" min="1" id="quantity" value='1' />
     </div>
     <button class="button button-primary" onclick="insertQuantity();"><span class="mif-plus"></span>
         Add to Transfer List</button>
     <button class="button danger" onclick="hideMetroDialog('#transferdialog');"><span class="mif-cross fg-white"> Cancel</span>
     </div>
  </div>
   <div   data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-height="80%" data-width="50%" data-overlay-click-close="true" id="viewdialog" data-close-button="true" style="overflow-y:scroll;">
     <div class="padding20" id="propertyInformations" style="padding-top:0;">

     </div>

  </div>
  <div data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-height="90%" data-width="auto" data-overlay-click-close="true" id="transferlist" data-close-button="true" >
    <div  style="overflow-y:scroll;height:99%">
       <div id='transferForm' class="container grid padding20">
           <?php include "build/ajax/showPropertyIssuance.php"; ?>
       </div>
     </div>
 </div>
  <script src="build/js/propertyIssuance.js"></script>
</body>
</html>
