<?php

  require_once('../../connection.php');
  $emp_id = $_POST['emp_id'];
  $db->delete("account_table",['emp_id'=>$emp_id]);
  $db->delete("property_accountability",["emp_id"=>$emp_id]);
  echo 1;

?>
