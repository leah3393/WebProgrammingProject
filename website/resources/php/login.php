<?php 
	define(HOST, "localhost");
	define(USER, "root");
	define(PW, "root");
	define(DB, "realestate_db");

	$connect = mysql_connect(HOST,USER,PW) or die('Could not connect to mysql server.');

	mysql_select_db(DB, $connect) or die('Could not select database.');

	$email = test_input($_POST["email"]);
	$password = test_input($_POST["password"]);

	$query = "SELECT * FROM BUYER WHERE BUYER.email = '" . $email . "'";

	$result = mysql_query($query);

	if(mysql_num_rows($result) > 0){
		$buyer = mysql_fetch_object($result);
		if($buyer->password == $password){
			echo '{"login": true, "buyer": {"bid": ' . $buyer->bid . ', "fname": "' . $buyer->fname .'", "lname": "' . $buyer->lname . '"}}';
		}	
		else{
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