<?php 
	$username = test_input($_POST["username"]);

	echo "Login Successful";

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>