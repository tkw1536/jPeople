<?php

	include "config.php"; 

	$REQ_USER = $config["admin_username"]; 
	$REQ_PASS = $config["admin_pass"]; 

	if(!@$_POST["step"]){
		include "update_header.html"; 
		echo "<form method='post' role='form'>"; 
		echo "<input type='hidden' value='1' name='step'>"; 
		echo "<input type='text' value='' name='user' class='form-control' placeholder='Username'><br/>"; 
		echo "<input type='password' value='' name='pass' class='form-control' placeholder='Password'><br/>"; 
		echo '<input type="submit" value="Go" class="btn btn-default">'; 
		echo "</form>"; 
		include "update_footer.html"; 
	} else {
		include "update_header.html"; 
		//check auth here
		$step = $_POST["step"]; 
		$user = $_POST["user"]; 
		$pass = $_POST["pass"]; 
		if($user != $REQ_USER && $pass != $REQ_PASS){
			echo "Wrong user/pass"; 
			include "update_footer.html"; 
			die(); 
		}

		if($step == "1"){
			echo "<pre>"; 
			include "01_pull_data.php"; 
			echo "</pre>"; 
			echo "<form method='post' role='form'>"; 
			echo "<input type='hidden' value='2' name='step'>"; 
			echo "<input type='hidden' value='$user' name='user'>"; 
			echo "<input type='hidden' value='$pass' name='pass'>"; 
			echo '<input type="submit" value="Step 2" class="btn btn-default">'; 
			echo "</form>"; 
		}
		if($step == "2"){
			echo "<pre>"; 
			include "02_insert_into_db.php"; 
			echo "</pre>"; 
			echo "<form method='post' role='form'>"; 
			echo "<input type='hidden' value='3' name='step'>"; 
			echo "<input type='hidden' value='$user' name='user'>"; 
			echo "<input type='hidden' value='$pass' name='pass'>"; 
			echo '<input type="submit" value="Finish" class="btn btn-default">'; 
			echo "</form>"; 
		}

		if($step == "3"){
			echo "Clearing temporary files...";
			//delete temporary files
			define("FILE_DATA", __DIR__ . "/jP-data.xml");
			define("FILE_BIRTHDAYS", __DIR__ . "/jP-bDays.dump");

			unlink(FILE_BIRTHDAYS); 
			unlink(FILE_DATA); 
			
			echo "Done with everything. Goodbye. ";
		}
		include "update_footer.html"; 
	}
?>