<?php
  require_once("../../connection.php");
  session_start();

  if (!isset($_POST['showRequest'])) {
		exit();
	}  elseif(isset($_POST['showRequest'])){
    $pID = $_POST['viewP'];
    echo '<input type="hidden" id="idHolder" value='.$pID.'>';
?>
<table class="dataTable border bordered hovered full-size" id="userShowUpdateHistoryRepair">
    <thead>
      <tr>
        <td class="sortable-column">Action</td>
        <td class="sortable-column">Date Repaired</td>
        <td class="sortable-column">Remarks</td>
        <td class="sortable-column">Recommendation</td>
        <td class="sortable-column">Cost</td>

        <!-- <td class="sortable-column"></td>
        <td class="sortable-column">Control Number</td>
        <td class="sortable-column">Item Borrowed</td>
        <td class="sortable-column">Transfer To</td>
        <td class="sortable-column">Released From</td>
        <td class="sortable-column">Date Approved</td>
        <td class="sortable-column">Borrow Status</td> -->
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
<script>
console.log($('#request_id').val());
var userShowUpdateHistoryRepairs = $("#userShowUpdateHistoryRepair").DataTable({
  "order": [[ 2, 'desc' ]],
  "processing": true,
  "searching": false,
  "serverSide": true,
  "ajax": "build/server_side/adminRepairHistory.php?id="+$('#idHolder').val(),
  oLanguage : {
    sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
  }
});
setInterval(function() {
  userShowUpdateHistoryRepairs.ajax.reload(null,false);
  console.log(1);
  }, 10000);

</script>
<?php
}
else
{
  echo "<h2 class='text-light'><center>There is no Repair History .</center></h2>
  <br /><br /><br />";
}
?>
