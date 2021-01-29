<?php  

include('connection.php');
session_start();

if (isset($_POST['email'])) {

	// User Data
	$name = $_POST['name'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$hashedPass = password_hash($pass, PASSWORD_DEFAULT);
	$dateTime = date('Y-m-d H:i:s');


	// Username validation
	$queryName = "SELECT * FROM usuarios WHERE Name = '$name'";
	$resultName = mysqli_query($conn,$queryName);

	// Email validation
	$queryEmail = "SELECT * FROM usuarios WHERE Email = '$email'";
	$resultEmail = mysqli_query($conn,$queryEmail);

	if ($nameVal = mysqli_fetch_array($resultName)) {
		echo 'Username already exists';
	}elseif ($emailVal = mysqli_fetch_array($resultEmail)) {
		echo 'Email already exists';
	}else{
		// Register user
		$query = "INSERT INTO usuarios (Name, Email, Password, RegisterDate) VALUES ('$name','$email','$hashedPass','$dateTime')";
		$result = mysqli_query($conn,$query);

		if (!$result) {
			die('Query Failed');
		}

		// Success login validation
		$successLogin = "SELECT * FROM usuarios WHERE Name = '$name'";
		$resultSuccessLogin = mysqli_query($conn,$successLogin);
		$user = mysqli_fetch_array($resultSuccessLogin);
		$_SESSION['idUser'] = $user['idUsuario'];

		echo "Successfully registered user";

	}

}

?>