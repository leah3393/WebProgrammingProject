<?php
	//$con = mysqli_connect('localhost', 'root', '', 'realestate_db'); // <-- Toggle
	$con = mysqli_connect('localhost', 'root', 'root', 'realestate_db'); // <-- Toggle
	mysqli_select_db($con, "realestate_db");
	$queryPic = mysqli_query($con, "SELECT * FROM picture WHERE pictureID = " . $_GET['id']);
	$row = mysqli_fetch_array($queryPic);
	header('content-type: image/jpeg');
	echo $row['picture'];
?>