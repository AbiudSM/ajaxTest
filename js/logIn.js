$(function(){

	// Functions
	verifyUser();
	
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
				window.location.href = "index.html";
				console.log(user);

			}catch{

				$('#textAlert').html(response);
				$('#errorAlert').show('fast');

			}

		});

		$('#loginForm').trigger("reset");
	});


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