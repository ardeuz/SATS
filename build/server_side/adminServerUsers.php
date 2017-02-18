<?php
  require( '../dataTables/ssp.php' );
  $table = "account_table";
  $pkey = "emp_id";
  $column = array(
    array('db' => '`u`.`status`', 'dt' => 'status','field'=>"status"),
    array('db' => '`u`.`emp_id`', 'dt' => 0,'field' => "emp_id"),
    array('db' => '`u`.`first_name`', 'dt' => 1,'field' => "first_name"),
    array('db' => '`u`.`middle_name`', 'dt' => 1,'field' => "middle_name"),
    array('db' => '`u`.`last_name`', 'dt' => 1,'field' => "last_name","formatter" => function($first_name,$rows)
    {
      $fn = $rows['first_name'];
      $mn = $rows['middle_name'];
      $ln = $rows['last_name'];

        return $ln.", ".$fn." ".$mn;
    }),
    array('db' => '`u`.`department`', 'dt' => 2,'field' => "department"),
    array('db' => '`u`.`emp_id`', 'dt' => 3,'field'=> 'emp_id' ,'formatter' => function($emp_id,$row)
      {
        $empId = $row[1];
        $empFname = $row[2];
        $empMname = $row[3];
        $empLname = $row[4];
        $empDept = $row[5];
        $maintenance = '<div class="toolbar">
          <button class="toolbar-button button primary" onClick="showMetroDialog(\'#editUser\'); editUser(\''.$empId.'\',\''.$empFname.'\',\''.$empMname.'\',\''.$empLname.'\',\''.$empDept.'\');"><span class="mif-pencil icon"></span></button>
          <button class="toolbar-button button primary" onClick="showMetroDialog(\'#deleteUser\'); deleteUserView(\''.$empId.'\')"><span class="mif-bin icon"></span></button>
          </div>';
        return $maintenance;
      }),
    array('db' => '`u`.`status`', 'dt' => 4,'field' => "status" , "formatter" => function($status,$row)
    {
      $empId = $row[1];
      $empStat = $row['status'];
      $activated = "";
      if($empStat == 1){$activated = 'checked=\'true\'';}
      $accountActivation="<label class='switch-original'>
                          <input type='checkbox' id=\"$empId\"
                           value=\"$empStat\" $activated onChange='activateAccount(\"$empId\")'>
                          <span class='check'></span>
                          </label>";
      return $accountActivation;
    })
  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $joinQuery = "FROM `account_table` AS `u`";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $column, $joinQuery )
  );
  return;
?>
