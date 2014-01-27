<?php

//query_search: Performs an actual search operation. 
$columns  = 'id,eid,employeetype,attributes,account,attributes,fname,lname,birthday,country,college,majorlong,majorinfo,major,status,year,room,phone,email,description,title,office,deptinfo,block,floor';
if( $clause = $Search->getQuery($str) ){
	$query    = "SELECT $columns FROM ".$config["mysql_conn_table"]." WHERE $clause";
	$res      = mysql_query($query);
	if ($res) {
		$records  = sqlToArray($res);
		foreach ($records as $key => $value) {
			$records[$key]['photo_url'] = imageUrl($value['eid']);
			$records[$key]['flag_url'] = flagURL($value['country']);
		}
		jsonOutput(array(
			'sanitize'  => $Search->getLastSanitize(),
			'parse'     => $Search->getLastParse(),
			'length'    => mysql_num_rows( $res ),
			'clause'    => $clause,
			'records'   => $records
			));
	} else {
		jsonOutput(array('error' => mysql_error()));
	}
} else {
	jsonOutput( array( 'error' => 'Invalid query' ) );
}
?>