<?php
  require( '../dataTables/ssp.php' );
  $table = "major_category";
  $pkey = "id";
  $column = array(
    array('db' => '`u`.`depreciate_yr`', 'dt' => 'depreciate_yr','field'=> 'depreciate_yr'),
    array('db' => '`u`.`id`', 'dt' => 0,'field'=> 'id' ,'formatter' => function($id,$row)
      {
        $ids = $row['id'];
        $depYear = $row['depreciate_yr'];
        $description = $row['description'];
        $maintenance = '<div class="toolbar">
          <button class="toolbar-button button primary" onClick="showMetroDialog(\'#editMajorDialog\'); EditMajor(\''.$ids.'\',\''.$description.'\',\''.$depYear.'\');"><span class="mif-pencil icon"></span></button>
          <button class="toolbar-button button primary" onClick="showMetroDialog(\'#deleteMajorDialog\'); deleteMajorValidation(\''.$ids.'\')"><span class="mif-bin icon"></span></button>
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
  $joinQuery = "FROM `major_category` AS `u`";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $column, $joinQuery )
  );
  return;
?>
