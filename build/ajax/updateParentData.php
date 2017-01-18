<?php
  require_once('../../connection.php');

  if (isset($_POST['parent_id'])) {
    $parent_id = $_POST['parent_id'];
    $property_id = $_POST['property_id'];

    if ($db->has("sub_property", ["sub_property_id" => $property_id])) { //check if the item has already parent
      $db->update("sub_property", [
        "property_id" => $parent_id
      ], [
        "sub_property_id" => $property_id
      ]);
    } else { //else insert it
      $db->insert("sub_property", [
        "property_id" => $parent_id,
        "sub_property_id" => $property_id
      ]);
    }

    echo 1;
  }
?>
