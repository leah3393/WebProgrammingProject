<?php
	$pass = "root"; // <-- Toggle
	//$pass = ""; // <-- Toggle
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		$con = mysqli_connect('localhost', 'root', $pass, 'realestate_db');
		if(!$con)
		{
			die('Could not connect: ' . mysqli_error($con));
		}		
		mysqli_select_db($con, "realestate_db");
		$sql = "SELECT * FROM property WHERE pid = " . $_POST["propertyID"];
		$result = mysqli_query($con, $sql);
		$toEcho = "";
		while($row = mysqli_fetch_array($result))
		{
			$query = mysqli_query($con, "SELECT * FROM picture WHERE pid = " . $row['pid']);
			while($innerRow = mysqli_fetch_array($query))
			{
				$imageID = $innerRow['pictureID'];
				$toEcho .= "<img src='resources/php/image.php?id={$imageID}' />";
			}
			$toEcho .= "<p>" . $row['addr'] . " " . $row['city'] . " " . $row['state'] . " " . $row['zip'] . "</p>";
			$toEcho .= "<p>" . $row['description'] . "</p>";
			$toEcho .= "<p>Price: " . $row['price'] . "</p>";
			$toEcho .= "<p>Home Size: " . $row['homeSize'] . "</p>";
			if($row['typeID'] == 1 || $row['typeID'] == 4)
				$toEcho .= "<p>Lot Size: " . $row['lotSize'] . "</p>";
			$toEcho .= "<p>Year Built: " . $row['yearBuilt'] . "</p>";
			$toEcho .= "<p>Number of bedrooms: " . $row['beds'] . "</p>";
			$toEcho .= "<p>Number of bathrooms: " . $row['baths'] . "</p>";
			if($_POST["buyer_seller"] == "buyer")
			{
				$findSeller = mysqli_query($con, "SELECT * FROM SELLER WHERE sid = " . $row['sellerID']);
				$innerRow = mysqli_fetch_array($findSeller);
				$toEcho .= "<p>Please contact " . $innerRow['fname'] . " " . $innerRow['lname'] . " from " . $innerRow['agency'] . " if you would like to purchase this home. Email " . $innerRow['email'] . " or call " . $innerRow['phone'];
			}
			elseif($_POST["buyer_seller"] == "seller")
			{
				//check if the property is being sold by this seller
				if($_POST["sellerID"] == $row['sellerID'])
				{
					$toEcho .= "<button id=\"edit\">Edit Property</button>";
				}
			}
		}
		echo $toEcho;
		mysqli_close($con);
	}
?>