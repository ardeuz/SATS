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
function addRecommendation(recommendation_id){
	showMetroDialog("#adminAddRecommendation");
	$("#audit_id").val(recommendation_id);
}
function addedRecommendation(){
	var recommendation = $("#recommendation").val();
	var id = $("#audit_id").val();
	$.post("build/ajax/updateRecommendation.php",{recommendation : recommendation, id : id},function(data){
		$.Notify({
			caption: 'Recommendation Added',
				content: ' ' ,
				icon: "<span class='mif-plus icon'></span>",
				type: "success"
		});
		hideMetroDialog("#adminAddRecommendation");
		$("#recommendation").val("");
	});
}
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
