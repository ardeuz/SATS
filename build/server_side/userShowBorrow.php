<?php
  session_start();
  require( '../dataTables/ssp.php' );
  $emp_id = $_SESSION['account']['emp_id'];
  $table = "showBorrows";
  $pkey = "id";
  $columns = array(
    array('db' => '`u`.`condition_id`', 'dt' => 0,'field'=> 'condition_id'),
    array('db' => '`u`.`new_loc_id`', 'dt' => 0,'field'=> 'new_loc_id'),
    array('db' => '`u`.`id`', 'dt' => 0,'field'=> 'id',"formatter" => function($id,$row)
    {
      $ids = $row['id'];
      $conditionIds = $row['condition_id'];
      $locationIds = $row['new_loc_id'];
      $viewing = '<div class="toolbar"><button class="toolbar-button button primary" onclick="currentBorrowView('.$ids.','.$conditionIds.','.$locationIds.');showMetroDialog(\'#borrowedDialog\')"><span class="mif-eye icon"></span></button></div>';
      return $viewing;
    }),
    array('db' => '`u`.`pcode`', 'dt' => 1,'field' => "pcode"),
    array('db' => '`u`.`sno`', 'dt' => 2,'field' => "sno"),
    array('db' => '`u`.`description`', 'dt' => 3,'field' => "description"),
    array('db' => '`u`.`condition_id`', 'dt' => 4,'field' => "condition_id"),
    array('db' => '`u`.`qty`', 'dt' => 5,'field' => "qty"),
    array('db' => '`u`.`borrowedTo`', 'dt' => 6,'field' => "borrowedTo"),
    array('db' => '`u`.`date_approved`', 'dt' => 7,'field' => "date_approved"),
  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $joinQuery = "FROM `showBorrows` AS `u`";
  $extraWhere = "transfer_to='$emp_id' AND date_approved!=0";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $columns, $joinQuery ,$extraWhere  )
  );
  return;
?>
