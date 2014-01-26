<?php

require_once 'config.php';

if(!isset($_GET['action']) || strlen($_GET['action']) < 2) {
  jsonOutput( array('error' => '[ERROR] No action set') );
}

define('MIN_LIMIT', $config["min_query_limit"]);

	if( isset($_GET['str']) ) { //actions that require additional info

    $str 		= $_GET['str'];

    if( strlen( $str ) < MIN_LIMIT ){
      jsonOutput( array('error' => 'Query too short. Must have at least '.
        MIN_LIMIT.' chars'
        ));
    }

    switch($_GET['action']){
      case 'fullAutoComplete':
      $columns  = 'id,eid,employeetype,attributes,account,attributes,'.
      'fname,lname,birthday,country,college,majorlong,'.
      'majorinfo,major,status,year,room,phone,email,'.
      'description,title,office,deptinfo,block,floor';
      if( $clause = $Search->getQuery($str) ){
        $query    = "SELECT $columns FROM ".TABLE_SEARCH." WHERE $clause";
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
      break;
      default: jsonOutput( array( 'error' => 'No search string specified' ) );
    }

  } else {
    jsonOutput( array( 'error' => 'No search string specified' ) );
  }
  ?>
