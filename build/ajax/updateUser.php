<?php

    require_once('../../connection.php');
    $emp_id=$_POST['emp_id'];
    $empfirst = $_POST["empfirst"];
    $empmiddle = $_POST["empmiddle"];
    $emplast = $_POST["emplast"];
    $empdepartment = $_POST["empdepartment"];
    $oldpass = $_POST["oldpass"];
    $emppass = $_POST["emppass"];
    $confirmpass = $_POST["confirmpass"];
    $accountDatas = $db->get("account_table",["password"],['emp_id'=>$emp_id]);
    if($oldpass == null && $emppass == null && $confirmpass == null)
    {
      echo 1;
      $db->update("account_table",
        [
          "first_name"=>$empfirst,
          "last_name"=>$emplast,
          "middle_name"=>$empmiddle,
          "department"=>$empdepartment,
        ],
        [
          "emp_id"=>$emp_id
        ]
      );
    }
    else{
      if($emppass != $confirmpass)
      {
        echo 3;
      }
      elseif($accountDatas['password'] != $oldpass)
      {
        echo 2;
      }
      elseif($emppass == $confirmpass)
      {
        echo 1;
        $db->update("account_table",
          [
            "first_name"=>$empfirst,
            "last_name"=>$emplast,
            "middle_name"=>$empmiddle,
            "department"=>$empdepartment,
            "password"=>$emppass
          ],
          [
            "emp_id"=>$emp_id
          ]
        );
      }
    }
?>
