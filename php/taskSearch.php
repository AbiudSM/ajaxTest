<?php 

	include('connection.php');
	session_start();

	$idUser = $_SESSION['idUser'];

	if ($_POST['search']) {
		$search = $_POST['search'];

		$query = "SELECT * FROM tasks WHERE idUser = '$idUser' AND Name LIKE '$search%'";
		$resultQuery = mysqli_query($conn,$query);

		if (!$resultQuery) {
			die('Query Failed'.mysqli_error($conn));
		}

		$json = array();
		while ($task = mysqli_fetch_array($resultQuery)) {
			$json[] = array(
				'id' => $task['idTask'],
				'name' => $task['Name'],
				'description' => $task['Description'] 
			);
		}

		$jsonString = json_encode($json);

		echo $jsonString;

	}

?>