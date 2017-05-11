<?php

session_start();
require_once 'class.gator.php';

if(!isset($_SESSION['username'])) {
	echo "<script>console.log('Nobody is logged in.')</script>";
	header("Location:login_form_09.php");
}
else {
	// $_SESSION['username'] = $userRow['username'];
	$username = $_SESSION['username'];
	echo "<script>console.log('" . $username . "  is logged in.')</script>";
}

?>

<!DOCTYPE html>
<html>
<head><meta name="viewport" content="user-scalable=no, width=device-width" />
	<meta charset="UTF-8">
    <title>Stakeout | <?php echo $row['username']; ?></title>
    <script src="http://www.jotascript.com/js/jquery-214.js"></script>
    <script src="http://www.jotascript.com/js/jquery_play.js"></script>
    <link rel="stylesheet" type="text/css" href="http://www.jotascript.com/js/bootstrap/css/bootstrap.min.css">
    <script src="http://www.jotascript.com/js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://www.jotascript.com/js/bootstrap/css/justified-nav.css">
    <link rel="apple-touch-icon-precomposed" href = "stakeoutIcon.png" />
    <LINK href="favicon.ico" rel="icon" type="image/x-icon">
    <LINK href="favicon.ico" rel="shortcut icon" type="image/x-icon">
    <LINK href="favicon.ico" rel="icon" type="image/ico">
</head>
<body>
	<div class="container">
             

            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="http://www.roxorsoxor.com/mailer9/index_09.php">You</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="http://www.roxorsoxor.com/mailer9/cases_09.php">Cases</a></li>
                            <li><a href="http://www.roxorsoxor.com/mailer9/observations_09.php">Observations</a></li>
                            <li><a href="http://www.roxorsoxor.com/mailer9/gators_09.php">Investigators</a></li>
						<li><a href="http://www.roxorsoxor.com/mailer9/assignments_09.php">Assignments</a></li>
					</ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="logout_09.php">Logout</a></li>
                        </ul>
                    </div> <!-- /collapse -->
                </div> <!-- /container-fluid -->
            </nav> <!-- /navbar -->
      <div class="jumbotron">
        <h1>Welcome <?php echo $row['forename']; ?></h1>
        <p class="lead">Your email is <?php echo $row['email']; ?></P>
        <p class="lead">Your username is <?php echo $row['username']; ?></P>
      </div>
    <footer class="footer">
        <p>&copy; RoxorSoxor 2017</p>
    </footer>
</div> <!-- /container -->
</body>
</html>
