<?php
  require( '../dataTables/ssp.php' );
  $table = "supplier";
  $pkey = "sup_id";
  $column = array(
    array('db' => '`u`.`sup_id`', 'dt' => 0,'field'=> 'sup_id' ,'formatter' => function($sup_id,$row)
      {
        $ids = $row['sup_id'];
        $description = $row['sup_name'];
        $maintenance = '<div class="toolbar">
          <button class="toolbar-button button primary" onClick="showMetroDialog(\'#editMajorDialog\'); EditMajor(\''.$ids.'\',\''.$description.'\');"><span class="mif-pencil icon"></span></button>
          <button class="toolbar-button button primary" onClick="showMetroDialog(\'#deleteSupplier\'); deleteSuppliers(\''.$ids.'\')"><span class="mif-bin icon"></span></button>
          </div>';
        return $maintenance;
      }),
    array('db' => '`u`.`sup_name`', 'dt' => 1,'field' => "sup_name")
  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $joinQuery = "FROM `supplier` AS `u`";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $column, $joinQuery )
  );
  return;
?>
