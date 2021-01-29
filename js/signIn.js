$(function(){

	// Functions
	verifyUser();
	
	$('#errorAlert').hide();

	$('#signinForm').submit(function(event) {
		event.preventDefault();
		$('#errorAlert').hide();

		// Password validation
		if ($('#userPassword').val() != $('#userPasswordConfirm').val()) {
			$('#textAlert').html('Passwords must match');
			$('#errorAlert').show('fast');
		}else{
			const userData = {
				name: $('#userName').val(),
				email: $('#userEmail').val(),
				pass: $('#userPassword').val()
			}

			$.post('php/signIn.php', userData, function(response) {
				
				if (response == 'Successfully registered user') {
					alert(response);
					window.location.href = "logIn.html";
				}else{
					$('#textAlert').html(response);
					$('#errorAlert').show('fast');
				}


			});

			$('#signinForm').trigger("reset");

		}

	});

	// User login validations
	function verifyUser(){
		$.get('php/getUser.php', function(data) {
			try{
				var user = JSON.parse(data);
				window.location.href = "index.html";
			}
			catch{
				console.log('Inicia sesión');
			}

		});
	}

});