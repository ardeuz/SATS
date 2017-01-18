<?php

  require_once('../../connection.php');
  $locationID = $_POST['pcode'];
  $db->delete("major_category",["id"=>$locationID]);
  echo 1;
?>
