showRequestForms();
showRequest();
historyBorrow();
function confirmYes()
{
        $.Notify({
            caption: "Transfer Confirmation Success",
            content: "the request have been approved",
            icon: "<span class='mif-checkmark icon'></span>",
            type: "success"
        });
}
function confirmNo()
{
		hideMetroDialog('#confirmNo');
        $.Notify({
            caption: "Transfer Confirmation Reject",
            content: "the request have been rejected",
            icon: "<span class='mif-cross icon'></span>",
            type: "alert"
        });
}
function historyBorrow()
{
	$.ajax
	({
			url : 'build/ajax/showUserHistoryBorrowRequest.php',
			async : false,
			type : 'POST',
			data :
			{
				showRequest : 1
			},
			success : function(transfer)
			{
				$("#tableBorrowHistory").html(transfer);
			}
	});
}
$('body').delegate('.showConfirmation','click',function()
{
    var showCon = $(this).attr("idUp");

    if (confirm("Are you sure you want to approved this borrow request?")) {
        $.post("build/ajax/updateBorrowForm.php",{confirmation_id:showCon},function(data)
        {
          console.log(data);
            if(data==1)
            {
                $.Notify({
                    caption: "Borrow Confirmation Success",
                    content: "the request have been approved",
                    icon: "<span class='mif-checkmark icon'></span>",
                    type: "success"
                });
                showRequest();
                showRequestForms();
            }
        });
    }
});

$('body').delegate('.requestView','click',function()
{
    var viewR = $(this).attr("idRv");
    $.ajax
    ({
            url : 'requestTable.php',
            async : false,
            type : 'POST',
            data :
            {
                showRequest : 1,
                requestID : viewR
            },
            success : function(requestInformation)
            {
                $("#requestInformations").html(requestInformation);
            }
    });
});

function pushMessage(t){
    var mes = 'Info|Implement independently';
    $.Notify({
        caption: mes.split("|")[0],
        content: mes.split("|")[1],
        type: t
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

function showRequestForms()
{
    $.post("build/ajax/showRequestFormBorrow.php",{requestType:0},function(request)
    {
        $("#requestForm").html(request);
    });
}
function showRequest()
{
  $.post("build/ajax/showRequestFormBorrow.php",{requestType:1},function(approved)
  {
      $("#approvedRequest").html(approved);
  });
}
function  approveInHistory(request_code){
  $.post('build/ajax/insertBorrowHistory.php',{request_code:request_code }, function(data){
      var result = parseInt(data);
      console.log(data);
      if(result == 1 )
      {
          $.Notify({
              caption: "Item Returned Success",
              content: "Item successfully returned",
              icon: "<span class='mif-checkmark icon'></span>",
              type: "success"
          });
          showRequest();

      }
      else if(result == 2)
      {
        $.Notify({
            caption: "Item Returned Failed",
            content: "Item error",
            icon: "<span class='mif-checkmark icon'></span>",
            type: "alert"
        });
      }
      else if(result == 3)
      {
        $.Notify({
            caption: "Item Returned Failed",
            content: "Server Error",
            icon: "<span class='mif-checkmark icon'></span>",
            type: "warning"
        });
      }
  });
}
function disapproveRequest(request_code){
  $.post('build/ajax/dissapproveBorrow.php',{request_code:request_code}, function(data)
  {
    var result = parseInt(data);
    if(result == 1){
      $.Notify({
        caption: "Item Dissapproved",
        content: "Item successfully dissapproved",
        icon: "<span class='mif-checkmark icon'></span>",
        type: "alert"
      });
      showRequestForms();
    }
  });
}
