<?php

	require_once "../../connection.php";
	session_start();
	$id = $_POST['id'];
  $emp_id = $_SESSION['account']['emp_id'];
  $location_id = $_POST['location_id'];
  $new_condition_id = $_POST['new_condition_id'];
  $old_condition_id = $_POST['old_condition_id'];
	$dateToday = date('Y-m-d H:i:s');
	//check if going to merge
	if ($db->has("property_accountability", [
		"AND" => [
			"property_id" => $id,
			"emp_id" => $emp_id,
			"condition_id" => $new_condition_id,
			"location_id" => $location_id
		]
	])) { //if employee want to change already exists in her/his accountabliity
		$qty = $db->get("property_accountability", "qty", [
			"AND" => [
				"property_id" => $id,
				"emp_id" => $emp_id,
				"condition_id" => $old_condition_id,
				"location_id" => $location_id
			]
		]);

		$db->update("property_accountability", ["qty[+]" => $qty], [
			"AND" => [
				'emp_id' => $emp_id,
				'property_id' => $id,
				'condition_id' => $new_condition_id,
				'location_id' => $location_id
			]
		]);

		$db->delete("property_accountability", [
			"AND" => [
				'emp_id' => $emp_id,
				'property_id' => $id,
				'condition_id' => $old_condition_id,
				'location_id' => $location_id
			]
		]);

		echo 2;
	} else { //else if not exists, just a simple update
			$db->update("property_accountability", ["condition_id" => $new_condition_id], [
			"AND" => [
				'emp_id' => $emp_id,
				'property_id' => $id,
				'condition_id' => $old_condition_id,
				'location_id' => $location_id
			]
		]);

			echo 1;
	}

	$db->update("transfer_request", ["condition_id" => $new_condition_id], [
		"AND" => [
			'emp_id' => $emp_id,
			'property_id' => $id,
			'condition_id' => $old_condition_id,
			'old_location_id' => $location_id
		]
	]);
	// insert to audit trail
	$remarks = $_POST['remarks'];
	$propertyName = $db->get("property",["pcode","sno","description","brand","uom","or_number"],["id"=>$id]);
	$oldCond = $db->get("condition_info","condition_info",["id" => $old_condition_id]);
	$newCond = $db->get("condition_info","condition_info",["id" => $new_condition_id]);
	$actions = $emp_id." updated the condition of ".$propertyName['pcode']." - ".$propertyName['sno']." - ".$propertyName['description']." from ".$oldCond." to ".$newCond;
	$db->insert("audit_trail_condition",
	["brand"=>$propertyName['brand'],
	"uom"=>$propertyName['uom'],
	"po_number"=>$propertyName['or_number'],
	'property_id'=>$id,
	"pcode"=>$propertyName['pcode'],
	"sno"=>$propertryName['sno'],
	"description"=>$propertyName['description'],
	"actor"=>$emp_id,
	"action" => $actions ,
	"date" => $dateToday ,
	 "remarks"=>$remarks	]);


?>
