requestCall();

function requestCall()
{
	$.post("build/ajax/adminRequest.php",{showRequest:1},function(data)
	{
		$('#approved_loader').hide();
		$('#approved_request_div').html(data);
		$('#approved_request_div').show();
	});

	$.post("build/ajax/showHistoryRequest.php",{showRequest:1},function(data)
	{
		$('#history_loader').hide();
		$('#history_request_div').html(data);
		$('#history_request_div').show();
	});
}

$('body').delegate('.adminConfirmation','click',function(){
	if (confirm("Approve transfer for this request?")) {
		var adConfirm= $(this).attr('idAdminUp');

		$.post("build/ajax/insertHistory.php",{request_code:adConfirm},function(data)
	  {
				console.log(data);

				var result = parseInt(data);
				if (result == 1) {
					$.Notify({
							caption: "Transfer request approved.",
							content: "Item successfully aproved." ,
							icon: "<span class='mif-pencil icon'></span>",
							type: "success"
					});

					requestCall();
				}
	  });
	}
});
function updateAdminCondition(propertyId, locationId, oldConditionId) {
	var newConditionId = $("#condition" + propertyId + locationId + oldConditionId).val();

	$.post("build/ajax/updateCondition.php", {id: propertyId, new_condition_id: newConditionId, location_id : locationId, old_condition_id : oldConditionId}, function(data) {
		var result = parseInt(data);

		if (result == 1)
    {
      $.Notify({
      	caption: 'Update Success',
          content: 'Condition successfully Updated' ,
          icon: "<span class='mif-pencil icon'></span>",
          type: "success"
      });
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
}
