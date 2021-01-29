<?php 

include('connection.php');

if (isset($_POST['id'])) {

	// User Data
	$id = $_POST['id'];

	$name = $_POST['name'];
	$email = $_POST['email'];

	$newName = $_POST['newName'];
	$newEmail = $_POST['newEmail'];

	// Username validation
	$queryName = "SELECT * FROM usuarios WHERE Name = '$newName'";
	$resultName = mysqli_query($conn,$queryName);

	// Email validation
	$queryEmail = "SELECT * FROM usuarios WHERE Email = '$newEmail'";
	$resultEmail = mysqli_query($conn,$queryEmail);


	if (($nameVal = mysqli_fetch_array($resultName) && ($name != $newName))) {
		echo 'Username already exists';
	}elseif (($emailVal = mysqli_fetch_array($resultEmail) && ($email != $newEmail))) {
		echo 'Email already exists';
	}else{

		// Update user account
		$query = "UPDATE usuarios SET Name = '$newName', Email = '$newEmail' WHERE idUsuario = '$id'";
		$result = mysqli_query($conn,$query);

		if (!$result) {
			die('Query Failed');
		}

		echo "User Account Successfully Update";
	}

}

?>