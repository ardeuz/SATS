<?php
  session_start();
  require( '../dataTables/ssp.php' );
  require( '../../medoo.php' );
  $emp_id = $_SESSION['account']['emp_id'];
  $table = "propertyaccountability";
  $pkey = "id";
  $columns = array(
    array('db' => '`u`.`condition_id`', 'dt' => 0,'field'=> 'condition_id'),
    array('db' => '`u`.`emp_id`', 'dt' => 0,'field'=> 'emp_id'),
    array('db' => '`u`.`location_id`', 'dt' => 0,'field'=> 'location_id'),
    array('db' => '`u`.`id`', 'dt' => 0,'field'=> 'id',"formatter" => function($id,$row)
    {
      $ids = $row['id'];
      $conditionIds = $row['condition_id'];
      $locationIds = $row['location_id'];
      $empId = $row['emp_id'];
      $qty = $row['qty'];
      $viewing = '<div class="toolbar"><button class="toolbar-button button primary" onclick="transferView('.$ids.','.$conditionIds.','.$locationIds.',\''.$empId.'\');showMetroDialog(\'#viewdialog\')"><span class="mif-eye icon"></span></button>
      <button class="toolbar-button button primary transferView" idTv='.$ids.' onclick="transferItem('.$ids.','.$qty.',\''.$empId.'\','.$conditionIds.','.$locationIds.');showMetroDialog(\'#transferdialog\')"><span class="mif-plus icon"></span></button>
      </div>';
      return $viewing;
    }),
    array('db' => '`u`.`pcode`', 'dt' => 1,'field' => "pcode"),
    array('db' => '`u`.`sno`', 'dt' => 2,'field' => "sno"),
    array('db' => '`u`.`description`', 'dt' => 3,'field' => "description"),
    array('db' => '`u`.`location`', 'dt' => 4,'field' => "location"),
    array('db' => '`u`.`condition_info`', 'dt' => 5,'field' => "condition_info"),
    array('db' => '`u`.`qty`', 'dt' => 6,'field' => "qty"),
    array('db' => '`u`.`department`', 'dt' => 7,'field' => "department"),
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
      $property_id = $row['id'];
      $empId = $employeeId;
      if($db2->has("borrow_request",["[>]account_table"=>["transfer_to"=>"emp_id"]],["AND"=>["released_from"=>$empId,"id"=>$property_id]])){
        $accountName = $db2->get("borrow_request",["[>]account_table"=>["transfer_to"=>"emp_id"]],["last_name","first_name"],["AND"=>["released_from"=>$empId,"id"=>$property_id]]);
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
  $joinQuery;
  $whereClause;
  $conditionFilter = $_GET['condition'];
  $locationFilter = $_GET['location'];
  $descriptionFilter = $_GET['description'];
  if($conditionFilter == 0 && $locationFilter == 0 && $descriptionFilter == 0)
  {
    $whereClause = "emp_id != '$emp_id'";
  }
  if($conditionFilter != 0 && $locationFilter == 0 && $descriptionFilter == 0)
  {
    $whereClause = "emp_id != '$emp_id' AND condition_id = $conditionFilter ";
  }
  if($locationFilter != 0 && $conditionFilter == 0 && $descriptionFilter == 0)
  {
    $whereClause = "emp_id != '$emp_id' AND location_id = $locationFilter ";
  }
  if($locationFilter == 0 && $conditionFilter == 0 && $descriptionFilter != 0)
  {
    $whereClause = "emp_id != '$emp_id' AND minor_category = $descriptionFilter ";
  }
  if($locationFilter != 0 && $conditionFilter != 0 && $descriptionFilter == 0)
  {
    $whereClause = "emp_id != '$emp_id' AND location_id = $locationFilter AND condition_id = $conditionFilter";
  }
  if($locationFilter == 0 && $conditionFilter != 0 && $descriptionFilter != 0)
  {
    $whereClause = "emp_id != '$emp_id' AND minor_category = $descriptionFilter AND condition_id = $conditionFilter";
  }
  if($locationFilter != 0 && $conditionFilter == 0 && $descriptionFilter != 0)
  {
    $whereClause = "emp_id != '$emp_id' AND location_id = $locationFilter AND minor_category = $descriptionFilter";
  }
  if($locationFilter != 0 && $conditionFilter != 0 && $descriptionFilter != 0)
  {
    $whereClause = "emp_id != '$emp_id' AND location_id = $locationFilter AND condition_id = $conditionFilter AND minor_category = $descriptionFilter";
  }
  $joinQuery = "FROM `propertyaccountability` AS `u`";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $columns, $joinQuery, $whereClause)
  );
  return;
      // $joinQuery = "FROM `propertyaccountability` AS `u` where emp_id != '$emp_id' AND condition_id = $conditionFilter AND location_id = $locationFilter AND emp_id = \"$accountFilter\" ";
?>
