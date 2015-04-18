<?php
	$con = mysqli_connect('localhost', 'root', 'root', 'realestate_db');
	mysqli_select_db($con, "realestate_db");
	
	$result = mysqli_query($con, "SELECT * FROM SELLER WHERE sid = " . $_POST["sellerID"]);
	$row = mysqli_fetch_array($result);
	echo $row['approved'];
?>