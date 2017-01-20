<?php

  require_once('../../connection.php');
  $itemLocation = $_POST['itemLocation'];
  $itemCondition = $_POST['itemCondition'];
  $quantity = $_POST['quantity'];
  $propertyId = $_POST['propertyId'];
  $oldLocation = $_POST['oldLocation'];
  $oldCondition = $_POST['oldCondition'];
  $emp_id = $_POST['emp_id'];
  if($db->max("property_accountability",["qty"],["AND"=>["property_id" => $propertyId,"emp_id"=>$emp_id]]) <= $quantity){
    echo 1;
  }
  elseif($db->has("property_accountability",["location_id"],["AND"=>["emp_id" => $emp_id,"property_id" => $propertyId, "condition_id"=> $oldCondition , "location_id"=>$oldLocation]])){
    echo 2;
    // same location
  }
  else{
    if($db->update("property_accountability" , ["qty[-]" => $quantity] , ["OR"=>["location_id" => $oldLocation,"condition_id" => $oldCondition]]) )
    {
      $insertPropertyNew=$db->insert("property_accountability",
      ["emp_id" => $emp_id , "property_id" => $propertyId , "qty" => $quantity  , "location_id" => $itemLocation , "condition_id" => $itemCondition],["AND"=>["location_id" => $itemLocation , "condition_id" => $itemCondition]]);
      echo var_dump($insertPropertyNew);
      echo 0;
    }
    //update
    // No Error
    // query Here
  }
?>
