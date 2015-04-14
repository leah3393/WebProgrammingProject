<?php 
	$con = mysqli_connect('localhost', 'root', '', 'realestate_db');
		if(!$con)
		{
			die('Could not connect: ' . mysqli_error($con));
		}		
		mysqli_select_db($con, "realestate_db");

	$email = test_input($_POST["email"]);
	$password = test_input($_POST["password"]);

	$query = "SELECT * FROM BUYER WHERE BUYER.email = '" . $email . "'";
	$querySeller = "SELECT * FROM SELLER WHERE SELLER.email = '" . $email . "'";

	$result = mysqli_query($con, $query);
	$resultSeller = mysqli_query($con, $querySeller);

	if(mysqli_num_rows($result) > 0){
		$buyer = mysqli_fetch_array($result);
		if($buyer['password'] == $password){
			echo '{"login": true, "buyer": {"isBuyer": "true", "bid": ' . $buyer['bid'] . ', "fname": "' . $buyer['fname'] .'", "lname": "' . $buyer['lname'] . '"}}';
		}	
		else{
			echo '{"login": false}';
		}
	}
	elseif(mysqli_num_rows($resultSeller) > 0)
	{
		$seller = mysqli_fetch_array($resultSeller);
		if($seller['password'] == $password)
		{
			echo '{"login": true, "buyer": {"isBuyer": "false", "bid": ' . $seller['sid'] . ', "fname": "' . $seller['fname'] .'", "lname": "' . $seller['lname'] . '"}}';
		}	
		else
		{
			echo '{"login": false}';
		}
	}
	else{
		echo '{"login": false}';
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>