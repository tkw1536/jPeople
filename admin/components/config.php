<?php
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

		$config["server_path"] = $_POST["store_server_path"];
		$config["allow_ips"] = explode(";", $_POST["store_allow_ips"]);

			//update live credentials
		$user = $_POST["store_admin_username"]; 
		$pass = $_POST["store_admin_pass"]; 

			//write the changed settings to a file. 
		$code = json_encode($config);
		$res = @file_put_contents(dirname(__FILE__)."/../config.json", $code) or false; 

		if($res){
			?><div class="alert alert-success">Settings updated. </div><?php
		} else {
			?><div class="alert alert-danger">Failed to save settings. </div><?php
		}
	}

?>
<form method='post' role='form'>
	<input type='hidden' value='yes' name='config_store'> 
	<input type='hidden' value='true' name='login'>
	<input type='hidden' value='<?php echo $user; ?>' name='user'>
	<input type='hidden' value='<?php echo $pass;  ?>' name='pass'>
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


		<br />

		<label for="store_server_path">Relative path of jPeople on the server (with ending /): </label>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="/jpeople/" id="store_server_path" value='<?php echo $config["server_path"];  ?>' name='store_server_path'>
			<div class="input-group-btn">
				<button class="btn btn-default" onclick="return detect(); ">Detect</button>
			</div>

		</div>

		<br />

		<label for="store_server_path">Allow the following (partial) ips without login (seperate by ;) : </label>
		<input type="text" class="form-control" placeholder="" id="store_allow_ips" value='<?php echo implode(";", $config["allow_ips"]);  ?>' name='store_allow_ips'>
	</div>

	<h3>Admin settings</h3>

	<div class="form-group">

		<label for="store_admin_username">Administration Username: </label>
		<input type="text" class="form-control" placeholder="admin" id="store_admin_username" value='<?php echo $config["admin_username"];  ?>' name='store_admin_username'>

		<br />

		<label for="store_admin_pass">Administration Password: </label>
		<input type="password" class="form-control" placeholder="" id="store_admin_pass" value='<?php echo $config["admin_pass"];  ?>' name='store_admin_pass'>
	</div>

	<div class="btn-group">
		<input type="submit" value="Save changes" class="btn btn-default">
		<input type="reset" value="Discard changes" class="btn btn-danger">
	</div>
</form>

<br />


<form method='post' role='form'>
	<input type='hidden' value='true' name='login'>
	<input type='hidden' value='<?php echo $user; ?>' name='user'>
	<input type='hidden' value='<?php echo $pass; ?>' name='pass'>
	<div class="btn-group">
		<input type="submit" value="Return" class="btn btn-info">
		<button class='btn btn-info disabled'>to admin page and discard all changes. </button>
	</div>
</form>

<script type="text/javascript">
	function detect(){
		var path = location.pathname; 
		var suffix = "admin/"; 
		if(path[path.length - 1 ] == "p"){
			//we end on index.php
			suffix = "admin/index.php"; 
		} else if(path[path.length - 1 ] != "/"){
			path = path + "/"; 
		}


		$("#store_server_path").val(path.substring(0, path.length - suffix.length)); 
		return false; 
	}
</script>