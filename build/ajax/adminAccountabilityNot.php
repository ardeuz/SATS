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
<table class="dataTable border bordered hovered full-size" id="adminAccountabilityNot">
<thead>
<tr>
<td class="sortable-column"></td>
<td class="sortable-column">Property Code</td>
<td class="sortable-column">Serial Number</td>
<td class="sortable-column">Quantity</td>
<td class="sortable-column">Add Accountability</td>
</tr>
</thead>
<tbody>
</tbody>
</table>
<script type="text/javascript">
var accountsNot;
 accountsNot = $('#adminAccountabilityNot').DataTable({
  "processing": true,
  "serverSide": true,
  "ajax": "build/server_side/adminServerAccountabilityNot.php",
  oLanguage : {
    sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
  }
});
setInterval(function() {
  accountsNot.ajax.reload(null,false);
  console.log(1);
}, 10000);
</script>
<?php
exit();

}
if(isset($_POST['showInformation']))
{
  $id = $_POST['prowareID'];

  $prowareInfoDatas = $db->select("property", [
    "[>]minor_category" => ["minor_category" => "id"],
    "[>]major_category" => ["major_category" => "id"],
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
<tr>
<td>Date Acquired</td>
<td><?php echo date('M d, Y',strtotime($prowareInfoData['date_acquired']));?></td>
</tr>
<?php
  if($db->has("sub_property",["sub_property_id"=>$id])){
    $parentProperty = "<tr><td>Parent Property</td><td>";
    $property_id = -1;
    $parent_id = -1;
    $pcode = "None";
    $description = "";
      if ($db->has("sub_property", ["sub_property_id" => $prowareInfoData['property_id']])) {
        $propertyData = $db->get("sub_property", [
          "[>]property" => ["property_id" => "id"]
        ], [
          "property.id",
          "property.pcode",
          "property.description"
        ], ["sub_property.sub_property_id" => $prowareInfoData['property_id']]);

        $property_id = $prowareInfoData['property_id'];
        $parent_id = $propertyData['id'];
        $pcode = $propertyData['pcode'];
        $description = $propertyData['description'];

      }

      //parent property div
      $parentProperty .= "
      <div class='listview-outlook' data-role='listview'>
        <div class='list marked' onclick='deleteParentProperty($property_id, $parent_id)'>
            <div class='list-content'>
                <span class='list-title' id='parent_title_span'>$pcode</span>
                <small class='list-subtitle' id='parent_desc_span' style='white-space: normal !important;'>$description</small>
            </div>
        </div>
      </div>";

      //change/add for parent property
      $parentProperty .= "
      <hr class='bg-green'/>
      <p class='text-normal'>Pick a Parent Property:</p>
      <div class='input-control select full-size' data-role='select'>
            <select id='parentData' style='display:none;'>";

              $selectParentDatas=$db->select('property',[
                'pcode','description','id'
              ],[
                'id[!]' => $prowareInfoData['property_id']
              ]);

              foreach($selectParentDatas as $selectParentData)
              {
                $parentProperty .= '<option data-desc="' . $selectParentData['description'] . '" value='.$selectParentData['id'].'>'.$selectParentData['pcode']. ' - '.$selectParentData['description'].'</option>';
              }

      $parentProperty .="
            </select>
      </div>

      <button class='button primary'  onclick='updateParent(" . $prowareInfoData['property_id'] . ")'>Update Change</button>
      </td>
      </tr>";
      echo $parentProperty;
  }
  elseif($db->has("sub_property",["property_id"=>$id]) || $db->has("minor_category",["id"=>1])){
    $subParent = "<tr>
                    <td>Sub Items</td>
                    <td>";

      $subPropertyDatas = $db->select("sub_property", [
        "[>]property" => ["sub_property_id" => "id"]
      ], [
        "property.id",
        "property.pcode",
        "property.description"
      ], ["sub_property.property_id" => $prowareInfoData['property_id']]);

      $subParent .= "
      <div id='sub_property_div' class='listview-outlook' data-role='listview'>";

      if (count($subPropertyDatas) > 0) {
        foreach ($subPropertyDatas as $subPropertyData) {
          $subParent .= "
            <div id='sub_property_div" . $subPropertyData['id'] . "' class='list' onclick='deleteSubProperty(" . $subPropertyData['id'] . ", " . $prowareInfoData['property_id'] . ")'>
                <div class='list-content'>
                    <span class='list-title' id='sub_title_span'>" . $subPropertyData['pcode'] . "</span>
                    <small class='list-subtitle' id='sub_desc_span' style='white-space: normal !important;'>" . $subPropertyData['description'] . "</small>
                </div>
            </div>";
        }
      }

      $subParent .= "</div>";

      $subParent .= "
      <hr class='bg-green'/>
      <p class='text-normal'>Pick a Sub Property:</p>
      <div class='input-control select full-size' data-role='select'>
        <select id='sub_property_select' style='display:none;'>";
          $selectParentDatas = $db->select('property', [
            'pcode','description','id'
          ], [
            "AND" => [
              'id[!]' => $prowareInfoData['property_id'],
              'id[!]' => $db->get("sub_property", "sub_property_id", ["property_id" => $prowareInfoData['property_id']])
            ]
          ]);

          foreach($selectParentDatas as $selectParentData) {
            $subParent .= '<option data-desc="' . htmlspecialchars($selectParentData['description']) . '" value=' . $selectParentData['id'].'>' . $selectParentData['pcode'] . ' - '.$selectParentData['description'].'</option>';
          }

      $subParent .= "
        </select>
      </div>
      <button class='button primary'  onclick='addChildProperty(" . $prowareInfoData['property_id'] . ")'>Add Sub Property</button>
        </td>
      </tr>";
      echo $subParent;
    }
  }
  ?>
  </tbody>
</table>
<?php
exit();

}
?>
