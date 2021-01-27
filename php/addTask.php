<?php  

	include('connection.php');

	if (isset($_POST['name'])) {
		$name = $_POST['name'];
		$description = $_POST['description'];

		$query = "INSERT INTO tasks(name,description) VALUES ('$name','$description')";
		$resultQuery = mysqli_query($conn,$query);

		if (!$resultQuery) {
			die('Query Failed');
		}

		echo 'Task Added Successfully';
	}

?>