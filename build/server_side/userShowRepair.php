<?php
  session_start();
  require( '../dataTables/ssp.php' );
  require( '../../medoo.php' );
  $emp_id = $_SESSION['account']['emp_id'];
  $table = "propertyAccountability";
  $pkey = "id";
  $columns = array(
    array('db' => '`u`.`condition_id`', 'dt' => 'condition_id','field'=> 'condition_id'),
    array('db' => '`u`.`location_id`', 'dt' => 0,'field'=> 'location_id'),
    array('db' => '`u`.`id`', 'dt' => 0,'field'=> 'id',"formatter" => function($id,$row)
    {
      $ids = $row['id'];
      $conditionIds = $row['condition_id'];
      $locationIds = $row['location_id'];
      $viewing = '<div class="toolbar"><button class="toolbar-button button primary prowareView" idPv='.$ids.' conditionPv='.$conditionIds.' locationPv='.$locationIds.' onclick="showMetroDialog(\'#prowaredialog\')"><span class="mif-eye icon"></span></button></div>';
      return $viewing;
    }),
    array('db' => '`u`.`pcode`', 'dt' => 1,'field' => "pcode"),
    array('db' => '`u`.`sno`', 'dt' => 2,'field' => "sno"),
    array('db' => '`u`.`description`', 'dt' => 3,'field' => "description"),
    array('db' => '`u`.`location`', 'dt' => 4,'field'=> 'location' ,'formatter' => function($id,$rows)
      {
        $db = new medoo([
          // required
          'database_type' => 'mysql',
          'database_name' => 'sats',
          'server' => 'localhost',
          'username' => 'root',
          'password' => '',
          'charset' => 'utf8',

          'option' => [
              PDO::ATTR_ERRMODE,
              PDO::ERRMODE_EXCEPTION
          ]
        ]);
        $locationId = $rows['location_id'];
        if($db->has("location", "location",["id"=>$locationId])){
          $locationDatas = $db->get("location", "location",["id"=>$locationId]);
          $maintenance = $locationDatas;
        } else {
          $maintenance = "No Location to Show";
        }
        return $maintenance;
      }),
      array('db' => '`u`.`qty`', 'dt' => 5,'field' => "qty"),
      array('db' => '`u`.`condition_info`', 'dt' => 6,'field' => "condition_info","formatter" => function($employeeId,$rows){
        $db2 = new medoo([
          // required
          'database_type' => 'mysql',
          'database_name' => 'sats',
          'server' => 'localhost',
          'username' => 'root',
          'password' => '',
          'charset' => 'utf8',

          'option' => [
              PDO::ATTR_ERRMODE,
              PDO::ERRMODE_EXCEPTION
          ]
        ]);
        $conditionId = $rows['condition_id'];
        if($db2->has("condition_info", "condition_info", ["id" => $conditionId])){
          $conditionDatas = $db2->get("condition_info", "condition_info", ["id" => $conditionId]);
          $maintenance = $conditionDatas;
        } else {
          $maintenance = "No Condition to Show";
        }

        return $maintenance;
      })
  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $joinQuery = "FROM `propertyAccountability` AS `u`";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $columns, $joinQuery   )
  );
  return;
?>
