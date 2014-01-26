<?php

include(dirname(__FILE__)."/../admin/config.php");

define( 'DB_USER', $config["mysql_conn_user"] );
define( 'DB_PASS', $config["mysql_conn_pass"] );
define( 'DB_NAME', $config["mysql_conn_db"] );

define( 'TABLE_RAWDATA', $config["mysql_table_rawdata"] );
define( 'TABLE_SEARCH', $config["mysql_table_search"] );

define( 'WEB_ROOT', 'http://localhost/jPeople/');

require_once 'class.Search.php';

dbConnect( DB_USER, DB_PASS, DB_NAME );

  /******************
  ******* URLS ******
  ******************/
  function dataURL( $chr ){
    return "http://swebtst01.public.jacobs-university.de/jPeople/ldap/xml_people_search.php?limit=1000&search=".$chr."&filter=all";
  }

  function birthdayURL( $chr ){
    return "http://swebtst01.public.jacobs-university.de/jPeople/ldap/xml_people_search.php?limit=300&search=$chr&filter=birthday";
  }

  function imageURL( $eid ){
    return "http://swebtst01.public.jacobs-university.de/jPeople/image.php?id=$eid";
    //return WEB_ROOT . "/utils/images/$eid.jpg";
  }

  function flagURL( $country ){
    $country = str_replace( " ", '%20', $country );
    return "http://swebtst01.public.jacobs-university.de/jPeople/embed_assets/flags/$country.png";
  }

  /******************
  ****** COLUMNS ****
  ******************/
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
  'eid', 'employeetype', 'account', 'attributes', 'fname', 'lname', 'birthday', 'country', 'college',
  'majorlong', 'majorinfo', 'room', 'phone', 'email', 'description', 'title', 'office', 'deptinfo'
  );

$search_query = array(
  'fname', 'lname', 'college', 'room', 'phone', 'country',
  'major', 'birthday', 'year', 'status'
  );

$searchable_columns = array(
  'employeetype', 'account', 'attributes', 'fname', 'lname', 'birthday', 'country',
  'college', 'majorlong', 'majorinfo', 'room', 'phone', 'description',
  'title', 'office', 'deptinfo', 'major', 'block', 'floor', 'email', 'year', 'status'
  );

  /******************
  ******* BULK ******
  ******************/

  function sqlToJsonOutput( $q ){
    if( $q ){
      jsonOutput( sqlToArray( $q ) );
    } else {
      jsonOutput( array( 'error' => mysql_error() ) );
    }
  }

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

  function dbConnect($user, $pass, $name = null, $host = 'localhost'){
    $connexion = mysql_connect( $host, $user, $pass ) or die ("Could not connect to Data Base!");
    if( $name ) mysql_select_db( $name, $connexion ) or die ("Failed to select Data Base");
  }

  /******************
  ****** SEARCH *****
  ******************/

  $Search = new Search( $searchable_columns );


  ?>
