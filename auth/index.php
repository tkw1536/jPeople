<?php
	include "auth.php"; 
	
	if(!@$_POST["username"] && is_session_valid()){
		if(@$_GET["do"] == "logout"){
			session_remove(); 
			$auth_message = "You have been logged out! "; 
			include "session_invalid.php"; 
		} else {
			include "session_valid.php"; 
		}
		
	} else {
		$auth_message = "No valid session found. ";
		if(@$_GET["do"] == "login"){
			if(session_create($_POST["username"], $_POST["password"])){
				include "session_created.php"; 
				die(); 
			} else {
				$auth_message = "<div class='alert alert-danger'>Login failed. </div>";
			}
		}
		include "session_invalid.php"; 
	}
?>