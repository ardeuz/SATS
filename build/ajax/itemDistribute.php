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
  elseif($db->get("property_accountability",["location_id"],["location_id"=>$oldLocation]) == $itemLocation){
    echo 2;
    // same location
  }
  elseif(){
    echo 3;
    //
  }
  elseif(){
    echo 4;
    //Server Error
  }
  else{
    echo 0;
    //update
    // No Error
    // query Here
  }
?>
