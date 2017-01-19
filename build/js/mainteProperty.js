requestAccountability();
function requestAccountability()
{
	$.post("build/ajax/propertyMaintenance.php",{showAccounts:1},function(data)
	{
		$('#history_loader').hide();
		$('#history_request_div').html(data);
		$('#history_request_div').show();
	});
}
$(document).ready(function() {
	$("#conditions").select2();
	$("#locations").select2();
	$("#accountCategory").select2();
	$("#minorCategory").select2();
});
function addProperty(){
  var pcode = $("#pcode").val();
  var sno = $("#sno").val();
  var propertyDescription = $("#propertyDescription").val();
  var qty = $("#qty").val();
  var brand = $("#brand").val();
  var model = $("#model").val();
  var cost = $("#cost").val();
  var uom = $("#uom").val();
  var orno = $("#orno").val();
  var locations = $("#locations").val();
  var conditions = $("#conditions").val();
  var minorCategory = $("#minorCategory").val();
  var accountCategory = $("#accountCategory").val();
  $.post("build/ajax/addProperty.php", {pcode:pcode, sno:sno, propertyDescription:propertyDescription, qty:qty, locations:locations, minorCategory:minorCategory, accountCategory:accountCategory, conditions:conditions, brand:brand, model:model, cost:cost, uom:uom, orno:orno} ,function(data)
  {
    var result = parseInt(data);

    if (result == 1) {
      $.Notify({
      	caption: 'Insert Success',
          content: 'Property Added' ,
          icon: "<span class='mif-floppy-disk icon'></span>",
          type: "success"
      });
      hideMetroDialog('#adminAdd');
			location.reload();
		} else if (result == -1) {
      $.Notify({
        caption: 'Insert Failed',
          content: 'Serial number already Exists' ,
          icon: "<span class='mif-floppy-disk icon'></span>",
          type: "alert"
      });
      //serial number already exists
    } else {
      console.log(data);
      $.Notify({
        caption: 'Insert Failed',
          content: 'Theres a problem with the server' ,
          icon: "<span class='mif-floppy-disk icon'></span>",
          type: "warning"
      });
      //problem with the server
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
function EditProperty(propertyCode)
{
	var propertyID = parseInt(propertyCode);
	$("#propertyId").val(propertyID);
	// ano ano ieedit dine
}
function DeletePropertyValidation(propertyCode,pcode)
{
	var propertyID = parseInt(propertyCode);
	$("#deletePropertyID").val(propertyID);
	$("#propertyCode").html(pcode);
}
function DeleteProperty()
{
	var pcode=$("#deletePropertyID").val();
	$.post("build/ajax/deleteProperty.php",{pcode : pcode },function(data)
	{
		var result = parseInt(data);
		if (result == 1) {
			$.Notify({
				caption: 'Delete Success',
					content: 'Property Deleted' ,
					icon: "<span class='mif-bin icon'></span>",
					type: "alert"
			});
			requestAccountability();
			hideMetroDialog('#deletePropertyDialog');
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
