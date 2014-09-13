<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>signup Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signup.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
	<div class="panel panel-default">
	  <div class="panel-body">
      <form class="form-signup" role="form">
        <h2 class="form-signup-heading">Sign Up Today !</h2>
		<h4>First Name </h4><input type="text" class="text-size form-control" placeholder="First Name" required autofocus>
		<h4>Last Name </h4><input type="text" class="form-control text-size" placeholder="First Name">
		<h4>Email Address </h4><input type="email" class="form-control text-size" placeholder="Email address" required>
        <h4>Confirm Email </h4><input type="email" class="form-control text-size" required>
		<h4>Password </h4><input type="password" class="form-control text-size" placeholder="Password" required>
        <h4>Confirm Password </h4><input type="password" class="form-control text-size" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Subscribe for News Feeds
        </label>
        <button class="btn btn-lg btn-primary btn-block text-size" type="submit">Sign Up</button>
      </form>
	  </div>
	  </div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
