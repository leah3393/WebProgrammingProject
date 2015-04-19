<?php
	$con = mysqli_connect('localhost', 'root', '', 'realestate_db');
	mysqli_select_db($con, "realestate_db");

	mysqli_query($con, "UPDATE property SET addr = '" . $_POST["newAddress"] . "' WHERE pid = " . $_POST["propertyID"]);
	mysqli_query($con, "UPDATE property SET city = '" . $_POST["newCity"] . "' WHERE pid = " . $_POST["propertyID"]);
	mysqli_query($con, "UPDATE property SET state = '" . $_POST["newState"] . "' WHERE pid = " . $_POST["propertyID"]);
	mysqli_query($con, "UPDATE property SET zip = " . $_POST["newZip"] . " WHERE pid = " . $_POST["propertyID"]);
	mysqli_query($con, "UPDATE property SET description = '" . $_POST["newDescription"] . "' WHERE pid = " . $_POST["propertyID"]);
	mysqli_query($con, "UPDATE property SET price = " . $_POST["newPrice"] . " WHERE pid = " . $_POST["propertyID"]);
	mysqli_query($con, "UPDATE property SET homeSize = " . $_POST["newHomeSize"] . " WHERE pid = " . $_POST["propertyID"]);
	mysqli_query($con, "UPDATE property SET lotSize = " . $_POST["newLotSize"] . " WHERE pid = " . $_POST["propertyID"]);
	mysqli_query($con, "UPDATE property SET yearBuilt = " . $_POST["newYearBuilt"] . " WHERE pid = " . $_POST["propertyID"]);
	mysqli_query($con, "UPDATE property SET beds = " . $_POST["newBedrooms"] . " WHERE pid = " . $_POST["propertyID"]);
	mysqli_query($con, "UPDATE property SET baths = " . $_POST["newBathrooms"] . " WHERE pid = " . $_POST["propertyID"]);
?>