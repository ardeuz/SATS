requestAccountability();
function requestAccountability()
{
	$.post("build/ajax/locationMaintenance.php",{showAccounts:1},function(data)
	{
		$('#history_loader').hide();
		$('#history_request_div').html(data);
		$('#history_request_div').show();
	});
}
function ViewProperty(propertyId)
{
		var propertyID = parseInt(propertyId);
		$.ajax
		({
						url : 'build/ajax/propertyMaintenance.php',
						async : false,
						type : 'POST',
						data :
						{
								showInformation : 1,
								prowareID : propertyID
						},
						success : function(adminDatas)
						{
								$("#adminInformation").html(adminDatas);
						}
		});
}
function EditLocation(propertyCode,location)
{
	var propertyID = parseInt(propertyCode);
  $("#locationValue").val(location);
	$("#editLocationID").val(propertyID);
	// ano ano ieedit dine
}
function updateLocation()
{
  var locationID = $("#editLocationID").val();
  var locationValue = $("#locationValue").val();
  $.post("build/ajax/updateSoloLocation.php",{locationID : locationID, locationValue : locationValue},function(data)
  {
    var result = parseInt(data);
    if(result == 1)
    {
			console.log(result);
      $.Notify({
        caption: 'Update Success',
          content: 'Location is not been changed' ,
          icon: "<span class='mif-bin icon'></span>",
          type: "warning"
      });
    }
    else if(result == 2)
    {
      console.log(result);
      $.Notify({
        caption: 'Update Failed',
          content: 'Server Error' ,
          icon: "<span class='mif-bin icon'></span>",
          type: "alert"
      });
    }
    else if(result == 3)
    {
			console.log(result);
      hideMetroDialog("#editLocationDialog");
      $.Notify({
				caption: 'Update Success',
					content: 'Location Deleted' ,
					icon: "<span class='mif-bin icon'></span>",
					type: "success"
			});
    }
    else if(result == 4)
    {
			console.log(result);
      hideMetroDialog("#editLocationDialog");
      $.Notify({
        caption: 'Update Success',
          content: 'Location is already Recorded' ,
          icon: "<span class='mif-bin icon'></span>",
          type: "warning"
      });
    }
  });
}
function DeleteLocationValidation(deleteLocationID, location)
{
	var propertyID = parseInt(deleteLocationID);
	$("#deleteLocationID").val(propertyID);
	$("#location").html(location);
}
function deleteLocation()
{
	var pcode=$("#deleteLocationID").val();
	$.post("build/ajax/deleteLocation.php",{pcode : pcode },function(data)
	{
		var result = parseInt(data);
		if (result == 1) {
			$.Notify({
				caption: 'Delete Success',
					content: 'Location Deleted' ,
					icon: "<span class='mif-bin icon'></span>",
					type: "alert"
			});
			hideMetroDialog('#deleteLocationDialog');
		}
		 else {
			console.log(data);
			$.Notify({
				caption: 'Delete Failed',
					content: 'Theres a problem with the server' ,
					icon: "<span class='mif-bin icon'></span>",
					type: "warning"
			});
			//problem with the server
		}
	});
}
function addNewLocation(){
    var newLoc = $("#newLoc").val();
    $.post("build/ajax/addNewLocation.php",{ newLoc : newLoc },function(data)
    {
      var res = parseInt(data);
      if(res == -1){
        $.Notify({
          caption: 'Insert Failed',
            content: 'Location already Exists' ,
            icon: "<span class='mif-floppy-disk icon'></span>",
            type: "warning"
        });

      }
      else if(res == 1){
        $.Notify({
          caption: 'Insert Success',
            content: 'Location Successfully Added' ,
            icon: "<span class='mif-floppy-disk icon'></span>",
            type: "success"
        });
        $('#newLoc').val('');
        hideMetroDialog('#addNewLocation');

    } else {
      console.log(data);
    }
  });
}
