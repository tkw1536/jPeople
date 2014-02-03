<?php
	session_start(); 

	include(dirname(__FILE__)."/../admin/config.php");


	function is_session_valid(){
		//Check if a given session (on this server) is correct
		if(@$_SESSION['init']){
			if($_SESSION['timeout'] + $GLOBALS["config"]["session_timeout"] >= time()){
				$_SESSION['timeout'] = time(); 
				return true; 
			} else {
				return false; 
			}
		} else {
			if(requires_login()){
				return false; 
			} else {
				$_SESSION['init'] = false; 
				$_SESSION['timeout'] = 0; 
				$_SESSION['user'] = ""; 
			}
		}
	}

	function session_create($user, $pass){
		if(is_pass_valid($user, $pass)){
			$_SESSION['init'] = true; 
			$_SESSION['user'] = $user; 
			$_SESSION['timeout'] = time(); 
			return true; 
		} else {
			return false; //failed to validate credentials
		}
	}

	function session_remove(){
		session_destroy(); 
	}

	function check_ldap_pass($user, $pass) {
		//connect to ldap and check pass
		if($user == "" || $pass == ""){
			return false; 
		}
		$ldap_host = 'jacobs.jacobs-university.de';
		$ldap_port = 389;
		$ds = @ldap_connect($ldap_host,$ldap_port);
		$res = @ldap_bind($ds, $user . "@" . $ldap_host, $pass); 
		@ldap_unbind($ds); 
		return $res; 
	}

	function is_pass_valid($user, $pass){
		$config = $GLOBALS["config"]; 
		return ($user == $config["admin_username"] && $pass == $config["admin_pass"]) || check_ldap_pass($user, $pass); 
	}

	function requires_login(){
		if(@$_POST["auth_supplied"] == "true"){
			if(is_pass_valid($_POST["user"], $_POST["pass"])){
				return false; 
			} else {
				return true; 
			}
		}
		return !$GLOBALS["config"]["disable_campusnet_login"]; 
	}

	function require_valid_session(){
		if(!is_session_valid()){
			include "401.php"; 
			die(); 
		}
	}

?>