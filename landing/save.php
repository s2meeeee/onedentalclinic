<?php
	$url = "https://ae-ads.com/db/saveUserData";

	$data = array(
		"dbName" => $_POST['dbName'],
		"dbCellPhone" => $_POST['dbCellPhone'],
		"dbRaw" => $_POST['dbRaw'],
		"dbChannel1" => $_POST['dbChannel1'],
		"dbChannel2" => $_POST['dbChannel2'],
		"dbChannel3" => $_POST['dbChannel3'],
		"dbChannel4" => $_POST['dbChannel4']
	);

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch);

	if (curl_errno($ch)) {
		echo 'Curl error: ' . curl_error($ch);
	}

	curl_close($ch);
	
	// $response variable now contains the response from the server
?>