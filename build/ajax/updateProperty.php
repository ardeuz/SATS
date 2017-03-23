<?php

  require_once('../../connection.php');
  $propertyId = $_POST['propertyId'];
  $editPropertyCode = $_POST['editPropertyCode'];
  $editSerialNumber = $_POST['editSerialNumber'];
  $editPropertyDescription = $_POST['editPropertyDescription'];
  $editBrand = $_POST['editBrand'];
  $editModel = $_POST['editModel'];
  $ornumber = $_POST['ornumber'];
  // $dateAcquired = date("Y-m-d",strtotime($_POST['editDateAcquired']));
  $editUom = $_POST['editUom'];
  $editQty = $_POST['editQty'];
  $editCost = $_POST['editCost'];
  $editMinorId = $_POST['editMinorId'];
  $editSupplier = $_POST['editSupplier'];
    if($editMinorId !=0){
      $updateQuery = $db->update('property',['minor_category'=> $editMinorId],['id' => $propertyId]);
    } if ($editSupplier != 0){
      $db->update("equipment_rental",["supplier_id"=>$editSupplier],["property_id"=>$propertyId]);
    } if(empty($dateAcquired)) {
        $dateAcquired = "0000-00-00";
    } elseif(!empty($dateAcquired)){
       $dateAcquired = date("Y-m-d",strtotime($_POST['editDateAcquired']));
    }
    $updateQuery = $db->update('property',['pcode' => $editPropertyCode ,'sno'=>$editSerialNumber ,'description'=> $editPropertyDescription,'brand'=> $editBrand,'model'=> $editModel,'or_number'=> $ornumber,'uom'=> $editUom, 'cost'=> $editCost ,"date_acquired" => $dateAcquired],['id' => $propertyId]);
    $updateQty = $db->update('property_accountability',['qty'=>$editQty],['property_id' => $propertyId]);
    echo 1;


?>
