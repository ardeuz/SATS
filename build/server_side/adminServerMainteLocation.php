<?php
  require( '../dataTables/ssp.php' );
  $table = "location";
  $pkey = "id";
  $column = array(
    array('db' => '`u`.`id`', 'dt' => 0,'field'=> 'id' ,'formatter' => function($id,$row)
      {
        $ids = $row['id'];
        $depYear = $row['location'];

        $maintenance = '<div class="toolbar">
          <button class="toolbar-button button primary" onClick="showMetroDialog(\'#editLocationDialog\'); EditLocation(\''.$ids.'\',\''.$depYear.'\');"><span class="mif-pencil icon"></span></button>
          <button class="toolbar-button button primary" onClick="showMetroDialog(\'#deleteLocationDialog\'); DeleteLocationValidation(\''.$ids.'\',\''.$depYear.'\')"><span class="mif-bin icon"></span></button>
          </div>';
        return $maintenance;
      }),
    array('db' => '`u`.`location`', 'dt' => 1,'field' => "location")
  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $joinQuery = "FROM `location` AS `u`";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $column, $joinQuery )
  );
  return;
?>
