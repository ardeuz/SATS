<?php

require_once('../../connection.php');
$minorValue = $_POST['pcode'];
if($db->has("minor_category", ["id" => $minorValue]) == $minorValue){
  $db->delete("minor_category", ["id" => $minorValue]);
  echo 1;
}
else {
  echo 2;
}
?>
