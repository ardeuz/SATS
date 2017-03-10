<?php
  require( '../dataTables/ssp.php' );
  $table = "audit_trail_condition";
  $pkey = "date";
  $column = array(
    array('db' => '`u`.`property_id`', 'dt' => 0,'field'=> 'property_id',"formatter" => function($property_id)
    {
      $viewing = '<div class="toolbar"><button class="toolbar-button button primary"onclick="addRecommendation('.$property_id.')"><span class="mif-pencil icon"></span></button></div>';
      return $viewing;
    }),
    array('db' => '`u`.`pcode`', 'dt' => 1,'field'=>"pcode"),
    array('db' => '`u`.`sno`', 'dt' => 2,'field' => "sno"),
    array('db' => '`u`.`description`', 'dt' => 3,'field' => "description"),
    array('db' => '`u`.`brand`', 'dt' => 4,'field'=> 'brand'),
    array('db' => '`u`.`uom`', 'dt' => 5,'field'=> 'uom'),
    array('db' => '`u`.`po_number`', 'dt' => 6,'field'=> 'po_number')

  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $joinQuery = "FROM `audit_trail_condition` AS `u` group by u.property_id";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $column, $joinQuery )
  );
  return;
?>
