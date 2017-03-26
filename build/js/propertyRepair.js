

$(document).ready(function() {
    prowareTable();
  $('body').delegate('.prowareView','click',function()
  {
      var viewP = $(this).attr("idPv");
      var viewC = $(this).attr("conditionPv");
      var viewL = $(this).attr("locationPv");
      $("#historyID").val(viewP);
      $.ajax
      ({
              url : 'build/ajax/showUserRepair.php',
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
function prowareTable()
{
    $.ajax
    ({
      url : 'build/ajax/showUserRepair.php',
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
function addNewHistoryRepair(){
  $("#addHistory").slideToggle(100);
}
function addHistoryRepair(){
  var audit_id = $("#historyID").val();
  var remarks = $("#remarks").val();
  var recommendation = $("#recommendation").val();
  var cost = $("#cost").val();
  $.post("build/ajax/userAddRepair.php",{ audit_id:audit_id, remarks:remarks, recommendation:recommendation, cost:cost},function(data){
    $.Notify({
      caption: 'Repair History Added',
        content: ' ' ,
        icon: "<span class='mif-plus icon'></span>",
        type: "success"
    });
    console.log(data);
    $("#cost").val("");
    $("#recommendation").val("");
    $("#remarks").val("");
    $("#addHistory").slideUp(100);
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
