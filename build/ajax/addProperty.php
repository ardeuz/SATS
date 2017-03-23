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
    if(empty($_POST['dateAcquired'])){
      $date_acquired = "0000-00-00";
    } elseif(!empty($_POST['dateAcquired'])){
      $date_acquired = date("Y-m-d",strtotime($_POST['dateAcquired']));      
    }
    $propertyDescription = $_POST['propertyDescription'];
    $qty = $_POST['qty']; //property accountability
    $locations = $_POST['locations']; //property accountability
    $conditions = $_POST['conditions']; //property accountability
    $minorCategory = $_POST['minorCategory'];
    $majorCategory = $_POST['majorCategory'];
    $accountCategory = $_POST['accountCategory']; //property accountability
    $rental = $_POST['rental'];

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
        "date_acquired" => $date_acquired,
        "or_number" => $orno
      ]);

      $db->insert("property_accountability", [
        "emp_id" => $accountCategory,
        "property_id" => $propertyId,
        "qty" => $qty,
        "location_id" => $locations,
        "condition_id" => $conditions
      ]);
      if($rental != 0){
        $db->insert("equipment_rental",["supplier_id"=>$rental,"property_id"=>$propertyId]);
      }
      echo 1;
    }
  }

?>
