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
    $thisPage = "issueProperty";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Issue Property</title>
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
  <script src="build/js/issueProperty.js"></script>
  </head>
<body>
            <?php

                include ("navigation.php");

            ?>

            <button id='transfer_icon_span' class="cycle-button large-button shadow fab bg-cyan fg-white" data-role="popover" data-popover-mode="mouseenter" data-popover-position="left" data-popover-text="View Transfer List" data-popover-shadow="true"data-popover-background="bg-cyan" data-popover-color="fg-white" onclick="showMetroDialog('#transferlist')">
                <span class='mif-tab'></span>
            </button>

             <div class="cell full-size padding50 bg-white" id="cell-content" style="width:100%;">
                    <h1 class="text-light">
                        Property Issuance
                        <u><span class="mif-truck place-right  mif-ani-fast mif-ani-pass"></span></u>
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
                        <label class="text-light">&nbsp;&nbsp; &nbsp;Condition </label>
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
                    <div  data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-height="auto" data-width="27%" data-overlay-click-close="true" id="transferdialog" data-close-button="true">
                     <h3 class="padding20 text-light header">Transfer Item </h3>
                       <input type="hidden" id="propertyid"/>
                       <input type="hidden" id="empId"/>
                       <input type="hidden" id="conditionId"/>
                       <input type="hidden" id="locationId"/>
                       <div class="padding20" style="padding-top:0">
                       <span>Transfer to a new location:</span><br/>
                       <div class="input-control" style="width:24.5%" data-role="select">
                               <select id="location" style="display:none;">
                               </select>
                       </div>
                       <br>
                       <span>Account Holder:</span><br/>
                       <div class="input-control" style="width:24.5%" data-role="select">
                               <select id="empIds" style="display:none;">
                                 <option selected value="0">Select Account</option>
                                 <?php
                                   // initialize the query
                                   $accountHolders = $db->select("account_table",['last_name','first_name','department','emp_id'],['emp_id[!]'=>$_SESSION['account']['emp_id']]);
                                   // initialize the select
                                   foreach($accountHolders as $accountHolder){
                                     echo '<option value="'.$accountHolder['emp_id'].'">'.$accountHolder['last_name'].', '.$accountHolder['first_name'].' = '.$accountHolder['department'].'</option>';
                                   }

                                 ?>
                               </select>
                       </div>
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
                     <div   data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-height="90%" data-position="top-center" data-width="50%" data-overlay-click-close="true" id="viewdialog" style="overflow-y:scroll;" data-close-button="true">
                       <div class="tabcontrol padding20" data-role="tabcontrol">
                         <ul class="tabs">
                             <li><a href="#propertyInformation">Property Information</a></li>
                             <li><a href="#repairHistory">Repair History</a></li>
                             <li><a href="#locationHistory">Location History</a></li>
                         </ul>
                           <div class="frames">
                               <div class="frame bg-white" id="propertyInformation">
                                 <div class="padding20" id="propertyInformations" style="padding-top:0;">
                                 </div>
                               </div>
                               <div class="frame bg-white" id="repairHistory">
                                 <div class="" id="propertyRepairHistory" style="padding-top:0;" ></div>
                               </div>
                               <div class="frame bg-white" id="locationHistory">
                                 <div class="" id="propertyLocationHistory" style="padding-top:0;" ></div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div   data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-height="70%" data-width="auto" data-overlay-click-close="true" id="transferlist" data-close-button="true" style="overflow-x:hidden;">
                       <div id='transferForm' class="container grid padding20">
                           <?php include "build/ajax/showIssuePropertyTransfer.php"; ?>
                       </div>
                   </div>
             </div>

</body>

</html>

<!-- click item transfer property code and quantity -->
