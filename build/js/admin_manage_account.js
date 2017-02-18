$(document).ready(function()
{
	requestAccountability();
});

function requestAccountability()
{

	$.post("build/ajax/adminManageAccount.php",{showAccounts:1},function(data)
	{

		$('#history_loader').hide();
		$('#history_request_div').html(data);
		$('#history_request_div').show();
	});
}
function activateAccount(emp_id)
{

	console.log(emp_id);
	if($("#"+emp_id).is(' :checked'))
	{
		console.log('property checked');
		$.post("build/ajax/updateAccount.php",{emp_id:emp_id,key:1}, function(data)
		{
			$.Notify({
			caption: 'Update Success',
			content: 'Account ' + emp_id + ' is now Activated' ,
			icon: "<span class='mif-pencil icon'></span>",
			type: "success"
			});
		});
	}
	else
	{
		$.post("build/ajax/updateAccount.php",{emp_id:emp_id,key:0}, function(data)
		{
			$.Notify({
			caption: 'Update Success',
			content: 'Account ' + emp_id + ' is now Locked' ,
			icon: "<span class='mif-pencil icon'></span>",
			type: "success"
			});
		});
		console.log('property not checked');
	}
}
function addNewUser(){
  var emp_id = $("#emp_id").val();
  var first_Name = $("#first_name").val();
  var middle_name = $("#middle_name").val();
  var last_name = $("#last_name").val();
  var department = $("#department").val();
  var password = $("#password").val();

    $.post("build/ajax/addNewUser.php",{emp_id:emp_id, first_Name:first_Name, middle_name:middle_name, last_name:last_name, department:department, password:password},function(data)
    {
      var res = parseInt(data);
      if(res == -1){
        $.Notify({
          caption: 'Insert Failed',
            content: 'User already Exists' ,
            icon: "<span class='mif-floppy-disk icon'></span>",
            type: "warning"
        });
      }
      else if(res == 1){
        $.Notify({
          caption: 'Insert Success',
            content: 'User Successfully Added' ,
            icon: "<span class='mif-floppy-disk icon'></span>",
            type: "success"
        });
        var emp_id = $("#emp_id").val('');
        var first_Name = $("#first_name").val('');
        var middle_name = $("#middle_name").val('');
        var last_name = $("#last_name").val('');
        var department = $("#department").val('');
        var password = $("#password").val('');
        hideMetroDialog('#addNewUser');
      }
    });
}
function editUser(employeeId,employee_fname,employee_mname,employee_lname,employee_department)
{
	$("#employeeID").val(employeeId);
	$("#updateFName").val(employee_fname);
	$("#updateMName").val(employee_mname);
	$("#updateLName").val(employee_lname);
	$("#updateDepartment").val(employee_department);
}
function updateUser(){
	var emp_id = $("#employeeID").val();
	var empfirst = $("#updateFName").val();
	var empmiddle = $("#updateMName").val();
	var emplast = $("#updateLName").val();
	var empdepartment = $("#updateDepartment").val();
	var oldpass = $("#oldPassword").val();
	var emppass = $("#updatePassword").val();
	var confirmpass = $("#passwordCheck").val();
	$.post("build/ajax/updateUser.php",{emp_id:emp_id ,empfirst:empfirst ,empmiddle:empmiddle, emplast: emplast, empdepartment:empdepartment ,emppass:emppass ,oldpass:oldpass ,confirmpass:confirmpass },function(data)
	{
		var result = parseInt(data);
		if(result == 1){
			$.Notify({
				caption: 'Update Success',
					content: 'User Update Success' ,
					icon: "<span class='mif-pencil icon'></span>",
					type: "success"
			});
			requestAccountability();
			hideMetroDialog("#editUser");
			console.log(data);
			//success
		}
		else if (result == 2) {
			$.Notify({
				caption: 'User Update Failed',
					content: 'Please Check your Old password' ,
					icon: "<span class='mif-pencil icon'></span>",
					type: "alert"
			});
			console.log(data);

		}
		else if (result == 3) {
			$.Notify({
				caption: 'User Update Failed',
					content: 'Password mismatch' ,
					icon: "<span class='mif-pencil icon'></span>",
					type: "alert"
			});
			console.log(data);

		}
		else{
			//server error
		}
	});
}
function deleteUserView(employeeId)
{
	$("#deleteUserId").val(employeeId);
	$("#userID").html(employeeId);
}
function deleteUser()
{
	var emp_id=$("#deleteUserId").val();
	$.post("build/ajax/deleteUser.php",{emp_id : emp_id },function(data)
	{
		var result = parseInt(data);
		if (result == 1) {
			$.Notify({
				caption: 'Delete Success',
					content: 'User Deleted' ,
					icon: "<span class='mif-bin icon'></span>",
					type: "alert"
			});
			hideMetroDialog('#deleteUser');
		}
		 else {
			console.log(data);
			$.Notify({
				caption: 'Delete Failed',
					content: 'Theres a problem with the server' ,
					icon: "<span class='mif-bin icon'></span>",
					type: "warning"
			});
			//problem with the server
		}
	});
}
