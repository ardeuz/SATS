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
function showConfirmation()
{
    showMetroDialog('#confirmYes');
}

$('body').delegate('.showConfirmation','click',function()
{
    var showCon = $(this).attr("idUp");

    if (confirm("Are you sure you want to approved this transfer request?")) {
        $.post("build/ajax/updateRequestForm.php",{confirmation_id:showCon},function(data)
        {
            if(data==1)
            {
                $.Notify({
                    caption: "Transfer Confirmation Success",
                    content: "the request have been approved",
                    icon: "<span class='mif-checkmark icon'></span>",
                    type: "success"
                });
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
    $.post("build/ajax/showRequestForm.php",{requestType:0},function(request)
    {
        $("#requestForm").html(request);
        console.log(request);
    });
    $.post("build/ajax/showRequestForm.php",{requestType:1},function(approved)
    {
        $("#approvedRequest").html(approved);
        console.log(approved);
    });
}