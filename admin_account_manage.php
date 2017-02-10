<?php
  session_start();

  ini_set('max_execution_time', 300); //300 seconds = 5 minutes
  ini_set('memory_limit', '256M');
  set_time_limit(30);

  require_once('connection.php');
  include('config.php');
  include('validatePage.php');

  $thisPage="ViewAccounts";
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
            <h1 class="text-light fg-green">Manage Accounts<span class="mif-user place-right text-light"></span></h1>
            <p class='text-normal fg-red'>Colored Rows are locked.</p>
            <button class="button warning" onclick="showMetroDialog('#addNewUser')"><span class="mi-usert icon"></span> Add User</button>
            <a href='build/ajax/exportUser.php' class="button success">Export Property List</a>
            <button class="button success place-right" onclick="showMetroDialog('#importUsers')"><span class="mi-usert icon"></span> Import User</button>

            <hr class="thin bg-grayLighter">
            <div id="history_request_div"  style="display:none;"></div>

            <!--pre loader-->
            <center>
              <div class="cell auto-size padding20" style="height:77.5vh;" data-role="preloader" data-type="cycle" data-style="color"  id="history_loader"></div>
            </center>
          </div>
        <div data-role="dialog" class="padding20" data-position="top" data-overlay="true" data-width="25%" data-overlay-color="op-dark"  data-overlay-click-close="true" id="editUser" data-close-button="true">
            <h4 class='text-light'>Update User</h4>
            <input type='hidden' id='employeeID'/>
            <div class="input-control full-size">
              <input type="text" id="updateFName" placeholder="First Name"/>
            </div>
            <div class="input-control full-size">
              <input type="text" id="updateMName" placeholder="Middle Name"/>
            </div>
            <div class="input-control full-size">
              <input type="text" id="updateLName" placeholder="Last Name"/>
            </div>
            <div class="input-control full-size">
              <input type="text" id="updateDepartment" placeholder="Department"/>
            </div>
            <div class="input-control password full-size" data-role="input">
              <input type="password" id="oldPassword" placeholder="Old Password">
              <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <div class="input-control password full-size" data-role="input">
              <input type="password" id="updatePassword" placeholder="New Password">
              <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <div class="input-control password full-size" data-role="input">
              <input type="password" id="passwordCheck" placeholder="Confirm Password">
              <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <button class="button primary" onclick="updateUser()">Update Account</button>
        </div>
        <div data-role="dialog" data-overlay="true" class="padding20" data-overlay-color="op-dark" data-overlay-click-close="true" id="deleteUser" data-close-button="true">
          <input type="hidden" id="deleteUserId" />
          <h5 class="text-light">Are you sure you want to Delete? <br/><b><span id="userID"></span></b></h5>
          <button class="button danger" onclick="deleteUser()"> Delete</button>
          <button class="button primary" onclick="hideMetroDialog('#deleteUser')"> Cancel</button>
          <!-- <div class="input-control"/>
            edittable values here
          </div> -->
        </div>
        <div data-role="dialog" class="padding20" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="importUsers" data-close-button="true" >
          <h3 class=" text-light header">Upload CSV</h3>
          <small><b></b></small>
          <span class="text-light"><small ><b>Column Order:</b> Employee Id, First Name, Middle Name, Last Name, Department</small></span>

          <form action="build/ajax/adminImportUser.php" method="POST" enctype="multipart/form-data">
            <div class="input-control file full-size" data-role="input">
                <input type="file" name="import_user">
                <button class="button" type="button"><span class="mif-folder"></span></button>
            </div>
            <br/>
            <button class="button warning" type="submit">Upload File</button>
          </form>
        </div>
    </div>
  </div>
  </body>
  <script src="build/js/admin_manage_account.js"></script>
</html>
