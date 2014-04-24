<?php

include(dirname(__FILE__)."/query.php");

//create a search object
$Search = new Search( $searchable_columns );

set_time_limit(60); //This may take a bit longer

//set the filename

define("FILE_DATA", __DIR__ . "/data.xml");

$data = array();
// Get the information and store it in an array
$DD = new DOMDocument('1.0', 'utf-8');
$DD->loadXML( utf8_encode( '<jPeople>'.file_get_contents(FILE_DATA).'</jPeople>' ) );
$persons = $DD->getElementsByTagName('person');
$data = array();
for( $i=0; $i<$persons->length; ++$i ){
  $p = $persons->item($i);
  $data[$i] = getValues( $p, $map );
}

$searchData = array();
mysql_query( "DROP TABLE ".$config["mysql_conn_table"] );
$columns = array( '`id` INT(8) auto_increment' );

foreach( $search as $v ){
  $columns[] = "`$v` VARCHAR(128)";
}
$q = "CREATE TABLE IF NOT EXISTS `".$config["mysql_conn_table"]."`(
    ".implode(", \n", $columns).",
    year VARCHAR(8),
    status VARCHAR(32),
    major VARCHAR(32),
    block VARCHAR(8),
    floor VARCHAR(8),
    query VARCHAR(512) NOT NULL,
    PRIMARY KEY(id),
    INDEX(eid),
    INDEX(fname),
    INDEX(lname),
    INDEX(college),
    INDEX(employeetype),
    INDEX(birthday),
    INDEX(year),
    INDEX(status),
    INDEX(majorlong),
    INDEX(major),
    INDEX(block),
    INDEX(floor),
    INDEX(query)
  );
";

$people_counter = 0; 

if( mysql_query( $q ) ){
  // add data to array
  foreach( $data as $d ){
    $tmp = array();
    foreach( $d as $k => $v ){
      if( in_array( $k, $search ) ){
        $tmp[$k] = trim($v);
      }
    }
    $searchData[] = $tmp;
  }

  // manipulate data
  foreach( $searchData as $k => $v ){
    $people_counter++; //add 
    // fix rooms and create blocks + floors
    $v['block'] = '';
    $v['floor'] = '';
    $v['birthday'] = ''; //currently unsupported. 
    $room = $v['room'];
    if( isCollege( $room ) ){
      $room = collegeInitial( $room ) . substr( $room, strripos($room, 'Room ') + 5 );
      $room = substr( $room, 0, 2 ) . '-' . substr( $room, 3 );
      $room = strtoupper( substr($room, 0, 6) );
      $v['room']   = $room;
      $v['block']  = substr( $room, 1, 1 );
      $v['floor']  = substr( $room, 3, 1 );
    }

    // manipulate college
    $college = $v['college'];
    switch( $college ){
      case 'Mercator College': $college = 'Mercator'; break;
      case 'Alfried Krupp College': $college = 'Krupp'; break;
      case 'College III': $college = 'College-III'; break;
      case 'College Nordmetall': case 'College IV': $college = 'Nordmetall'; break;
    }
    $v['college'] = $college;

    // create major column from majorinfo
    $v['majorinfo'] = str_ireplace( 'int ', 'int_', $v['majorinfo'] );
    $v['description'] = str_ireplace( array('int ', 'class '), array('int_', ''), $v['description'] );
    $description      = $v['description'];
    $description      = preg_replace( '/\(.*\)/', '', $description );
    $v['majorinfo']   = trim( $description );
    $description      = explode(' ', $v['description']);
    if( count( $description ) >= 2 ){
      $v['status']  = getStatus( $description[0] );
      $v['year']    = intval( $description[1] );
      $v['year']    = $v['year'] ? $v['year'] : '';
      $v['major']   = implode(' ', array_slice( $description, 2 ) );
    } else {
      $v['status']  = '';
      $v['year']    = '';
      $v['major']   = '';
    }

    // create query column - should be last
    $query = array();
    foreach( $search_query as $v2 ){
      $query[] = $v[$v2];
    }
    $v['query'] = ' '.implode(' ', $query).' ';

    // store the information back into the array
    $searchData[$k] = $v;
  }

  // Insert data to DB
  $q = "INSERT INTO ".$config["mysql_conn_table"]." ".makeQuery( $searchData ).';';
  echo '<div>'.$config["mysql_conn_table"].': '.(mysql_query($q) ? 'Success!' : 'Fail: '.mysql_error()).'</div>';
} else {
  exit( mysql_error() );
}
echo "Inserted $people_counter people into the database. \n"; 
echo "Deleting dumped data file ...."; 
unlink(FILE_DATA);
echo "Done. "; 

//Library functions

/**
 * Maps
 *  ug      => undergrad,
 *  m       => master,
 *  phd     => phd,
 *  int_phd => phd-integrated
 *  fy      => foundation-year,
 *  *       => ''
 * @param {string} $str
 * @return {string}
 */
function getStatus( $str ){
  $str = strtolower( $str );
  switch( $str ){
    case 'ug':      return 'undergrad';
    case 'm':       return 'master';
    case 'fy':      return 'foundation-year';
    case 'phd':     return 'phd';
    case 'int_phd': return 'phd-integrated';
    default:        return '';
  }
  return '';
}

/**
 * Checks wheter a string has a College Name in it
 * @param {string} $string
 * @return {bool}
 */
function isCollege( $string ){
  return stripos( $string, 'College' ) !== FALSE;
}

/**
 * Returns the initial of the college, if it is a college, empty string otherwise
 * @param {string} $string
 * @return {string}
 */
function collegeInitial( $string ){
  if( stripos( $string, 'Mercator' ) !== false ){
    return 'M';
  } else if( stripos( $string, 'Krupp' ) !== false ) {
    return 'K';
  } else if( stripos( $string, 'College III' ) !== false ){
    return 'C';
  } else if( stripos( $string, 'Nordmetall' ) !== false || stripos( $string, 'College IV' ) !== false ){
    return 'N';
  } else {
    return '';
  }
}

/**
 * Takes a mapping of key=>values and returns a "() VALUES (...),(...)..." string out of it
 * @param {array} $arr  The map
 * @return {string}  a string of the type: "(key1, key2, ... ) VALUES (`value1.1`, `value1.2`, ...), (`value2.1`...), ..."
 */
function makeQuery( array $arr ){
  if( count($arr) > 0 ){
    $values = array();
    foreach( $arr as $v ){
      if( is_array( $v ) ){
        $values[] = "\n".'('.implode( ',', mysqlValue( $v ) ).')';
      }
    }
    return '('.implode(',', array_keys($arr[0])).') VALUES '.implode(',', $values);
  } else {
    return '';
  }
}

/**
 * Returns the VALUES for the specified DOMElement
 * @param {DOMElement} $person  The DOM Element Tag
 * @param {Array} $map  key=>value mapping of the columns to new columns
 * @returns {Array}  Associative array of newKey=>Value pairs
 */
function getValues( $person, $map ){
  $vals = array();
  foreach( $map as $k => $v ){
    $vals[$v] = utf8_decode($person->getElementsByTagName($k)->item(0)->textContent);
  }
  return $vals;
}

/**
 * Wraps every element of the array in quotes and applies mysql_real_escape_string.
 * Usually used for INSERT Queries
 * @param {array} $arr
 * @param {char} $quote
 * @return {array}
 */
function mysqlValue( array $arr, $quote = "'" ){
  foreach( $arr as $k => $v ){
    $arr[$k] = $quote.mysql_real_escape_string($v).$quote;
  }
  return $arr;
}

?>
