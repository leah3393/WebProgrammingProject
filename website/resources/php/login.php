<?php 
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);

	if(test_login($username, $password)){
		echo "true";
	}
	else{
		echo "false";
	}


	function test_login($username, $password){
		if($username == "leah" && $password == "pass"){
			return true;
		}
		else{
			return false;
		}
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>