<?php 
	$db = new mysqli('localhost','root','root','realestate_db'); // <-- Toggle
	//$db = new mysqli('localhost','root','','realestate_db'); // <-- Toggle

	$email = test_input($_POST["email"]);
	$password = test_input($_POST["password"]);

	$query = "SELECT * FROM BUYER WHERE BUYER.email = '" . $email . "'";

	$result = $db->query($query);

	if($result->num_rows > 0){
		$buyer = $result->fetch_assoc();
		if($buyer['password'] == $password){
			echo '{"login": true, "buyer": {"bid": ' . $buyer['bid'] . ', "fname": "' . $buyer['fname'] .'", "lname": "' . $buyer['lname'] . '"}}';
		}	
		else{
			echo '{"login": false}';
		}
	}
	else{
		$query2 = "SELECT * FROM SELLER WHERE SELLER.email = '" . $email . "'";
		$result2 = $db->query($query2);
		if($result2->num_rows > 0){
			$seller = $result2->fetch_assoc();
			if($seller['password'] == $password){
				echo '{"login": true, "seller": {"sid": ' . $seller['sid'] . ', "fname": "' . $seller['fname'] .'", "lname": "' . $seller['lname'] . '"}}';
			}	
			else{
				echo '{"login": false}';
			}
		}
		else{
			echo '{"login": false}';
		}
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>