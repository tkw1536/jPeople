Another implementation of jPeople, including CampusNet authorisation. Based on [smirea's original version](https://github.com/smirea/jpeople).  

Still in really early stages. 

## Dependencies

* Server: PHP with support for: 
	* ldap
	* session
	* sql
* Client: Any modern browser should do. 

## Setup

* Upload the files to your webserver. Make sure the admin/ and query/ directories are writable by the webserver. 
* Navigate to: 'http://example.com/jpeople/admin/'
* Login with the username 'admin' and an empty password. 
* Update the settings. 
* Update the database. 
* Enjoy jPeople working!

## Structure

* 'admin/' - Admin interface. Mostly for updating the DB. Should be writable by the webserver. 
* 'auth/' - Authorisation with CampusNet (if enabled)
* 'query/' - Files used to query. Should be writable by the webserver. 
* 'client/' - Files for the client, written in JavaScript. 
* '/index.php' - Main client
* '/ajax.php' - Client for ajax requests
* '/image.php' - Client for image requests