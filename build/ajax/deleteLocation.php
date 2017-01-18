<?php

  require_once('../../connection.php');
  $locationID = $_POST['pcode'];
  $db->delete("location",["id"=>$locationID]);
  echo 1;
?>
