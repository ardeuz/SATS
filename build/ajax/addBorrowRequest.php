<?php
	require_once "../../connection.php";
	include "../../config.php";
	session_start();

	date_default_timezone_set('Asia/Manila');
	$dateToday = date('Y-m-d H:i:s');

	$emp_id = $_POST['emp_id']; //block of transfer request to be add on database

	$propertyTransferList = $_SESSION['propertyTransferList'];

	//============generate request code==============//
	$request_code = $db->max("borrow_request", "request_code") + 1;

	//===============insertion=============//
	$msgResponse = new stdClass();
	$hasRequest = false; //checker if atleast 1 property has requested
	$notReserveCount = 0; //validation, count the items that will be request
	for ($i = 0; $i < count($propertyTransferList); $i++) {
		if ($propertyTransferList[$i]->{'property'}['emp_id'] == $emp_id) { //insert only the whole data of one employee

			if ($db->has("borrow_request", [
				"AND" => [
						"id" => $propertyTransferList[$i]->{'property'}['id'],
						"condition_id" => $propertyTransferList[$i]->{'property'}['condition_id'],
						"old_loc_id" => $propertyTransferList[$i]->{'property'}['location_id'],
						"released_from" => $propertyTransferList[$i]->{'property'}['emp_id']
					]
				])) { //check if already requested
					$notReserveCount++;
			} else if ($db->has("transfer_request", [
				"AND" => [
						"id" => $propertyTransferList[$i]->{'property'}['id'],
						"condition_id" => $propertyTransferList[$i]->{'property'}['condition_id'],
						"old_loc_id" => $propertyTransferList[$i]->{'property'}['location_id'],
						"released_from" => $propertyTransferList[$i]->{'property'}['emp_id']
					]
				])) { //check if also in the transfer request
					$notReserveCount++;
			} else {
				$hasRequest = true;

				$db->insert("borrow_request", [
					"request_code" => $request_code,
					"id" => $propertyTransferList[$i]->{'property'}['id'],
					"qty" => $propertyTransferList[$i]->{'qty'},
					"condition_id" => $propertyTransferList[$i]->{'property'}['condition_id'],
					"old_loc_id" => $propertyTransferList[$i]->{'property'}['location_id'],
					"new_loc_id" => $propertyTransferList[$i]->{'location'},
					"remarks" => $propertyTransferList[$i]->{'property'}['remarks'],
					"transfer_to" => $_SESSION['account']['emp_id'],
					"released_from" => $propertyTransferList[$i]->{'property'}['emp_id'],
					"date_request" => $dateToday,
					"date_borrow"=> $propertyTransferList[$i]->{'dateBorrow'}
				]);
			}
		}
	}

	//=========advance response============//
	if ($hasRequest && $notReserveCount > 0) {
		$msgResponse->{'code'} = 2;
		$msgResponse->{'msg'} = $notReserveCount . " items are already on the borrowing/transferring queue.";
	} else if ($hasRequest) {
		$msgResponse->{'code'} = 1;
		$msgResponse->{'msg'} = "Successfully requested.";
	} else if (!$hasRequest) {
		$msgResponse->{'code'} = -1;
		$msgResponse->{'msg'} = "Item(s) are already on the borrowing/transferring queue.";
	}

	echo json_encode($msgResponse);
?>
