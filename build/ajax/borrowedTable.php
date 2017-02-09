<?php
session_start();
require_once('../../connection.php');

  $emp_id = $_SESSION['account']['emp_id'];
  if(isset($_POST['showTable']))
  {
?>
<table class="dataTable border bordered hovered" id="userBorrowTable">
  <thead>
  <tr>
  <td class="sortable-column"></td>
  <td class="sortable-column">Property Code</td>
  <td class="sortable-column">Serial Number</td>
  <td class="sortable-column">Description</td>
  <td class="sortable-column">Location</td>
  <td class="sortable-column">Quantity</td>
  <td class="sortable-column">Borrowed From</td>
  <td class="sortable-column">Date Borrowed</td>
  </tr>
  </thead>
<tbody>
</tbody>
</table>
<script type="text/javascript">
var userBorrowTable = $('#userBorrowTable').DataTable({
  "processing": true,
  "serverSide": true,
  "ajax": "build/server_side/userShowBorrow.php",
  oLanguage : {
    sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
  }
});
setInterval(function() {
  userBorrowTable.ajax.reload(null,false);
  console.log(1);
}, 30000);
</script>
<?php
exit();

}
if(isset($_POST['showInformation']))
{
$id = $_POST['prowareID'];
$condition_id = $_POST['condition_id'];
$location_id =$_POST['location_id'];

$prowareInfoDatas=$db->query("SELECT b.pcode , b.sno , b.description as property_description, b.brand , b.model , c.description as major_description, d.description as minor_description, a.qty, b.uom, e.location, b.cost from borrow_request as a left join property as b on a.id = b.id left join minor_category as d on  b.minor_category = d.id left join major_category as c on d.major_id = c.id left join location as e on a.new_loc_id = e.id  WHERE a.id=$id AND a.new_loc_id = $location_id AND a.condition_id = $condition_id")->fetchAll();
?>
<table class="table border bordered striped" style="overflow-y:hidden; " style="height:50%;">
<tbody>
<?php
foreach ($prowareInfoDatas as $prowareInfoData)
{
?>
<tr>
<td style="text-align:center;"><h4>Specifications</h4></td>
<td style="text-align:center;"><h4>Value</h4></td>
</tr>
<tr>
<td>Property Code</td>
<td><?php echo $prowareInfoData['pcode'];?></td>
</tr>
<tr>
<td>Serial Number</td>
<td><?php echo $prowareInfoData['sno'];?></td>
</tr>
<tr>
<td>Property Description</td>
<td><?php echo $prowareInfoData['property_description'];?></td>
</tr>
<tr>
<td>Brand</td>
<td><?php echo $prowareInfoData['brand'];?></td>
</tr>
<tr>
<td>Model</td>
<td><?php echo $prowareInfoData['model'];?></td>
</tr>
<tr>
<td>Major Description</td>
<td><?php echo $prowareInfoData['major_description'];?></td>
</tr>
<tr>
<td>Minor Description</td>
<td><?php echo $prowareInfoData['minor_description'];?></td>
</tr>
<tr>
<td>Quantity</td>
<td><?php echo $prowareInfoData['qty'];?></td>
</tr>
<tr>
<td>Unit of Measurement</td>
<td><?php echo $prowareInfoData['uom'];?></td>
</tr>
<tr>
<td>Location</td>
<td><?php echo $prowareInfoData['location'];?></td>
</tr>
<tr>
<td>Cost</td>
<td><?php echo $prowareInfoData['cost'];?></td>
</tr>
<?php
}
?>
</tbody>
</table>
<?php
exit();

}
?>
