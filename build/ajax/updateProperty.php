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
  if(!empty($editPropertyCode) || !empty($editPropertySerialNumber))
  {
    if($editMinorId == 0)
    {
      $updateQuery = $db->update('property',['pcode' => $editPropertyCode ,'sno'=>$editSerialNumber ,'description'=> $editPropertyDescription,'brand'=> $editBrand,'model'=> $editModel,'or_number'=> $ornumber,'uom'=> $editUom, 'cost'=> $editCost],['id' => $propertyId]);
      echo 1;
    }
    else{
      $updateQuery = $db->update('property',['pcode' => $editPropertyCode ,'sno'=>$editSerialNumber ,'description'=> $editPropertyDescription,'brand'=> $editBrand,'model'=> $editModel,'or_number'=> $ornumber,'uom'=> $editUom, 'cost'=> $editCost,'minor_category'=> $editMinorId],['id' => $propertyId]);
      echo 1;
    }
  }
  elseif(empty($editPropertyCode) && empty($editPropertySerialNumber))
  {
    echo 2;
  }
  else {
    echo 3;
  }

?>