<?php
  session_start();
  require( '../dataTables/ssp.php' );
  $emp_id = $_SESSION['account']['emp_id'];
  $table = "propertyAccountability";
  $pkey = "id";
  $columns = array(
    array('db' => '`u`.`condition_id`', 'dt' => 0,'field'=> 'condition_id'),
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
        include ("../../connection.php");
        $ids = $rows['id'];
        $locationId = $rows['location_id'];
        $conditionId = $rows['condition_id'];
        $maintenance = '
        <div class="input-control select full-size">
        <select onchange="updateLocation('.$ids.', '.$conditionId.', '.$locationId.');" id="location'.$ids. $locationId.$conditionId.'">';

          $locationDatas = $db->select("location", ["id","location"]);
          foreach ($locationDatas as $locationData){
            if ($locationId == $locationData['id']) //if this is the location
              {
                  $maintenance .= "<option value='" . $locationData['id'] . "' selected>" . $locationData['location'] ."</option>";
              }
              else
              {
                  $maintenance .= "<option value='" . $locationData['id'] . "' >" . $locationData['location'] ."</option>";
              }
          }

          $maintenance .= '
        </select>
        </div>
        ';

        return $maintenance;
      }),
      array('db' => '`u`.`qty`', 'dt' => 5,'field' => "qty"),
      array('db' => '`u`.`condition_info`', 'dt' => 6,'field' => "condition_info","formatter" => function($employeeId,$rows){
        include ("../../connection2.php");
        $ids = $rows['id'];
        $locationId = $rows['location_id'];
        $conditionId = $rows['condition_id'];
        $maintenance = '
        <div class="input-control select full-size">
        <select onchange="updateCondition('.$ids.', '.$conditionId.', '.$locationId.');" id="condition'.$ids. $locationId.$conditionId.'">';

          $conditionDatas = $db2->select("condition_info", ["id","condition_info"]);
          foreach ($conditionDatas as $conditionData){
            if ($conditionId == $conditionData['id']) //if this is the location
              {
                  $maintenance .= "<option value='" . $conditionData['id'] . "' selected>" . $conditionData['condition_info'] ."</option>";
              }
              else
              {
                  $maintenance .= "<option value='" . $conditionData['id'] . "' >" . $conditionData['condition_info'] ."</option>";
              }
          }

          $maintenance .= '
        </select>
        </div>
        ';

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
  $extraWhere = "emp_id='$emp_id'";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $columns, $joinQuery ,$extraWhere  )
  );
  return;
?>
