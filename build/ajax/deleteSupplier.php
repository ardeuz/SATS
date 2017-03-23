<?php

  require_once('../../connection.php');
  $locationID = $_POST['pcode'];
  $db->delete("supplier",["sup_id"=>$locationID]);
  echo 1;
?>
