<?php

  require_once('../../connection.php');
  $recommendation = $_POST['recommendation'];
  $audit_id = $_POST['id'];
  $db->update("audit_trail_condition",["recommendation"=>$recommendation],["id"=>$audit_id]);
?>
