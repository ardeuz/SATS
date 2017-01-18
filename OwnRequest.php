<?php
  require_once('connection.php');
  include ('config.php');
  session_start();
  include 'validatePage.php';

  $thisPage = 'Owner Request';
?>
<!DOCTYPE html>
<html charset="UTF-8" lang="en">
  <head>
    <title>My Request</title>
    <link rel="icon" href="logo/logo.png" type="image/png" sizes="16x22">
    <link href="build/css/metro.css" rel="stylesheet">
    <link href="build/css/backend.css" rel="stylesheet">
    <link href="build/css/admin.css" rel="stylesheet">
    <link href="build/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="build/css/metro-icons.css" rel="stylesheet">
    <link href="build/css/metro-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="build/css/login.css">
    <link href="build/css/inventory.css" rel="stylesheet">
    <script src="build/js/jquery-2-1-3.min.js"></script>
    <script src="build/js/jquery.dataTables.min.js"></script>
    <script src="build/js/metro.js"></script>
    <script src="build/js/OwnRequest.js"></script>
    
  </head>
  <body>
    <?php include('navigation.php'); ?>
    <div class="cell full-size padding50 bg-white" id="cell-content" style="width:100%;">
      <h1 class="text-light fg-lightBlue">My Request<span class="mif-notification place-right text-light"></span></h1>
      <hr class="thin bg-grayLighter">
      <center>
        <div class="container grid padding10" id="requestForm">
          <?php
            $emp_id = $_SESSION['account']['emp_id'];
            $sql="SELECT request_code, transfer_to, released_from, date_request, emp_approval, CONCAT(b.last_name, ', ', b.first_name) AS emp_name, b.department FROM transfer_request AS a LEFT JOIN account_table AS b ON a.released_from=b.emp_id WHERE transfer_to='$emp_id' GROUP BY request_code";

            $transferRequestGroupDatas = $db->query($sql)->fetchAll();

            echo "<div class='row cells3'>";
            $cardCount = 1;
            foreach ($transferRequestGroupDatas as $transferRequestGroupData) {

              //color coding
              $color = "";
              if ($transferRequestGroupData['emp_approval'] == $REQUEST_PENDING) {
              $color = 'orange';
              } else if ($transferRequestGroupData['emp_approval'] == $REQUEST_APPROVED) {
              $color = 'blue';
              }

              echo "
              <div class='cell padding0 shadow align-left'>
                <div class='bg-" . $color . " padding0 fg-" . $color . "'>.</div>
                <div class='cell padding10'>
                  <small>Transfer Request to</small>
                  <br />
                  <span class='sub-header'>" . $transferRequestGroupData['emp_name'] . "</span>
                  <p><small>" . $transferRequestGroupData['department']  . " Department</small></p>
                  <hr class='thin' />";

                  echo "<div style='overflow-y: scroll; height: 300px'>";

                  $sql = "SELECT b.description, qty, c.condition_info, d.location AS old_loc, e.location AS new_loc FROM transfer_request AS a LEFT JOIN property AS b ON a.id=b.id LEFT JOIN condition_info AS c ON a.condition_id=c.id LEFT JOIN location AS d ON a.old_loc_id=d.id LEFT JOIN location AS e ON a.new_loc_id=e.id WHERE request_code=" . $transferRequestGroupData['request_code'];

                  $transferRequestItemDatas = $db->query($sql)->fetchAll();

                  foreach ($transferRequestItemDatas as $transferRequestItemData) {

                    echo "
                    <div>
                    <b>" . $transferRequestItemData['description'] . "</b>
                    <p><small>x " . $transferRequestItemData['qty'] . "</small></p>
                    <p><small><b>Condition:</b> " . $transferRequestItemData['condition_info'] . "</small></p>";

                    echo "
                    <span><b>From:</b> " . $transferRequestItemData['old_loc'] . "</span>
                    <br />
                    <span><b>To:</b> " . $transferRequestItemData['new_loc'] . "</span>";

                    echo "<hr class='thin bg-grayLighter'>
                    </div>";
                  }

                    echo "
                      </div>
                    </div>
                  </div>";

                  if ($cardCount == 3) {
                  echo "</div>";

                  echo "<div class='row cells3'>";
                  $cardCount = 1;
                  }

                  $cardCount++;
                }//end

                if ($cardCount != 3) {
                  echo "</div>";
                }

                if (count($transferRequestGroupDatas) <= 0) {
                  echo "<h2>You have no any transfer request.</h2>
                  <small>Choose property on the list to request for transfer to your accountability.</small>";
                }
              ?>
        </div>
      </center>
    </div>
  </body>
</html>
