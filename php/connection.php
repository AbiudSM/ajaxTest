<?php 
	
	$conn = mysqli_connect(
		'localhost',	// DB Host
		'root',			// DB User
		'',				// DB Password
		'pruebas'		// DB Name
	);

	if (!$conn) {
		echo 'Database Error';
	}

?>