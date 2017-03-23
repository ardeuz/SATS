requestAccountability();

function requestAccountability()
{

	$.post("build/ajax/adminRepair.php",{showAccounts:1},function(data)
	{
		$('#history_loader').hide();
		$('#history_request_div').html(data);
		$('#history_request_div').show();
	});

}
function updateRepair(repairId){
	var repairId = repairId;
	var recommendation = $("#recommend"+repairId).val();
	var cost = $("#cost"+repairId).val();
	$.post("build/ajax/updateRecommendation.php",{recommendation : recommendation, id : repairId , cost : cost },function(data){
		$.Notify({
			caption: 'Recommendation Added',
				content: ' ' ,
				icon: "<span class='mif-plus icon'></span>",
				type: "success"
		});
	});
}
function addNewRepairHistories(){
	$("#showAddHistory").slideToggle(100);
}
function addAnotherHistory(){
	var audit_id = $("#audit_id").val();
	var remarks = $("#remarks").val();
	var recommendation = $("#recommendation").val();
	var cost = $("#cost").val();
	$.post("build/ajax/addAnotherHistory.php",{ audit_id:audit_id, remarks:remarks, recommendation:recommendation, cost:cost},function(data){
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
		$("#showAddHistory").slideUp(100);
	});
}
function addRecommendation(id){
	$.post('build/ajax/adminUpdateRepairHistory.php',{showRequest : 1 , viewP : id},function(data){
		$("#adminEditRepairHistory").html(data);
		// $("#adminRepairHistory").html(1);
		// console.log(data);
	});
	showMetroDialog("#adminAddRecommendation");
	$("#audit_id").val(id);
}
// function addedRecommendation(){
// 	var recommendation = $("#recommendation").val();
// 	var id = $("#audit_id").val();
// 	$.post("build/ajax/updateRecommendation.php",{recommendation : recommendation, id : id},function(data){
// 		$.Notify({
// 			caption: 'Recommendation Added',
// 				content: ' ' ,
// 				icon: "<span class='mif-plus icon'></span>",
// 				type: "success"
// 		});
// 		hideMetroDialog("#adminAddRecommendation");
// 		$("#recommendation").val("");
// 	});
// }
$('body').delegate('.adminView','click',function()
{
		var viewP = $(this).attr("idPv");
		var viewC = $(this).attr("conditionPv");
		var viewL = $(this).attr("locationPv");
		$.ajax
		({
						url : 'build/ajax/adminAccountability.php',
						async : false,
						type : 'POST',
						data :
						{
								showInformation : 1,
								prowareID : viewP,
								condition_id: viewC,
								location_id: viewL
						},
						success : function(adminDatas)
						{
								$("#adminInformation").html(adminDatas);
						}
		});
});
