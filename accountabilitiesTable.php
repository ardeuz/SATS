<?php
session_start();
require_once('connection.php');

  $emp_id = $_SESSION['account']['emp_id'];

  if(isset($_POST['showTable']))
  {
      $prowareDatas = $db->query("SELECT a.property_id AS id, b.pcode, b.sno , b.description, c.location, d.condition_info, a.emp_id, e.department, a.qty, a.condition_id, b.uom, a.location_id from property_accountability AS a left join property AS b on a.property_id = b.id left join location AS c on a.location_id = c.id left join condition_info AS d on a.condition_id = d.id inner join account_table as e on a.emp_id = e.emp_id WHERE a.emp_id='$emp_id'")-> fetchAll();
?>
<table id="table1" class="dataTable border bordered hovered">
  <thead>
  <tr>
  <td class="sortable-column">Maintenance</td>
  <td class="sortable-column">Property Code</td>
  <td class="sortable-column">Serial Number</td>
  <td class="sortable-column">Description</td>
  <td class="sortable-column">Location</td>
  <td class="sortable-column">Quantity</td>
  <td class="sortable-column">Condition</td>
  </tr>
  </thead>
<tbody>
<?php
foreach ($prowareDatas as $prowareData)
{
?>

<tr class="<?php if($prowareData['condition_id'] == 4){echo 'bg-orange';} elseif($prowareData['condition_id'] == 5){echo 'bg-red';} elseif($prowareData['condition_id'] == 3 ){echo 'bg-green';}elseif($prowareData['condition_id'] <= 2 ){echo 'bg-white';}?>">
<td>
<div class="toolbar"><button class="toolbar-button button primary prowareView" idPv='<?php echo $prowareData['id']?>' conditionPv='<?php echo $prowareData['condition_id']; ?>' locationPv='<?php echo $prowareData['location_id']; ?>' onclick="showMetroDialog('#prowaredialog')"><span class="mif-eye icon"></span></button>
 <!-- <button class="toolbar-button button primary" onclick="showMetroDialog('#propertyDistribution');distributeProperty(<?php echo $prowareData['id']?>,'<?php echo  $prowareData['pcode'] ?>','<?php echo $emp_id;?>',<?php echo $prowareData['condition_id']?>,<?php echo $prowareData['location_id']?>)" ><span class="mif-unlink icon"></span></button> -->
 <!-- <button class="toolbar-button button primary" onclick="showMetroDialog('#propertyRepair');repairProperty(<?php echo $prowareData['id']?>,'<?php echo  $prowareData['pcode'] ?>','<?php echo $emp_id;?>',<?php echo $prowareData['condition_id']?>,<?php echo $prowareData['location_id']?>)" ><span class="mif-wrench icon"></span></button> -->
</div>
</td>
<td><?php echo $prowareData['pcode']?></td>
<td><?php echo $prowareData['sno']?></td>
<td><?php echo $prowareData['description']?></td>
<td>
<div class="input-control select">
<select onchange='<?php echo "updateLocation(" . $prowareData['id'] . ", " .$prowareData['condition_id'] . ", " . $prowareData['location_id'] . ")"; ?>' id='<?php echo "location" . $prowareData['id'] . $prowareData['location_id'] . $prowareData['condition_id']; ?>'>
<?php
$locationDatas = $db->select("location", ["id","location"]);
  foreach ($locationDatas as $locationData){
    if ($prowareData['location_id'] == $locationData['id']) //if this is the location
      {
          echo "<option value='" . $locationData['id'] . "' selected>" . $locationData['location'] . "</option>";
      }
      else
      {
          echo "<option value='" . $locationData['id'] . "'>" . $locationData['location'] . "</option>";
      }
  }
?>
</select>
</div>
</td>
<td><?php echo $prowareData['qty']; ?></td>
<td>
<div class="input-control select">
<select onchange='<?php echo "updateCondition(" . $prowareData['id'] . ", " . $prowareData['location_id'] . ", " . $prowareData['condition_id'] . ")"; ?>' id='<?php echo "condition" . $prowareData['id'] . $prowareData['location_id'] . $prowareData['condition_id']; ?>'>
<?php
  $conditionDatas = $db->select("condition_info", ["id","condition_info"]);
  foreach ($conditionDatas as $conditionData){
    if ($prowareData['condition_id'] == $conditionData['id']) //if this is the location
      {
          echo "<option value='" . $conditionData['id'] . "' selected>" . $conditionData['condition_info'] . "</option>";
      }
      else
      {
          echo "<option value='" . $conditionData['id'] . "'>" . $conditionData['condition_info'] . "</option>";
      }
  }
?>
</select>
</div>
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

$prowareInfoDatas=$db->query("SELECT b.pcode , b.sno , b.description as property_description, b.brand , b.model , c.description as major_description, d.description as minor_description, a.qty, b.uom, e.location, b.cost from property_accountability as a left join property as b on a.property_id = b.id left join minor_category as d on  b.minor_category = d.id left join major_category as c on d.major_id = c.id left join location as e on a.location_id = e.id  WHERE a.property_id=$id AND a.location_id=$location_id AND a.condition_id = $condition_id AND a.emp_id = '$emp_id'")->fetchAll();

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
