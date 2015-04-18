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
		$con = mysqli_connect('localhost', 'root', '', 'realestate_db'); //toggle
		//$con = mysqli_connect('localhost', 'root', 'root', 'realestate_db'); //toggle
		$queryPhoto = mysqli_query($con, "SELECT * FROM picture WHERE pid = " . $pid . " AND isPrimary = 1");
		$imageID;
		while($row = mysqli_fetch_array($queryPhoto))
			$imageID = $row['pictureID'];
		
		return "resources/php/image.php?id=" . $imageID;
	}
?>