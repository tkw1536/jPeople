<?php

include(dirname(__FILE__)."/query.php");

//create a search object
$Search = new Search( $searchable_columns );

//set the filenames
define("FILE_DATA", __DIR__ . "/data.xml");
define("SUFFIX", "@");

//open the file and chmod it
fclose(fopen(FILE_DATA, "w"));
chmod(FILE_DATA, 0777);

//get the data
$h = '';
for($i=97; $i<=122; ++$i){ //iterate over all characters
	$chr = urlencode(chr($i).SUFFIX);
	echo chr($i) . "<br />";
	$href = dataURL( $chr );
	$h .= curlGet($href);
}

file_put_contents(FILE_DATA, $h);

function curlGet($page) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $page);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($ch);

	curl_close($ch);

	return $result;
}

?>