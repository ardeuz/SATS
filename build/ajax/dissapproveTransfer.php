<?php

  require_once("../../connection.php");
  $request_code = $_POST['request_code'];
  if($db->delete("transfer_request",["request_code" => $request_code]))
  {
    echo 1;
  }
?>
