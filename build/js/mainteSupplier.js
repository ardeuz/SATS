requestAccountability();
function requestAccountability()
{
	$.post("build/ajax/adminSupplierMaintenance.php",{showAccounts:1},function(data)
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
function addSupplier()
{
  var newMajor = $("#supplier").val();
  $.post("build/ajax/addNewSupplier.php",{ newMajor : newMajor},function(data)
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
        $('#supplier').val('');
        hideMetroDialog('#addSupplier');

    } else {
      console.log(data);
    }
  });
}
function EditMajor(supplierID,supplierName)
{
	var propertyID = parseInt(supplierID);
	$("#supplierVal").val(supplierName);
	$("#editSupplierID").val(propertyID);
	// ano ano ieedit dine
}
function updateMajor()
{
  var editSupplierID = $("#editSupplierID").val();
	var supplierVal = $("#supplierVal").val();
  $.post("build/ajax/updateSupplier.php",{supplierVal : supplierVal, editSupplierID : editSupplierID,},function(data)
  {
    var result = parseInt(data);
    console.log(data);
    if(result == 1)
    {
      console.log("update Complete");
      $.Notify({
        caption: 'Update Success',
          content: 'Supplier is not been changed' ,
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
			console.log(data);
      console.log("update");
      hideMetroDialog("#editMajorDialog");
      $.Notify({
				caption: 'Update Success',
					content: 'Supplier has been updated' ,
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
function deleteSuppliers(supplierID)
{
	var propertyID = parseInt(supplierID);
	$("#deleteSupplierID").val(propertyID);
}
function deleteSupplier()
{
	var pcode=$("#deleteSupplierID").val();
	$.post("build/ajax/deleteSupplier.php",{pcode : pcode },function(data)
	{
		var result = parseInt(data);
		if (result == 1) {
			$.Notify({
				caption: 'Delete Success',
					content: 'Supplier Deleted' ,
					icon: "<span class='mif-bin icon'></span>",
					type: "alert"
			});
			hideMetroDialog('#deleteSupplier');
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
