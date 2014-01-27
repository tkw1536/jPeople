<?php

include(dirname(__FILE__)."/query.php");

//create a search object
$Search = new Search( $searchable_columns );

if(!isset($_GET['action']) || strlen($_GET['action']) < 2) {
  jsonOutput( array('error' => '[ERROR] No action set') );
}

if( isset($_GET['str']) ) { //actions that require additional info

  $str = $_GET['str'];

  if( strlen( $str ) < $config["min_query_limit"] ){
    jsonOutput( array('error' => 'Query too short. Must have at least '.
      $config["min_query_limit"].' chars'
      ));
  }

  switch($_GET['action']){
    case 'fullAutoComplete':
      include "query.search.php"; //make the search
      break;
    default: jsonOutput( array( 'error' => 'No search string specified' ) );
  }

} else {
  jsonOutput( array( 'error' => 'No search string specified' ) );
}
?>