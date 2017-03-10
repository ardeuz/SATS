<?php
  require( '../dataTables/ssp.php' );
  $table = "audit_trail_condition";
  $pkey = "id";
  $column = array(
    array('db' => '`u`.`action`', 'dt' => 0,'field'=>"action"),
    array('db' => '`u`.`date`', 'dt' => 1,'field'=>"date"),
    array('db' => '`u`.`remarks`', 'dt' => 2 ,'field' => "remarks"),
    // array('db' => '`u`.`id`', 'dt' => 3,'field'=>'id'),
    array('db' => '`u`.`recommendation`', 'dt' => 3,'field'=> 'recommendation'),
    array('db' => '`u`.`cost`', 'dt' => 4,'field'=> 'cost')
  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $joinQuery = "FROM `audit_trail_condition` AS `u`";
  $whereClause = 'property_id='.$_GET['id'];
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $column, $joinQuery, $whereClause )
  );
  return;
?>
