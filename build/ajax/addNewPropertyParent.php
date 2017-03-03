<?php
require_once('../../connection.php');
$parent_id = $db->max("property",'id');
$sub_id = $_POST['parent'];
$db->insert("sub_property", [
  "property_id" => $sub_id,
  "sub_property_id" => $parent_id+1
]);

?>
