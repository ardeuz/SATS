<?php

  session_start();
  require_once('../../connection.php');
  $accountId = $_SESSION['account']['emp_id'];
  $OldPass = $_POST['OldPass'];
  $NewPass = $_POST['NewPass'];
  if($db->update("account_table", ["password"=>$NewPass] , ["AND"=>["password"=>$OldPass,"emp_id"=>"$accountId"]])){
    echo 1;
  }else {
    echo 2;
  }

?>
