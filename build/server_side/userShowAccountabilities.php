<?php
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
      $viewing = '<div class="toolbar"><button class="toolbar-button button primary adminView" idPv='.$ids.' conditionPv='.$conditionIds.' locationPv='.$locationIds.' onclick="showMetroDialog(\'#adminAccountabilityDialog\')"><span class="mif-eye icon"></span></button></div>';
      return $viewing;
    }),
    array('db' => '`u`.`pcode`', 'dt' => 1,'field' => "pcode"),
    array('db' => '`u`.`sno`', 'dt' => 2,'field' => "sno"),
    array('db' => '`u`.`location`', 'dt' => 3,'field' => "location"),
    array('db' => '`u`.`qty`', 'dt' => 4,'field' => "qty"),
    array('db' => '`u`.`id`', 'dt' => 5,'field'=> 'id' ,'formatter' => function($id,$rows)
      {
        include ("../../connection.php");
        $ids = $rows['id'];
        $locationId = $rows['location_id'];
        $conditionId = $rows['condition_id'];
        $empId = $rows['emp_id'];
        $maintenance = '
        <div class="input-control select">
        <select onchange="updateAdminCondition('.$ids.', '.$locationId.', '.$conditionId.', \'' . $empId . '\');" id="condition'.$ids. $locationId.$conditionId.$empId.'">';

          $conditionDatas = $db->select("condition_info", ["id","condition_info"]);
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
      }),
      array('db' => '`u`.`emp_name`', 'dt' => 6,'field' => "emp_name"),
      array('db' => '`u`.`emp_id`', 'dt' => 7,'field' => "emp_id","formatter" => function($employeeId,$row){
        include_once("../../connection.php");
        $empId = $row[0];
        if($db->has("borrow_request",["[><]account_table"=>["transfer_to"=>"emp_id"]],["AND"=>["released_from"=>$empId, ]])){
          $accountName = $db->get("borrow_request",["[>]account_table"=>["transfer_to"=>"emp_id"]],["last_name","first_name"]);
          return "Borrowed By ". $accountName["last_name"].', '.$accountName['first_name'];
        }
        else{
          return "Not Borrowed";
        }
        // return "hello";
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
