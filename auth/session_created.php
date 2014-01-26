<?php include(dirname(__FILE__)."/../admin/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Logged in. </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">
<meta http-equiv="refresh" content="<?php echo $config["session_created_redirect_timeout"]; ?>; url=../" />
</head>
<body>
<div class="container">
  <div class="jumbotron">
    <div class="container">
      <h1>You have been logged in. You will be redirected in <?php echo $config["session_created_redirect_timeout"]; ?> second(s). </h1>
      <p>
          User: <?php echo $_SESSION["user"]; ?> <br />
          <a href="../" class="btn btn-primary">Continue</a>
      </p>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</body>
</html>