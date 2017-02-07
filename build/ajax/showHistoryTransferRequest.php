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
<table class="dataTable border bordered hovered full-size" id="adminShowHistoryTransfer">
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
    </tbody>
  </table>
<script>
var adminShowHistoryTransfer = $("#adminShowHistoryTransfer").DataTable({
  "processing": true,
  "serverSide": true,
  "ajax": "build/server_side/adminServerShowTransferHistory.php",
  oLanguage : {
    sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
  }
});
setInterval(function() {
  accounts.ajax.reload(null,false);
  console.log(1);
  }, 10000);

</script>
<?php
}
else
{
  echo "<h2 class='text-light'><center>There is no Transfer History.</center></h2>
  <br /><br /><br />";
}
?>
