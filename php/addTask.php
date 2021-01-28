<?php  

	include('connection.php');
	session_start();

	$idUser = $_SESSION['idUser'];

	if (isset($_POST['name'])) {
		$name = $_POST['name'];
		$description = $_POST['description'];

		$query = "INSERT INTO tasks(idUser,name,description) VALUES ('$idUser','$name','$description')";
		$resultQuery = mysqli_query($conn,$query);

		if (!$resultQuery) {
			die('Query Failed');
		}

		echo 'Task Added Successfully';
	}

?>