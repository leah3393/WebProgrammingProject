<?php 
	$host = 'localhost';
	$user = 'root';
	$pass = 'root'; // <-- Toggle
	//$pass = ''; // <-- Toggle
	$dbname = 'realestate_db';


	if(isset($_POST['bemail'])){
		register_buyer();
	}
	else{
		register_seller();
	}

	function register_buyer(){
		global $host, $user, $pass, $dbname;
		$db = new mysqli($host,$user,$pass,$dbname);

		$email = test_input($_POST["bemail"]);
		$password = test_input($_POST["bpassword"]);
		$confirm_pass = test_input($_POST["bconfirm-password"]);
		$fname = test_input($_POST["bfname"]);
		$lname = test_input($_POST["blname"]);


		$query = "SELECT * FROM BUYER WHERE BUYER.email = '" . $email . "'";

		$result = $db->query($query);

		if($result->num_rows > 0){
			echo '{"created": false}';
		}
		else{
			$count_query = "SELECT COUNT(*) FROM BUYER";
			$result2 = $db->query($count_query);
			if($result2->num_rows > 0){
				$row = $result2->fetch_assoc();
				$bid = $row["COUNT(*)"];
			}
			else{
				$bid = 0;
			}

			$insert = "INSERT INTO BUYER (bid, email, password, fname, lname) VALUES (". $bid . ", '" . $email . "', '" . $password . "', '" . $fname . "', '" . $lname . "');";
			$db->query($insert);
			$token = 256;
			echo '{"created": true, "bid": ' . $bid . ', "fname": "' . $fname . '", "token": ' . $token . '}';
		}
	}

	function register_seller(){
		global $host, $user, $pass, $dbname;
		$db = new mysqli($host,$user,$pass,$dbname);

		$email = test_input($_POST["semail"]);
		$password = test_input($_POST["spassword"]);
		$confirm_pass = test_input($_POST["sconfirm-password"]);
		$fname = test_input($_POST["sfname"]);
		$lname = test_input($_POST["slname"]);

		$query = "SELECT * FROM SELLER WHERE SELLER.email = '" . $email . "'";

		$result = $db->query($query);

		//echo $query;

		if($result->num_rows > 0){
			echo '{"created": false}';
		}
		else{
			$count_query = "SELECT COUNT(*) FROM SELLER";
			$result2 = $db->query($count_query);
			if($result2->num_rows > 0){
				$row = $result2->fetch_assoc();
				$sid = $row["COUNT(*)"];
			}
			else{
				$sid = 0;
			}

			$insert = "INSERT INTO SELLER (sid, email, password, fname, lname) VALUES (". $sid . ", '" . $email . "', '" . $password . "', '" . $fname . "', '" . $lname . "');";
			$db->query($insert);
			$token = 256;
			echo '{"created": true, "sid": ' . $sid . ', "fname": "' . $fname . '", "token": ' . $token . '}';
		}

	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>