<?php
	require_once "../../connection.php";
	session_start();

	$id = $_POST['id'];
	$emp_id = $_POST['emp_id'];
	$condition_id = $_POST['condition_id'];
	$qty = $_POST['qty'];
  $location = $_POST['location'];
	$location_id = $_POST['location_id'];

	$propertyObj = $db->query("SELECT a.property_id AS id, a.condition_id, a.remarks, b.pcode , b.sno , b.description as property_description, b.brand , b.model , c.description as major_description, d.description as minor_description, a.qty, b.uom, a.location_id, e.location, b.cost, f.condition_info , g.emp_id, g.first_name, g.last_name, g.department  from property_accountability AS a left join property as b on a.property_id = b.id left join minor_category as d on  b.minor_category = d.id left join major_category as c on d.major_id = c.id left join location as e on a.location_id = e.id left join condition_info as f on a.condition_id = f.id left join account_table as g on a.emp_id = g.emp_id  WHERE a.property_id=$id AND a.location_id=$location_id AND a.condition_id = $condition_id AND a.emp_id = '$emp_id'")->fetch();

	$propertyTransferList = array(); //intialize array of properties to be transfered

	if (!isset($_SESSION['propertyBorrowList'])) {

		$transferProperty = new stdClass(); //property and qty object

		$transferProperty->{'property'} = $propertyObj;
		$transferProperty->{'qty'} = $qty;
		$transferProperty->{'location'} = $location;
		array_push($propertyTransferList, $transferProperty); //add to array

	} else {
		$propertyTransferList = $_SESSION['propertyBorrowList'];

		$hasProperty = false;
		for ($i = 0; $i < count($propertyTransferList); $i ++) {
			if ($propertyTransferList[$i]->{'property'}['id'] == $propertyObj['id'] &&
			$propertyTransferList[$i]->{'property'}['emp_id'] == $propertyObj['emp_id'] &&
			$propertyTransferList[$i]->{'property'}['condition_id'] == $propertyObj['condition_id'] &&
			$propertyTransferList[$i]->{'property'}['location_id'] == $propertyObj['location_id']) { //if the item and employee ordered exists, update the qty and location only
				$propertyTransferList[$i]->{'qty'} = $qty;
				$propertyTransferList[$i]->{'location'} = $location;

				$hasProperty = true;
			}
		}

		if (!$hasProperty) {
			$transferProperty = new stdClass(); //property and qty object

			$transferProperty->{'property'} = $propertyObj;
			$transferProperty->{'qty'} = $qty;
      $transferProperty->{'location'} = $location;


			array_push($propertyTransferList, $transferProperty); //add to array
		}
	}

	$_SESSION['propertyBorrowList'] = $propertyTransferList;

	include "showPropertyBorrow.php";
?>
