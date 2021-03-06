

$(document).ready(function() {
    borrowTable();
    prowareTable();
  $('body').delegate('.prowareView','click',function()
  {
      var viewP = $(this).attr("idPv");
      var viewC = $(this).attr("conditionPv");
      var viewL = $(this).attr("locationPv");
      $.ajax
      ({
              url : 'accountabilitiesTable.php',
              async : false,
              type : 'POST',
              data :
              {
                  showInformation : 1,
                  prowareID : viewP,
                  condition_id: viewC,
                  location_id: viewL
              },
              success : function(prowareInformation)
              {
                  $("#propertyInformations").html(prowareInformation);
              }
      });
      $.post('build/ajax/adminShowRepairHistory.php',{showRequest : 1 , viewP : viewP},function(data){
        $("#propertyRepairHistory").html(data);
      });
      $.post('build/ajax/adminShowLocationHistory.php',{showRequests : 1 , viewPs : viewP},function(datas){
        $("#propertyLocationHistory").html(datas);
      });
  });

});
function currentBorrowView(viewP ,viewC ,viewL)
  {
      $.ajax
      ({
              url : 'build/ajax/borrowedTable.php',
              async : false,
              type : 'POST',
              data :
              {
                  showInformation : 1,
                  prowareID : viewP,
                  condition_id: viewC,
                  location_id: viewL
              },
              success : function(prowareInformation)
              {
                  $("#currentBorrowInformations").html(prowareInformation);
              }
      });
      $.post('build/ajax/adminShowRepairHistory.php',{showRequest : 1 , viewP : viewP},function(data){
        $("#propertyBorrowRepairHistory").html(data);
      });
      $.post('build/ajax/adminShowLocationHistory.php',{showRequests : 1 , viewPs : viewP},function(datas){
        $("#propertyBorrowLocationHistory").html(datas);
      });
  }
function updateLocation(propertyId, conditionId, oldLocationId) {
	var newLocationId = $("#location" + propertyId + oldLocationId + conditionId).val();
  var remarks = prompt("Changing its location will may vary to its history, please state your remarks");
  if(remarks != null)
  {
  	$.post("build/ajax/updateLocation.php", {id: propertyId, new_location_id: newLocationId, condition_id : conditionId, old_location_id : oldLocationId , remarks:remarks}, function(data) {
  		var result = parseInt(data);

  		if (result == 1)
      {
        $.Notify({
        	  caption: 'Update Success',
            content: 'Location successfully Updated' ,
            icon: "<span class='mif-pencil icon'></span>",
            type: "success"
        });
        prowareTable();

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
          content: 'Location Update failed' ,
          icon: "<span class='mif-pencil icon'></span>",
          type: "alert"
          });
  		}
  	});
  }
}
function updateCondition(propertyId, oldConditionId, locationId) {
	var newConditionId = $("#condition" + propertyId + locationId + oldConditionId ).val();
  console.log(newConditionId);
  console.log(propertyId)
  console.log(locationId);
  console.log(oldConditionId);
  while(!remarks){
    var remarks = prompt("Changing its condition will may vary to its history, please state your remarks");
  }
  if(remarks != null)
  {
  	$.post("build/ajax/updateCondition.php", {id: propertyId, remarks:remarks , new_condition_id: newConditionId, location_id : locationId, old_condition_id : oldConditionId}, function(data) {
  		var result = parseInt(data);

  		if (result == 1)
      {
        $.Notify({
        	caption: 'Update Success',
            content: 'Condition successfully Updated' ,
            icon: "<span class='mif-pencil icon'></span>",
            type: "success"
        });
        historyTable();

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
    window.open("build/reports/statusReport.php?propertyId="+propertyId+"&remarks="+remarks);
  }
}

function prowareTable()
{
    $.ajax
    ({
      url : 'accountabilitiesTable.php',
      async : false,
      type : 'POST',
      data :
      {
          showTable : 1
      },
      success : function(proware)
      {
          $("#tableProware").html(proware);
      }
    });
}
function borrowTable()
{
    $.ajax
    ({
      url : 'build/ajax/borrowedTable.php',
      async : false,
      type : 'POST',
      data :
      {
          showTable : 1
      },
      success : function(borrowTable)
      {
          $("#tableBorrowedProware").html(borrowTable);
      }
    });
}
function pushMessage(t)
{
  var mes = 'Info|Implement independently';
  $.Notify({
      caption: mes.split("|")[0],
      content: mes.split("|")[1],
      type: t
  });
}
function distributeProperty(id,pcode,empid,oldCondition,oldLocation)
{
  $("#emp_id").val(empid);
  $("#propertyId").val(id);
  $("#propertyname").html(pcode);
  $("#oldLocation").val(oldLocation);
  $("#oldCondition").val(oldCondition);
}
function itemDistribute()
{
  var emp_id = $("#emp_id").val();
  var propertyId = $("#propertyId").val();
  var oldLocation = $("#oldLocation").val();
  var oldCondition = $("#oldCondition").val();
  var quantity = $("#quantity").val();
  var itemLocation = $("#itemLocation").val();
  var itemCondition = $("#itemCondition").val();
  $.post("build/ajax/itemDistribute.php",{ propertyId:propertyId , quantity:quantity , itemLocation:itemLocation , itemCondition:itemCondition , emp_id:emp_id , oldCondition:oldCondition , oldLocation:oldLocation },function(data)
  {
      console.log(data);
      var result = parseInt(data);
      if(result == 0){
        //nabaklas na
        $.Notify({
        caption: 'Update Success',
        content: 'Item Distribution Success' ,
        icon: "<span class='mif-checkmark icon'></span>",
        type: "success"
        });
        hideMetroDialog("#propertyDistribution");
        prowareTable();
        // success
      }
      else if(result == 1){
        //exceeded Quantity
        $.Notify({
        caption: 'Update Failed',
        content: "Item Quantity Reached" ,
        icon: "<span class='mif-pencil icon'></span>",
        type: "warning"
        });
      }
      else if(result == 2){
        //same location
        $.Notify({
        caption: 'Update Failed',
        content: "you can't distribute item in the same location",
        icon: "<span class='mif-pencil icon'></span>",
        type: "warning"
        });
        // validations
      }
      else if(result == 3){
        //nothing happen
        $.Notify({
        caption: 'Update Failed',
        content: "You aren't doing anything" ,
        icon: "<span class='mif-pencil icon'></span>",
        type: "warning"
        });
        // validations

      }
      else if(result == 4){
        //failed Server
        $.Notify({
        caption: 'Update Failed',
        content: "there's a problem with the Server" ,
        icon: "<span class='mif-pencil icon'></span>",
        type: "alert"
        });
        // validations
      }
  });
}
