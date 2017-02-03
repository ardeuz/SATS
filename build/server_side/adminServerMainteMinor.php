<?php
  require( '../dataTables/ssp.php' );
  $table = "minor_category";
  $pkey = "id";
  $column = array(
    array('db' => '`u`.`id`', 'dt' => 0,'field'=> 'id' ,'formatter' => function($id,$row)
      {
        $ids = $row['id'];
        $description = $row['description'];
        $maintenance = '<div class="toolbar">
          <button class="toolbar-button button primary" onClick="showMetroDialog(\'#editMinorDialog\'); EditMinor(\''.$ids.'\',\''.$description.'\');"><span class="mif-pencil icon"></span></button>
          <button class="toolbar-button button primary" onClick="showMetroDialog(\'#deleteMinorDialog\'); deleteMinorValidation(\''.$ids.'\')"><span class="mif-bin icon"></span></button>
          </div>';
        return $maintenance;
      }),
    array('db' => '`u`.`description`', 'dt' => 1,'field' => "description")
  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $joinQuery = "FROM `minor_category` AS `u`";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $column, $joinQuery )
  );
  return;
?>
