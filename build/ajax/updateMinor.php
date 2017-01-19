<?php

  require_once('../../connection.php');
  $locationID = $_POST['minorID'];
  $locationValue = $_POST['minorValue'];
  $locationDatas = $db->get("minor_category",['description','id'],['id'=>$locationID]);

  if( $db->has("minor_category","description",["description[!]"=>$locationValue]) )
  {
    echo 3;
    $db->update("minor_category",["description"=>$locationValue],["id"=>$locationID]);
  }
  elseif($locationDatas['description'] != $locationValue AND $db->has("minor_category",["description"=>$locationValue]))
  {
    echo 4;
  }

  elseif($locationDatas['description'] == $locationValue)
  {
    // Same
    echo 1;
  }

  else {
    echo 2;
  }



?>
