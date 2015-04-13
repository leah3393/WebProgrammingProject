<?php 
	$pid = test_input($_POST["pid"]);

	echo "PID: " . $pid;

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>