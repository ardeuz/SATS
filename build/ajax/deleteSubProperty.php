<?php
  require_once("../../connection.php");

  if (isset($_POST['sub_id'])) {
    $sub_id = $_POST['sub_id'];
    $parent_id = $_POST['parent_id'];

    $db->delete("sub_property", [
      "AND" => [
        "property_id" => $parent_id,
        "sub_property_id" => $sub_id
      ]
    ]);

    echo 1;
  }
?>
