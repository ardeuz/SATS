<?php

  require_once('../../connection.php');
  $propertyId = $_POST['propertyId'];
  $editPropertyCode = $_POST['editPropertyCode'];
  $editSerialNumber = $_POST['editSerialNumber'];
  $editPropertyDescription = $_POST['editPropertyDescription'];
  $editBrand = $_POST['editBrand'];
  $editModel = $_POST['editModel'];
  $ornumber = $_POST['ornumber'];
  $editUom = $_POST['editUom'];
  $editCost = $_POST['editCost'];
  $editMinorId = $_POST['editMinorId'];
  $editQty = $_POST['editQty'];

      $updateQuery = $db->update('property',['pcode' => $editPropertyCode ,'sno'=>$editSerialNumber ,'description'=> $editPropertyDescription,'brand'=> $editBrand,'model'=> $editModel,'or_number'=> $ornumber,'uom'=> $editUom, 'cost'=> $editCost,'pcode'=> $editMinorId,'qty'=> $editQty],['id' => $propertyId]);
      echo 1;
?>
