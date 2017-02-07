<?php
  session_start();
  require_once('../../connection.php');
  include ('../../validatePage.php');
  require_once ('../dataTables/ssp.php');


$emp_id = $_SESSION['account']['emp_id'];

if(isset($_POST['showAccounts']))
{
    $prowareDatas = $db->query("SELECT a.property_id AS id, b.pcode, b.sno , b.description, c.location AS location, d.condition_info, a.emp_id, e.department AS department, a.qty AS qty, a.condition_id AS condition_id,b.uom AS uom,a.location_id AS location_id, CONCAT(e.last_name, ', ', e.first_name) AS emp_name, depreciate_yr, date_acquired from property_accountability AS a left join
    property AS b on a.property_id = b.id left join location AS c on a.location_id = c.id left join
    condition_info AS d on a.condition_id = d.id left join account_table as e on a.emp_id = e.emp_id left join minor_category as f on f.id=b.minor_category left join major_category as g on f.major_id=g.id")-> fetchAll();
?>

<table class="dataTable border bordered hovered full-size" id="adminAccountability">
<thead>
<tr>
<td class="sortable-column"></td>
<td class="sortable-column">Property Code</td>
<td class="sortable-column">Serial Number</td>
<td class="sortable-column">Location</td>
<td class="sortable-column">Quantity</td>
<td class="sortable-column">Condition</td>
<td class="sortable-column">Employee Name</td>
<td class="sortable-column">is Borrowed</td>
</tr>
</thead>
<tbody>
</tbody>
</table>
<script type="text/javascript">
  var accounts = $('#adminAccountability').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "build/server_side/adminServerAccountability.php",
    oLanguage : {
      sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
    }
  });
  // setInterval(function() {
  //   accounts.ajax.reload(null,false);
  //   console.log(1);
  // }, 10000);
</script>
<?php
exit();

}
if(isset($_POST['showInformation']))
{
$id = $_POST['prowareID'];
$condition_id = $_POST['condition_id'];
$location_id =$_POST['location_id'];

$prowareInfoDatas=$db->query("SELECT b.id AS property_id, b.pcode , b.sno , b.description as property_description, b.brand , b.model , c.description as major_description, d.description as minor_description,a.qty , b.uom, e.location, b.cost from property_accountability as a left join property as b on a.property_id = b.id left join minor_category as d on  b.minor_category = d.id left join major_category as c on d.major_id = c.id left join location as e on a.location_id = e.id  WHERE a.property_id=$id AND a.location_id=$location_id AND a.condition_id = $condition_id")->fetchAll();

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
<tr>
<td>Parent Property</td>
<td>
  <?php
    if ($db->has("sub_property", ["sub_property_id" => $prowareInfoData['property_id']])) {
      $propertyData = $db->get("sub_property", [
        "[>]property" => ["property_id" => "id"]
      ], [
        "property.pcode",
        "property.description"
      ], ["sub_property.property_id" => $prowareInfoData['property_id']]);

      echo "
      <div class='panel'>
        <div class='heading'>
            <span class='title'>" . $propertyData['pcode'] . "</span>
        </div>
        <div class='content padding5'>
            <span class='text-bold'>" . $propertyData['description'] . "</span>
        </div>
      </div>
      <br />";

    } else {
      echo "None";
    }
  ?>
</td>
</tr>
<tr>
<td>Sub Items</td>
<td>
  <?php
    $subPropertyDatas = $db->select("sub_property", [
      "[>]property" => ["sub_property_id" => "id"]
    ], [
      "property.pcode",
      "property.description"
    ], ["sub_property.property_id" => $prowareInfoData['property_id']]);

    if (count($subPropertyDatas) <= 0) {
      echo "None";
    }

    foreach ($subPropertyDatas as $subPropertyData) {
      echo "
      <div class='panel'>
        <div class='heading'>
            <span class='title'>" . $subPropertyData['pcode'] . "</span>
        </div>
        <div class='content padding5'>
            <span class='text-bold'>" . $subPropertyData['description'] . "</span>
        </div>
      </div>
      <br />";
    }
  ?>

</td>
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
