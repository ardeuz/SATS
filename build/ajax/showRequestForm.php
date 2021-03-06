<?php
	require_once("../../connection.php");
	include "../../config.php";
	session_start();

	$requestType = $_POST['requestType'];
	$emp_id = $_SESSION['account']['emp_id'];
	//============make the card=================//

	$sql = "";
	if($db->has("transfer_request",["transfer_type"=>"issue"])){
			$sql = "SELECT request_code, remarks, transfer_to, released_from, date_request, emp_approval, CONCAT(b.last_name, ', ', b.first_name) AS emp_name, b.department FROM transfer_request AS a LEFT JOIN account_table AS b ON a.transfer_to=b.emp_id WHERE transfer_to='$emp_id' AND emp_approval=$requestType GROUP BY request_code";
			$header = "Transfering to";
	} else {
			$sql = "SELECT request_code, remarks, transfer_to, released_from, date_request, emp_approval, CONCAT(b.last_name, ', ', b.first_name) AS emp_name, b.department FROM transfer_request AS a LEFT JOIN account_table AS b ON a.transfer_to=b.emp_id WHERE released_from='$emp_id' AND emp_approval=$requestType GROUP BY request_code";
			$header = "Requested From";
	}

	$transferRequestGroupDatas = $db->query($sql)->fetchAll();
	//color coding
	$color = "";
	if ($requestType == $REQUEST_PENDING) {
		$color = 'orange';
	} else if ($requestType == $REQUEST_APPROVED) {
		$color = 'green';
	}

		echo "<div class='row cells3'>";
		$cardCount = 1;
		foreach ($transferRequestGroupDatas as $transferRequestGroupData) {
			echo "
			<div class='cell padding0 shadow align-left'>
					<div class='bg-" . $color . " padding0 fg-" . $color . "'>.</div>
					<div class='cell padding10'>
		        	<small>".$header."</small>

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
		                	<p><small><b>Condition:</b> " . $transferRequestItemData['condition_info'] . "</small></p>
		                	<span><b>From:</b> " . $transferRequestItemData['old_loc'] . "</span>
		                	<br />
		            		<span><b>To:</b> " . $transferRequestItemData['new_loc'] . "</span>";

		                	echo "<hr class='thin bg-grayLighter'>
		                	</div>";
		            }

		            echo "
		            </div>
									Remarks: ".$transferRequestGroupData['remarks']."
		            </div>";

		            if ($requestType == $REQUEST_PENDING) {

		            	echo "
		            		<hr class='thin' />
		            		<button class='button danger place-right' onclick='disapproveRequest(".$transferRequestGroupData['request_code'].")'>
		            			<span class='mif-cross'></span>
		        			</button>
		        			<button class='button success place-right showConfirmation' idUp=". $transferRequestGroupData['request_code'] .">
		        				<span class='mif-checkmark'></span>
		        				Accept
        					</button>";
		            }


		    echo "</div>";

		    if ($cardCount == 3) {
		    	echo "</div>";

		    	echo "<div class='row cells3'>";
				$cardCount = 1;
		    }

		    $cardCount++;
		}

		if ($cardCount != 3) {
			echo "</div>";
		}

		if (count($transferRequestGroupDatas) <= 0) {
			echo "<h2>You have no any Transfer request.</h2>
					<small>Choose property on the list to request for Transfer to your accountability.</small>";
		}

?>
