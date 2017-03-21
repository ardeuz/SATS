<?php
session_start();
require_once('connection.php');

$emp_id = $_SESSION['account']['emp_id'];

if(isset($_POST['showTable']))
{
?>
<table class="dataTable border bordered hovered" id="showAccountabilities">
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
</tbody>
</table>
<script type="text/javascript">
var userShowAccountabilities = $("#showAccountabilities").DataTable({
  "processing": true,
  "serverSide": true,
  "ajax": "build/server_side/userShowAccountabilities.php",
  oLanguage : {
    sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
  },
  "createdRow": function( row, data, dataIndex ) {
    if(data['status'] == 0 ) {
      $(row).addClass('bg-lightRed');
      $(row).addClass('fg-white');
    }
  }
});
setInterval(function() {
  userShowAccountabilities.ajax.reload(null,false);
  console.log(1);
  }, 10000);

</script>
<?php
exit();

}
if(isset($_POST['showInformation']))
{
$id = $_POST['prowareID'];
$condition_id = $_POST['condition_id'];
$location_id =$_POST['location_id'];

$prowareInfoDatas=$db->query("SELECT b.pcode , b.property_image, b.sno , b.description as property_description, b.brand , b.model , c.description as major_description, d.description as minor_description, a.qty, b.uom, e.location, b.cost from property_accountability as a left join property as b on a.property_id = b.id left join minor_category as d on  b.minor_category = d.id left join major_category as c on b.major_category = c.id left join location as e on a.location_id = e.id  WHERE a.property_id=$id AND a.location_id=$location_id AND a.condition_id = $condition_id AND a.emp_id = '$emp_id'")->fetchAll();

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
    $property_id = -1;
    $parent_id = -1;
    $pcode = "None";
    $description = "";
      if ($db->has("sub_property", ["sub_property_id" => $id])) {
        $propertyData = $db->get("sub_property", [
          "[>]property" => ["property_id" => "id"]
        ], [
          "property.id",
          "property.pcode",
          "property.description"
        ], ["sub_property.sub_property_id" => $id]);
        $property_id = $id;
        $parent_id = $propertyData['id'];
        $pcode = $propertyData['pcode'];
        $description = $propertyData['description'];
      }
      //parent property div
      echo "
      <div class='listview-outlook' data-role='listview'>
        <div class='list marked' onclick='deleteParentProperty($property_id, $parent_id)'>
            <div class='list-content'>
                <span class='list-title' id='parent_title_span'>$pcode</span>
                <small class='list-subtitle' id='parent_desc_span' style='white-space: normal !important;'>$description</small>
            </div>
        </div>
      </div>";
      //change/add for parent property
      echo "
      <hr class='bg-green'/>
      <p class='text-normal'>Pick a Parent Property:</p>
      <div class='input-control select full-size' data-role='select'>
            <select id='parentData' style='display:none;'>";
              $selectParentDatas=$db->select('property',[
                'pcode','description','id'
              ],[
                'id[!]' => $id
              ]);
              foreach($selectParentDatas as $selectParentData)
              {
                echo '<option data-desc="' . $selectParentData['description'] . '" value='.$selectParentData['id'].'>'.$selectParentData['pcode'].'</option>';
              }
      echo"
            </select>
      </div>
      <button class='button primary'  onclick='updateParent(" .$id . ")'>Update Change</button>
        ";
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
        "property.id",
        "property.pcode",
        "property.description"
      ], ["sub_property.property_id" => $id]);
      echo "
      <div id='sub_property_div' class='listview-outlook' data-role='listview'>";
      if (count($subPropertyDatas) > 0) {
        foreach ($subPropertyDatas as $subPropertyData) {
          echo "
            <div id='sub_property_div" . $subPropertyData['id'] . "' class='list' onclick='deleteSubProperty(" . $subPropertyData['id'] . ", " . $id . ")'>
                <div class='list-content'>
                    <span class='list-title' id='sub_title_span'>" . $subPropertyData['pcode'] . "</span>
                    <small class='list-subtitle' id='sub_desc_span' style='white-space: normal !important;'>" . $subPropertyData['description'] . "</small>
                </div>
            </div>";
        }
      }

      echo "</div>";
      echo "
      <hr class='bg-green'/>
      <p class='text-normal'>Pick a Sub Property:</p>
      <div class='input-control select full-size' data-role='select'>
        <select id='sub_property_select' style='display:none;'>";
          $selectParentDatas = $db->select('property', [
            'pcode','description','id'
          ], [
            "AND" => [
              'id[!]' => $id,
              'id[!]' => $db->get("sub_property", "sub_property_id", ["property_id" => $id])
            ]
          ]);
          foreach($selectParentDatas as $selectParentData) {
            echo '<option data-desc="' . htmlspecialchars($selectParentData['description']) . '" value=' . $selectParentData['id'].'>' . $selectParentData['pcode'] . '</option>';
          }
      echo "
        </select>
      </div>
      <button class='button primary'  onclick='addChildProperty(" .$id . ")'>Add Sub Property</button>";
    ?>

  </td>
  </tr>
  <tr>
    <td>Property Image</td>
    <td><?php echo '<img src='.$prowareInfoData['property_image'].'>'?></td>
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
