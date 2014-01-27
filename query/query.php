<?php

include(dirname(__FILE__)."/../admin/config.php");
include(dirname(__FILE__)."/class.Search.php");

//connect to the database
mysql_connect($config["mysql_conn_host"], $config["mysql_conn_user"], $config["mysql_conn_pass"] ) or die ("DATABASE_CONN_FAIL");
mysql_select_db($config["mysql_conn_db"]) or die ("DATABASE_SELECT_FAIL");

//all important URLs
function dataURL( $chr ){
  return "http://swebtst01.public.jacobs-university.de/jPeople/ldap/xml_people_search.php?limit=10000&search=".$chr."&filter=all";
}

function imageURL( $eid ){
  return "http://swebtst01.public.jacobs-university.de/jPeople/image.php?id=" . $eid;
}

function flagURL( $country ){
  $country = str_replace( " ", '%20', $country );
  return "http://swebtst01.public.jacobs-university.de/jPeople/embed_assets/flags/" . $country . ".png";
}

//columns
$map = array(
  'employeeid'                  => 'eid',
  'company'                     => 'employeetype',
  'samaccountname'              => 'account',
  'employeetype'                => 'attributes',
  'givenname'                   => 'fname',
  'sn'                          => 'lname',
  'displayname'                 => 'displayname',
  'name'                        => 'name',
  'cn'                          => 'cn',
  'houseidentifier'             => 'college',
  'extensionattribute2'         => 'majorinfo',
  'extensionattribute3'         => 'majorlong',
  'extensionattribute5'         => 'country',
  'mail'                        => 'email',
  'roomInfo'                    => 'room',
  'telephonenumber'             => 'phone',
  'description'                 => 'description',
  'title'                       => 'title',
  'physicaldeliveryofficename'  => 'office',
  'department'                  => 'department',
  'wwwhomepage'                 => 'www',
  'jpegphoto'                   => 'photo',
  'deptInfo'                    => 'deptinfo'
  );

$search = array(
  'eid', 'employeetype', 'account', 'attributes', 'fname', 'lname', 'birthday', 'country', 'college', 'majorlong', 'majorinfo', 'room', 'phone', 'email', 'description', 'title', 'office', 'deptinfo'
  );

$search_query = array(
  'fname', 'lname', 'college', 'room', 'phone', 'country', 'major', 'birthday', 'year', 'status'
  );

$searchable_columns = array(
  'employeetype', 'account', 'attributes', 'fname', 'lname', 'birthday', 'country', 'college', 'majorlong', 'majorinfo', 'room', 'phone', 'description', 'title', 'office', 'deptinfo', 'major', 'block', 'floor', 'email', 'year', 'status'
  );


//lib functions
function jsonOutput( array $arr ){
  if( !headers_sent() ){
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type:application/json');
    header('Content-attributes: application/json; charset=ISO-8859-15');
  }
  exit( json_encode( $arr ) );
}

function sqlToArray( $sql, $key = null ){
  if( $sql ){
    $a = array();
    while( $r = mysql_fetch_assoc( $sql ) ){
      if( $key ){
        $a[ $r[ $key ] ] = $r;
      } else {
        $a[] = $r;
      }
    }
    return $a;
  } else {
    return array();
  }
}

?>