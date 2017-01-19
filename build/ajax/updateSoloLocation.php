<?php

  require_once('../../connection.php');
  $locationID = $_POST['locationID'];
  $locationValue = $_POST['locationValue'];
  $locationDatas = $db->get("location",['location','id'],['id'=>$locationID]);
  if($locationDatas['location'] != $locationValue && $db->has("location",["location[!]"=>$locationValue]))
  {
    echo 3;
    $db->update("location",["location"=>$locationValue],["id"=>$locationID]);
  }
  elseif($locationDatas['location'] != $locationValue AND $db->has("location",["location"=>$locationValue]))
  {
    echo 4;
  }

  elseif($locationDatas['location'] == $locationValue)
  {
    // Same
    echo 1;
  }
  else {
    echo 2;
  }



?>
