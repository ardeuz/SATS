<?php
  require_once('../../connection.php');

  date_default_timezone_set('Asia/Manila');
	$dateToday = date('Y-m-d H:i:s');

  if (isset($_POST['pcode']) ) {
    $pcode = trim($_POST['pcode']);
    $sno = trim($_POST['sno']);
    $orno = trim($_POST['orno']);
    $brand = trim($_POST['brand']);
    $model = trim($_POST['model']);
    $cost = $_POST['cost'];
    $uom = $_POST['uom'];
    $propertyDescription = $_POST['propertyDescription'];
    $qty = $_POST['qty']; //property accountability
    $locations = $_POST['locations']; //property accountability
    $conditions = $_POST['conditions']; //property accountability
    $minorCategory = $_POST['minorCategory'];
    $majorCategory = $_POST['majorCategory'];
    $accountCategory = $_POST['accountCategory']; //property accountability

    if ($sno == "" || !$db->has("property", ["sno" => $sno])) { //if there's no same serial number
      $propertyId = $db->insert("property", [
        "pcode" => $pcode,
        "sno" => $sno,
        "description" => $propertyDescription,
        "brand" => $brand,
        "model" => $model,
        "minor_category" => $minorCategory,
        "uom" => $uom,
        "major_category" => $majorCategory,
        "cost" => $cost,
        "date_acquired" => $dateToday,
        "or_number" => $orno
      ]);

      $db->insert("property_accountability", [
        "emp_id" => $accountCategory,
        "property_id" => $propertyId,
        "qty" => $qty,
        "location_id" => $locations,
        "condition_id" => $conditions
      ]);
      echo 1;
    }
  }

?>
