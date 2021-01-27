<?php 

	include('connection.php');

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$description = $_POST['description'];

		$query = "UPDATE tasks SET Name = '$name', Description = '$description' WHERE idTask = '$id'";
		$result = mysqli_query($conn,$query);

		if (!$result) {
			die('Query Failed');
		}

		echo "Update Task Successfully";
	}

?>