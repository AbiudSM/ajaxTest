<?php  

	include('connection.php');

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$query = "DELETE FROM tasks WHERE idTask = '$id'";
		$result = mysqli_query($conn,$query);
		if ($result) {
			echo "Task deleted successfully";
		}else{
			die('Query Failed');
		}
	}

?>