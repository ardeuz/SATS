<?php
  require_once("../../connection.php");
  $id = $_POST['id'];
  $pcode = $_POST['pcode'];
  $newHolder = $_POST['account'];
  $db->insert("property_accountability",[
  "emp_id" => $newHolder,
  "property_id" => $id
  ]);
  echo 1;
?>
