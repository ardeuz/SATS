<?php
  session_start();
  require_once('../../connection.php');
  include ('../../validatePage.php');
?>
<table class="dataTable border bordered hovered full-size">
<thead>
<tr>
<td class="sortable-column">Employee ID</td>
<td class="sortable-column">Employee Name</td>
<td class="sortable-column">Department</td>
<td class="sortable-column">Maintenance</td>
<td class="sortable-column">Account Activation</td>
</tr>
</thead>
<tbody>
<?php
$accountDatas = $db -> select("account_table", ["emp_id","middle_name" , "first_name" , "last_name" , "department" , "status"]);
foreach($accountDatas as $accountData)
{
  $emp_ids = $accountData['emp_id'];

?>
<tr class="<?php if($accountData['status'] == 0){echo 'bg-red fg-white'; } ?>">
<td>
  <?php echo $accountData['emp_id']; ?>
</td>
<td><?php echo $accountData['last_name']?>, <?php echo $accountData['first_name']?></td>
<td><?php echo $accountData['department']?></td>
<td>
  <div class="toolbar">
    <button class="toolbar-button button primary" onclick="showMetroDialog('#editUser'); editUser('<?php echo  $emp_ids ?>','<?php echo $accountData['first_name']?>','<?php echo $accountData['last_name']?>','<?php echo $accountData['middle_name']?>','<?php echo $accountData['department']?>');"><span class="mif-pencil icon"></span></button>
    <button class="toolbar-button button primary"onclick="showMetroDialog('#deleteUser'); deleteUserView('<?php echo   $emp_ids;?>')"><span class="mif-bin icon"></span></button>
  </div>

</td>
<td>
  <label class="switch-original">
      <input type="checkbox" id='<?php echo $accountData['emp_id']?>'
       value='<?php echo $accountData['emp_id']?>' <?php if($accountData['status'] == 1){echo 'checked="true"'; }?> onchange='activateAccount(<?php echo "\"$emp_ids\""; ?>)'>
      <span class="check"></span>
  </label>
</td>
</tr>
<?php
}
?>
</tbody>
</table>
<script type="text/javascript">
$("table").dataTable({
});
</script>
