<?php
session_start();
require_once('../../connection.php');

  $emp_id = $_SESSION['account']['emp_id'];
  if(isset($_POST['showTable']))
  {
?>
<table class="dataTable border bordered hovered" id="userHistoryTable">
  <thead>
  <tr>
    <td class="sortable-column">Action</td>
    <td class="sortable-column">Remark</td>
    <td class="sortable-column">Date Repaired</td>
    <td class="sortable-column">Recommendation</td>
    <td class="sortable-column">Cost</td>
  </tr>
  </thead>
<tbody>
</tbody>
</table>
<script type="text/javascript">
var userHistoryTables = $('#userHistoryTable').DataTable({
  "processing": true,
  "serverSide": true,
  "ajax": "build/server_side/userHistoryTable.php",
  oLanguage : {
    sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
  }
});
setInterval(function() {
  userHistoryTables.ajax.reload(null,false);
  console.log(1);
}, 30000);
</script>
<?php
exit();

}
?>
