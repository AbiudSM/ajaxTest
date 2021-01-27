<?php  

	include('connection.php');

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$query = "SELECT * FROM tasks WHERE idTask = '$id'";
		$result = mysqli_query($conn,$query);

		if (!$result) {
			die('Query Failed');
		}

		if($task = mysqli_fetch_array($result)) {
			$json = array(
				'id' => $task['idTask'], 
				'name' => $task['Name'],
				'description' => $task['Description'],
			);
		}

		$jsonString = json_encode($json);

		echo $jsonString;
	}

?>