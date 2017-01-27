<?php
  session_start();
  require_once("../../connection.php");
  include "../../config.php";
  if(isset($_POST['showBorrows']))
  {
  $emp_id = $_SESSION['account']['emp_id'];
  $sql="SELECT id, condition_id, old_loc_id, request_code, transfer_to, released_from, date_request, date_borrow, emp_approval, CONCAT(b.last_name, ', ', b.first_name) AS emp_name, b.department FROM borrow_request AS a LEFT JOIN account_table AS b ON a.released_from=b.emp_id WHERE transfer_to='$emp_id' GROUP BY request_code";

  $borrowRequestGroupDatas = $db->query($sql)->fetchAll();

  echo "<div class='row cells3'>";
  $cardCount = 1;
  foreach ($borrowRequestGroupDatas as $borrowRequestGroupData) {

    //color coding
    $color = "";
    if ($borrowRequestGroupData['emp_approval'] == $REQUEST_PENDING) {
    $color = 'orange';
    } else if ($borrowRequestGroupData['emp_approval'] == $REQUEST_APPROVED) {
    $color = 'orange';
    }

    echo "
    <div class='cell padding0 shadow align-left'>
      <div class='bg-" . $color . " padding0 fg-" . $color . "'>.</div>
      <div class='cell padding10'>
        <small>Borrow Request to</small>
        <br />
        <span class='sub-header'>" . $borrowRequestGroupData['emp_name'] . "</span>
        <p><small>" . $borrowRequestGroupData['department']  . " Department</small></p>
        <p><small><b>Date to be returned:</b> " . date("M d, Y H:i A", strtotime($borrowRequestGroupData['date_borrow'])) . "</small></p>
        <hr class='thin' />";

        echo "<div style='overflow-y: scroll; height: 300px'>";

        $sql = "SELECT b.description, qty, c.condition_info, d.location AS old_loc, e.location AS new_loc FROM borrow_request AS a LEFT JOIN property AS b ON a.id=b.id LEFT JOIN condition_info AS c ON a.condition_id=c.id LEFT JOIN location AS d ON a.old_loc_id=d.id LEFT JOIN location AS e ON a.new_loc_id=e.id WHERE request_code=" . $borrowRequestGroupData['request_code'];

        $borrowRequestItemDatas = $db->query($sql)->fetchAll();

        foreach ($borrowRequestItemDatas as $borrowRequestItemData) {

          echo "
          <div>
          <b>" . $borrowRequestItemData['description'] . "</b>
          <p><small>x " . $borrowRequestItemData['qty'] . "</small></p>
          <p><small><b>Condition:</b> " . $borrowRequestItemData['condition_info'] . "</small></p>";

          echo "
          <span><b>From:</b> " . $borrowRequestItemData['old_loc'] . "</span>
          <br />
          <span><b>To:</b> " . $borrowRequestItemData['new_loc'] . "</span>";

          echo "<hr class='thin bg-grayLighter'>
          </div>";
        }

          echo "
            </div>
            <button class='button button-default' onclick=approveInHistory(".$borrowRequestGroupData['request_code'].")>Returned Request</button>

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

      if (count($borrowRequestGroupDatas) <= 0) {
        echo "<h2>You have no any borrow request.</h2>
        <small>Choose property on the list to borrow.</small>";
      }
      exit();
    }
    ?>
