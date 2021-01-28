<?php  

include('connection.php');
session_start();

if (isset($_POST['name'])) {

	$name = $_POST['name'];
	$pass = $_POST['pass'];

	$query = "SELECT * FROM usuarios WHERE Name = '$name'";
	$result = mysqli_query($conn,$query);

	if ($user = mysqli_fetch_array($result)) {
		$hashedPass = $user['Password'];
		if (password_verify($pass, $hashedPass)) {
			
			$_SESSION['idUser'] = $user['idUsuario'];

			$json = array(
				'id' => $user['idUsuario'],
				'name' => $user['Name'], 
				'password' => $user['Password']
			);
			$jsonString = json_encode($json);
			echo $jsonString;
		}else{
			$userConfirm = 'Incorrect password';
			echo $userConfirm;
		}
	}else{
		$userConfirm = 'User not found';
		echo $userConfirm;
	}
}

?>