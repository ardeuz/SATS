<?php

  require_once("../../connection.php");
  $request_code = $_POST['request_code'];
  $emp_approval = $_POST['emp_approval'];
  if($emp_approval == 0){
    if($db->delete("issuance_request",["AND"=>["request_code" => $request_code,"emp_approval" => 0]]))
    {
      echo 1;
    }
  }
  elseif($emp_approval == 1){
    if($db->delete("issuance_request",["AND"=>["request_code" => $request_code,"emp_approval" => 1]]))
    {
      echo 1;
    }
  }
?>
