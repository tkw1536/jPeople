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
						</div>
					</div>
				</form>
			</div>

			
		</div>

		<div id="results">
			<!-- Results go here -->
		</div>

		<div id="dummyresult" class="hidden">
			<div class="col-lg-3">
				<img src="about:blank" class="resimg">
			</div>
			<div class="col-lg-4">
				<h2>
						<span class="replace" id="lname">lname</span>, <span class="replace" id="fname">fname</span>
				</h2>

				<div>
					<span class="group"><span class="replace" id="majorlong">majorlong</span>, </span><span class="group">Class of 20<span class="replace" id="year">year</span><br /></span>

					<span class="replace" id="description">description</span><span class="group">, <span class="replace" id="status">status</span><br /></span>

					<span class="replace" id="country">country</span>
				</div>
			</div>
			<div class="col-lg-5">

					<span class="group">
					<h2>
						<span class="replace" id="college">college</span>
					</h2>
					</span>

					<div>
						<span class="group">
							Block <span class="replace" id="block">block</span>, 
							Floor <span class="replace" id="floor">floor</span>, 
							Room <span class="replace" id="room">room</span>
						</span>



						<span class="group">
							Office: <span class="replace" id="office">office</span>
							<br />
						</span>



						<span class="group">
							Phone: (+49 421) 200<strong><span class="replace" id="phone">phone</span></strong>
							<a href="#" class="calllink">Call now &raquo;</a>

							<br />
						</span>

						<span class="group">
							E-Mail: <span class="replace" id="email">email</span>
							<a href="#" class="maillink">Write mail &raquo;</a>
						</span>
					</div>


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