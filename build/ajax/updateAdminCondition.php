<?php
	require_once "../../connection.php";

  session_start();

	$id = $_POST['id'];
  $emp_id = 'CLN00002';
  $location_id = $_POST['location_id'];
  $new_condition_id = $_POST['new_condition_id'];
  $old_condition_id = $_POST['old_condition_id'];

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
?>
