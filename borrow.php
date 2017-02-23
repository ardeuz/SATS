<?php
    session_start();
	  require_once('connection.php');
    include 'validatePage.php';
        if(!isset($_SESSION['account']['emp_id']))
            {
                header("location:index.php");
            }
        if(isset($_POST['LogOut']))
            {

                session_destroy();
                header("location:index.php");
                exit();

            }
    $thisPage = "borrow";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Borrow Property</title>
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
  <script src="build/js/jquery.dataTables.min.js"></script>
  <script src="build/js/select2.min.js"></script>
  <script src="build/js/metro.js"></script>
  <script src="build/js/borrow.js"></script>
</head>
<body>
            <?php

                include ("navigation.php");

            ?>

            <button id='transfer_icon_span' class="cycle-button large-button shadow fab bg-cyan fg-white" data-role="popover" data-popover-mode="mouseenter" data-popover-position="left" data-popover-text="View Borrow List" data-popover-shadow="true"data-popover-background="bg-cyan" data-popover-color="fg-white" onclick="showMetroDialog('#transferlist')">
                <span class='mif-tab'></span>
            </button>

             <div class="cell full-size padding50 bg-white" id="cell-content" style="width:100%;">
                    <h1 class="text-light">
                        Borrow
                        <u><span class="mif-paper-plane place-right  mif-ani-fast mif-ani-float"></span></u>
                    </h1>
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
                    <div id="tableTransfer"></div>
                </div>
             <div   data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-height="auto" data-width="27%" data-overlay-click-close="true" id="transferdialog" data-close-button="true">
             	<h3 class="padding20 text-light header">Borrow Item </h3>
                <input type="hidden" id="propertyid"/>
                <input type="hidden" id="empId"/>
                <input type="hidden" id="conditionId"/>
                <input type="hidden" id="locationId"/>
                <div class="padding20" style="padding-top:0">
                <span>Borrow to your new Location:</span>
                <div class="input-control select full-size">
                        <select id="location">
                        </select>
                </div>
                <br>
                <br>
                <span>Quantity:</span>
                <div class="input-control text full-size">
                     <input type="number" min="1" id="quantity" value='1' />
                </div>
                <span>Return Date:</span>

                <div class='input-control text full-size'>
                  <input type="date" id="dateBorrow"/>
                </div>

                <button class="button button-primary" onclick="insertQuantity();"><span class="mif-plus"></span>
                    Add to Borrow List</button>
                <button class="button danger" onclick="hideMetroDialog('#transferdialog');"><span class="mif-cross fg-white"> Cancel</span>
                </div>
             </div>
              <div   data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-height="80%" data-width="50%" data-overlay-click-close="true" id="viewdialog" data-close-button="true" style="overflow-y:scroll;">
                <div class="padding20" id="propertyBorrowInformations" style="padding-top:0;">

                </div>

             </div>
             <div   data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-height="80%" data-width="90%" data-overlay-click-close="true" id="transferlist" data-close-button="true" style="overflow-x:hidden;">
                <div id='transferForm' class="container grid padding20">
                    <?php include "build/ajax/showPropertyBorrow.php"; ?>
                </div>
            </div>
</body>

</html>

<!-- click item transfer property code and quantity -->
