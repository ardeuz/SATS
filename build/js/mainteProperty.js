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
	$("#editMinorId").select2();
	$("#subPr1").select2();

});

var subProperty = 1;
var i = 0;
function addAnotherSubProperty(){

	if(i < subProperty ){
		$.post("build/ajax/showSelectors.php",{showSelect : 1},function(data){
			$("#selectProps"+subProperty).html(data);
		$("#subProperties").append("<div class='input-control select full-size' data-role='select'><select id=subPr"+subProperty+" style='display:none;'><option value=0>Select a Property</option>"+data+"></select></div>");
		});
	}
	console.log(subProperty);
	i = i + 1;
	subProperty = subProperty + 1;
	//
	// if(i <= subProperty){
	// 	i += 1;
	// }

}
function addSubProperty(){
	if($("#minorCategory").val() == 1 ){
		$.post("build/ajax/showSelectors.php",{showSelect : 1},function(data){
			$("#selectProps1").html(data);
		$("#subProperties").append("<div class='input-control select full-size' data-role='select'><select id=subPr1 style='display:none;'><option value=0>Select a Property</option>"+data+"></select></div>");
		});
		$("#subProperty").show();
	}
	else{
		$("#subProperty").hide();
	}
}
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
	if(subProperty != 0){
		for (var a = 1; a <= subProperty; a++) {
			var appended = $("#subPr"+a).val();
			console.log(appended);
			$.post("build/ajax/addProperty.php",{appended : appended},function(data){

			});
		}
	}
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
function EditProperty(propertyCode, pcode, serialNumber, propertyDescription, brand, model, orNumber, uom, cost,minorCat,quantity)
{
	var propertyID = parseInt(propertyCode);
	$("#propertyId").val(propertyID);
	$("#propertyName").html(pcode);
	$("#editPropertyCode").val(pcode);
	$("#editSerialNumber").val(serialNumber);
	$("#editPropertyDescription").val(propertyDescription);
	$("#editBrand").val(brand);
	$("#editModel").val(model);
	$("#editQty").val(quantity);
	$("#ornumber").val(orNumber);
	$("#editUom").val(uom);
	$("#editCost").val(cost);

	// ano ano ieedit dine
}
function updateProperty()
{
	var propertyId = $("#propertyId").val();
	var editPropertyCode = $("#editPropertyCode").val();
	var editSerialNumber = $("#editSerialNumber").val();
	var editPropertyDescription = $("#editPropertyDescription").val();
	var editBrand = $("#editBrand").val();
	var editModel = $("#editModel").val();
	var editQty = $("#editQty").val();
	var ornumber = $("#ornumber").val();
	var editUom = $("#editUom").val();
	var editCost = $("#editCost").val();
	var editMinorId = $("#editMinorId").val();
	$.post("build/ajax/updateProperty.php" , {propertyId:propertyId , editQty:editQty , editPropertyCode:editPropertyCode, editSerialNumber:editSerialNumber , editPropertyDescription:editPropertyDescription, editBrand:editBrand, editModel:editModel, ornumber:ornumber , editUom:editUom , editCost:editCost , editMinorId:editMinorId  },function(data){
		var result = parseInt(data);
		if(result == 1)
		{
			$.Notify({
				caption: 'Update Property Success',
					content: 'Property Updated',
					icon: "<span class='mif-checkmark mif-ani-heartbeat mif-ani-fast icon'></span>",
					type: "success"
			});
			hideMetroDialog("#editPropertyDialog");
		}
		else if(result == 2)
		{
			$.Notify({
				caption: 'Update Failed',
					content: 'Property Code and Serial number must have a value',
					icon: "<span class='mif-cross mif-ani-flash icon'></span>",
					type: "alert"
			});
		}
		else if(result == 3)
		{
			$.Notify({
				caption: 'Update Failed',
					content: 'Server Error',
					icon: "<span class='mif-cross mif-ani-flash icon'></span>",
					type: "alert"
			});
		}
	});
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
