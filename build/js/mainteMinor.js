requestAccountability();
$(document).ready(function(){
		$("#minorSelect").select2();

});
function requestAccountability()
{
	$.post("build/ajax/minorCategoryMaintenance.php",{showAccounts:1},function(data)
	{
		$('#history_loader').hide();
		$('#history_request_div').html(data);
		$('#history_request_div').show();
	});
}
function addNewMinor()
{
  var newMinor = $("#newMinor").val();
  $.post("build/ajax/addNewMinorCategory.php",{ newMinor : newMinor},function(data)
  {
      var res = parseInt(data);
      if(res == -1){
        $.Notify({
          caption: 'Insert Failed',
            content: 'Minor Category already Exists' ,
            icon: "<span class='mif-floppy-disk icon'></span>",
            type: "warning"
        });
      }
      else if(res == 1){
        $.Notify({
          caption: 'Insert Success',
            content: 'Minor Category Successfully Added' ,
            icon: "<span class='mif-floppy-disk icon'></span>",
            type: "success"
        });
        document.getElementById('newMinor').value='';
        hideMetroDialog('#addNewMinorCategory');
    } else {
      console.log(data);
    }
  });
}
function EditMinor(propertyCode,location)
{
	var propertyID = parseInt(propertyCode);
  $("#minorValue").val(location);
	$("#editMinorID").val(propertyID);
	// ano ano ieedit dine
}
function updateMinor()
{
  var minorID = $("#editMinorID").val();
  var minorValue = $("#minorValue").val();
  $.post("build/ajax/updateMinor.php",{minorID : minorID, minorValue : minorValue},function(data)
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
			hideMetroDialog('#deleteMinorDialog');
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
