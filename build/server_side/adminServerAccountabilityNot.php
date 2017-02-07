<?php
  require( '../dataTables/ssp.php' );
  $table = "propertyAccountabilitynot";
  $pkey = "id";
  $columns = array(
    array('db' => '`u`.`id`', 'dt' => 0,'field'=> 'id',"formatter" => function($id,$row)
    {
      $ids = $row['id'];
      $viewing = '<div class="toolbar"><button class="toolbar-button button primary adminView" idPv='.$ids.' onclick="showMetroDialog(\'#adminAccountabilityDialog\')"><span class="mif-eye icon"></span></button></div>';
      return $viewing;
    }),
    array('db' => '`u`.`pcode`', 'dt' => 1,'field' => "pcode"),
    array('db' => '`u`.`sno`', 'dt' => 2,'field' => "sno"),
    array('db' => '`u`.`qty`', 'dt' => 3,'field' => "qty"),
    array('db' => '`u`.`id`', 'dt' => 4,'field'=> 'id' ,'formatter' => function($id,$rows)
      {
        include_once ("../../connection.php");
        $ids = $rows['id'];
        $pcode = $rows['pcode'];
        $conditionId = $rows['condition_id'];
        $empId = $rows['emp_id'];
        $maintenance = '
        <div class="input-control select" style="width:300px; border-radius:0px;" data-role="select">
          <select style="display:none;" id="selectAccount"
          onchange=\'changeAccountability(\''. $ids. ', \' . \'' .$pcode. '\'"; ?>)\'>';
          $selectAccounts = $db->select("account_table",['emp_id' , 'last_name' , 'first_name' ,'department'],["status"=>1]);
          foreach ($selectAccounts as $selectAccount){
                  $maintenance .= "<option value=". $selectAccount['emp_id'] ."> ". $selectAccount['last_name'] .", ". $selectAccount['first_name']." - ". $selectAccount['department']. "</option>";
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
  $joinQuery = "FROM `propertyAccountabilitynot` AS `u`";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $columns, $joinQuery  )
  );
  return;
?>
