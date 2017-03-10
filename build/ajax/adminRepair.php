<?php
  session_start();
  require_once('../../connection.php');
  include ('../../validatePage.php');


$emp_id = $_SESSION['account']['emp_id'];

if(isset($_POST['showAccounts']))
{
    ?>

<table class="dataTable border bordered hovered full-size" id="adminRepairView">
<thead>
<tr>
<td class="sortable-column"></td>
<td class="sortable-column">Property Code</td>
<td class="sortable-column">Serial Number</td>
<td class="sortable-column">Property Description</td>
<td class="sortable-column">Brand</td>
<td class="sortable-column">Unit of Measurement</td>
<td class="sortable-column">P.O. Number</td>
</tr>
</thead>
<tbody>
</tbody>
</table>
<script type="text/javascript">
var adminRepairsView = $("#adminRepairView").dataTable({
    "order": [[ 3, 'desc' ]],
    "processing": true,
    "serverSide": true,

    "ajax": "build/server_side/adminServerRepair.php",
    oLanguage : {
      sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
    },
  });
  setInterval(function() {
    adminRepairsView.ajax.reload(null,false);
    console.log(1);
  }, 30000);
</script>
<?php
exit();

}
?>
