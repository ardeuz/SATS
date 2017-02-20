<?php
	require_once("../../connection.php");
	include "../../config.php";
	session_start();

	if (!isset($_POST['showRequest'])) {
		exit();
	}

	$emp_id = $_SESSION['account']['emp_id'];
	//============make the card=================//
	$sql = "SELECT request_code, remarks, transfer_to, released_from, date_request, date_approved, emp_approval, CONCAT(b.last_name, ', ', b.first_name) AS transfer_to, CONCAT(c.last_name, ', ', c.first_name) AS released_from, b.department FROM borrow_request AS a LEFT JOIN account_table AS b ON a.transfer_to=b.emp_id LEFT JOIN account_table AS c ON a.released_from=c.emp_id WHERE emp_approval=1 AND date_approved != 0 GROUP BY request_code";

	$transferRequestGroupDatas = $db->query($sql)->fetchAll();

	echo "

	<div class='row'>";
	$cardCount = 1;
	foreach ($transferRequestGroupDatas as $transferRequestGroupData) {
		echo "
		<div class='cell size-p30 padding0 shadow align-left'>
				<div class='bg-amber padding0 fg-green'>.</div>
				<div class='cell padding10'>

					<small>Request From</small>
	      	<br />
	        <span class='sub-header'>" . $transferRequestGroupData['transfer_to'] . "</span>
					<br />
	        <span><small>" . $transferRequestGroupData['department']  . " Department</small></span>

					<div class='align-right'>
						<small>Accountabilities Of</small>
						<br />
						<span class='sub-header'>" . $transferRequestGroupData['released_from'] . "</span>
						<br />
						<span><small>" . $transferRequestGroupData['department']  . " Department</small></span>
					</div>

          <hr class='thin' />";

	            echo "<div style='overflow-y: scroll; height: 300px'>";

							$sql = "SELECT b.description, qty, c.condition_info, d.location AS old_loc, e.location AS new_loc FROM borrow_request AS a LEFT JOIN property AS b ON a.id=b.id LEFT JOIN condition_info AS c ON a.condition_id=c.id LEFT JOIN location AS d ON a.old_loc_id=d.id LEFT JOIN location AS e ON a.new_loc_id=e.id WHERE request_code=" . $transferRequestGroupData['request_code'];

							$transferRequestItemDatas = $db->query($sql)->fetchAll();

	            foreach ($transferRequestItemDatas as $transferRequestItemData) {
            		echo "
            		<div>
                	<b>" . $transferRequestItemData['description'] . "</b>
                	<p><small>x " . $transferRequestItemData['qty'] . "</small></p>
                	<p><small><b>Condition:</b> " . $transferRequestItemData['condition_info'] . "</small></p>
                	<span><b>From:</b> " . $transferRequestItemData['old_loc'] . "</span>
                	<br />
            		<span><b>To:</b> " . $transferRequestItemData['new_loc'] . "</span>";

                	echo "<hr class='thin bg-grayLighter'>
                	</div>";
	            }

	            echo "
	            	</div>

	            </div>
							<p class='padding10 text-light'>Remarks : ".$transferRequestGroupData['remarks']."</p>

						</div>";

				    if ($cardCount == 3) {
				    	echo "</div>";
				    	echo "<div class='row'>";
							$cardCount = 1;
				    }

	    			$cardCount++;
	}

	if ($cardCount != 3) {
		echo "</div>";
	}

	if (count($transferRequestGroupDatas) <= 0) {
		echo "<h2 class='text-light'><center>There is no any Current Borrow request.</center></h2
		<small></small>";
	}
?>
