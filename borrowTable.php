<?php
  require_once('connection.php');
  session_start();

  $emp_id = $_SESSION['account']['emp_id'];

  if(isset($_POST['showTable']))
  {
?>
    <table class="dataTable border bordered hovered" id="userShowBorrowTable">
      <thead>
        <tr>
          <td class="auto size">Maintenance</td>
          <td class="sortable-column">Property Code</td>
          <td class="sortable-column">Serial Number</td>
          <td class="sortable-column">Description</td>
          <td class="sortable-column">Location</td>
          <td class="sortable-column">Condition</td>
          <td class="sortable-column">Quantity</td>
          <td>Department</td>
          <td>Property Availability</td>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <script>
    var userShowBorrowTables;
    userShowBorrowTables  = $('#userShowBorrowTable').DataTable({
    	"processing": true,
    	"serverSide": true,
    	"ajax": "build/server_side/userShowBorrowAccountability.php?location="+ $("#locationFilter").val() +"&condition="+ $("#conditionFilter").val()+"&description="+$("#descriptionFilter").val(),
    	oLanguage : {
    		sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
    	}
    });
    function conditionFilter(){
    	if(userShowBorrowTables != null){
    		$("#userShowBorrowTable").dataTable().fnDestroy();
    	}
    	userShowBorrowTables = $('#userShowBorrowTable').DataTable({
    		"processing": true,
    		"serverSide": true,
    		"ajax": "build/server_side/userShowBorrowAccountability.php?location="+$("#locationFilter").val()+"&condition="+$("#conditionFilter").val()+"&description="+$("#descriptionFilter").val(),
    		oLanguage : {
    			sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
    		}
    	});

    	console.log($("#conditionFilter").val());
    }
    function locationFilter(){
    	if(userShowBorrowTables != null){
    		$("#userShowBorrowTable").dataTable().fnDestroy();
    	}
    	userShowBorrowTables = $('#userShowBorrowTable').DataTable({
    		"processing": true,
    		"serverSide": true,
    		"ajax": "build/server_side/userShowBorrowAccountability.php?location="+ $("#locationFilter").val() +"&condition="+ $("#conditionFilter").val()+"&description="+$("#descriptionFilter").val(),
    		oLanguage : {
    			sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
    		}
    	});

    	console.log($("#locationFilter").val());
    }
    function descriptionFilter(){
      if(userShowBorrowTables != null){
        $("#userShowBorrowTable").dataTable().fnDestroy();
      }
      userShowBorrowTables = $('#userShowBorrowTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "build/server_side/userShowBorrowAccountability.php?location="+ $("#locationFilter").val() +"&condition="+ $("#conditionFilter").val()+"&description="+$("#descriptionFilter").val(),
        oLanguage : {
          sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
        }
      });
      console.log($("#descriptionFilter").val());
    }
    setInterval(function() {
      userShowBorrowTables.ajax.reload(null,false);
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
$employee_name = $_POST['emp_id'];

$transferInfoDatas=$db->query("SELECT b.pcode , b.property_image, b.sno , b.description as property_description, b.brand , b.model , c.description as major_description, d.description as minor_description, a.qty, b.uom, e.location, b.cost, f.condition_info , g.first_name, g.last_name, g.department  from property_accountability as a left join property as b on a.property_id = b.id left join minor_category as d on  b.minor_category = d.id left join major_category as c on b.major_category = c.id left join location as e on a.location_id = e.id left join condition_info as f on a.condition_id = f.id left join account_table as g on a.emp_id = g.emp_id  WHERE a.property_id=$id AND a.location_id=$location_id AND a.condition_id = $condition_id AND a.emp_id = '$employee_name'")->fetchAll();
?>

<table class="table border bordered striped" style="overflow-y:hidden; " style="height:50%;">
<tbody>
<?php
foreach ($transferInfoDatas as $transferInfoData)
{

?>
<h3 class="padding20 text-light header">Accountability of <?php echo $transferInfoData['first_name'] . ' ' . $transferInfoData['last_name']?>
<br/><small><?php echo $transferInfoData['department']?> DEPARTMENT</small>
</h3>
<br/>

<tr>
<td style="text-align:center;"><h4>Specifications</h4></td>
<td style="text-align:center;"><h4>Value</h4></td>
</tr>
<tr>
<td>Property Code</td>
<td><?php echo $transferInfoData['pcode'];?></td>
</tr>
<tr>
<td>Serial Number</td>
<td><?php echo $transferInfoData['sno'];?></td>
</tr>
<tr>
<td>Property Description</td>
<td><?php echo $transferInfoData['property_description'];?></td>
</tr>
<tr>
<td>Brand</td>
<td><?php echo $transferInfoData['brand'];?></td>
</tr>
<tr>
<td>Model</td>
<td><?php echo $transferInfoData['model'];?></td>
</tr>
<tr>
<td>Minor Description</td>
<td><?php echo $transferInfoData['minor_description'];?></td>
</tr>
<tr>
<td>Major Description</td>
<td><?php echo $transferInfoData['major_description'];?></td>
</tr>
<tr>
<td>Quantity</td>
<td><?php echo $transferInfoData['qty'];?></td>
</tr>
<tr>
<td>Unit of Measurement</td>
<td><?php echo $transferInfoData['uom'];?></td>
</tr>
<tr>
<td>Condition</td>
<td><?php echo $transferInfoData['condition_info'];?></td>
</tr>
<tr>
<td>Location</td>
<td><?php echo $transferInfoData['location'];?></td>
</tr>
<tr>
<td>Cost</td>
<td><?php echo $transferInfoData['cost'];?></td>
</tr>
<tr>
  <!-- 008-CE42-2017-001 -->
  <td>Property Image</td>
  <td><?php echo '<img src='.$transferInfoData['imagery'].'>'?></td>
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
        $transferInfoData = $db->get("sub_property", [
          "[>]property" => ["property_id" => "id"]
        ], [
          "property.id",
          "property.pcode",
          "property.description"
        ], ["sub_property.sub_property_id" => $id]);
        $property_id = $id;
        $parent_id = $transferInfoData['id'];
        $pcode = $transferInfoData['pcode'];
        $description = $transferInfoData['description'];
      }
      //parent property div
      echo "
      <div class='listview-outlook' data-role='listview'>
        <div class='list marked'>
            <div class='list-content'>
                <span class='list-title' id='parent_title_span'>$pcode</span>
                <small class='list-subtitle' id='parent_desc_span' style='white-space: normal !important;'>$description</small>
            </div>
        </div>
      </div>";
      //change/add for parent property
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
            <div id='sub_property_div" . $subPropertyData['id'] . "' class='list'>
                <div class='list-content'>
                    <span class='list-title' id='sub_title_span'>" . $subPropertyData['pcode'] . "</span>
                    <small class='list-subtitle' id='sub_desc_span' style='white-space: normal !important;'>" . $subPropertyData['description'] . "</small>
                </div>
            </div>";
        }
      }

      echo "</div>";
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
if(isset($_POST['showQuantity']))
{
echo $_POST['transferID'];
}

?>
