<?php

session_start();

require_once 'class.gator.php';
require_once 'stylesAndSuch.php';

if(!isset($_SESSION['username'])) {
	echo "<script>console.log('Nobody is logged in.')</script>";
	header("Location:login_form_09.php");
}

else {
	echo "<script>console.log('" . $username . " is logged in.')</script>";
}

?>

<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="user-scalable=no, width=device-width" />
<meta charset="UTF-8">
<title>Stakeout | Home</title>
<?php echo $stylesAndSuch; ?>
</head>

<body>
<div class="container">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header"> <a class="navbar-brand" href="//www.roxorsoxor.com/mailer9/index_09.php">You</a> </div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="//www.roxorsoxor.com/mailer9/cases_09.php">Cases</a></li>
					<li><a href="//www.roxorsoxor.com/mailer9/observations_09.php">Observations</a></li>
					<li><a href="//www.roxorsoxor.com/mailer9/gators_09.php">Investigators</a></li>
					<li><a href="//www.roxorsoxor.com/mailer9/assignments_09.php">Assignments</a></li></ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="logout_09.php">Logout</a></li>
				</ul>
			</div>
			<!-- /collapse --> 
			
		</div>
		<!-- /container-fluid --> 
		
	</nav>
	<!-- /navbar -->
	
	<div class="jumbotron">
		<h1>Welcome <?php echo $forename; ?></h1>
		<p class="lead">Your email is <?php echo $email; ?></P>
		<p class="lead">Your username is <?php echo $username; ?></P>
        <p class="lead">Assigned Cases:</P>
		<p class="lead">Recent observations?</P>
	</div>
	<footer class="footer">
		<p>&copy; RoxorSoxor 2017</p>
	</footer>
</div>
<!-- /container -->

</body>
</html>
