<?php
  require( '../dataTables/ssp.php' );
  $table = "audit_trail_condition";
  $pkey = "id";
  $column = array(
    array('db' => '`u`.`id`','dt'=>0 ,'field'=>'id',"formatter"=>function($id){
      $viewing = '<div class="toolbar"><button class="toolbar-button button success" onClick="updateRepair('.$id.')"><span class="mif-checkmark icon"></span></button></div>';
      return $viewing;
    }),
    array('db' => '`u`.`action`', 'dt' => 1,'field'=>"action"),
    array('db' => '`u`.`date`', 'dt' => 2,'field'=>"date","formatter"=>function($date){
        return date('M d, Y H:i a', strtotime($date));
    }),
    array('db' => '`u`.`remarks`', 'dt' => 3,'field' => "remarks"),
    // array('db' => '`u`.`id`', 'dt' => 3,'field'=>'id'),
    array('db' => '`u`.`recommendation`', 'dt' => 4,'field'=> 'recommendation',"formatter" => function($recommendation,$row)
    {
      // $viewing = "Hello";
      $idss = $row[0];
      $viewing = "<div class='input-control text'><input type='text' id='recommend".$idss."' value=".$recommendation."></div>";

      return $viewing;
    }),
    array('db' => '`u`.`cost`', 'dt' => 5,'field'=> 'cost',"formatter" => function($cost,$rows)
    {
      $ids = $rows[0];
      $viewing = "<div class='input-control text'><input type='text' id='cost".$ids."' value=".$cost."></div>";
      return $viewing;
    }),

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
