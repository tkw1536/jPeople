
<!DOCTYPE html>
<html lang="en">
<head>
	<title>jPeople - Login</title>
	
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="../client/libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../client/libs/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../client/css/main.css" />
</head>
<body>
	<div class="container">
		<div class="header">
			<ul class="nav nav-pills pull-right">
				<li><a href="../">Search</a></li>
				<li class="active"><a href="#">Login</a></li>
			</ul>
			<h3 class="text-muted">jPeople</h3>
		</div>

		<div class="row marketing">
			<div class="col-lg-12">
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

		<div class="footer"><?php include dirname(__FILE__) . "/../query/footer.php";  ?></div>
		
	</div>
	<script src="client/libs/jquery/jquery.js"></script>
	<script src="client/libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>