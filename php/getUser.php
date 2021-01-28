<?php  

include('connection.php');
session_start();

if ($_SESSION['idUser']) {
	$id = $_SESSION['idUser'];
	$query = "SELECT * FROM usuarios WHERE idUsuario = '$id'";
	$result = mysqli_query($conn,$query);

	if ($user = mysqli_fetch_array($result)) {
		$json = array(
			'id' => $user['idUsuario'],
			'name' => $user['Name'], 
		);
		$jsonString = json_encode($json);
		echo $jsonString;
	}

}else{
	echo "LogIn";
}

?>