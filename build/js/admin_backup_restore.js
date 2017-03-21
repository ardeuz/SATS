$(document).ready(function()
{
	requestAccountability();
});

function requestAccountability()
{

	$.post("build/ajax/adminBackupRestore.php",{showAccounts:1},function(data)
	{

		$('#history_loader').hide();
		$('#history_request_div').html(data);
		$('#history_request_div').show();
	});
}
function backupDb(){
	var remarks = $("#backupRemarks").val();
	$.post('build/ajax/backupDatabase.php',{remarks:remarks},function(data){
		$.Notify({
			caption: 'Backup Success',
			content: 'Database Export Success' ,
			icon: "<span class='mif-database icon'></span>",
			type: "success"
		});
  	$("#backupRemarks").val('');
		hideMetroDialog("#backupCurrentData");
		requestAccountability();
	});
}
function restoreDb(restoreId){
	var backup_id = parseInt(restoreId);
	if(confirm("Are you sure you want to Restore this Data?")){
		$.Notify({
			caption: 'Restoring Database',
			content: 'Please wait while the database is restoring' ,
			icon: "<span class='mif-database icon'></span>",
			timeOut : 10000,
			type: "info"
		});
		$.post("build/ajax/importDatabase.php",{ backup_id : backup_id },function(data){
			$.Notify({
				caption: 'Restoring Success',
				content: 'Database Import Success' ,
				icon: "<span class='mif-database icon'></span>",
				type: "success"
			});
			$.post("build/ajax/backupRemove.php",{},function(datas){
				console.log(datas);
			});
			requestAccountability();
			// console.log(data);
		});
	} else {
		$.Notify({
			caption: 'Restoring Cancelled',
			content: 'Database Import Cancelled' ,
			icon: "<span class='mif-database icon'></span>",
			type: "info"
		});
	}
}
function importDb(){

}
