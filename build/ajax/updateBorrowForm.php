<?php
	require_once("../../connection.php");
	include "../../config.php";
	date_default_timezone_set('Asia/Manila');
	$dateToday = date('Y-m-d H:i:s');
	$request_code = $_POST['confirmation_id'];

	// $db->update("borrow_request", ["emp_approval" => 1], ["request_code" => $request_code]);
	//
	//
	//
	// $request_code = $_POST['request_code'];

	$db->update("borrow_request", ["date_approved" => $dateToday,"emp_approval" => 1], ["request_code" => $request_code]);
	//======generate ctrl no===========//
	$sy = $db->get("ctrl_sy", "sy"); //get sy
	$no = $db->max("borrow_request_history", "no") + 1; //get the next number for ctrl form

	$no_format = str_pad($no, 5, '0', STR_PAD_LEFT); //format to 5 digit

	$ctrl_no = $CTRL_NO_PREFIX . "-" . $sy . "-" . $no_format ."-". $CTRL_NO_SUFFIX;
	$transferRequestDatas = $db->select("borrow_request", [
		"request_code", "id", "qty", "condition_id", "old_loc_id", "new_loc_id", "transfer_to", "date_borrow", "date_request","released_from", "remarks"
	], [
		"request_code" => $request_code
	]);
	foreach ($transferRequestDatas as $transferRequestData) {
		$propertyDetails = $db->get('property',[
			"pcode","sno","description","cost","brand","uom","or_number"
		],[ "id"=> $transferRequestData['id']]);
		$transferToDetails = $db->get('account_table',["last_name","first_name","department"],["emp_id" => $transferRequestData['transfer_to']]);
		$releasedFromDetailes = $db->get('account_table',["last_name","first_name","department"],["emp_id" => $transferRequestData['released_from']]);
		$oldLocation = $db->get('location',"location",["id"=>$transferRequestData['old_loc_id']]);
		$newLocation = $db->get('location',"location",["id"=>$transferRequestData['new_loc_id']]);
		$action  = 'This property is borrowed by'.$transferToDetails['last_name'].', '.$transferToDetails['first_name'].' - '.$transferToDetails['department'].' from '.$releasedFromDetailes['last_name'].', '.$releasedFromDetailes['first_name'].' - '.$releasedFromDetailes['department'];
		$actor = $transferToDetails['last_name'].', '.$transferToDetails['first_name'].' - '.$transferToDetails['department'];



		$db->insert("borrow_request_history", [
			"ctrl_no" => $ctrl_no,
			"sy" => $sy,
			"no" => $no,
			"request_code" => $transferRequestData['request_code'],
			"id" => $transferRequestData['id'],
			"qty" => $transferRequestData['qty'],
			"condition_id" => $transferRequestData['condition_id'],
			"old_loc_id" => $transferRequestData['old_loc_id'],
			"new_loc_id" => $transferRequestData['new_loc_id'],
			"borrowed_to" => $transferRequestData['transfer_to'],
			"released_from" => $transferRequestData['released_from'],
			"remarks" => $transferRequestData['remarks'],
			"date_approved" => $transferRequestData['date_request'],
			"date_return" => $transferRequestData['date_borrow'],
			"date_actual_returned" => $dateToday,
			"borrow_status" => "borrowed"
		]); //insert things to history
		$db->insert('audit_trail_location',[
			"action"=> $action,
			"pcode"=> $propertyDetails['pcode'],
			"sno"=> $propertyDetails['sno'],
			"description"=> $propertyDetails['description'],
			"actor"=>  $actor,
			"cost"=> $propertyDetails['cost'],
			"date"=> $dateToday,
			"property_id"=> $transferRequestData['id'],
			"remarks"=> $transferRequestData['remarks'],
			"recommendation"=> " ",
			"brand"=> $propertyDetails['brand'],
			"uom"=> $propertyDetails['uom'],
			"po_number"=> $propertyDetails['or_number'],
			"old_location"=> $oldLocation,
			"new_location"=> $newLocation
		]); //inserting in audit trail

	}
	echo 1;
?>
