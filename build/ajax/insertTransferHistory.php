<?php
	require_once('../../connection.php');
	include "../../config.php";

	date_default_timezone_set('Asia/Manila');
	$dateToday = date('Y-m-d H:i:s');

	$request_code = $_POST['request_code'];

	//======generate ctrl no===========//
	$sy = $db->get("ctrl_sy", "sy"); //get sy
	$no = $db->max("transfer_request_history", "no") + 1; //get the next number for ctrl form

	$no_format = str_pad($no, 5, '0', STR_PAD_LEFT); //format to 5 digit

	$ctrl_no = $CTRL_NO_PREFIX . "-" . $sy . "-" . $no_format ."-". $CTRL_NO_SUFFIX;

	//===============magic happens================//
	$transferRequestDatas = $db->select("transfer_request", [
		"request_code", "id", "qty", "transfer_type" , "condition_id", "old_loc_id", "new_loc_id", "transfer_to", "released_from", "remarks"
	], [
		"request_code" => $request_code
	]);

	foreach ($transferRequestDatas as $transferRequestData) {
		$db->insert("transfer_request_history", [
			"ctrl_no" => $ctrl_no,
			"sy" => $sy,
			"no" => $no,
			"request_code" => $transferRequestData['request_code'],
			"id" => $transferRequestData['id'],
			"qty" => $transferRequestData['qty'],
			"condition_id" => $transferRequestData['condition_id'],
			"old_loc_id" => $transferRequestData['old_loc_id'],
			"new_loc_id" => $transferRequestData['new_loc_id'],
			"transfer_to" => $transferRequestData['transfer_to'],
			"released_from" => $transferRequestData['released_from'],
			"remarks" => $transferRequestData['remarks'],
			"date_approved" => $dateToday,
			"transfer_type" => $transferRequestData['transfer_type']
		]); //insert things to history

		$item_qty = $db->get("property_accountability", "qty", [
			"AND" => [
				"property_id" => $transferRequestData['id'],
				"emp_id" => $transferRequestData['released_from'],
				"location_id" => $transferRequestData['old_loc_id'],
				"condition_id" => $transferRequestData['condition_id']
				]
			]); //get the quantity of the item where it is accountable originally

		if ($item_qty > $transferRequestData['qty']) { //check if there will still item to be left on his accountability

			if ($db->has("property_accountability", [
				"AND" => [
					"property_id" => $transferRequestData['id'],
					"emp_id" => $transferRequestData['transfer_to'],
					"location_id" => $transferRequestData['new_loc_id'],
					"condition_id" => $transferRequestData['condition_id']
					]
				])) { //if the employee has already the item
				$db->update("property_accountability", [
					"qty[+]" => $transferRequestData['qty']
					], [
						"AND" => [
							"property_id" => $transferRequestData['id'],
							"emp_id" => $transferRequestData['transfer_to'],
							"location_id" => $transferRequestData['new_loc_id'],
							"condition_id" => $transferRequestData['condition_id']
						]
					]); //add the quantity
			} else { //else if the employee doesnt have the item
				$db->insert("property_accountability", [
					"emp_id" => $transferRequestData['transfer_to'],
					"property_id" => $transferRequestData['id'],
					"qty" => $transferRequestData['qty'],
					"location_id" => $transferRequestData['new_loc_id'],
					"condition_id" => $transferRequestData['condition_id'],
					"remarks" => $transferRequestData['remarks']
				]); //add item to his accountability
			}

			$db->update("property_accountability", [
				"qty[-]" => $transferRequestData['qty']
				], [
					"AND" => [
						"property_id" => $transferRequestData['id'],
						"emp_id" => $transferRequestData['released_from'],
						"location_id" => $transferRequestData['old_loc_id'],
						"condition_id" => $transferRequestData['condition_id']
					]
				]); //deduct the quantity from the orig owner

		} else { //if that was the last item, change the accountability to requestor

			//check if the employee has the item
			if ($db->has("property_accountability", [
				"AND" => [
					"property_id" => $transferRequestData['id'],
					"emp_id" => $transferRequestData['transfer_to'],
					"location_id" => $transferRequestData['new_loc_id'],
					"condition_id" => $transferRequestData['condition_id']
					]
				])) { //if the employee has already the item
					$db->update("property_accountability", [
						"qty[+]" => $transferRequestData['qty']
						], [
							"AND" => [
								"property_id" => $transferRequestData['id'],
								"emp_id" => $transferRequestData['transfer_to'],
								"location_id" => $transferRequestData['new_loc_id'],
								"condition_id" => $transferRequestData['condition_id']
							]
						]); //add the quantity

					$db->delete("property_accountability", [
						"AND" => [
							"property_id" => $transferRequestData['id'],
							"emp_id" => $transferRequestData['released_from'], //requestor
							"location_id" => $transferRequestData['old_loc_id'],
							"condition_id" => $transferRequestData['condition_id']
						]
					]); //delete it because it goes all to the new owner
				} else { //else if the employee doesnt have the item
					$db->update("property_accountability", [
						"emp_id" => $transferRequestData['transfer_to'],
						"location_id" => $transferRequestData['new_loc_id']
					], [
						"AND" => [
							"property_id" => $transferRequestData['id'],
							"emp_id" => $transferRequestData['released_from'], //requestor
							"location_id" => $transferRequestData['old_loc_id'],
							"condition_id" => $transferRequestData['condition_id']
						]
					]); //update the accountable, change ownership
				}
		}
	}

	$db->delete("transfer_request", ["request_code" => $request_code]); //lastly, delete it from transfer request
	echo 1;
?>
