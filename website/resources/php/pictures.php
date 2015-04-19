<?php
	$con = mysqli_connect('localhost', 'root', 'root', 'realestate_db');
	mysqli_select_db($con, "realestate_db");
	
	$pid = $_POST["pid"];

	$query = "SELECT * FROM PICTURE WHERE pid = " . $pid;

	$result = mysqli_query($con, $query);

	$json = '{"pictures":[';

	$first = true;

	while($row = mysqli_fetch_array($result))
	{
		$imageID = $row['pictureID'];
		$path = $row['picture'];

		if(!$first){
			$json .= ", ";
		}
		else{
			$first = false;
		}

		$json .= '{"pictureID":"' . $imageID . '", "path":"' . $path . '"}';

	}

	$json .= ']}';

	//echo $query;

	echo $json;

	//echo $pid;
?>