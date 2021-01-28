$(function(){
	
	$('#errorAlert').hide();

	$('#loginForm').submit(function(event) {
		event.preventDefault();
		const userData = {
			name: $('#userName').val(),
			pass: $('#userPassword').val()
		}

		$.post('php/logIn.php', userData, function(response) {
			try{
				// If user is found
				let user = JSON.parse(response);
				console.log(user);

			}catch{

				$('#textAlert').html(response);
				$('#errorAlert').show('fast');

			}

		});

		$('#loginForm').trigger("reset");
	});

});