<?php
	$con = mysqli_connect('localhost', 'root', 'root', 'realestate_db');
	mysqli_select_db($con, "realestate_db");
	
	mysqli_query($con, 'INSERT INTO favorite VALUES(' . $_POST['buyerID'] . ', ' . $_POST['propertyID'] . ')');
?>