<?php

  require_once("../../connection.php");
  $newMaj = $_POST['newMajor'];
  $depYear = $_POST['depYear'];
  if($db->has("major_category",["description" => $newMaj]))
  {
    echo -1;
  }
  else{
    $db->insert("major_category",
    [
      "description" => $newMaj,
      "depreciate_yr" => $depYear,
    ]);
    echo 1;

  }
?>
