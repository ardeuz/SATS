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
    $prowareDatas = $db->select("property", [
      "[>]minor_category" => ["minor_category" => "id"],
      "[>]major_category" => ["minor_category.major_id" => "id"],
      "[>]property_accountability" => ["id" => "property_id"]
    ], [
      "property.id",
      "property.pcode",
      "property.sno",
      "property.description",
      "property.brand",
      "property.model",
      "property.minor_category",
      "property.uom",
      "property.cost",
      "property.date_acquired",
      "property.or_number",
      "property_accountability.qty",
      "major_category.depreciate_yr"
    ]);
    $selectAccounts = $db->select("account_table",['emp_id' , 'last_name' , 'first_name' ,'department'],["status"=>1]);

?>
<table class="dataTable border bordered hovered full-size">
<thead>
<tr>
<td class="sortable-column">Maintenance</td>
<td class="sortable-column">Property Code</td>
<td class="sortable-column">Serial Number</td>
<td class="sortable-column">Quantity</td>
</tr>
</thead>
<tbody>
<?php
//query here for 1 time querying

foreach ($prowareDatas as $prowareData)
{
  $depreciateYear = $prowareData['depreciate_yr'];
  $acquiredYear = date('Y', strtotime($prowareData['date_acquired']));
  $yearToday = date('Y');
  $prowarePcode = $prowareData['pcode'];
?>

  <tr>
  <td>
    <div class="toolbar"><button class="toolbar-button button primary adminView" onclick="showMetroDialog('#adminAccountabilityDialog'); ViewProperty('<?php echo $prowareData['id']; ?>');"><span class="mif-eye icon"></span></button>
    <button class="toolbar-button button primary adminView" onclick="showMetroDialog('#editPropertyDialog'); EditProperty('<?php echo $prowareData['id'];?>','<?php echo $prowareData['pcode'];?>' , '<?php echo $prowareData['sno'];?>' , '<?php echo $prowareData['description'];?>' , '<?php echo $prowareData['brand'];?>' , '<?php echo $prowareData['model'];?>' ,<?php echo $prowareData['or_number'];?> , '<?php echo $prowareData['uom'];?>' , <?php echo $prowareData['cost'];?> , <?php echo $prowareData['qty'];?> , <?php echo $prowareData['minor_category'];?> );"><span class="mif-pencil icon"></span></button>
    <button class="toolbar-button button primary adminView" onclick="showMetroDialog('#deletePropertyDialog'); DeletePropertyValidation('<?php echo $prowareData['id']; ?>', '<?php echo $prowareData['pcode']; ?>');"><span class="mif-bin icon"></span></button></div>
  </td>
  <td><?php echo $prowareData['pcode']?></td>
  <td><?php echo $prowareData['sno']?></td>
  <td><?php echo $prowareData['qty']?></td>
  </tr>
<?php
}
?>
</tbody>
</table>
<script type="text/javascript">
$(".dataTable").dataTable({
'searching' : true,
'paging' : true,
'lengthChange' : false
});
</script>
<?php
exit();

}
if(isset($_POST['showInformation']))
{
  $id = $_POST['prowareID'];

  $prowareInfoDatas = $db->select("property", [
    "[>]minor_category" => ["minor_category" => "id"],
    "[>]major_category" => ["minor_category.major_id" => "id"],
    "[>]property_accountability" => ["id" => "property_id"]
  ], [
    "property.id(property_id)",
    "property.pcode",
    "property.sno",
    "property.description(property_description)",
    "property.brand",
    "property.model",
    "major_category.description(major_description)",
    "minor_category.description(minor_description)",
    "property.uom",
    "property.cost",
    "property.date_acquired",
    "major_category.depreciate_yr"
  ], [
    "property.id" => $id
  ]);

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
<td>Unit of Measurement</td>
<td><?php echo $prowareInfoData['uom'];?></td>
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
