requestAccountability();
function requestAccountability()
{
	$.post("build/ajax/minorCategoryMaintenance.php",{showAccounts:1},function(data)
	{
		$('#history_loader').hide();
		$('#history_request_div').html(data);
		$('#history_request_div').show();
	});
}
function EditMajor(propertyCode,location)
{
	var propertyID = parseInt(propertyCode);
  $("#minorValue").val(location);
	$("#editMinorID").val(propertyID);
	// ano ano ieedit dine
}
function updateMajor()
{
  var majorID = $("#editMinorID").val();
  var majorValue = $("#minorValue").val();
  $.post("build/ajax/updateMajor.php",{majorID : majorID, majorValue : majorValue},function(data)
  {
    var result = parseInt(data);
    console.log(data);
    if(result == 1)
    {
      console.log("update Complete");
      $.Notify({
        caption: 'Update Success',
          content: 'Major Category is not been changed' ,
          icon: "<span class='mif-bin icon'></span>",
          type: "warning"
      });
    }
    else if(result == 2)
    {
      console.log(data);
      $.Notify({
        caption: 'Update Failed',
          content: 'Server Error' ,
          icon: "<span class='mif-bin icon'></span>",
          type: "warning"
      });
    }
    else if(result == 3)
    {
      console.log("update");
      hideMetroDialog("#editMinorDialog");
      requestAccountability();
      $.Notify({
				caption: 'Update Success',
					content: 'Major Category has been updated' ,
					icon: "<span class='mif-bin icon'></span>",
					type: "success"
			});
    }
    else if(result == 4)
    {
      console.log("updat");
      hideMetroDialog("#editMinorDialog");
      requestAccountability();
      $.Notify({
        caption: 'Update Success',
          content: 'Major Category is already Recorded' ,
          icon: "<span class='mif-bin icon'></span>",
          type: "warning"
      });
    }
  });
}
function deleteMinorValidation(deleteLocationID, location)
{
	var propertyID = parseInt(deleteLocationID);
	$("#deleteMinorID").val(propertyID);
	$("#minorVal").html(location);
}
function deleteMinor()
{
	var pcode=$("#deleteMinorID").val();
	$.post("build/ajax/deleteMinor.php",{pcode : pcode },function(data)
	{
		var result = parseInt(data);
		if (result == 1) {
			$.Notify({
				caption: 'Delete Success',
					content: 'Location Deleted' ,
					icon: "<span class='mif-bin icon'></span>",
					type: "alert"
			});
			hideMetroDialog('#deleteMajorDialog');
      requestAccountability();
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
