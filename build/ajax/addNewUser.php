<?php

  require_once("../../connection.php");
  $emp_id = $_POST['emp_id'];
  $first_Name = $_POST['first_Name'];
  $middle_name = $_POST['middle_name'];
  $last_name = $_POST['last_name'];
  $department = $_POST['department'];
  $password = $_POST['password'];
  if($db->has("account_table",["emp_id" => $emp_id]))
  {
    echo -1;
  }
  else{
    $db->insert("account_table",
    [
      "emp_id" => $emp_id,
      "first_Name" => $first_Name,
      "middle_name" => $middle_name,
      "last_name" => $last_name,
      "department" => $department,
      "password" => $password,
      "status" => 1
    ]);
    echo 1;

  }

?>
