<?php
	$q = intval($_GET['q']);
	$con = mysqli_connect('localhost', 'root', 'root', 'realestate_db');
	if(!$con)
	{
		die('Could not connect: ' . mysqli_error($con));
	}
	mysqli_select_db($con, "realestate_db");
	$sql = "UPDATE seller SET approved = true WHERE sid = " . $q;
	mysqli_query($con, $sql);
	mysqli_close($con);
?>