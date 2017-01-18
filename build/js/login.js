validate();
$(function(){
    var form = $(".login-form");
    form.css({
        opacity: 1,
        "-webkit-transform": "scale(1)",
        "transform": "scale(1)",
        "-webkit-transition": ".5s",
        "transition": ".5s"
    });
});
function logIn()
  {
     $('#buttonLogIn').addClass('warning');
     document.getElementById("buttonLogIn").innerHTML="<span class='mif-ani-spin mif-spinner3 text-light'></span><span class='text-light padding10'> Logging In</span>";
  }
function pushMessage(t){
    var mes = 'Info|Implement independently';
    $.Notify({
        caption: mes.split("|")[0],
        content: mes.split("|")[1],
        type: t
     });
}
function validate()
{
}