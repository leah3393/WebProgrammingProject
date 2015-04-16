<?php 
	$host = 'localhost';
	$user = 'root';
	$pass = 'root'; // <-- Toggle
	//$pass = ''; // <-- Toggle
	$dbname = 'realestate_db';

	$db = new mysqli($host,$user,$pass,$dbname);

	$userid = test_input($_POST['userid']);
	$type = test_input($_POST['type']);

	$query = "";

	if($type == 'buyer'){
		$query .= getBuyerQuery($userid);
	}
	else{
		$query .= getBuyerQuery($userid);
	}

	//echo $query;	

	$db->query($query);

	echo $query;

	//$location = 'Location: ../../search-result.html' . $request;

	//header($location);

	//echo "success";

	function getBuyerQuery($bid){
		$query = "UPDATE BUYER SET ";
		$first = true;
		if(isset($_POST["fname"])){
			$fname = test_input($_POST["fname"]);
			if($fname != ""){
				if(!$first){
					$query .= ", ";
				}
				else{
					$first = false;
				}
				$query .= "fname='".$fname."'";
			}
		}
		if(isset($_POST["lname"])){
			$lname = test_input($_POST["lname"]);
			if($lname != ""){
				if(!$first){
					$query .= ", ";
				}
				else{
					$first = false;
				}
				$query .= "lname='".$lname."'";
			}
		}
		if(isset($_POST["phone"])){
			$phone = test_input($_POST["phone"]);
			if($phone != ""){
				if(!$first){
					$query .= ", ";
				}
				else{
					$first = false;
				}
				$query .= "phone='".$phone."'";
			}
		}
		if(isset($_POST["city"])){
			$city = test_input($_POST["city"]);
			if($city != ""){
				if(!$first){
					$query .= ", ";
				}
				else{
					$first = false;
				}
				$query .= "pref_city='".$city."'";
			}
		}
		if(isset($_POST["state"])){
			$state = test_input($_POST["state"]);
			if($state != ""){
				if(!$first){
					$query .= ", ";
				}
				else{
					$first = false;
				}
				$query .= "pref_state='".$state."'";
			}
		}
		if(isset($_POST["zip"])){
			$zip = test_input($_POST["zip"]);
			if($zip != ""){
				if(!$first){
					$query .= ", ";
				}
				else{
					$first = false;
				}
				$query .= "pref_zip='".$zip."'";
			}
		}
		if(isset($_POST["sqftmin"])){
			$sqftmin = test_input($_POST["sqftmin"]);
			if($sqftmin != "0"){
				if(!$first){
					$query .= ", ";
				}
				else{
					$first = false;
				}
				$query .= "pref_homeSize='".$sqftmin."'";
			}
		}
		if(isset($_POST["lotsize"])){
			$lotsize = test_input($_POST["lotsize"]);
			if($lotsize != "0"){
				if(!$first){
					$query .= ", ";
				}
				else{
					$first = false;
				}
				$query .= "pref_lotSize='".$lotsize."'";
			}
		}
		if(isset($_POST["beds"])){
			$beds = test_input($_POST["beds"]);
			if($beds != "0"){
				if(!$first){
					$query .= ", ";
				}
				else{
					$first = false;
				}
				$query .= "pref_beds='".$beds."'";
			}
		}
		if(isset($_POST["baths"])){
			$baths = test_input($_POST["baths"]);
			if($baths != "0"){
				if(!$first){
					$query .= ", ";
				}
				else{
					$first = false;
				}
				$query .= "pref_baths='".$baths."'";
			}
		}
		if(isset($_POST["pricemin"])){
			$pricemin = test_input($_POST["pricemin"]);
			if($pricemin != "0"){
				if(!$first){
					$query .= ", ";
				}
				else{
					$first = false;
				}
				$query .= "pref_lowPrice='".$pricemin."'";
			}
		}
		if(isset($_POST["pricemax"])){
			$pricemax = test_input($_POST["pricemax"]);
			if($pricemax != "any"){
				if(!$first){
					$query .= ", ";
				}
				else{
					$first = false;
				}
				$query .= "pref_highPrice='".$pricemax."'";
			}
		}
		$propertyType = $_POST["propertyType"];
		$typeSize = count($propertyType);
		if($typeSize > 0 && $typeSize < 5){
			if(!$first){
				$query .= ", ";
			}
			else{
				$first = false;
			}
			$query .= "pref_typeID='".$propertyType[0]."'";
		}
		/*for($i = 0; $i < $typeSize; $i++){
			echo $propertyType[$i] . "\n";
		}*/

		$query .= " WHERE bid=" . $bid . ";";

		return $query;
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>