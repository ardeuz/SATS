<?php
  session_start();
  require_once('connection.php');
  include('config.php');
  include('validatePage.php');

  $thisPage = $_GET['emp_id'];

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
            <h1 class="text-light fg-brown">Property Accountability Of<span class="mif-notification place-right text-light"></span></h1>
            <?php
              if (isset($_GET['emp_id'])) {
                $accountData = $db->get("account_table", ["emp_id","first_name", "last_name", "department"], ["emp_id" => $_GET['emp_id']]);

                echo "<div>";
                echo "<h4 class='text-normal'>" . $accountData['last_name'] . ', ' . $accountData['first_name'] . "</h4>";

                echo "<span class='text-light'>" . $accountData['department'] . " Department</span><br/>";
                echo "<a href='build/ajax/exportPropertyPerAccount.php?emp_id=".$accountData['emp_id']."' class='button default'>Export Property List</a>";
                echo "<button class='button place-right bg-blue fg-white' onclick='showMetroDialog(\"#uploadPhysicalCount\")'>Upload Physical Count</button>";
                echo "</div>";
              }
            ?>
            <br />
            <br />
            <br />
            <hr class="thin bg-grayLighter">
            <div id="history_request_div"  style="display:none;"></div>

            <!--pre loader-->
            <center>
              <div class="cell auto-size padding20" style="height:77.5vh;" data-role="preloader" data-type="cycle" data-style="color"  id="history_loader"></div>
            </center>
          </div>

        <div data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-height="80%" data-width="50%" data-overlay-click-close="true" id="adminAccountabilityDialog" data-close-button="true" style="overflow-y:scroll;">
          <h3 class="padding20 text-light header">Property Information</h3>
          <div class="padding20" id="adminInformation" style="padding-top:0;" ></div>
        </div>
        <div data-role="dialog" class="padding20" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="uploadPhysicalCount" data-close-button="true" >
          <h3 class=" text-light header">Upload CSV</h3>
          <form action="admin_physical_report.php" method="POST" enctype="multipart/form-data">
            <div class="input-control file " data-role="input">
                <input value="<?php echo $_GET['emp_id']?>" name='emp_id' hidden>
                <input type="file" name="physical_count_csv">
                <button class="button" type="button"><span class="mif-folder"></span></button>
            </div>
            <br/>
            <button class="button warning" type="submit">Upload File</button>
          </form>
        </div>
    </div>
  </div>
  </body>
  <script src="build/js/jquery.dataTables.min.js"></script>
  <script src='build/js/admin_accountability_property.js'></script>
  <script src="build/js/select2.min.js"></script>
  <script src="build/js/admin.js"></script>
</html>
