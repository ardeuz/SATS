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
function showRequests(){
  
}
