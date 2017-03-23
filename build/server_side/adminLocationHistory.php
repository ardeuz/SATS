<?php
  require( '../dataTables/ssp.php' );
  $table = "audit_trail_location";
  $pkey = "id";
  $column = array(
    array('db' => '`u`.`action`', 'dt' => 0,'field'=>"action"),
    array('db' => '`u`.`remarks`', 'dt' => 1,'field'=>"remarks"),
    array('db' => '`u`.`old_location`', 'dt' => 2,'field'=>"old_location"),
    array('db' => '`u`.`new_location`', 'dt' => 3,'field'=>"new_location"),
    array('db' => '`u`.`date`', 'dt' => 4 ,'field' => "date"),
    // // array('db' => '`u`.`id`', 'dt' => 3,'field'=>'id'),
    // array('db' => '`u`.`recommendation`', 'dt' => 3,'field'=> 'recommendation'),
    // array('db' => '`u`.`cost`', 'dt' => 4,'field'=> 'cost')
  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $joinQuery = "FROM `audit_trail_location` AS `u`";
  $whereClause = 'property_id='.$_GET['id'];
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $column, $joinQuery, $whereClause )
  );
  return;
?>
