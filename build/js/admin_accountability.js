requestAccountability();

$(document).ready(function(){
	$("#sub_property_select").select2();
	$("#parentData").select2();
	$("#locationsIDs").select2();
	$("#conditionsId").select2();
});
$('#uploadBulky').click(function(){
	$.Notify({
		caption: 'File Uploading',
			content: 'Please wait the system to reload...' ,
			icon: "<span class='mif-notification icon'></span>",
			type: "info",
			keepOpen:true
	});
	$("#uploadBulky").addClass('bg-lightOrange fg-white');
	$("#uploadBulky").html("<span class='mif-ani-spin mif-spinner3 text-light'></span><span class='text-light padding10'> Uploading</span>");
	this.form.submit(); this.disabled=true; this.value='Uploading…';
});
function requestAccountability()
{

	$.post("build/ajax/adminAccountability.php",{showAccounts:1},function(data)
	{
		$('#history_loader').hide();
		$('#history_request_div').html(data);
		$('#history_request_div').show();
	});
}
$('body').delegate('.adminView','click',function()
{
		var viewP = $(this).attr("idPv");
		var viewC = $(this).attr("conditionPv");
		var viewL = $(this).attr("locationPv");
		$.ajax
		({
						url : 'build/ajax/adminAccountability.php',
						async : false,
						type : 'POST',
						data :
						{
								showInformation : 1,
								prowareID : viewP,
								condition_id: viewC,
								location_id: viewL
						},
						success : function(adminDatas)
						{
							$("#adminInformation").html(adminDatas);
						}
		});
		$.post('build/ajax/adminShowRepairHistory.php',{showRequest : 1 , viewP : viewP},function(data){
			$("#adminRepairHistory").html(data);
		});
		$.post('build/ajax/adminShowLocationHistory.php',{showRequests : 1 , viewPs : viewP},function(datas){
			$("#adminLocationHistory").html(datas);
		});
});
function updateAdminCondition(propertyId, locationId, oldConditionId, emp_id) {
	var newConditionId = $("#condition" + propertyId + locationId + oldConditionId + emp_id).val();
	// while(!remarks){
  // }
	var remarks = prompt("Changing its condition will may vary to its history, please state your remarks");

  if(remarks != null)
  {
  	$.post("build/ajax/updateAdminCondition.php", {id: propertyId, remarks:remarks , new_condition_id: newConditionId, location_id : locationId, old_condition_id : oldConditionId, emp_id : emp_id}, function(data) {
  		var result = parseInt(data);

  		if (result == 1)
      {
        $.Notify({
        	caption: 'Update Success',
            content: 'Condition successfully Updated' ,
            icon: "<span class='mif-pencil icon'></span>",
            type: "success"
        });
        historyTable();

  		}
      else if(result == 2)
      {
        prowareTable();
      }
      else
      {
  			console.log(data);
        $.Notify({
          caption: 'Update Failed',
          content: 'Condition Update failed' ,
          icon: "<span class='mif-pencil icon'></span>",
          type: "alert"
          });
  		}
    });
    window.open("build/reports/statusReport.php?propertyId="+propertyId+"&remarks="+remarks);
  }
}
// $('body').delegate('.adminConfirmation','click',function(){
// 	if (confirm("Approve transfer for this request?")) {
// 		var adConfirm= $(this).attr('idAdminUp');
//
// 		$.post("build/ajax/insertHistory.php",{request_code:adConfirm},function(data)
// 	  {
// 				console.log(data);
//
// 				var result = parseInt(data);
// 				if (result == 1) {
// 					$.Notify({
// 							caption: "Transfer request approved.",
// 							content: "Item successfully aproved." ,
// 							icon: "<span class='mif-pencil icon'></span>",
// 							type: "success"
// 					});
//
// 					requestCall();
// 				}
// 	  });
// 	}
// });
