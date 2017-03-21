<?php

  require_once('../../connection.php');
  $backupDatas = $db->select("backup_restore",["backup_name"]);
  foreach($backupDatas as $backupData){
    $fileName = '../../sats_backup/'.$backupData['backup_name'].'.sql';
    if(file_exists($fileName)){
      echo 1;
    } else {
      echo 2;
      unlink($fileName);
    }
  }

?>
