<?php
  session_start();
  require_once('../../connection.php');
  include ('../../validatePage.php');
?>
<table class="dataTable border bordered hovered full-size" id="table1">
<thead>
<tr>
<td class="sortable-column">Employee ID</td>
<td class="sortable-column">Employee Name</td>
<td class="sortable-column">Department</td>
<td class="sortable-column">Maintenance</td>
<td class="sortable-column">Account Activation</td>
</tr>
</thead>
<tbody>
</tbody>
</table>
<script type="text/javascript">
  var accounts = $('#table1').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "build/server_side/adminServerUsers.php"
  });
  setInterval(function() {
    accounts.ajax.reload(null,false);
    console.log(1);
  }, 30000);
</script>
