<!DOCTYPE html>
<html lang="en">
<head>
	<title>jPeople</title>

	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="client/libs/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="client/libs/bootstrap/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="client/css/main.css" />
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
				There will be a search bar and results here. 
			</div>
		</div>

		<div class="footer"><?php include dirname(__FILE__) . "/query/footer.php";  ?></div>

	</div> <!-- /container -->
	<script src="client/libs/jquery/jquery.js"></script>
	<script src="client/libs/bootstrap/js/bootstrap.min.js"></script>

	<script src="client/js/jpeople.js"></script>
	<script src="client/js/utils.js"></script>
	<script src="client/js/main.js"></script>
</body>
</html>