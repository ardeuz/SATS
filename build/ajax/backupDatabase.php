<?php

  require_once('../../connection.php');
  require_once('../../db_backup/db_backup_library.php');
  date_default_timezone_set('Asia/Manila');
  //initialize datas to be inserted in the DB
  $remarks = $_POST['remarks'];
  // $target_dir = "../../sats_backup";
  $dateToday = date('Y-m-d');
  $backupName = "sats-backup-database-".$dateToday;


  //insert first the backupname
  $db->insert("backup_restore",
    [
      "backup_name" => $backupName,
      "backup_date" => $dateToday,
      "remarks" => $remarks
    ]
  );
  //after inserting insert it to directory
  //call the db_backup class
  $dbbackup = new db_backup;
  $dbbackup->connect("localhost","root","","SATS");
  $dbbackup->backup();
  $dbbackup->save("../../sats_backup/","".$backupName."");
?>
