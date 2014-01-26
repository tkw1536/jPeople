<?php
	require_once __DIR__ . '/../query/config.php';

	define("FILE_DATA", __DIR__ . "/jP-data.xml");
	define("FILE_BIRTHDAYS", __DIR__ . "/jP-bDays.dump");
	define("SUFFIX", "@");

	fclose(fopen(FILE_DATA, "w"));
	fclose(fopen(FILE_BIRTHDAYS, "w"));

	chmod(FILE_DATA, 0777);
	chmod(FILE_BIRTHDAYS, 0777);

	getData();
	echo "<hr />";
	getBirthdays();
	echo "<hr />--- DONE ---";

	function getData () {
	  $h = '';
	  for($i=97; $i<=122; ++$i){
		  $chr	= urlencode(chr($i).SUFFIX);
		  echo "$chr<br />";
		  $href = dataURL( $chr );
		  $h .= curlGet($href);
	  }
	  file_put_contents(FILE_DATA, $h);
	}

	function getBirthdays () {
	  $h 		= '';
	  $find		= array("<People>\n", "</People>\n");
	  $nameTag = 'employeeid';
	  for($i=1; $i<=12; ++$i){
	  	for($j=1; $j<=31; ++$j){
	  		$chr	= "$j.$i";
	  		echo "Date >: $chr <br />";
	  		$href	 = birthdayURL( $chr );
	  		$cont	 = curlGet($href);
	  		$cont  = str_replace($find, "", $cont);
	  		preg_match_all("/<$nameTag>([^<]*)<\/$nameTag>/", $cont, $a);
	  		foreach($a[1] as $v){
	  			$h .= "$chr $v\n";
	  		}
	  		
	  	}
	  }
	  file_put_contents(FILE_BIRTHDAYS, $h);
	}

	function curlGet($page) {
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, $page);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	  $result = curl_exec($ch);

	  curl_close($ch);

	  return $result;
	}

?>