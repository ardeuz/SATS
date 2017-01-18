<?php

  require_once('../../connection.php');
  $propertyID = $_POST['pcode'];
  $db->delete("property",['id'=>$propertyID]);
  $db->delete("property_accountability",["property_id"=>$propertyID]);
  echo 1;
?>
