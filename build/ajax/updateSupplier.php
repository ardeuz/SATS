<?php

  require_once('../../connection.php');
  $sup_id = $_POST['editSupplierID'];
  $sup_name = $_POST['supplierVal'];
  if($db->has("supplier","sup_name",["sup_name[!]"=>$sup_name]) )
  {
    echo 3;
    $db->update("supplier",["sup_name"=>$sup_name],["sup_id"=>$sup_id]);
  }
  elseif($db->has("supplier",["sup_name"=>$sup_name]))
  {
    echo 4;
  }
  else {
    echo 2;
  }



?>
