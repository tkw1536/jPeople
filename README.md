Another implementation of jPeople, including CampusNet authorisation. Based on [smirea's original version](https://github.com/smirea/jpeople).  

Still in really early stages. 

## Dependencies

* Server: PHP with support for: 
	* ldap
	* session
	* sql
* Client: Any modern browser should do. 

## Setup

* Set up settings in admin/config.php
* Upload files to the webserver; make sure the server has access to the jacobs network
* you may want to delete README.md
* go to 'http://example.com/jpeople/admin/' and enter the admin username and password. Then update the Database. 
* enjoy jpeople working!

## Structure

* 'admin/' - Admin interface for updating database, contains code adapted from the old implementation. 
* 'auth/' - Authorisation with CampusNet (if enabled)
* 'query/' - Files used to query, contains code adapted from the old implementation. 
* 'client/' - Files for the client, written in JavaScript. 
* '/index.php' - Main client
* '/ajax.php' - Client for ajax requests
* '/image.php' - Client for image requests