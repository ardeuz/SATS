<?php
session_start();
require_once('../../connection.php');

  $emp_id = $_SESSION['account']['emp_id'];
  if(isset($_POST['showTable']))
  {

      $prowareDatas = $db->query("SELECT a.id AS id, b.pcode, b.sno , b.description, c.location, d.condition_info, a.transfer_to, e.department, a.qty, a.condition_id, b.uom, a.new_loc_id, concat(f.last_name,', ',f.first_name) as borrowedTo, a.date_approved from borrow_request AS a left join property AS b on a.id = b.id left join location AS c on a.new_loc_id = c.id left join condition_info AS d on a.condition_id = d.id inner join account_table as e on a.transfer_to = e.emp_id inner join account_table as f on a.released_from = f.emp_id WHERE a.transfer_to='$emp_id'")-> fetchAll();

?>
<table id="table1" class="dataTable border bordered hovered ">
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
<?php
foreach ($prowareDatas as $prowareData)
{
?>

<tr class="<?php if($prowareData['date_approved'] <= date('Y-m-d H:i:s')){ echo 'bg-red fg-white';} elseif($prowareData['date_approved'] >= date('Y-m-d H:i:s',strtotime( date('Y-m-d H:i:s').'+30 minutes'))){echo 'bg-orange fg-white';} else{ echo 'bg-green fg-white';}?>">
</td>
<td>
<div class="toolbar"><button class="toolbar-button button primary" onclick="currentBorrowView(<?php echo $prowareData['id']?>,<?php echo $prowareData['condition_id']; ?>,<?php echo $prowareData['new_loc_id']; ?>);showMetroDialog('#borrowedDialog')"><span class="mif-eye icon"></span></button>
</div>
</td>
<td><?php echo $prowareData['pcode']?></td>
<td><?php echo $prowareData['sno']?></td>
<td><?php echo $prowareData['description']?></td>
<td><?php echo $prowareData['condition_id']?></td>
<td><?php echo $prowareData['qty']; ?></td>
<td><?php echo $prowareData['borrowedTo']?></td>
<td><?php echo $prowareData['date_approved']?></td>
</td>
</tr>
<?php
}
?>
</tbody>
</table>
<script type="text/javascript">
var table = $("#table1").dataTable({

});
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
