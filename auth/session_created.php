<?php include(dirname(__FILE__)."/../admin/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>jPeople - Login</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="../client/libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../client/libs/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../client/css/main.css" />

	<meta http-equiv="refresh" content="<?php echo $config["session_created_redirect_timeout"]; ?>; url=../" />
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
				<h1>You have been logged in. You will be redirected in <?php echo $config["session_created_redirect_timeout"]; ?> second(s). </h1>
				<p>
					User: <?php echo $_SESSION["user"]; ?> <br />
					<a href="../" class="btn btn-primary">Continue</a>
				</p>
			</div>
		</div>

		<div class="footer"><?php include dirname(__FILE__) . "/../query/footer.php";  ?></div>

	</div>
	<script src="client/libs/jquery/jquery.js"></script>
	<script src="client/libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>