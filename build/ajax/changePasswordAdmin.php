<?php

  session_start();
  require_once('../../connection.php');
  $accountId = $_SESSION['account']['emp_id'];
  $OldPass = $_POST['OldPass'];
  $NewPass = $_POST['NewPass'];
  if($db->update("admin", ["password"=>$NewPass] , ["AND"=>["password"=>$OldPass,"sub_id"=>"$accountId"]])){
    echo 1;
  }else {
    echo 2;
  }

?>
