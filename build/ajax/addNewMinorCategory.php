<?php

  require_once("../../connection.php");
  $minorCat = $_POST['newMinor'];
  $majorCat = $_POST['majorCat'];
  if($db->has("minor_category",["description" => $minorCat]))
  {
    echo -1;
  }
  else{
    $db->insert("minor_category",
    [
      "description" => $minorCat,
      "major_id" => $majorCat,
    ]);
    echo 1;

  }
?>
