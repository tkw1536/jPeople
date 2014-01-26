<!DOCTYPE html>
<html lang="en">
<head>
<title>Logged in. </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">
</head>
<body>
<div class="container">
  <div class="jumbotron">
    <div class="container">
      <h1>Logged in. </h1>
      <p>
          User: <?php echo $_SESSION["user"]; ?> <br />
          <a href="../" class="btn btn-primary">Return</a>
          <a href="?do=logout" class="btn btn-default">Logout</a>
      </p>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</body>
</html>