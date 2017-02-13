<?php
  session_start();
  require_once('../../connection.php');
  include ('../../validatePage.php');
?>
<table class="dataTable border bordered hovered full-size" id="accountsTable">
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
  var accounts = $('#accountsTable').DataTable({
    "createdRow":function(row,data,dataIndex)
    {
      if(data.status == 0)
      {
        $(row).addClass("bg-lightRed");
        $(row).addClass("fg-white");
      }
      else if(data.status == 1)
      {
        $(row).addClass("bg-white");
        $(row).addClass("fg-black");

      }
    },
    "processing": true,
    "serverSide": true,
    "ajax": "build/server_side/adminServerUsers.php",
    oLanguage : {
      sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
    }
  });
  setInterval(function() {
    accounts.ajax.reload(null,false);
    console.log(1);
  }, 30000);
</script>
