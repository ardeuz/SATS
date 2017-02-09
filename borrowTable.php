<?php
  require_once('connection.php');
  session_start();

  $emp_id = $_SESSION['account']['emp_id'];

  if(isset($_POST['showTable']))
  {

    $transferDatas = $db->query("SELECT a.property_id AS id, b.pcode, b.sno , b.description, c.location, d.condition_info, a.emp_id, e.department, a.qty, a.condition_id, b.uom, a.location_id from property_accountability AS a left join property AS b
    on a.property_id = b.id left join location AS c on a.location_id = c.id left join
    condition_info AS d on a.condition_id = d.id inner join account_table as e on a.emp_id = e.emp_id WHERE a.emp_id !='$emp_id'")-> fetchAll();
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
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <script>
    var userShowBorrowTable = $('#userShowBorrowTable').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "build/server_side/userShowBorrowAccountability.php",
      oLanguage : {
        sProcessing : "<div data-role=\"preloader\" data-type=\"cycle\" data-style=\"color\"></div>"
      }
    });
    setInterval(function() {
      userShowBorrowTable.ajax.reload(null,false);
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

$transferInfoDatas=$db->query("SELECT b.pcode , b.sno , b.description as property_description, b.brand , b.model , c.description as major_description, d.description as minor_description, a.qty, b.uom, e.location, b.cost, f.condition_info , g.first_name, g.last_name, g.department  from property_accountability as a left join property as b on a.property_id = b.id left join minor_category as d on  b.minor_category = d.id left join major_category as c on d.major_id = c.id left join location as e on a.location_id = e.id left join condition_info as f on a.condition_id = f.id left join account_table as g on a.emp_id = g.emp_id  WHERE a.property_id=$id AND a.location_id=$location_id AND a.condition_id = $condition_id AND a.emp_id = '$employee_name'")->fetchAll();
?>

<table class="table border bordered striped" style="overflow-y:hidden; " style="height:50%;">
<tbody>
<?php
foreach ($transferInfoDatas as $transferInfoData)
{

?>
<h3 class="padding20 text-light header">Accountability of <?php echo $transferInfoData['first_name'] . ' ' . $transferInfoData['last_name']?>
<br/><small>Department of <?php echo $transferInfoData['department']?></small>
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
