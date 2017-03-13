<?php

  require('../../connection.php');
  if($db->has("ctrl_sy",'sy')){
    $db->update('ctrl_sy',['sy'=>$_POST['changeSY']]);
  } else {
    $db->insert('ctrl_sy',['sy'=>$_POST['changeSY']]);
  }
?>
