<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		$con = mysqli_connect('localhost', 'root', 'root', 'realestate_db');
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
			//$toEcho .= "";
			$query = mysqli_query($con, "SELECT * FROM picture WHERE pid = " . $row['pid']);
			$toEcho .= "<div class=\"images\" style=\"text-align: center\">";
			while($innerRow = mysqli_fetch_array($query))
			{
				$imageID = $innerRow['pictureID'];
				$toEcho .= "<img class=\"picture\" src='resources/php/image.php?id={$imageID}' hspace=\"10\" />";
			}
			$toEcho .= "</div>";
			$toEcho .= "<div class=\"jumbotron\">"; //jumbotron
			$toEcho .= "<div style=\"text-align: center\" >"; //align div
			$toEcho .= "<p>" . $row['addr'] . " " . $row['city'] . " " . $row['state'] . " " . $row['zip'] . "</p>";
			$toEcho .= "<p>" . $row['description'] . "</p>";
			$toEcho .= "<p>Price: " . $row['price'] . "</p>";
			$toEcho .= "<p>Home Size: " . $row['homeSize'] . "</p>";
			if($row['typeID'] == 1 || $row['typeID'] == 4)
				$toEcho .= "<p>Lot Size: " . $row['lotSize'] . "</p>";
			$toEcho .= "<p>Year Built: " . $row['yearBuilt'] . "</p>";
			$toEcho .= "<p>Number of bedrooms: " . $row['beds'] . "</p>";
			$toEcho .= "<p>Number of bathrooms: " . $row['baths'] . "</p>";
			$toEcho .= "</div>"; //end align div
			$toEcho .= "</div>"; //end jumbotron
			if($_POST["buyer_seller"] == "buyer")
			{
				$findSeller = mysqli_query($con, "SELECT * FROM SELLER WHERE sid = " . $row['sellerID']);
				$innerRow = mysqli_fetch_array($findSeller);
				$toEcho .= "<p>Please contact " . $innerRow['fname'] . " " . $innerRow['lname'] . " from " . $innerRow['agency'] . " if you would like to purchase this home. Email " . $innerRow['email'] . " or call " . $innerRow['phone'];
				$query2 = mysqli_query($con, "SELECT * FROM favorite WHERE pid = " . $row['pid'] . " AND bid = " . $_POST["sellerID"]);
				if(mysqli_num_rows($query2) > 0)
				{
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<p id=\"favoriteDescription\">This is one of your favorite properties!</p>";
					$toEcho .= "</div>"; //row ends
				}
				else
				{
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<button id=\"favorite\"> Favorite this Property!</button>";
					$toEcho .= "<p id=\"propID\" hidden=\"hidden\">" . $_POST["propertyID"] . "</p>";
					$toEcho .= "<p id=\"favoriteDescription\" hidden=\"hidden\">This is one of your favorite properties!</p>";
					$toEcho .= "</div>"; //row ends
				}
			}
			elseif($_POST["buyer_seller"] == "seller")
			{
				//check if the property is being sold by this seller
				if($_POST["sellerID"] == $row['sellerID'])
				{	
					//$toEcho .= "";
					$toEcho .= "<div class=\"container\" style=\"text-align: center !important\">"; //open container
					$toEcho .= "<div class=\"jumbotron\" style=\"text-align: center !important\">"; //jumbotron
					$toEcho .= "<h1>Edit Property:</h1>";
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<p>Select a local file as your image, and click the button to add the image:</p>";
					$toEcho .= "<form action=\"resources/php/addImage.php\" method=\"post\" enctype=\"multipart/form-data\">
					<div class=\"row\">
					<div class=\"col-md-2 col-md-offset-5\">
					<input type=\"file\" name=\"image\">
					</div></div>
					<input type=\"submit\" name=\"submit\" value=\"Add Picture\"><input type=\"hidden\" id=\"pid\" name=\"pid\" value=\"" . $_POST["propertyID"] . "\" /></form>";
					$toEcho .= "<br>";
					$toEcho .= "</div>"; //row ends
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<p>Click this button and then click a picture above to delete it:</p>";
					$toEcho .= "<button id=\"deletePics\">Delete Pictures</button>";
					$toEcho .= "<br>";
					$toEcho .= "<p id=\"deleteDescription\" hidden=\"hidden\">Click on a picture above to delete it</p>";
					$toEcho .= "<br>";
					$toEcho .= "</div>"; //row ends
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "Edit any of these fields below, and then click the \"Make Changes\" button:";
					$toEcho .= "</div>"; //row ends
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<label>Change Address: </label>";
					$toEcho .= "<input value=\"" . $row['addr'] . "\" id=\"newAddress\"/>";
					$toEcho .= "</div>"; //row ends
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<label>Change City: </label>";
					$toEcho .= "<input value=\"" . $row['city'] . "\" id=\"newCity\"/>";
					$toEcho .= "</div>"; //row ends
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<label>Change State: </label>";
					$toEcho .= "<input value=\"" . $row['state'] . "\" id=\"newState\"/>";
					$toEcho .= "</div>"; //row ends
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<label>Change Zip: </label>";
					$toEcho .= "<input value=\"" . $row['zip'] . "\" id=\"newZip\"/>";
					$toEcho .= "</div>"; //row ends
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<label>Change Description: </label>";
					$toEcho .= "<input value=\"" . $row['description'] . "\" id=\"newDescription\"/>";
					$toEcho .= "</div>"; //row ends
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<label>Change Price: </label>";
					$toEcho .= "<input value=\"" . $row['price'] . "\" id=\"newPrice\"/>";
					$toEcho .= "</div>"; //row ends
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<label>Change Home Size: </label>";
					$toEcho .= "<input value=\"" . $row['homeSize'] . "\" id=\"newHomeSize\"/>";
					$toEcho .= "</div>"; //row ends
					if($row['typeID'] == 1 || $row['typeID'] == 4)
					{
						$toEcho .= "<div class=\"row\">"; //row begins
						$toEcho .= "<label>Change Lot Size: </label>";
						$toEcho .= "<input value=\"" . $row['lotSize'] . "\" id=\"newLotSize\"/>";
						$toEcho .= "</div>"; //row ends
					}
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<label>Change Year Built: </label>";
					$toEcho .= "<input value=\"" . $row['yearBuilt'] . "\" id=\"newYearBuilt\"/>";
					$toEcho .= "</div>"; //row ends
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<label>Change Number of Bedrooms: </label>";
					$toEcho .= "<input value=\"" . $row['beds'] . "\" id=\"newBedrooms\"/>";
					$toEcho .= "</div>"; //row ends
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<label>Change Number of Bathrooms: </label>";
					$toEcho .= "<input value=\"" . $row['baths'] . "\" id=\"newBathrooms\"/>";
					$toEcho .= "</div>"; //row ends
					$toEcho .= "<div class=\"row\">"; //row begins
					$toEcho .= "<button id=\"makeChanges\" name=\"makeChanges\" type=\"submit\">Make Changes</button>";
					$toEcho .= "</div>"; //row ends
					$toEcho .= "<br>";
					$toEcho .= "<div class=\"row\">"; //row begins
					if($row['sold'] == 0)
					{
						$toEcho .= "<button id=\"homeSold\" name=\"homeSold\" type=\"submit\">Home Sold</button>";
						$toEcho .= "<p id=\"homeSoldDescription\" hidden=\"hidden\">This home has been sold!</p>";
					}
					elseif($row['sold'] == 1)
					{
						$toEcho .= "<p id=\"homeSoldDescription\">This home has been sold!</p>";
					}
					$toEcho .= "</div>"; //row ends
					//$toEcho .= "</div>"; //end jumbotron
					$toEcho .= "</div>"; //close container
				}
			}
			$toEcho .= "</div>"; //end jumbotron
		}
		echo $toEcho;
		mysqli_close($con);
	}
?>