<?php

	include "config.php"; 

	$REQ_USER = $config["admin_username"]; 
	$REQ_PASS = $config["admin_pass"]; 

	function show_login_page($msg = ""){
		echo $msg; 
		echo "<form method='post' role='form'>"; 
		echo "<input type='hidden' value='true' name='login'>"; 
		echo "<input type='text' value='' name='user' class='form-control' placeholder='Username'><br/>"; 
		echo "<input type='password' value='' name='pass' class='form-control' placeholder='Password'><br/>"; 
		echo '<input type="submit" value="Login" class="btn btn-default">'; 
		echo "</form>"; 
	}

	include(dirname(__FILE__)."/components/header.php");
		
	if(!@$_POST["login"]){
		 show_login_page(); 
	} else {

		$user = $_POST["user"]; 
		$pass = $_POST["pass"]; 
		if($user != $REQ_USER or $pass != $REQ_PASS){
			show_login_page('<div class="alert alert-danger">Access denied</div>'); 
		} else if(@$_POST["db_step"]){

			//update database
			include(dirname(__FILE__)."/components/dbup.php");

		} else if(@$_POST["config_store"]){

			//config page
			include(dirname(__FILE__)."/components/config.php");

		} else if(@$_POST["test_db"]){

			//test settings
			include(dirname(__FILE__)."/components/test.php");

		} else {

			//overview page
			include(dirname(__FILE__)."/components/overview.php");

		}
	}

	include(dirname(__FILE__)."/components/footer.php");
?>