<?php

  require_once('../../connection.php');
  $locationID = $_POST['majorID'];
  $locationValue = $_POST['majorValue'];
  $dep_year = $_POST['depreYear'];
  $locationDatas = $db->get("major_category",['description','id'],['id'=>$locationID]);

  if( $db->has("major_category","description",["description[!]"=>$locationValue]) )
  {
    echo 3;
    $db->update("major_category",["description"=>$locationValue,"depreciate_yr"=>$dep_year],["id"=>$locationID]);
  }
  elseif($locationDatas['description'] != $locationValue AND $db->has("major_category",["description"=>$locationValue]))
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
