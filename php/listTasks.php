<?php  

	include('connection.php');

	$query = "SELECT * FROM tasks";
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