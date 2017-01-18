<?php

  require_once("../../connection.php");
  $newLoc = $_POST['newLoc'];
  if($db->has("location",["location" => $newLoc]))
  {
    echo -1;
  }
  else{
    $db->insert("location",
    [
      "location" => $newLoc,
    ]);
    echo 1;

  }
?>
