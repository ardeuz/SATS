<?php
  session_start();
  require_once('connection.php');
  include('config.php');
  include('validatePage.php');

  $thisPage = "EditMinorCat";

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
    <script src="build/js/jquery-2-1-3.min.js"></script>
    <link href="build/css/metro-schemes.min.css" rel="stylesheet">
    <link href="build/css/metro-colors.min.css" rel="stylesheet">
    <script src="build/js/metro.js"></script>

  </head>
  <body style="overflow:hidden;">
    <div class="flex-grid no-responsive-feature" style="height:100%;">
        <div class="row" style="height: 100%;">
        <input type="hidden" value="<?php echo $_GET['emp_id'];?>" id="emp_id"/>
        <?php include_once('admin_navigation.php'); ?>
          <div class="cell auto-size padding20 no-margin-top grid container place-right" id="style-4" style="overflow-y:scroll;height:100%;">
            <h1 class="text-light"><span class="mif-cogs icon"></span> Edit Minor Category</h1>
            <hr class="thin bg-grayLighter">
            <button class="button primary" onclick="showMetroDialog('#addNewMinorCategory')">Add Minor Category</button>
            <button class="button success place-right" onclick="showMetroDialog('#importMinor')"><span class="mi-usert icon"></span> Import Bulk Category</button>

            <div id="history_request_div"  style="display:none;"></div>

            <!--pre loader-->
            <center>
              <div class="cell auto-size padding20" style="height:77.5vh;" data-role="preloader" data-type="cycle" data-style="color"  id="history_loader"></div>
            </center>
          </div>
        </div>
        <div data-role="dialog" class="padding20" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="importMinor" data-close-button="true" >
          <h3 class=" text-light header">Upload CSV</h3>
          <small><b></b></small>
          <span class="text-light"><small ><b>Column Order:</b> Description</small></span>

          <form action="build/ajax/adminImportMinor.php" method="POST" enctype="multipart/form-data">
            <div class="input-control file full-size" data-role="input">
                <input type="file" name="import_minor">
                <button class="button" type="button"><span class="mif-folder"></span></button>
            </div>
            <br/>
            <!-- <div class="input-control" style="width:100%;">
              <select name="categoryValue" id="minorSelect" style="display:none;">
                <?php
                  $majorCategories = $db->select("major_category",["id","description"]);
                  foreach($majorCategories as $majorCategorie)
                  {
                    echo '<option value='.$majorCategorie['id'].'>'.$majorCategorie['description'].'</option>';
                  }
                ?>
              </select>
            </div> -->
            <button class="button warning" type="submit">Upload File</button>
          </form>
        </div>
        <div data-role="dialog" data-overlay="true" class="padding20" data-overlay-color="op-dark" data-overlay-click-close="true" id="editMinorDialog" data-close-button="true">
          <input type="hidden" id="editMinorID" />
          <h5 class='text-light'>Update Minor Category</h5>
          <div class="input-control full-size">
            <input type="text" id="minorValue"/>
          </div>
          <button class="button success" onclick="updateMinor()"> Update</button>
          <!-- <div class="input-control"/>
            edittable values here
          </div> -->
        </div>
        <div data-role="dialog" data-overlay="true" class="padding20" data-overlay-color="op-dark" data-overlay-click-close="true" id="deleteMinorDialog" data-close-button="true">
          <input type="hidden" id="deleteMinorID" />
          <h5 class="text-light">Are you sure you want to Delete? <br/><b><span id="minorVal"></span></b></h5>
          <button class="button danger" onclick="deleteMinor()"> Delete</button>
          <button class="button default" onclick="hideMetroDialog('#deleteMinorID')"> Cancel</button>
          <!-- <div class="input-control"/>
            edittable values here
          </div> -->
        </div>
  </div>
  </body>
  <script src="build/js/jquery.dataTables.min.js"></script>
  <script src="build/js/mainteMinor.js"></script>
  <script src="build/js/select2.min.js"></script>
  <script src="build/js/admin.js"></script>
</html>
