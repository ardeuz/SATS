<?php
  include_once("../../medoo.php");
  require( '../dataTables/ssp.php' );
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
    array('db' => '`u`.`description`', 'dt' => 3,'field' => "description"),
    array('db' => '`u`.`location`', 'dt' => 4,'field' => "location"),
    array('db' => '`u`.`qty`', 'dt' => 5,'field' => "qty"),
    array('db' => '`u`.`id`', 'dt' => 6,'field'=> 'id' ,'formatter' => function($id,$rows)
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
        $ids = $rows['id'];
        $conditionId = $rows['condition_id'];
        $locationId = $rows['location_id'];
        $empId = $rows['emp_id'];
        $selectAccounts = $db->select("account_table",['emp_id' , 'last_name' , 'first_name' ,'department'],["status"=>1]);
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
        // return "hello";
      }),
      array('db' => '`u`.`emp_name`', 'dt' => 7,'field' => "emp_name"),
      array('db' => '`u`.`emp_id`', 'dt' => 8,'field' => "emp_id","formatter" => function($employeeId,$row){
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
        include_once ("../../connection2.php");

        $empId = $row[0];
        if($db2->has("borrow_request",["[><]account_table"=>["transfer_to"=>"emp_id"]],["AND"=>["released_from"=>$empId, ]])){
          $accountName = $db2->get("borrow_request",["[>]account_table"=>["transfer_to"=>"emp_id"]],["last_name","first_name"]);
          return "Borrowed By ". $accountName["last_name"].', '.$accountName['first_name'];
        }
        else{
          return "Not Borrowed";
        }
        return "hello";
      })
  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $locationIDs = $_GET['location'];
  $conditionId = $_GET['condition'];
  $accountability = $_GET['accountability'];
  $joinQuery = "FROM `propertyAccountability` AS `u` where location_id = $locationIDs AND condition_id = $conditionId AND emp_id = \"$accountability\"";
    echo json_encode(
      SSP::simple( $_GET, $sql_details, $table, $pkey, $columns, $joinQuery )
    );
  return;
?>
