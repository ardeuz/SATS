<?php
  require( '../dataTables/ssp.php' );
  $table = "audit_trail_condition";
  $pkey = "date";
  $column = array(
    array('db' => '`u`.`id`', 'dt' => 0,'field'=> 'id',"formatter" => function($id)
    {
      $viewing = '<div class="toolbar"><button class="toolbar-button button primary"onclick="addRecommendation('.$id.')"><span class="mif-pencil icon"></span></button></div>';
      return $viewing;
    }),
    array('db' => '`u`.`action`', 'dt' => 1,'field'=>"action"),
    array('db' => '`u`.`remarks`', 'dt' => 2,'field' => "remarks"),
    array('db' => '`u`.`date`', 'dt' => 3,'field' => "date"),
    array('db' => '`u`.`recommendation`', 'dt' => 4,'field' => "recommendation")

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
