<?php
	echo 
		"<html> 
			<head> 
				<title> Administrator Utility </title>
				<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
				<link href=\"../css/adminUtility.css\" type=\"text/css\" rel=\"stylesheet\" />
			</head>
			<body>
				<h1> Seller Verification </h1>
				<h2> List of Sellers to Verify: </h2>";
	$con = mysqli_connect('localhost', 'root', 'root', 'realestate_db');
	if(!$con)
	{
		die('Could not connect: ' . mysqli_error($con));
	}
	mysqli_select_db($con, "realestate_db");
	$sql = "SELECT sid, fname, lname, email, phone, addr, agency FROM seller WHERE approved is NULL";
	$result = mysqli_query($con, $sql);
	$counter = 1;
	while($row = mysqli_fetch_array($result))
	{
		echo "<div class=\"theClass\">";
		echo "<form style=\"display:inline-block\">";
		echo "<p id=\"paragraph" . $counter . "\">" . $row['sid'] . " " . $row['fname'] .  " " . $row['lname'] . "</p>";
		echo "<button type=\"button\" id=\"theButton" . $counter . "\">Verify</button>";
		echo "</div>";
		$counter++;
	}
	echo 	
			"<button type=\"button\" id=\"logoutButton\">Log Out</button>";
	echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js\"></script>";
	echo
			"<script src=\"../js/adminUtility.js\"></script>";
	echo
			"</body>
		</html>";
	mysqli_close($con);
?>