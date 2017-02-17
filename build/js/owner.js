showRequests();

function showRequests(){
  $.post("build/ajax/showBorrowRequest.php",{showBorrows : 1 },function(data){
    $('#requestFormBorrowPreloader').hide();
    $('#requestFormBorrow').html(data);
    $('#requestFormBorrow').show();
  });
}
