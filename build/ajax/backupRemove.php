<?php

  require_once('../../connection.php');
  $directory = scandir('../../sats_backup/');
  foreach($directory as $dir){
    $dir = substr($dir, 0, count($dir) - 5); //remove the extension .sql because database has no sql extension
    if (!$db->has("backup_restore", ["backup_name" => $dir])) { //check if the database does not already exist on db
      unlink("../../sats_backup/" . $dir . ".sql"); //unlink because he's fuckin stranger from db
    }
  }

?>
