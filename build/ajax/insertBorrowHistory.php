<?php
	require_once('../../connection.php');
	include "../../config.php";

	date_default_timezone_set('Asia/Manila');
	$dateToday = date('Y-m-d H:i:s');

	$request_code = $_POST['request_code'];

		//======generate ctrl no===========//
		$db->update("borrow_request_history", [
			"borrow_status" => "returned"
		],["request_code" => $request_code]); //insert things to history
		$borrowDatas = $db->select("borrow_request_history",['id','old_loc_id','new_loc_id','borrowed_to','released_from','remarks'],["request_code" => $request_code]);
		foreach($borrowDatas as $borrowData){
			$propertyDetails = $db->get('property',[
				"pcode","sno","description","cost","brand","uom","or_number"],[ "id"=> $borrowData['id']]);
			$transferToDetails = $db->get('account_table',["last_name","first_name","department"],["emp_id" => $borrowData['borrowed_to']]);
			$releasedFromDetailes = $db->get('account_table',["last_name","first_name","department"],["emp_id" => $borrowData['released_from']]);
			$oldLocation = $db->get('location',"location",["id"=>$borrowData['old_loc_id']]);
			$newLocation = $db->get('location',"location",["id"=>$borrowData['new_loc_id']]);
		  $action  = 'This property is returned by '.$transferToDetails['last_name'].', '.$transferToDetails['first_name'].' - '.$transferToDetails['department'].' from '.$releasedFromDetailes['last_name'].', '.$releasedFromDetailes['first_name'].' - '.$releasedFromDetailes['department'];
			$actor = $releasedFromDetailes['last_name'].', '.$releasedFromDetailes['first_name'].' - '.$releasedFromDetailes['department'];
			$db->insert('audit_trail_location',[
				"action"=> $action,
				"pcode"=> $propertyDetails['pcode'],
				"sno"=> $propertyDetails['sno'],
				"description"=> $propertyDetails['description'],
				"actor"=>  $actor,
				"cost"=> $propertyDetails['cost'],
				"date"=> $dateToday,
				"property_id"=> $borrowData['id'],
				"remarks"=> $borrowData['remarks'],
				"recommendation"=> " ",
				"brand"=> $propertyDetails['brand'],
				"uom"=> $propertyDetails['uom'],
				"po_number"=> $propertyDetails['or_number'],
				"old_location"=> $oldLocation,
				"new_location"=> $newLocation
			]); //inserting in audit trail

		}
	$db->delete("borrow_request",["request_code" => $request_code]);
	//deletions of borrows
	echo 1;
?>
