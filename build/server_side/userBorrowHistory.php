<?php
  require( '../dataTables/ssp.php' );
  session_start();
  $emp_id = $_SESSION['account']['emp_id'];
  $emp_name = $_SESSION['account']['last_name'].', '.$_SESSION['account']['first_name'];
  $table = "showPropertyBorrow";
  $pkey = "ctrl_no";
  $columns = array(
    array('db' => '`u`.`ctrl_no`', 'dt' => 0,'field'=> 'ctrl_no',"formatter" => function($ctrl_no)
    {
      $viewing = '<div class="toolbar"><button class="toolbar-button button primary"onclick="window.open(\'build/reports/borrowReport.php?ctrl_no='.$ctrl_no.'\');"><span class="mif-print icon"></span></button></div>';
      return $viewing;
    }),
    array('db' => '`u`.`ctrl_no`', 'dt' => 1,'field' => "ctrl_no"),
    array('db' => '`u`.`qty`', 'dt' => 2,'field' => "qty"),
    array('db' => '`u`.`borrowed_to`', 'dt' => 3,'field' => "borrowed_to"),
    array('db' => '`u`.`released_from`', 'dt' => 4,'field' => "released_from"),
    array('db' => '`u`.`date_approved`', 'dt' => 5,'field'=> 'date_approved' ,'formatter' => function($date_approved)
      {
          return date('M d, Y H:i:A', strtotime($date_approved));
      }),
      array('db' => '`u`.`borrow_status`', 'dt' => 6,'field' => "borrow_status")
  );
  $sql_details = array(
  	'user' => "root",
  	'pass' => "",
  	'db'   => "sats",
  	'host' => "localhost"
  );
  $joinQuery = "FROM `showPropertyBorrow` AS `u` where borrowed_to = '$emp_name' OR released_from = '$emp_name'";
  echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $pkey, $columns, $joinQuery )
  );
  return;
?>
