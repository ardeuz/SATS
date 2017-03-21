<?php
session_start();
require_once('connection.php');

  if(isset($_POST['LogIn']))
  {
    if(empty($_POST['Uname']) || empty($_POST['UPass']))
    {
      $message = $message = "<p class='bg-red fg-white padding10 no-margin-top'>Account does not exist</p>";
    }
    else
    {
      $credentials = $db->select("account_table",
        ["department","first_name","last_name","emp_id","status"],
        [
          "AND" => [
            "emp_id" => $_POST['Uname'],
            "password" => $_POST['UPass']
            ]
        ]);

      //OR

      // $statement->bindParam(':username',$_POST['Uname']);
      // $statement->bindParam(':password',$_POST['UPass']);
      // $statement->execute();

      //OR

      // $statement->bindParam(':username',$username);
      // $statement->bindParam(':password',$password);

      // $username=$_POST['Uname'];
      // $password=$_POST['Uname'];
      // $statement->execute();

      if(count($credentials) == 1)
      {
        foreach ($credentials as $credential) {

          $_SESSION['account'] = strtoupper($credential);

          if($credential['status'] == 0)
          {
            $message = "<p class='bg-red fg-white padding10 no-margin-top'>Account is Locked</p>";
          }
          else
          {
              header("location:accountabilities.php");
          }
        }
      }
      else
      {
        $adminDatas = $db->select("admin",
          ["first_name","last_name","emp_id","sub_id","department"],
          [
            "AND" => [
              "emp_id" => $_POST['Uname'],
              "password" => $_POST['UPass']
              ]
          ]);
        if(count($adminDatas) == 1)
        {
          foreach ($adminDatas as $adminData) {
            $_SESSION['account'] = strtoupper($adminData);
            header("location:admin.php");
          }
        }
        else{
          $message = "<p class='bg-red fg-white padding10 no-margin-top'>Wrong Username or Password</p>";
        }
      }

    }
  }
if(isset($_SESSION['account']['emp_id']))
{
  if($db->has("account_table",['emp_id'=>$_SESSION['account']['emp_id']]))
  {
    header ("location:accountabilities.php");
  }
  elseif($db->has("admin",['emp_id'=>$_SESSION['account']['emp_id']]))
  {
    header ("location:admin.php");
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php

      include_once('meta.php');

    ?>
    <title>STI Asset Tracking System</title>
    <!-- sources -->
    <link rel="icon" href="logo/logo.png" type="image/png" sizes="16x22">
    <link href="build/css/metro.css" rel="stylesheet">
    <link href="build/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="build/css/metro-icons.css" rel="stylesheet">
    <link href="build/css/metro-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="build/css/login.css">
    <script src="build/js/jquery-2-1-3.min.js"></script>
    <script src="build/js/metro.js"></script>

</head>



<body class="white">
      <h3 class="small no-margin" style="background-color: #0072C6; padding:12px; color:#ffffff; margin-top:0px; border-bottom: solid #FFCE44">S.A.T.S: STI Assets Tracking System </h3>
      <?php if(isset($message)){echo $message;} ?>
    <div class="login-form padding20  shadow">

        <form action="" method="POST">

            <h1 class="text-light header">System Login</h1>
            <hr class="thin"/>
            <br/>
              <div class="input-control modern text iconic full-size" data-role="input">
                  <input type="text" name="Uname">
                  <span class="label">Username</span>
                  <span class="informer">Please enter your employee number as your Username</span>
                  <span class="placeholder">Username</span>
                  <span class="icon mif-user"></span>
                  <button class="button helper-button clear"><span class="mif-cross"></span></button>
              </div>
            <br />
            <br />
              <div class="input-control modern password iconic full-size" data-role="input">
                  <input type="password" name="UPass">
                  <span class="label">Password</span>
                  <span class="informer">Please enter your password</span>
                  <span class="placeholder">Password</span>
                  <span class="icon mif-lock place-right"></span>
                  <button class="button helper-button reveal"><span class="mif-looks"></span></button>
              </div>
            <br />
            <br />
            <div class="form-actions place-right">
                <button type="submit" name="LogIn" class="button primary" id="buttonLogIn" onclick="logIn();">Login</button>
            </div>

        </form>

    </div>


           <div style="z-index:1;float:center; position: absolute; background-color: #242529; bottom: 0;color: #ffffff; height: 50px;width: 100%; text-align: center" >
                            <p>Copyright © 2016. Developed and Created by SATS Developers</p>
         </div>

</body>

  <script src="build/js/jquery-2-1-3.min.js"></script>
  <script src="build/js/metro.js"></script>
  <script src="build/js/login.js"></script>
</html>
