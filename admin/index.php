<?php

	include "config.php"; 

	$REQ_USER = $config["admin_username"]; 
	$REQ_PASS = $config["admin_pass"]; 

	function show_login_page($msg = ""){
		include "header.php"; 
		echo $msg; 
		echo "<form method='post' role='form'>"; 
		echo "<input type='hidden' value='true' name='login'>"; 
		echo "<input type='text' value='' name='user' class='form-control' placeholder='Username'><br/>"; 
		echo "<input type='password' value='' name='pass' class='form-control' placeholder='Password'><br/>"; 
		echo '<input type="submit" value="Login" class="btn btn-default">'; 
		echo "</form>"; 
		include "footer.php";
	}

	if(!@$_POST["login"]){
		 show_login_page(); 
	} else {

		$user = $_POST["user"]; 
		$pass = $_POST["pass"]; 
		if($user != $REQ_USER && $pass != $REQ_PASS){
			show_login_page('<div class="alert alert-danger">Access denied</div>'); 
			die(); 
		}

		if(@$_POST["db_step"]){
			if(@$_POST["db_step"] == "1"){
				include "header.php"; 
				echo "<h2>Updating Database - Step 1/2</h2>"; 
				echo "<pre>"; 
				include(dirname(__FILE__)."/../query/query.pull_data.php");
				echo "</pre>"; 

				echo "<form method='post' role='form'>"; 
				echo "<input type='hidden' value='2' name='db_step'>"; 
				echo "<input type='hidden' value='true' name='login'>"; 
				echo "<input type='hidden' value='$user' name='user'>"; 
				echo "<input type='hidden' value='$pass' name='pass'>"; 
				echo '<input type="submit" value="Step 2" class="btn btn-default">'; 
				echo "</form>";

				include "footer.php"; 
			} else if(@$_POST["db_step"] == "2"){
				include "header.php"; 

				echo "<h2>Updating Database - Step 2/2</h2>";
				echo "<pre>"; 
				include(dirname(__FILE__)."/../query/query.insert_into_db.php");
				echo "</pre>";

				echo "<form method='post' role='form'>"; 
				echo "<input type='hidden' value='true' name='login'>"; 
				echo "<input type='hidden' value='$user' name='user'>"; 
				echo "<input type='hidden' value='$pass' name='pass'>"; 
				echo '<input type="submit" value="Back to admin page" class="btn btn-default">'; 
				echo "</form>";  

				include "footer.php"; 
			} else {
				include "header.php"; 
				echo '<div class="alert alert-danger">Error: Unknown DB step value. </div>'; 
				include "footer.php"; 
			}

		} else if(@$_POST["config_store"]){
			//Unimplemented: Config page
			include "header.php"; 

			include(dirname(__FILE__)."/config.php");

			if(@$_POST["config_store"] == "yes"){

				//store the settings
				$config["mysql_conn_host"] = $_POST["store_mysql_conn_host"]; 
				$config["mysql_conn_user"] = $_POST["store_mysql_conn_user"]; 
				$config["mysql_conn_pass"] = $_POST["store_mysql_conn_pass"]; 
				$config["mysql_conn_db"] = $_POST["store_mysql_conn_db"]; 
				$config["mysql_conn_table"] = $_POST["store_mysql_conn_table"]; 

				$config["disable_campusnet_login"] = (@$_POST["store_disable_campusnet_login"])?true:false; 

				$config["session_timeout"] = intval($_POST["store_session_timeout"]); 
				$config["session_created_redirect_timeout"] = intval($_POST["store_session_created_redirect_timeout"]); 
				$config["min_query_limit"] = intval($_POST["store_min_query_limit"]); 

				$config["admin_username"] = $_POST["store_admin_username"]; 
				$config["admin_pass"] = $_POST["store_admin_pass"]; 

				//update live credentials
				$user = $_POST["store_admin_username"]; 
				$pass = $_POST["store_admin_pass"]; 

				//write the changed settings to a file. 
				$code = json_encode($config, JSON_PRETTY_PRINT);
				$res = @file_put_contents(dirname(__FILE__)."/config.json", $code) or false; 
				
				if($res){
					echo '<div class="alert alert-success">Settings updated. </div>';
				} else {
					echo '<div class="alert alert-danger">Failed to save settings. </div>';
				}
			}

			echo "<form method='post' role='form'>"; 
			echo "<input type='hidden' value='yes' name='config_store'>"; 
			echo "<input type='hidden' value='true' name='login'>"; 
			echo "<input type='hidden' value='$user' name='user'>"; 
			echo "<input type='hidden' value='$pass' name='pass'>"; 
?>

<h2>Configuration page</h2>

<h3>MySQL settings</h3>

<div class="form-group">
	<label for="store_mysql_conn_host">MySQL Database Host: </label>
	<input type="text" class="form-control" placeholder="localhost" id="store_mysql_conn_host" value='<?php echo $config["mysql_conn_host"];  ?>' name='store_mysql_conn_host'>

	<br />

	<label for="store_mysql_conn_user">MySQL Database User: </label>
	<input type="text" class="form-control" placeholder="root" id="store_mysql_conn_user" value='<?php echo $config["mysql_conn_user"];  ?>' name='store_mysql_conn_user'>
	
	<br />

	<label for="store_mysql_conn_pass">MySQL Database Password: </label>
	<input type="password" class="form-control" placeholder="" id="store_mysql_conn_pass" value='<?php echo $config["mysql_conn_pass"];  ?>' name='store_mysql_conn_pass'>

	<br />

	<label for="store_mysql_conn_db">MySQL Database Name: </label>
	<input type="text" class="form-control" placeholder="jpeople" id="store_mysql_conn_db" value='<?php echo $config["mysql_conn_db"];  ?>' name='store_mysql_conn_db'>

	<br />

	<label for="store_mysql_conn_table">MySQL Table Name: </label>
	<input type="text" class="form-control" placeholder="search" id="store_mysql_conn_table" value='<?php echo $config["mysql_conn_table"];  ?>' name='store_mysql_conn_table'>
</div>

<h3>Search settings</h3>

<div class="form-group">

	<div class="checkbox">
		<label>
			<input type="checkbox" name="store_disable_campusnet_login" <?php if($config["disable_campusnet_login"]){echo "checked='checked'"; } ?> id="store_disable_campusnet_login"> Disable Campusnet login
		</label>
	</div>

	<label for="store_session_timeout">Session timeout (seconds): </label>
	<input type="number" min="60" class="form-control" placeholder="86400" id="store_session_timeout" value='<?php echo $config["session_timeout"];  ?>' name='store_session_timeout'>
	
	<br />

	<label for="store_session_created_redirect_timeout">Time to wait after login (seconds): </label>
	<input type="number" min="1" class="form-control" placeholder="1" id="store_session_created_redirect_timeout" value='<?php echo $config["session_created_redirect_timeout"];  ?>' name='store_session_created_redirect_timeout'>

	<br />

	<label for="store_min_query_limit">Minimum number of characters for query: </label>
	<input type="number" min="0" class="form-control" placeholder="3" id="store_min_query_limit" value='<?php echo $config["min_query_limit"];  ?>' name='store_min_query_limit'>
</div>

<h3>Admin settings</h3>

<div class="form-group">

	<label for="store_admin_username">Administration Username: </label>
	<input type="text" class="form-control" placeholder="admin" id="store_admin_username" value='<?php echo $config["admin_username"];  ?>' name='store_admin_username'>
	
	<br />

	<label for="store_admin_pass">Administration Password: </label>
	<input type="password" class="form-control" placeholder="" id="store_admin_pass" value='<?php echo $config["admin_pass"];  ?>' name='store_admin_pass'>
</div>
<?php

			echo '<div class="btn-group">'; 
			echo '<input type="submit" value="Save changes" class="btn btn-default">'; 
			echo '<input type="reset" value="Discard changes" class="btn btn-danger">'; 
			echo '</div>'; 
			echo "</form>";
			echo "<br />";

			echo "<form method='post' role='form'>"; 
			echo "<input type='hidden' value='true' name='login'>"; 
			echo "<input type='hidden' value='$user' name='user'>"; 
			echo "<input type='hidden' value='$pass' name='pass'>"; 
			echo '<div class="btn-group">'; 
			echo '<input type="submit" value="Return" class="btn btn-info">'; 
			echo "<button class='btn btn-info disabled'>to admin page and discard all changes. </button>";
			echo '</div>'; 
			echo "</form>";

			include "footer.php";
		} else if(@$_POST["test_db"]){
			//test settings

			include "config.php"; 
			include "header.php";

			echo "<h2>Checking database connection. </h2>";

			$conn = @mysql_connect($config["mysql_conn_host"], $config["mysql_conn_user"], $config["mysql_conn_pass"]) or false; 
			
			if($conn){
				echo '<div class="alert alert-success"><strong>MySQL connection: </strong>OK</div>';
			} else {
				echo '<div class="alert alert-danger"><strong>MySQL connection: </strong>Failed: ' . mysql_error() . '</div>';
			}

			$conn = @mysql_select_db($config["mysql_conn_db"]) or false;

			if($conn){
				echo '<div class="alert alert-success"><strong>MySQL database: </strong>OK</div>';
			} else {
				echo '<div class="alert alert-danger"><strong>MySQL database: </strong>Failed: ' . mysql_error() . '</div>';
			}

			echo "<br />"; 

			echo "<form method='post' role='form'>"; 
			echo "<input type='hidden' value='true' name='login'>"; 
			echo "<input type='hidden' value='$user' name='user'>"; 
			echo "<input type='hidden' value='$pass' name='pass'>"; 
			echo '<div class="btn-group">'; 
			echo '<input type="submit" value="return to admin page" class="btn btn-default">'; 
			echo '</div>'; 
			echo "</form>";

			include "footer.php";

		} else {
			include "header.php"; 

			//config
			echo "<form method='post' role='form'>"; 
			echo "<input type='hidden' value='no' name='config_store'>"; 
			echo "<input type='hidden' value='true' name='login'>"; 
			echo "<input type='hidden' value='$user' name='user'>"; 
			echo "<input type='hidden' value='$pass' name='pass'>"; 
			echo '<div class="btn-group">'; 
			echo '<input type="submit" value="Configuration" class="btn btn-default">'; 
			echo "<button class='btn btn-warning disabled'>May effect functionality. </button>";
			echo '</div>'; 
			echo "</form>";
			echo "<br />"; 

			//test configuration
			echo "<form method='post' role='form'>"; 
			echo "<input type='hidden' value='true' name='test_db'>"; 
			echo "<input type='hidden' value='true' name='login'>"; 
			echo "<input type='hidden' value='$user' name='user'>"; 
			echo "<input type='hidden' value='$pass' name='pass'>"; 
			echo '<div class="btn-group">'; 
			echo '<input type="submit" value="Test" class="btn btn-success">';
			echo "<button class='btn btn-success disabled'>database settings. </button>";
			echo '</div>'; 
			echo "</form>";
			echo "<br />"; 

			//udpate db
			echo "<form method='post' role='form'>"; 
			echo "<input type='hidden' value='1' name='db_step'>"; 
			echo "<input type='hidden' value='true' name='login'>"; 
			echo "<input type='hidden' value='$user' name='user'>"; 
			echo "<input type='hidden' value='$pass' name='pass'>"; 
			echo '<div class="btn-group">'; 
			echo '<input type="submit" value="Update Database" class="btn btn-default">'; 
			echo "<button class='btn btn-warning disabled'>This may take a while. </button>";
			echo '</div>'; 
			echo "</form>";
			echo "<br />"; 

			//logout
			echo "<form method='post' role='form'>"; 
			echo '<div class="btn-group">'; 
			echo '<input type="submit" value="Logout" class="btn btn-default">';
			echo '</div>'; 
			echo "</form>";

			include "footer.php";
		}
	}
?>