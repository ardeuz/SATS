<?php
  ini_set('max_execution_time', 300); //300 seconds = 5 minutes
  ini_set('memory_limit', '256M');
  set_time_limit(30);

  ob_start("ob_gzhandler");

  session_start();
  require_once('../../connection.php');
  include ('../../validatePage.php');


$emp_id = $_SESSION['account']['emp_id'];

if(isset($_POST['showAccounts']))
{
    $prowareDatas = $db->select("minor_category", ["id","description"
    ]);
?>
<table class="dataTable border bordered hovered full-size" id="adminMainteMinor">
<thead>
<tr>
<td class="sortable-column">Maintenance</td>
<td class="sortable-column">Description</td>
</tr>
</thead>
<tbody>
</tbody>
</table>
<script type="text/javascript">
  var accounts = $('#adminMainteMinor').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "build/server_side/adminServerMainteMinor.php"
  });
  setInterval(function() {
    accounts.ajax.reload(null,false);
    console.log(1);
  }, 30000);
</script>
<?php
exit();

}
?>
