<?php

  require_once("../../connection.php");
  $supplier = $_POST['newMajor'];
  if($db->has("supplier",["sup_name" => $supplier]))
  {
    echo -1;
  }
  else{
    $db->insert("supplier",
    [
      "sup_name" => $supplier,
    ]);
    echo 1;

  }
?>
