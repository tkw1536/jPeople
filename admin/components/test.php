<h2>Checking database connection. </h2>

<?php
	$conn = @mysql_connect($config["mysql_conn_host"], $config["mysql_conn_user"], $config["mysql_conn_pass"]) or false; 

	if($conn){
		?><div class="alert alert-success"><strong>MySQL connection: </strong>OK</div><?php
	} else {
		?><div class="alert alert-danger"><strong>MySQL connection: </strong>Failed: <?php echo mysql_error(); ?></div><?php
	}

	$conn = @mysql_select_db($config["mysql_conn_db"]) or false;

	if($conn){
		?><div class="alert alert-success"><strong>MySQL database: </strong>OK</div><?php
	} else {
		?><div class="alert alert-danger"><strong>MySQL databse: </strong>Failed: <?php echo mysql_error(); ?></div><?php
	}
?>

<br />

<form method='post' role='form'>
	<input type='hidden' value='true' name='login'>
	<input type='hidden' value='<?php echo $user; ?>' name='user'>
	<input type='hidden' value='<?php echo $pass; ?>' name='pass'>
	<div class="btn-group">
		<input type="submit" value="return to admin page" class="btn btn-default">
	</div>
</form>