<?php

  require_once('../../connection.php');
  $cost = $_POST['cost'];
  $recommendation = $_POST['recommendation'];
  $audit_id = $_POST['id'];
  $db->update("audit_trail_condition",["recommendation"=>$recommendation,"cost"=>$cost],["id"=>$audit_id]);
?>
