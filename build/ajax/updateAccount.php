<?php
  require_once("../../connection.php");
  $key = $_POST['key'];
  $emp_id = $_POST['emp_id'];
  $db->update("account_table" , ["status" => $key] , ["emp_id" => $emp_id]);
?>
