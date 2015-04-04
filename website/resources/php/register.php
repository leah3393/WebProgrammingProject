<?php 
	define(HOST, "localhost");
	define(USER, "root");
	define(PW, "root");
	define(DB, "realestate_db");

	$connect = mysql_connect(HOST,USER,PW) or die('Could not connect to mysql server.');

	mysql_select_db(DB, $connect) or die('Could not select database.');

	if(isset($_POST['bemail'])){
		register_buyer();
	}
	else{
		register_seller();
	}

	function register_buyer(){
		$email = test_input($_POST["bemail"]);
		$password = test_input($_POST["bpassword"]);
		$confirm_pass = test_input($_POST["bconfirm-password"]);
		$fname = test_input($_POST["bfname"]);
		$lname = test_input($_POST["blname"]);

		$query = "SELECT * FROM BUYER WHERE BUYER.email = '" . $email . "'";

		$result = mysql_query($query);

		if(mysql_num_rows($result) > 0){
			echo '{"created": false}';
		}
		else{
			$count_query = "SELECT COUNT(*) FROM BUYER";
			$result2 = mysql_query($count_query);
			if(mysql_num_rows($result2) > 0){
				$row = mysql_fetch_array($result2);
				$bid = $row[0];
				//echo "Count: " . $count;
			}
			else{
				//echo "Error";
				$bid = 0;
			}

			$insert = "INSERT INTO BUYER (bid, email, password, fname, lname) VALUES (". $bid . ", '" . $email . "', '" . $password . "', '" . $fname . "', '" . $lname . "');";
			mysql_query($insert);
			$token = 256;
			echo '{"created": true, "bid": ' . $bid . ', "fname": "' . $fname . '", "token": ' . $token . '}';
		}
	}

	function register_seller(){
		$email = test_input($_POST["semail"]);
		$password = test_input($_POST["spassword"]);
		$confirm_pass = test_input($_POST["sconfirm-password"]);
		$fname = test_input($_POST["sfname"]);
		$lname = test_input($_POST["slname"]);

		$query = "SELECT * FROM SELLER WHERE SELLER.email = '" . $email . "'";

		$result = mysql_query($query);

		if(mysql_num_rows($result) > 0){
			echo '{"created": false}';
		}
		else{
			$count_query = "SELECT COUNT(*) FROM SELLER";
			$result2 = mysql_query($count_query);
			if(mysql_num_rows($result2) > 0){
				$row = mysql_fetch_array($result2);
				$sid = $row[0];
				//echo "Count: " . $count;
			}
			else{
				//echo "Error";
				$sid = 0;
			}

			$insert = "INSERT INTO SELLER (sid, email, password, fname, lname) VALUES (". $sid . ", '" . $email . "', '" . $password . "', '" . $fname . "', '" . $lname . "');";
			mysql_query($insert);
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