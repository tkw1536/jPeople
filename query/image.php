<?php
	// JSON URL which should be requested
	if(@$_GET["orig"] == "true"){
		$json_url = 'http://ircitweb.irc-it.jacobs-university.de/cnpics_128_intranet/'
		 . urlencode($_GET["id"] . ".jpg");
	} else {
		$json_url = 'http://swebtst01.public.jacobs-university.de/jPeople/image.php?id='
		 . urlencode($_GET["id"]);
	}

	

	// Initializing curl
	$ch = curl_init( $json_url );

	// Configuring curl options
	$options = array(
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_HTTPHEADER => array('Content-type: image/jpeg') ,
	);

	// Setting curl options
	curl_setopt_array( $ch, $options );

	// Getting results
	$result =  curl_exec($ch); // Getting JSON result string
	curl_close($ch);

	header("Content-type: image/jpeg");
	echo $result; 
?>