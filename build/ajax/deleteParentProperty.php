<?php
  require_once "../../connection.php";

  if (isset($_POST['property_id'])) {
    $property_id = $_POST['property_id'];
    $parent_id = $_POST['parent_id'];

    $db->delete("sub_property", [
      "AND" => [
        "property_id" => $parent_id,
        "sub_property_id" => $property_id
      ]
    ]);

    echo 1;
  }
?>
