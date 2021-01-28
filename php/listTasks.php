<?php  

	include('connection.php');
	session_start();

	$idUser = $_SESSION['idUser'];

	$query = "SELECT * FROM tasks WHERE idUser = '$idUser'";
	$result = mysqli_query($conn,$query);

	if (!$result) {
		die('Query Failed');
	}

	$json = array();
	while ($tasks = mysqli_fetch_array($result)) {
		$json[] = array(
			'id' => $tasks['idTask'], 
			'name' => $tasks['Name'],
			'description' => $tasks['Description']
		);
	}

	$jsonString = json_encode($json);

	echo $jsonString;

?>