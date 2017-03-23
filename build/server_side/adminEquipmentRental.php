<?php
  include_once("../../medoo.php");
  require( '../dataTables/ssp.php' );
  $table = "equipmentRental";
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
    array('db' => '`u`.`description_minor`', 'dt' => 4,'field' => "description_minor"),
    array('db' => '`u`.`location`', 'dt' => 5,'field' => "location"),
    array('db' => '`u`.`qty`', 'dt' => 6,'field' => "qty"),
    array('db' => '`u`.`id`', 'dt' => 7,'field'=> 'id' ,'formatter' => function($id,$rows)
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
        $conditionDatas = $db->get("condition_info", ["id","condition_info"],["id"=>$conditionId]);

        return $conditionDatas['condition_info'];
        // return "hello";
      }),
      array('db' => '`u`.`emp_name`', 'dt' => 8,'field' => "emp_name"),
      array('db' => '`u`.`sup_name`', 'dt' => 9,'field' => "sup_name"),
      array('db' => '`u`.`emp_id`', 'dt' => 10,'field' => "emp_id","formatter" => function($employeeId,$row){
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

        $empId = $employeeId;
        $ids = $row['id'];
        if($db2->has("borrow_request",["[>]account_table"=>["transfer_to"=>"emp_id"]],["AND"=>["released_from"=>$empId,"id"=>$ids ]])){
          $accountName = $db2->get("borrow_request",["[>]account_table"=>["transfer_to"=>"emp_id"]],["last_name","first_name"],["AND"=>["released_from"=>$empId,"id"=>$ids]]);
          return "Borrowed By ". $accountName["last_name"].', '.$accountName['first_name'];
        }
        else{
          return "Not Borrowed";
        }
      })
  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );

  $joinQuery = "FROM `equipmentRental` AS `u`";
    echo json_encode(
      SSP::simple( $_GET, $sql_details, $table, $pkey, $columns, $joinQuery )
    );
  return;
?>
