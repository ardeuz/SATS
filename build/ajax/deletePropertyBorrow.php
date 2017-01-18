<?php
	require_once "../../connection.php";
	session_start();

	$propertyTransferList = $_SESSION['propertyTransferList'];

	if (isset($_POST['emp_id'])) {
		$emp_id = $_POST['emp_id'];

		for ($i = 0; $i < count($propertyTransferList); $i ++) {
			if ($propertyTransferList[$i]->{'property'}['emp_id'] == $emp_id) {
				array_splice($propertyTransferList, $i, 1); //remove array

				$i--; //re indexed
			}
		}
	} else if (isset($_POST['property_id'])) {
		$property_id = $_POST['property_id'];
		$location_id = $_POST['location_id'];

		for ($i = 0; $i < count($propertyTransferList); $i ++) {
			if ($propertyTransferList[$i]->{'property'}['id'] == $property_id &&
				$propertyTransferList[$i]->{'property'}['location_id'] == $location_id) {
				array_splice($propertyTransferList, $i, 1); //remove array
				break;
			}
		}
	}

	$_SESSION['propertyTransferList'] = $propertyTransferList;

	include "showPropertyBorrow.php";
?>
