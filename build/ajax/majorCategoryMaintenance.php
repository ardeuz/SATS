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
    $prowareDatas = $db->select("major_category", ["id","description","depreciate_yr"
    ]);
?>
<table class="dataTable border bordered hovered full-size" >
<thead>
<tr>
<td class="sortable-column">Maintenance</td>
<td class="sortable-column">Description</td>
</tr>
</thead>
<tbody>
<?php
//query here for 1 time querying

foreach ($prowareDatas as $prowareData)
{
?>

  <tr>
  <td>
    <div class="toolbar">
    <button class="toolbar-button button primary" onclick="showMetroDialog('#editMajorDialog'); EditMajor('<?php echo $prowareData['id']; ?>','<?php echo $prowareData['description']; ?>');"><span class="mif-pencil icon"></span></button>
    <button class="toolbar-button button primary" onclick="showMetroDialog('#deleteMajorDialog'); deleteMajorValidation('<?php echo $prowareData['id']; ?>', '<?php echo $prowareData['description']; ?>');"><span class="mif-bin icon"></span></button></div>
  </td>
  <td><?php echo $prowareData['description']?></td>
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
?>
