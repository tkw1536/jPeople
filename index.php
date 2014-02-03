<?php include dirname(__FILE__) . "/admin/config.php";  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>jPeople</title>

	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="<?php echo $config["server_path"];  ?>client/libs/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo $config["server_path"];  ?>client/libs/bootstrap/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="<?php echo $config["server_path"];  ?>client/css/main.css" />
</head>
<body>

	<div class="container">
		<div class="header">
			<ul class="nav nav-pills pull-right">
				<li class="active"><a href="#">Search</a></li>
				<li><a href="auth/">Login</a></li>
			</ul>
			<h3 class="text-muted">jPeople</h3>
		</div>

		<div class="row marketing">
			<div class="col-lg-12">
				<form class="navbar-form" role="search" action="<?php echo $config["server_path"]; ?>">
					<div class="input-group">
					<input type="text" class="form-control" placeholder="Search JPeople" name="q" id="q">
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
							Searching unimplemented. 
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="footer"><?php include dirname(__FILE__) . "/query/footer.php";  ?></div>

	</div> <!-- /container -->
	<script src="<?php echo $config["server_path"];  ?>client/libs/jquery/jquery.js"></script>
	<script src="<?php echo $config["server_path"];  ?>client/libs/bootstrap/js/bootstrap.min.js"></script>

	<script src="<?php echo $config["server_path"];  ?>client/js/jpeople.js"></script>
	<script src="<?php echo $config["server_path"];  ?>client/js/utils.js"></script>
	<script src="<?php echo $config["server_path"];  ?>client/js/main.js"></script>
</body>
</html>