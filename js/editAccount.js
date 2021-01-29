$(function(){

	// User information 
	var user;

	// Hidden elements
	$('#errorAlert').hide();


	// Functions
	verifyUser();


	// Add user information
	$('#editForm').submit(function(event) {
		event.preventDefault();
		$('#errorAlert').hide();

		// Get inputs data
		const userData = {
			name: user.name,
			email: user.email,
			newName: $('#userName').val(),
			newEmail: $('#userEmail').val(),
			id: user.id
		}

		// Add task to DB
		$.post('php/editAccount.php', userData, function(response) {
			
			if (response == 'User Account Successfully Update') {
				alert(response);
				window.location.href = "index.html";
			}else{
				$('#textAlert').html(response);
				$('#errorAlert').show('fast');
			}

		});
	});


	function verifyUser(){
		$.get('php/getUser.php', function(data) {
			try{
				user = JSON.parse(data);
				$('#userContainer').show();
				$('#logInNavBar').hide();
				$('#userDropdown').html(user.name);
				$('#userNavBar').show();

				// Set user information into inputs
				$('#userName').val(user.name);
				$('#userEmail').val(user.email);
				$('#userID').val(user.id);

			}
			catch{
				
				// User not logged
				window.location.href = "index.html";

			}

		});
	}
})