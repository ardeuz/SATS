<?php
  require_once("../../connection.php");
  $id = $_POST['id'];
  $pcode = $_POST['pcode'];
  $location = $_POST['location'];
  $condition = $_POST['condition'];
  $newHolder = $_POST['account'];
  if($db->update("property_accountability",[
  "emp_id" => $newHolder
  ],
  ["AND"=>[
   "property_id"=>$id,
   "location_id"=>$location,
   "condition_id"=>$condition
  ]]))
  {
    echo 1;
  }
  else{
    echo $id.$pcode.$location.$condition.$newHolder;
    }
?>
