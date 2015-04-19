<?php
	$db = new mysqli('localhost','root','root','realestate_db'); // <-- Toggle
	//$db = new mysqli('localhost','root','','realestate_db'); // <-- Toggle

	$query = "SELECT * FROM PROPERTY WHERE sellerID = " . $_POST["sellerID"];

	$result = $db->query($query);

	$json = '{"properties": [';
	$first = True;

	if($result){
		while($row = $result->fetch_assoc()){
			$photo = get_photo($row['pid']);
			if($first){
				$json .= '{"pid": "'.$row['pid'].'", "addr": "'.$row['addr'].'", "city": "'.$row['city'].'", "state": "'.$row['state'].'", "price": "'.$row['price'].'", "photo": "'.$photo.'"}';
				$first = False;
			}
			else{
				$json .= ',{"pid": "'.$row['pid'].'", "addr": "'.$row['addr'].'", "city": "'.$row['city'].'", "state": "'.$row['state'].'", "price": "'.$row['price'].'", "photo": "'.$photo.'"}';
			}
		}
		$result->free();
	}

	$json .= ']}';

	echo $json;
	
	function get_photo($pid)
	{
		global $db;

		$photoQuery = "SELECT * FROM PICTURE WHERE pid = ".$pid." AND isPrimary = 1";

		$result = $db->query($photoQuery);

		if($result->num_rows == 1){
			return 'resources/images/property/'.$pid.'_1.jpg';
		}
		else{
			return 'resources/images/default.jpg';
		}
		
		//return "resources/php/image.php?id=" . $imageID;
	}
?>