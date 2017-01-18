<?php
  require_once("../../connection.php");

  if (isset($_POST['parent_id'])) {
    $parent_id = $_POST['parent_id'];
    $sub_id = $_POST['sub_id'];

    if ($db->has("sub_property", [
      "AND" => [
        "property_id" => $parent_id,
        "sub_property_id" => $sub_id
    ]
    ])) {
      echo -1;
    } else {
      $db->insert("sub_property", [
        "property_id" => $parent_id,
        "sub_property_id" => $sub_id
      ]);

      

      echo 1;
    }
  }
?>
