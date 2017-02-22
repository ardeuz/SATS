var MAX_QTY = 0;
var transfer_table;

$(document).ready(function() {

	prowareTable();
});

function prowareTable()
{


	$.ajax
	({
			url : 'transferTable.php',
			async : false,
			type : 'POST',
			data :
			{
				showTable : 1
			},
			success : function(transfer)
			{
				$("#tableTransfer").html(transfer);
			}
	});
}

function transferView(viewP,conditionPv,locationPv,employee)
{

    $.ajax
    ({
    		url : 'transferTable.php',
    		async : false,
    		type : 'POST',
    		data :
    		{
					prowareID : viewP,
					emp_id:employee,
					condition_id: conditionPv,
					location_id: locationPv,
    			showInformation : 1

    		},
    		success : function(prowareInformation)
    		{

    			$("#propertyInformations").html(prowareInformation);
    		}
    });
}



$(function(){
    $('.sidebar').on('click', 'li', function(){
        if (!$(this).hasClass('active')) {
            $('.sidebar li').removeClass('active');
            $(this).addClass('active');
        }
    })
});

function insertQuantity()
{
    var propertyid=$("#propertyid").val();
    var empId = $("#empId").val();
    var conditionId = $("#conditionId").val();
    var locationId = $("#locationId").val();
    var qtty= parseInt($("#quantity").val());
    var locationTransfer = $("#location").val();
		console.log(locationId);
    if (locationTransfer == "-1" || locationTransfer == null) {

        $.Notify({
            caption: "Put a Location",
            content: "Please specify the new location of the item.",
            icon: "<span class='mif-cross icon'></span>",
            type: "alert"
        });
    } else if (qtty > MAX_QTY) {

        $.Notify({
            caption: "Quantity Limit",
            content: "Quantity must not exceed " + MAX_QTY,
            icon: "<span class='mif-cross icon'></span>",
            type: "alert"
        });
    } else {
        $("#transfer_icon_span").addClass("mif-ani-fast mif-ani-bounce");
        setTimeout(function() {
            $("#transfer_icon_span").removeClass("mif-ani-fast mif-ani-bounce");
        }, 1000);

        $.post("build/ajax/insertPropertyTransfer.php", {id: propertyid, emp_id: empId, qty:qtty, condition_id: conditionId, location_id: locationId, location: locationTransfer}, function(data) {

            $.Notify({
                caption: "Transfer List Updated.",
                content: "Item successfully updated." ,
                icon: "<span class='mif-pencil icon'></span>",
                type: "success"
            });
						hideMetroDialog("#transferdialog");
            $("#transferForm").html(data);
        });
    }

}

function transferItem(propertyId, qty, empId, conditionId, locationId) {
    showMetroDialog('#transferdialog');
    $('#propertyid').val(propertyId);
    $('#empId').val(empId);
    $("#conditionId").val(conditionId);
    $("#locationId").val(locationId);
    $("#quantity").attr({"max" : qty});

    MAX_QTY = parseInt(qty);

    $.post("build/ajax/getLocation.php", {transferRequest: 1}, function(data) {
        $("#location").html(data);
    });
}

function pushMessage(t){
    var mes = 'Info|Implement independently';
    $.Notify({
        caption: mes.split("|")[0],
        content: mes.split("|")[1],
        type: t
    });
}

function removeEmployee(empId) {
    if (confirm("Remove this transfer request?")) {
        $.post("build/ajax/deletePropertyTransfer.php", {emp_id: empId}, function(data) {
            $("#transferForm").html(data);
        });
    }
}

function removeProperty(propertyId, locationId) {
    if (confirm("Remove this item from transfer request?")) {
        $.post("build/ajax/deletePropertyTransfer.php", {property_id: propertyId, location_id: locationId}, function(data) {
            $("#transferForm").html(data);
        });
    }
}

function requestTransfer(empId) {
		var remarks = $("#remarks").val();
    $.post("build/ajax/addTransferRequest.php", {remarks:remarks, emp_id: empId}, function(data) {
        var response = JSON.parse(data);
				// console.log(data);

        if(response.code==1)
        {
					prowareTable();

		        $.Notify({
                caption: "Transfer is added to the Queue",
                content:" ",
                icon: "<span class='mif-checkmark icon'></span>",
                type: "success"
            });

            //remove the whole request because it is submitted
            $.post("build/ajax/deletePropertyTransfer.php", {emp_id: empId}, function(data) {
                $("#transferForm").html(data);
            });
        }
        else if(response.code==2)
        {
					prowareTable();

            $.Notify({
                caption: "Item Request Error",
                content: "This item is already been added to the queue " + response.msg,
                icon: "<span class='mif-warning icon'></span>",
                type: "warning",
                timeout:7000
            });

            //remove the whole request because it is submitted
            $.post("build/ajax/deletePropertyTransfer.php", {emp_id: empId}, function(data) {
                $("#transferForm").html(data);
            });
        }
        else if(response.code== -1)
        {
            $.Notify({
                caption: "The Request is already existed",
                content: " ",
                icon: "<span class='mif-cross icon'></span>",
                type: "alert"
            });
        }
    });
}
