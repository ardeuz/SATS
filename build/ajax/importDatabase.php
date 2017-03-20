<?php

  require_once('../../connection.php');
  require_once('../../db_backup/db_backup_library.php');

  $backupId = $_POST['backup_id'];
  $backupName = $db->get("backup_restore","backup_name",["backup_id"=>$backupId]);
  $fileName = '../../sats_backup/'.$backupName.'.sql';
  //call the db_backup class
  $dbbackup = new db_backup;
  $dbbackup->connect("localhost","root","","SATS");
  $dbbackup->backup();
  $dbbackup->db_import("".$fileName."");
?>
