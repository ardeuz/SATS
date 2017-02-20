<?php
  require( '../dataTables/ssp.php' );
  $table = "audit_trail_condition";
  $pkey = "date";
  $column = array(
    array('db' => '`u`.`action`', 'dt' => 0,'field'=>"action"),
    array('db' => '`u`.`date`', 'dt' => 1,'field' => "date","formatter" => function($date,$row){
        return "remarks";
    }),
    array('db' => '`u`.`date`', 'dt' => 2,'field' => "date")

  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $joinQuery = "FROM `audit_trail_condition` AS `u`";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $column, $joinQuery )
  );
  return;
?>
