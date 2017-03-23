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
?>
<table class="dataTable border bordered hovered full-size" id="adminMainteMajor">
<thead>
<tr>
<td class="sortable-column">Maintenance</td>
<td class="sortable-column">Supplier Name</td>
</tr>
</thead>
<tbody>
</tbody>
</table>
<script type="text/javascript">
  var accounts = $('#adminMainteMajor').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "build/server_side/adminServerSupplier.php",
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
exit();

}
?>
