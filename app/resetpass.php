<?php

require_once 'class.gator.php';
require_once 'stylesAndSuch.php';
require_once 'navbar.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('https://www.roxorsoxor.com/stakeout/login_form.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];
	
	$stmt = $user->runQuery("SELECT * FROM user_creds WHERE id=:uid AND tokenCode=:token");
	$stmt->execute(array(":uid"=>$id,":token"=>$code));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() == 1)
	{
		if(isset($_POST['btn-reset-pass']))
		{
			$pass = $_POST['pass'];
			$cpass = $_POST['confirm-pass'];
			
			if($cpass!==$pass)
			{
				$msg = "<div class='alert alert-block'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Try again.</strong> Passwords don't match. 
						</div>";
			}
			else
			{
				$password = md5($cpass);
				$stmt = $user->runQuery("UPDATE user_creds SET password=:upass WHERE id=:uid");
				$stmt->execute(array(":upass"=>$password,":uid"=>$rows['id']));
				
				$msg = "<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						Password changed. Good job. You'll be redirected home in 5 seconds.
						</div>";
				header("refresh:5;index.php");
			}
		}	
	}
	else
	{
		$msg = "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				No such account found. Try again.
				</div>";		
	}	
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Password Reset</title>
	<?php echo $stylesAndSuch; ?>   
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
  </head>
  <body id="login">
    <div class="container">
<nav class='navbar navbar-default'>	
	<div id='header' class='container-fluid'>		
		<h1 class="hide"><a href="index.php">Stakeout</a></h1>
<?php 
	if ($jefe == 1) {
		echo $navbarJefe;
	}
	else {
		echo $navbarGator;
	}
?>
	
	</div> <!-- /container-fluid -->   
</nav> <!-- /navbar -->	  
    	<div class='alert alert-success'>
			<strong>Hello there,</strong> <?php echo $rows['username'] ?>! So far, so good. Enter your new password.
		</div>
        <form class="form-horizontal" method="post">
        <legend>Password Changing Station</legend>
        <?php
        if(isset($msg))
		{
			echo $msg;
		}
		?>
		<fieldset>
		<div class="form-group">
        <input type="password" class="form-control" placeholder="Type your new password" name="pass" required />
		</div>
		<div class="form-group">
        <input type="password" class="form-control" placeholder="Type it again" name="confirm-pass" required />
     	</div>
		<div class="form-group">
        <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Make it so</button>
        </div>
		</fieldset>
      </form>
    </div> <!-- /container -->
  <script src='https://www.roxorsoxor.com/stakeout/js/mobrules.js'></script></body>
</html>