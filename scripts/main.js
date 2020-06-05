//function to login
function login() {
	event.preventDefault();
	var username = $("#username");
	var password = $("#password");
	var inputError = false;
	var errorMsg = "";
	username.removeClass('input-error');
	password.removeClass('input-error');

	if (username.val() == "") {
		inputError = true;
		username.addClass('input-error');
		errorMsg = "Please enter your username!";
	}

	if (password.val() == "") {
		inputError = true;
		password.addClass('input-error');
		if (errorMsg) {
			errorMsg += " Please enter your password!";
		}
		else {
			errorMsg = "Please enter your password!";
		}
	}

	if (inputError == false) {
		$.ajax({
			method: 'POST',
			url: 'login.php',
			data: $("#login-form").serialize(),
			success: function(data) {
				if (data == 1) {
					window.location.href = 'home.html';
				}
				else {
					var errorMsg = "Wrong username or password!";
					$(".error").html(errorMsg);
				}
			}
		});
	}
	$(".error").html(errorMsg);
}

//function to check session
function check_session () {
	$.post("check_session.php", {
		column_name: "username"
	}).done(function (data) {
		if (data == 0) {
			window.location.href='index.html';
			var errorMsg = 'Session expired!';
			$(".error").html(errorMsg);
		}
		else {
			$("#session_username").html(data);
		}
	});
}
//function to open menu
function Toggle (item) {
	$("#"+item).slideToggle(1000);
}

//function to check passwords
function checkPasswords () {
    var Password1 = $('#Password1');
    var Password2 = $('#Password2');
    if (Password1.val() != Password2.val()) {
        $('#passwordStatus').addClass('error');
        $('#passwordStatus').html('Passwords do not match!');
        $('#btn-submit').attr("disabled", true);
    }
    else {
        $('#passwordStatus').removeClass('error');
        $('#passwordStatus').addClass('green');
        $('#passwordStatus').html('Passwords match!');
        $("#btn-submit").removeAttr("disabled");
	}
}


//function to set data from the table admin
function getAdminsData(column) {
	$.post("admins_data.php", {
		column: column}).done(function(data) {
			$('#'+column).val(data);
		});
}

//function to update data from the table admin
function selfUpdateAdmin() {
	event.preventDefault();

	var email = $("#email");
	var mobile = $("#mobile");
	var response = $("#response");

	var inputError = false;
	var errorMsg = "";
	email.removeClass('input-error');
	mobile.removeClass('input-error');
	response.removeClass('input-error');

	if (email.val() == "") {
		var inputError = true;
		email.addClass('input-error');
		if (errorMsg) {
			errorMsg += "Email cannot be blank!";
		}
		else {
			errorMsg = "Email cannot be blank!"
		}
	}

	if (mobile.val() == "") {
		var inputError = true;
		mobile.addClass('input-error');
		if (errorMsg) {
			errorMsg += "Mobile number cannot be blank!";
		}
		else {
			errorMsg = "Mobile number cannot be blank!"
		}
	}

	if (inputError == true) {
		response.addClass('error');
	}

	if (inputError == false) {
		$.ajax({
			method: 'POST',
			url: 'reset_password.php',
			data: $("#reset_password-form").serialize(),
			success: function (data){
				if (data === 'email') {
					var errorMsg = "Please enter a valid email!";
					response.addClass('error');
					response.html(errorMsg);
				}
				else {
					response.removeClass('error');
					response.html(data);
				}
			}
		});
	}
	$("#response").html(errorMsg);
}

//function to create new admin
function createNewAdmin () {
	var username = $("#username");
	var email = $("#email");
	var mobile = $("#mobile");
	var response = $("#response");

	var errorMsg = "";
	var inputError = false;
	username.removeClass('input-error');
	email.removeClass('input-error');
	mobile.removeClass('input-error');
	response.removeClass('error');


	if (username.val().trim() == "") {
		username.addClass('input-error');
		inputError = true;
		if (errorMsg) {
			errorMsg += ' Please enter username!';
		}
		else {
			errorMsg = 'Please enter username!';
		}
	}

	if (email.val().trim() == "") {
		email.addClass('input-error');
		inputError = true;
		if (errorMsg) {
			errorMsg += ' Please enter email!';
		}
		else {
			errorMsg = 'Please enter email!';
		}
	}

	if (mobile.val().trim() == "") {
		mobile.addClass('input-error');
		inputError = true;
		if (errorMsg) {
			errorMsg += ' Please enter mobile number!';
		}
		else {
			errorMsg = 'Please enter mobile number!';
		}
	}

	if (inputError == true) {
		response.addClass('error');
	}

	if (inputError == false) {
		$.ajax({
			method: 'POST',
			url: 'admins.php',
			data: $("#admins-form").serialize(),
			success: function (data) {
				if (data === 'email') {
					email.addClass('input-error');
					response.addClass('error');
					response.html('Please enter a valid email!');
				}
				else {
					email.removeClass('input-error');
					response.addClass('error');
					if (data >= 1) {
						username.addClass('input-error');
						response.addClass('error');
						errorMsg = "Username already exist! Please choose another username!";
						response.html(errorMsg);
					}
					else {
						username.removeClass('input-error');
						response.removeClass('error');
						response.html(data);
					}
				}
			}
		});
	}
	response.html(errorMsg);
}

//function to change data load
function changeData(target, page) {
	$("#"+target).load(page);	
}

//function to allow edit data
function allowEditData (id) {
	$('.class' + id).removeAttr("readonly");
	$('#btn-submit'+ id).removeAttr("disabled");
}

//function to submit Admins data
function updateAdminsData(id) {
	
	var username = $("#username" + id);
	var email = $("#email" + id);
	var mobile = $("#mobile" + id);
	var response = $("#response1");

	var inputError = false;
	var errorMsg = "";
	username.removeClass('input-error');
		
	if (username.val().trim() == "") {
		inputError = true;
		username.addClass('input-error');
		response.addClass('error');
		errorMsg += " Please enter a username!";
		response.html(errorMsg);
	}

	if (email.val().trim() == "") {
		inputError = true;
		email.addClass('input-error');
		response.addClass('error');
		errorMsg += " Please enter an email!";
		response.html(errorMsg);
	}

	if (mobile.val().trim() == "") {
		inputError = true;
		mobile.addClass('input-error');
		response.addClass('error');
		errorMsg += " Please enter mobile number!";
		response.html(errorMsg);
	}

	if (inputError == false) {
		$.post ("admins_data_update.php", {
			username: username.val().trim(),
			email: email.val().trim(),
			mobile: mobile.val().trim(),
			adminsId: id
		}, function (data) {
			email.removeClass('input-error');
			response.removeClass('error');
			var errorMsg = "";
			if (data == 'email') {
				email.addClass('input-error');
				response.addClass('error');
				errorMsg = "Please enter a valid email!";
				response.html(errorMsg);
			}
			else {
				email.removeClass('input-error');
				response.removeClass('error');
				errorMsg = "";
				response.html(errorMsg);

				if (data >= 1) {
					response.addClass('error');
					errorMsg = "Username already exists! Please choose another username!";
					response.html(errorMsg);
				}
				else {
					response.removeClass('input-error');
					response.removeClass('error');
					response.html(data);
					$(".class" + id).attr("readonly", "readonly");
					$('#btn-submit'+ id).attr("disabled", "disabled");
				}
			}
		});
	}	
}

//function to change users_data_page
function change_users_data_page (users_data_page) {
	$("#data_page").val(users_data_page);
}


//function to reset Users password
function resetPassword (id) {
	var r = confirm("Are you sure you want to reset the password for this user?");
	if (r == true) {
		$.post("reset_user_password.php", {
			UsersId: id
		}, function (data) {
			$("#response1").html(data);
		});
	}	
}

//function to update Users data
function updateUsersData(id) {
	var Title = $("#Title" + id);
	var Name = $("#Name" + id);
	var Mobile = $("#Mobile" + id);
	var DOB = $("#DOB" + id);
	var Address = $("#Address" + id);
	var Town = $("#Town" + id);
	var State = $("#State" + id);
	var CountryCode = $("#CountryCode" + id);
	var response = $("#response1");

	var inputError = false;
	var errorMsg = "";

	response.removeClass('error');
	response.html("");
	Name.removeClass('input-error');
	Mobile.removeClass('input-error');

	if (Name.val().trim() == "") {
		inputError = true;
		Name.addClass('input-error');
		errorMsg += "Please enter a name! ";
		response.addClass('error');
		response.html(errorMsg);
	}

	if (Mobile.val().trim() == "") {
		inputError = true;
		Mobile.addClass('input-error');
		errorMsg += "Please enter a mobile number! ";
		response.addClass('error');
		response.html(errorMsg);	
	}

	if (DOB.val().trim() == "") {
		inputError = true;
		DOB.addClass('input-error');
		errorMsg += "Please enter a date of birth! ";
		response.addClass('error');
		response.html(errorMsg);	
	}

	if (Address.val().trim() == "") {
		inputError = true;
		Address.addClass('input-error');
		errorMsg += "Please enter address! ";
		response.addClass('error');
		response.html(errorMsg); 
	}

	if (Town.val().trim() == "") {
		inputError = true;
		Town.addClass('input-error');
		errorMsg += "Please enter town! ";
		response.addClass('error');
		response.html(errorMsg);
	}

	if (State.val().trim() == "") {
		inputError = true;
		State.addClass('input-error');
		errorMsg += "Please enter state! ";
		response.addClass('error');
		response.html(errorMsg);
	}

	if (inputError == false) {
		$.post("users_data_update.php", {
			Id: id,
			Title: Title.val().trim(),
			Name: Name.val().trim(),
			Mobile: Mobile.val().trim(),
			DOB: DOB.val().trim(),
			Address: Address.val().trim(),
			Town: Town.val().trim(),
			State: State.val().trim(),
			CountryCode: CountryCode.val()
		}, function(data) {
			$(".class" + id).attr("readonly", "readonly");
			$('#btn-submit'+ id).attr("disabled", "disabled");
			response.html(data);
		});
	}
}

//function to reload users data grid / table
function reloadUsersData() {
	var page = $("#data_page").val();
	var sorting = $("#sorting");
	var limit = $("#limit");
	var search = $("#search");
	
	$.post(page, {
		sorting: sorting.val(),
		limit: limit.val(),
		search: search.val().trim()
	}, function(data) {
		$("#users-data").html(data);
	});
}

//function to export Users data
function exportData(page) {
	var sorting = $("#sorting");
	var limit = $("#limit");
	var search = $("#search");
	window.location.href = page+'?search='+search.val().trim()+'&limit='+limit.val()+'&sorting='+sorting.val();	
}

//////                   Functions for Messages //////

//function to mark as read or unread
function readUnread (value, MessagesId) {
	$.post('read_unread.php', {
		value: value,
		MessagesId: MessagesId
	}, function(data) {
		if (data == 'OK') {
			reloadMessagesData ();
		}
		else {
			alert(data);
		}
	});
}

// function to reload messages 
function reloadMessagesData() {
	var sorting = $("#sorting");
	var limit = $("#limit");
	var search = $("#search");

	$.post('messages_data_grid.php', {
		sorting: sorting.val(),
		limit: limit.val(),
		search: search.val().trim()
		}, function (data) {
			$("#messages-data").html(data);
	});
}