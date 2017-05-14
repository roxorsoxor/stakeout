<?php
session_start();
require_once 'class.gator.php';
require_once 'stylesAndSuch.php';
$user = new USER();

if(isset($_POST['btn-submit']))
{
	$email = $_POST['txtemail'];
	$stmt = $user->runQuery("SELECT id FROM user_creds4 WHERE email=:email LIMIT 1");
	$stmt->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() == 1)
	{
		$id = base64_encode($row['id']);
		$code = md5(uniqid(rand()));
		$stmt = $user->runQuery("UPDATE user_creds4 SET tokenCode=:token WHERE email=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$email));
		$message= "Hello $email,
				   <br /><br />
				   Someone requested this email to reset your password.
				   If it was you, click the link and reset your password.
				   If it wasn't you, someone is up to no good.
				   <br /><br />
				   <a href='https://www.roxorsoxor.com/mailer9/resetpass.php?id=$id&code=$code'>Click here to reset your password</a>.
				   <br /><br />
				   Be safe.
				   ";
		$subject = "Password Reset";
		$user->send_mail($email,$message,$subject);
		$msg = "<div class='alert alert-success'>
					<button class='close' data-dismiss='alert'>&times;</button>
					We've sent an email to $email.
                    Click the link in the email to reset your password.
			  	</div>";
	}
	else
	{
		$msg = "<div class='alert alert-danger'>
					<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Dude!</strong> This totally sucks but your email can not be found.
			    </div>";
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Land of Forgotten Passwords</title>
<?php echo $stylesAndSuch; ?>
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body id="login">
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
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Land of Forgotten Passwords</h2><hr />
        	<?php
			if(isset($msg))
			{
				echo $msg;
			}
			else
			{
				?>
              	<div class='alert alert-info'>
				Request an email with a link to reset your password.
				</div>
                <?php
			}
			?>
        <input type="email" class="input-block-level" placeholder="email@domain.com" name="txtemail" required />
     	<hr />
        <button class="btn btn-danger btn-primary" type="submit" name="btn-submit">Reset password</button>
      </form>
    </div> <!-- /container -->
  </body>
</html>
