<?php
	$config = array(

		//mySQL Settings
		"mysql_conn_host" => "localhost", //MySQL Host
		"mysql_conn_user" => "root", //MySQL Username
		"mysql_conn_pass" => "", //MySQL Password
		"mysql_conn_db" => "jpeople", //MySQL Database

		"mysql_table_rawdata" => "RawData", //Table for storing raw data
		"mysql_table_search" => "Search", //Table for storing raw data
		"mysql_table_track" => "Track", //Table for storing raw data

		"session_timeout" => 24 * 60 * 60, //Session timeout in Seconds, default: 1 day
		"session_created_redirect_timeout" => 1, //time to stay on the session created page in seconds, default: 1

		"admin_username" => "admin", //Admin username
		"admin_pass" => "", //admin password

		"disable_campusnet_login" => false, //disable the CampusNet login?

		"min_query_limit" => 3, //minimum number of characters required for query
	);


?>