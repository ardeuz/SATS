showRequestForms();

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

$('body').delegate('.showConfirmation','click',function()
{
    var showCon = $(this).attr("idUp");
    var emp_approval = $("#emp_approval").val();
    if (confirm("Are you sure you want to approved this transfer request?")) {
        $.post("build/ajax/updateRequestIssuanceForm.php",{confirmation_id:showCon, emp_approval:emp_approval},function(data)
        {
            var result = parseInt(data);
            console.log(data);
            if(result == 1)
            {
              $.Notify({
                  caption: "Issuance Confirmation Success",
                  content: "the request have been approved",
                  icon: "<span class='mif-checkmark icon'></span>",
                  type: "success"
              });
              showRequestForms();
            }
        });

    }
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
    $.post("build/ajax/showIssuanceRequestForm.php",{requestType:1},function(request)
    {
        $("#requestForm").html(request);
        console.log(request);

    });
    $.post("build/ajax/showIssuanceRequestForm.php",{requestedType:1},function(approved)
    {
        $("#approvedRequest").html(approved);
    });
}
function disapproveRequest(request_code){
  var emp_approval = $("#emp_approval").val();
  $.post('build/ajax/dissapproveIssuance.php',{emp_approval:emp_approval, request_code:request_code}, function(data)
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
