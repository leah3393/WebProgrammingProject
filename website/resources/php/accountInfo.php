<?php 
	$db = new mysqli('localhost','root','root','realestate_db'); // <-- Toggle
	//$db = new mysqli('localhost','root','','realestate_db'); // <-- Toggle

	$query = "";

	$type = test_input($_POST["type"]);
	$userid = test_input($_POST["userid"]);

	if($type == "buyer"){
		$query .= "SELECT * FROM BUYER WHERE BUYER.bid = '" . $userid . "'";
	}
	else{
		$query .= "SELECT * FROM SELLER WHERE SELLER.sid = '" . $userid . "'";
	}

	//echo $query;

	$result = $db->query($query);

	if($type == "buyer"){
		if($result->num_rows == 1){
			$buyer = $result->fetch_assoc();
			echo json_encode($buyer);
		}
	}
	else{
		if($result->num_rows == 1){
			$seller = $result->fetch_assoc();
			echo json_encode($seller);
		}
	}
	

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>