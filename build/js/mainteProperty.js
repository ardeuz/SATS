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
	$("#majorCategory").select2();
	$("#editMinorId").select2();
	$("#editSpplierSelecter").select2();
	$("#supplierSelecter").select2();
	// if($("#parent").checked){
	// 	$("#parentProperty").hide();
	// 	$("#subProperty").show();
	// }
	$('#parent').change(function(){
        if(this.checked){
						if($("#parentProperty").show()){
							$("#parentProperty").hide();
							$("#parPrDiv").remove();
							$('#subProperty').show();
							$('#sub').prop('checked',false);
						}	else {
							$('#subProperty').show();
						}
        }	else {
					//to reset to zero subPR and var I in adding dynamically element
						for (var h = 0; h <= subProperty; h++) {
							$("#divCount"+h).remove();
						}
						$('#subProperty').hide();
						if(subProperty != 0 && i != -1){
							subProperty = 0;
							i = -1;
						}

				}
    });
	$('#sub').change(function(){
			if(this.checked){
				// to check if the subProperty div is onshow
				// if show hide it and reset the sub Property counts

				if($('#subProperty').show()){
					$('#parent').prop('checked',false);
					for (var h = 0; h <= subProperty; h++) {
						$("#divCount"+h).remove();
					}
					$('#subProperty').hide();
					if(subProperty != 0 && i != -1){
						subProperty = 0;
						i = -1;
					}
					$('#subProperty').hide();
					$.post("build/ajax/showSelectorsParent.php",{showSelect : 1},function(data){
						$("#selectProps1").html(data);
						$("#parentProperties").append("<div class='input-control select full-size' data-role='select' id='parPrDiv'><select id=parPr style='display:none;'><option value=0>Select a Property</option>"+data+"></select></div>");
					});
					$("#parentProperty").show();
				}	else {
					$.post("build/ajax/showSelectorsParent.php",{showSelect : 1},function(data){
						$("#selectProps1").html(data);
						$("#parentProperties").append("<div class='input-control select full-size' data-role='select' id='parPrDiv'><select id=parPr style='display:none;'><option value=0>Select a Property</option>"+data+"></select></div>");
					});
					$("#parentProperty").show();
				}
			}	else {
				$("#parPrDiv").remove();
				$("#parentProperty").hide();
			}
	});
	$('#rental').change(function(){
		if(this.checked){
			$("#rentalEquipments").slideDown(100);
		} else {
			$("#rentalEquipments").slideUp(100);
		}
	});
});

var subProperty = 0;
var i = -1;
function addAnotherSubProperty(){

	if(i < subProperty ){
		$.post("build/ajax/showSelectors.php",{showSelect : 1},function(data){
			$("#selectProps"+subProperty).html(data);
		$("#subProperties").append("<div class='input-control select full-size' data-role='select' id='divCount"+subProperty+"'><select id='subPr"+subProperty+"' style='display:none;'><option value=0>Select a Property</option>"+data+"></select></div>");
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


	// if($("#minorCategory").val() ==  ){
	// 	$.post("build/ajax/showSelectorsParent.php",{showSelect : 1},function(data){
	// 	$("#selectProps1").html(data);
	// 	$("#parentProperties").append("<div class='input-control select full-size' data-role='select'><select id=parPr style='display:none;'><option value=0>Select a Property</option>"+data+"></select></div>");
	// 	});
	// 	$("#subProperty").hide();
	// 	$("#parentProperty").show();
	// }
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
	var rental = $("#supplierSelecter").val();
	var dateAcquired = $("#dateAcquired").val();
  var locations = $("#locations").val();
  var conditions = $("#conditions").val();
	var majorCategory = $("#majorCategory").val();
	var minorCategory = $("#minorCategory").val();
  var accountCategory = $("#accountCategory").val();
  $.post("build/ajax/addProperty.php", { rental:rental , dateAcquired : dateAcquired , pcode:pcode, majorCategory:majorCategory, sno:sno, propertyDescription:propertyDescription, qty:qty, locations:locations, minorCategory:minorCategory, accountCategory:accountCategory, conditions:conditions, brand:brand, model:model, cost:cost, uom:uom, orno:orno} ,function(data)
  {
		console.log(data);
    var result = parseInt(data);

    if (result == 1) {
      $.Notify({
      	caption: 'Insert Success',
          content: 'Property Added' ,
          icon: "<span class='mif-floppy-disk icon'></span>",
          type: "success"
      });
			$("#pcode").val("");
			$("#sno").val("");
			$("#propertyDescription").val("");
			$("#qty").val("");
			$("#brand").val("");
			$("#model").val("");
			$("#cost").val("");
			$("#uom").val("");
			$("#orno").val("");
			$("#dateAcquired").val("");
			$('#locations').select2("val","0");
			$('#accountCategory').select2("val","0");
			$('#majorCategory').select2("val","0");
			$('#minorCategory').select2("val","0");
			$('#conditions').select2("val","0");
			// $('#location').prop('selectedIndex', -1);
			$("#addProperty").ajaxForm(function(data) {
				console.log(data);
				$.Notify({
					caption: 'Update Property Success',
						content: 'Property Updated',
						icon: "<span class='mif-checkmark mif-ani-heartbeat mif-ani-fast icon'></span>",
						type: "success"
				});
			}).submit();
			hideMetroDialog("#adminAdd");
			if($("#parent").show()){
				addPropertyWithSub();
			} else if ($("#sub").show()) {
				var parent = $("#parPr").val();
				$.post("build/ajax/addNewPropertyParent.php",{parent : parent},function(data){
					console.log(data);
					 location.reload();
				});
			}


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
	// if($('#minorCategory').val() == 1){
	// 	addPropertyWithSub();
	// }
	// else if ($('#minorCategory').val() == 2) {

	// }
	// else if ($('#minorCategory').val() != 1 || $('#minorCategory').val() == 2) {
	// 	location.reload();
	// }


}
function addPropertyWithSub(pcode){
	if(subProperty != 0){
		for (var a = 0; a <= subProperty; a++) {
			var appended = $("#subPr"+a).val();
			console.log(appended);
			$.post("build/ajax/addNewPropertySub.php",{appended : appended},function(data){
				console.log(data);
			// 	setTimeout(function () {
				 location.reload();
			//  }, 2500);
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
function EditProperty(propertyCode, pcode, serialNumber, propertyDescription, brand, model, orNumber, uom, cost,minorCat,quantity ,dateAcquired, file_image, supplierId)
{
	var propertyID = parseInt(propertyCode);
	$("#propertyId").val(propertyID);
	$("#propertiesId").val(propertyID);
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
	$("#editDateAcquired").val(dateAcquired)
	$("#files").attr('src',file_image);
	if(supplierId != 0){
		$("#editSupplier").show();
	} else if(supplierId == 0){
		$("#editSupplier").hide();
	}
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
	var editDateAcquired = $("#editDateAcquired").val();
	var ornumber = $("#ornumber").val();
	var editUom = $("#editUom").val();
	var editCost = $("#editCost").val();
	var editMinorId = $("#editMinorId").val();
	var editSupplier = $("#editSpplierSelecter").val();
	$.post("build/ajax/updateProperty.php" , { editSupplier:editSupplier, editDateAcquired:editDateAcquired , propertyId:propertyId , editQty:editQty , editPropertyCode:editPropertyCode, editSerialNumber:editSerialNumber , editPropertyDescription:editPropertyDescription, editBrand:editBrand, editModel:editModel, ornumber:ornumber , editUom:editUom , editCost:editCost , editMinorId:editMinorId  },function(data){
		console.log(data);
		var result = parseInt(data);
		if(result == 1)
		{
			$("#formUpload").ajaxForm(function(datas) {
				console.log(datas);
				$.Notify({
					caption: 'Update Property Success',
						content: 'Property Updated',
						icon: "<span class='mif-checkmark mif-ani-heartbeat mif-ani-fast icon'></span>",
						type: "success"
				});
			}).submit();
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
