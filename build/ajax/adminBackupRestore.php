<?php
  session_start();
  require_once('../../connection.php');
  include ('../../validatePage.php');
?>
<table class="dataTable border bordered hovered full-size" id="backupDatabase">
<thead>
  <tr>
    <td class="sortable-column">Backup Date</td>
    <td class="sortable-column">Backup Name</td>
    <td class="sortable-column">Remarks</td>
    <td class="sortable-column">Backup Restoration</td>
  </tr>
</thead>
  <tbody>
    <?php
      $backupDatas = $db->select("backup_restore",["backup_id","backup_name","backup_date","remarks"]);
      // var_dump($db->error());
      // return;
      foreach($backupDatas as $backupData){
        echo "
          <tr>
            <td>".$backupData['backup_name']."</td>
            <td>".$backupData['backup_date']."</td>
            <td>".$backupData['remarks']."</td>
            <td><button class='button' onClick='restoreDb(".$backupData['backup_id'].");'>Restore</button></td>
          </tr>
        ";
      }
    ?>
  </tbody>
</table>
<script>
  var backup = $("#backupDatabase").dataTable({
    "order": [[ 1, 'desc' ]]
  });
</script>
