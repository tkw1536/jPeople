<?php
if(@$_POST["db_step"] == "1"){
	echo "<h2>Updating Database - Step 1/2</h2>"; 
	echo "<pre>"; 
	include(dirname(__FILE__)."/../../query/query.pull_data.php");
	echo "</pre>"; 

	echo "<form method='post' role='form'>"; 
	echo "<input type='hidden' value='2' name='db_step'>"; 
	echo "<input type='hidden' value='true' name='login'>"; 
	echo "<input type='hidden' value='$user' name='user'>"; 
	echo "<input type='hidden' value='$pass' name='pass'>"; 
	echo '<input type="submit" value="Step 2" class="btn btn-default">'; 
	echo "</form>";
} else if(@$_POST["db_step"] == "2"){

	echo "<h2>Updating Database - Step 2/2</h2>";
	echo "<pre>"; 
	include(dirname(__FILE__)."/../../query/query.insert_into_db.php");
	echo "</pre>";

	echo "<form method='post' role='form'>"; 
	echo "<input type='hidden' value='true' name='login'>"; 
	echo "<input type='hidden' value='$user' name='user'>"; 
	echo "<input type='hidden' value='$pass' name='pass'>"; 
	echo '<input type="submit" value="Back to admin page" class="btn btn-default">'; 
	echo "</form>";  

} else {

	echo '<div class="alert alert-danger">Error: Unknown DB step value. </div>'; 
}
?>