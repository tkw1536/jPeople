
<!-- Config -->
<form method='post' role='form'>
	<input type='hidden' value='no' name='config_store'> 
	<input type='hidden' value='true' name='login'> 
	<input type='hidden' value='<?php echo $user; ?>' name='user'> 
	<input type='hidden' value='<?php echo $pass; ?>' name='pass'> 
	<div class="btn-group">
		<input type="submit" value="Configuration" class="btn btn-default">
		<button class='btn btn-warning disabled'>May effect functionality. </button>
	</div>
</form>
<br /> 

<!-- Test Config -->
<form method='post' role='form'> 
	<input type='hidden' value='true' name='test_db'> 
	<input type='hidden' value='true' name='login'> 
	<input type='hidden' value='<?php echo $user; ?>' name='user'> 
	<input type='hidden' value='<?php echo $pass; ?>' name='pass'> 
	<div class="btn-group"> 
		<input type="submit" value="Test" class="btn btn-success">
		<button class='btn btn-success disabled'>database settings. </button>
	</div> 
</form>
<br /> 

<!-- Update DB -->
<form method='post' role='form'> 
	<input type='hidden' value='1' name='db_step'> 
	<input type='hidden' value='true' name='login'> 
	<input type='hidden' value='<?php echo $user; ?>' name='user'> 
	<input type='hidden' value='<?php echo $pass; ?>' name='pass'> 
	<div class="btn-group">
		<input type="submit" value="Update Database" class="btn btn-default">
		<button class='btn btn-warning disabled'>This may take a while. </button>
	</div>
</form>
<br /> 

<!-- Logout -->
<form method='post' role='form'> 
	<div class="btn-group"> 
		<input type="submit" value="Logout" class="btn btn-default">
	</div>
</form>