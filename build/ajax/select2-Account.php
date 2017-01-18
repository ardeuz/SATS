<?php
ob_start("ob_gzhandler");
session_start();
require_once('../../connection.php');
$selectAccounts = $db->select("account_table",['emp_id' , 'last_name' , 'first_name' ,'department']);

foreach($selectAccounts as $selectAccount)
{
  echo "
    <option value=". $selectaccount['emp_id'] ."> ". $selectAccount['last_name'] .", ". $selectAccount['first_name']." - ". $selectAccount['department']. "</option> ";
}
?>
