<?php 
	$host = 'localhost';
	$user = 'root';
	$pass = 'root'; // <-- Toggle
	//$pass = ''; // <-- Toggle
	$dbname = 'realestate_db';

	$db = new mysqli($host,$user,$pass,$dbname);

	$userid = test_input($_POST['userid']);
	
	$favorite = test_input($_POST['favorite']);

	if($favorite == 'get'){
		//TODO
		$json = '{"properties": [';
		$test = '';
		$first = True;

		$query = "SELECT * FROM FAVORITE WHERE bid=".$userid;
		//$test .= $query;
		$pidList = $db->query($query);

		if($pidList){
			while($fav = $pidList->fetch_assoc()){
				$pid = $fav["pid"];
				$newQuery = "SELECT * FROM PROPERTY WHERE pid=".$pid;
				$test .= $newQuery;
				$result = $db->query($newQuery);
				$row = $result->fetch_assoc();
				$photo = get_photo($row['pid']);
				$verified = get_verified($row['sellerID']);
				$favorite = true;
				if($first){
					$json .= '{"pid": "'.$row['pid'].'", "addr": "'.$row['addr'].'", "city": "'.$row['city'].'", "state": "'.$row['state'].'", "price": "'.$row['price'].'", "photo": "'.$photo.'", "favorite": "'.$favorite.'", "verified": "'.$verified.'"}';
					$first = False;
				}
				else{
					$json .= ',{"pid": "'.$row['pid'].'", "addr": "'.$row['addr'].'", "city": "'.$row['city'].'", "state": "'.$row['state'].'", "price": "'.$row['price'].'", "photo": "'.$photo.'", "favorite": "'.$favorite.'", "verified": "'.$verified.'"}';
				}
			}
			$pidList->free();
		}
		$json .= ']}';
		echo $json;
		//echo $test;
	}
	else{
		$pid = test_input($_POST['pid']);
		$query = "";
		if($favorite == 'add'){
			$query .= "INSERT INTO FAVORITE (bid,pid) VALUES (".$userid.",".$pid.");";
		}
		else if($favorite == 'remove'){
			$query .= "DELETE FROM FAVORITE WHERE bid=".$userid." AND pid=".$pid.";";
		}

		$db->query($query);

		echo $query;
	}

	function get_photo($pid){
		global $db;

		$photoQuery = "SELECT * FROM PICTURE WHERE pid = ".$pid." AND isPrimary = 1";

		$result = $db->query($photoQuery);

		if($result->num_rows == 1){
			return 'resources/images/property/'.$pid.'_1.jpg';
		}
		else{
			return 'resources/images/default.jpg';
		}

		//return 'resources/images/default.jpg';
	}

	function get_verified($sellerID){
		//return false;

		global $db;
		if($sellerID != null){
			$query = "SELECT * FROM SELLER WHERE sid = ".$sellerID;

			$result = $db->query($query);
			$row = $result->fetch_assoc();

			if($row["approved"] == 1){
				return true;
			}
			else{
				return false;
			}
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