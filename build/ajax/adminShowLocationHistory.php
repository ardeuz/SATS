<?php
  require_once("../../connection.php");
  session_start();

  if (!isset($_POST['showRequests'])) {
		exit();
	}  elseif(isset($_POST['showRequests'])){
    $pID = $_POST['viewPs'];
    echo '<input type="hidden" id="idHolders" value='.$pID.'>';
?>
<table class="dataTable border bordered hovered full-size" id="userShowLocationHistory">
    <thead>
      <tr>
        <td class="sortable-column">Action Taken</td>
        <td class="sortable-column">Remarks</td>
        <td class="sortable-column">Old Location</td>
        <td class="sortable-column">New Location</td>
        <td class="sortable-column">Date Taken</td>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
<script>
// console.log($('#request_id').val());
var userShowLocationHistorys = $("#userShowLocationHistory").DataTable({
  "order": [[ 2, 'desc' ]],
  "processing": true,
  "searching": false,
  "serverSide": true,
  "ajax": "build/server_side/adminLocationHistory.php?id="+$('#idHolders').val(),
  oLanguage : {
    sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
  }
});
setInterval(function() {
  userShowLocationHistorys.ajax.reload(null,false);
  console.log(1);
  }, 10000);

</script>
<?php
}
else
{
  echo "<h2 class='text-light'><center>There is no Location History .</center></h2>
  <br /><br /><br />";
}
?>
