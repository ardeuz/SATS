<?php
  require( '../dataTables/ssp.php' );
  session_start();
  $emp_id = $_SESSION['account']['emp_id'];
  $table = "showPropertyTransfer";
  $pkey = "ctrl_no";
  $columns = array(
    array('db' => '`u`.`ctrl_no`', 'dt' => 0,'field'=> 'ctrl_no',"formatter" => function($ctrl_no)
    {
      $viewing = '<div class="toolbar"><button class="toolbar-button button primary"onclick="window.open(\'build/reports/transferReport.php?ctrl_no='.$ctrl_no.'\');"><span class="mif-print icon"></span></button></div>';
      return $viewing;
    }),
    array('db' => '`u`.`ctrl_no`', 'dt' => 1,'field' => "ctrl_no"),
    array('db' => '`u`.`items_transferred`', 'dt' => 2,'field' => "items_transferred"),
    array('db' => '`u`.`transfer_to`', 'dt' => 3,'field' => "transfer_to"),
    array('db' => '`u`.`released_from`', 'dt' => 4,'field' => "released_from"),
    array('db' => '`u`.`date_approved`', 'dt' => 5,'field'=> 'date_approved' ,'formatter' => function($date_approved)
      {
          return date('M d, Y H:i:A', strtotime($date_approved));
      }),
  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $joinQuery = "FROM `showPropertyTransfer` AS `u`";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $columns, $joinQuery )
  );
  return;
?>
