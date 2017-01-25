<?php
  require_once("../../connection.php");
  session_start();

  if (!isset($_POST['showRequest'])) {
		exit();
	}

  $sql = "SELECT ctrl_no, COUNT(id) AS items_transferred, CONCAT(b.last_name, ', ', b.first_name) AS transfer_to, CONCAT(c.last_name, ', ', c.first_name) AS released_from, date_approved FROM transfer_request_history AS a LEFT JOIN account_table AS b ON a.transfer_to=b.emp_id LEFT JOIN account_table AS c ON a.released_from=c.emp_id GROUP BY ctrl_no";

  $transferHistoryDatas = $db->query($sql)->fetchAll();
  $historyCount = count($transferHistoryDatas);
  if($historyCount != 0)
  {
?>
<table class="dataTable border bordered hovered full-size">
    <thead>
      <tr>
        <td class="sortable-column"></td>
        <td class="sortable-column">Control Number</td>
        <td class="sortable-column">Item Transferred</td>
        <td class="sortable-column">Transfer To</td>
        <td class="sortable-column">Released From</td>
        <td class="sortable-column">Date Approved</td>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($transferHistoryDatas as $transferHistoryData)
      {
      ?>
      <tr>
        <td><div class="toolbar"><button class="toolbar-button button primary"onclick="window.open('build/reports/transferReport.php?ctrl_no=<?php echo $transferHistoryData['ctrl_no']?>', '', '');"><span class="mif-print icon"></span></button></div></td>
        <td><?php echo $transferHistoryData['ctrl_no']?> </td>
        <td><?php echo $transferHistoryData['items_transferred']?> </td>
        <td><?php echo $transferHistoryData['transfer_to']?> </td>
        <td><?php echo $transferHistoryData['released_from']?> </td>
        <td><?php echo date('M d, Y H:i:A', strtotime($transferHistoryData['date_approved'])); ?> </td>
      <?php
      }
      ?>
    </tbody>
  </table>
<script>
$("table").dataTable({
});
</script>
<?php
}
else
{
  echo "<h2 class='text-light'><center>There is no Transfer History.</center></h2>
  <br /><br /><br />";
}
?>
