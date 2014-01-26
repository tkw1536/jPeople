<!DOCTYPE html>
<html lang="en">
<head>
<title>Not logged in. </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">
</head>
<body>
<div class="container">
  <div class="jumbotron">
    <div class="container">
      <h1>Not logged in. </h1>
      <p>
      	<?php echo $auth_message; ?> <br/>
        You can login by entering your data below. You can use your campusnet credentials. 
        Your password will not be stored and only be used to authenticate with the ldap server. 
        <form role="form" action="?do=login" method="POST">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="username"  placeholder="Enter username">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
			</div>
			<button type="submit" class="btn btn-primary">Login</button>
			<a class="btn btn-default" href="../">Continue in external mode</a>
		</form>
      </p>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</body>
</html>