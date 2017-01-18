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
      "property.date_acquired",
      "property_accountability.qty",
      "major_category.depreciate_yr"
    ], [
      "property_accountability.property_id" => null
    ]);
    $selectAccounts = $db->select("account_table",['emp_id' , 'last_name' , 'first_name' ,'department'],["status"=>1]);

?>
<table class="dataTable border bordered hovered full-size">
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
<?php
//query here for 1 time querying

foreach ($prowareDatas as $prowareData)
{
  $depreciateYear = $prowareData['depreciate_yr'];
  $acquiredYear = date('Y', strtotime($prowareData['date_acquired']));
  $yearToday = date('Y');
  $prowarePcode = $prowareData['pcode'];
?>

  <tr class="<?php if(($yearToday - $acquiredYear) >= $depreciateYear){echo 'bg-orange fg-white'; } ?>">
  <td>
    <div class="toolbar"><button class="toolbar-button button primary adminView" idPv='<?php echo $prowareData['id']?>'  onclick="showMetroDialog('#adminAccountabilityDialog')"><span class="mif-eye icon"></span></button></div>
  </td>
  <td><?php echo $prowareData['pcode']?></td>
  <td><?php echo $prowareData['sno']?></td>
  <td><?php echo $prowareData['qty']?></td>
  <td>
    <div class="input-control select" style="width:300px; border-radius:0px;" data-role="select">
      <select style="display:none;" id="selectAccount"
      onchange='changeAccountability(<?php echo  $prowareData["id"] . ', ' . "\"$prowarePcode\""; ?>)'>
          <?php
          foreach($selectAccounts as $selectAccount)
          {
            echo "
              <option value=". $selectAccount['emp_id'] ."> ". $selectAccount['last_name'] .", ". $selectAccount['first_name']." - ". $selectAccount['department']. "</option> ";
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
<tr>
<td>Parent Property</td>
<td>
  <?php
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
    <div class='input-control select full-size' data-role='input'>
          <select id='parentData'>";

            $selectParentDatas=$db->select('property',[
              'pcode','description','id'
            ],[
              'id[!]' => $prowareInfoData['property_id']
            ]);

            foreach($selectParentDatas as $selectParentData)
            {
              echo '<option data-desc="' . $selectParentData['description'] . '" value='.$selectParentData['id'].'>'.$selectParentData['pcode'].'</option>';
            }

    echo"
          </select>
    </div>

    <button class='button primary'  onclick='updateParent(" . $prowareInfoData['property_id'] . ")'>Update Change</button>
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
    ], ["sub_property.property_id" => $prowareInfoData['property_id']]);

    if (count($subPropertyDatas) <= 0) {
      echo "None";
    } else {
      echo "
      <div id='sub_property_div' class='listview-outlook' data-role='listview'>";

      foreach ($subPropertyDatas as $subPropertyData) {
        echo "
          <div id='sub_property_div" . $subPropertyData['id'] . "' class='list' onclick='deleteSubProperty(" . $subPropertyData['id'] . ", " . $prowareInfoData['property_id'] . ")'>
              <div class='list-content'>
                  <span class='list-title' id='sub_title_span'>" . $subPropertyData['pcode'] . "</span>
                  <small class='list-subtitle' id='sub_desc_span' style='white-space: normal !important;'>" . $subPropertyData['description'] . "</small>
              </div>
          </div>";
      }

      echo "</div>";
    }

    echo "
    <hr class='bg-green'/>
    <p class='text-normal'>Pick a Sub Property:</p>
    <div class='input-control select full-size' data-role='input'>
      <select id='sub_property_select'>";

        $selectParentDatas = $db->select('property', [
          'pcode','description','id'
        ], [
          "AND" => [
            'id[!]' => $prowareInfoData['property_id'],
            'id[!]' => $db->select("sub_property", "sub_property_id", ["property_id" => $prowareInfoData['property_id']])
          ]
        ]);

        foreach($selectParentDatas as $selectParentData) {
          echo '<option data-desc="' . $selectParentData['description'] . '" value=' . $selectParentData['id'].'>' . $selectParentData['pcode'] . '</option>';
        }

    echo "
      </select>
    </div>

    <button class='button primary'  onclick='addChildProperty(" . $prowareInfoData['property_id'] . ")'>Add Sub Property</button>";
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
