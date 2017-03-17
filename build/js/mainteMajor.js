requestAccountability();
function requestAccountability()
{
	$.post("build/ajax/majorCategoryMaintenance.php",{showAccounts:1},function(data)
	{
		$('#history_loader').hide();
		$('#history_request_div').html(data);
		$('#history_request_div').show();
	});
}
// $("#majorUpload").click(function(){
// 	if(!$('#mainteUploader').val()){
// 		$.Notify({
// 			caption: 'Please inser a File',
// 				content: ' ' ,
// 				icon: "<span class='mif-ile-excel icon'></span>",
// 				type: "warning"
// 		});
// 	}
// 	else{
// 		// this.form.submit(); this.disabled=true; this.value='Uploading…';
// 	}
// });
function addNewMajor()
{
  var newMajor = $("#newMaj").val();
  var depYear = $("#depYear").val();
  $.post("build/ajax/addNewMajorCategory.php",{ newMajor : newMajor , depYear : depYear },function(data)
  {
      var res = parseInt(data);
      if(res == -1){
        $.Notify({
          caption: 'Insert Failed',
            content: 'Major Category already Exists' ,
            icon: "<span class='mif-floppy-disk icon'></span>",
            type: "warning"
        });
      }
      else if(res == 1){
        $.Notify({
          caption: 'Insert Success',
            content: 'Major Category Successfully Added' ,
            icon: "<span class='mif-floppy-disk icon'></span>",
            type: "success"
        });
        $('#newMaj').val('');
        $('#depYear').val('');
        hideMetroDialog('#addNewMajorCategory');

    } else {
      console.log(data);
    }
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
function EditMajor(propertyCode,location,depyear)
{
	var propertyID = parseInt(propertyCode);
  $("#majorValue").val(location);
	$("#editMajorID").val(propertyID);
	$("#dep_year").val(depyear);
	console.log(dep_year);
	// ano ano ieedit dine
}
function updateMajor()
{
  var majorID = $("#editMajorID").val();
	var majorValue = $("#majorValue").val();
	var depreYear = $("#dep_year").val();
  $.post("build/ajax/updateMajor.php",{majorID : majorID, majorValue : majorValue, depreYear:depreYear },function(data)
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
      hideMetroDialog("#editMajorDialog");
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
      hideMetroDialog("#editMajorDialog");
      $.Notify({
        caption: 'Update Success',
          content: 'Major Category is already Recorded' ,
          icon: "<span class='mif-bin icon'></span>",
          type: "warning"
      });
    }
  });
}
function deleteMajorValidation(deleteLocationID, location)
{
	var propertyID = parseInt(deleteLocationID);
	$("#deleteMajorID").val(propertyID);
	$("#majorVal").html(location);
}
function deleteMajor()
{
	var pcode=$("#deleteMajorID").val();
	$.post("build/ajax/deleteMajor.php",{pcode : pcode },function(data)
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
