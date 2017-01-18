<?php
	require_once "../../connection.php";
	session_start();

	$id = $_POST['id'];
	$qty = $_POST['qty'];
	$location = $_POST['location'];

	$sql="SELECT * from property_information_view where id= :id";
	$statement=$connection->prepare($sql);
	$statement->execute(array(
		'id' => $id
	));

	$propertyObj = $statement->fetch();

	$propertyTransferList = array(); //intialize array of properties to be transfered

	if (!isset($_SESSION['propertyTransferList'])) {

		$transferProperty = new stdClass(); //property and qty object

		$transferProperty->{'property'} = $propertyObj;
		$transferProperty->{'qty'} = $qty;
		$transferProperty->{'location'} = $location;

		array_push($propertyTransferList, $transferProperty); //add to array

	} else {
		$propertyTransferList = $_SESSION['propertyTransferList'];

		$hasProperty = false;
		for ($i = 0; $i < count($propertyTransferList); $i ++) {
			if ($propertyTransferList[$i]->{'property'}['id'] == $propertyObj['id']) {
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

	$_SESSION['propertyTransferList'] = $propertyTransferList;

	include "showPropertyTransfer.php";
?>