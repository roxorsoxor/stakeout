<?php
session_start();
require_once 'class.gator.php';
require_once 'stylesAndSuch.php';
require_once 'navbar.php';
$user = new USER();

if(!$user->areTheyLoggedIn()) {
	$user->redirect('http://www.roxorsoxor.com/stakeout/login_form.php');
} else {
	$jefe = $_SESSION['jefe'];
	if ($jefe == 1) {
		echo "<script>console.log('You are an admin.')</script>";
	} else {
		$user->redirect('index.php');
	}	
	$username = $_SESSION['username'];
	echo "<script>console.log('" . $username . " is logged in.')</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cases</title>
	<?php echo $stylesAndSuch; ?>
</head>
<body>
<div class="container">

<nav class='navbar navbar-default'>	
	<div id='header' class='container-fluid'>		
		<h1 class="hide"><a href="index.php">Stakeout</a></h1>
		
<?php 
	echo $navbarJefe;
?>
	
	</div> <!-- /container-fluid -->   
</nav> <!-- /navbar -->	
	
	<!-- main -->
	
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Cases</h3>
		</div>
		<div class="panel-body"> 
			
			<!-- Panel Content --> 
			<?php
				echo "<a href='http://www.roxorsoxor.com/stakeout/insert_case.php' class='btn btn-primary'>Add Case</a>";
				echo "<a href='http://www.roxorsoxor.com/stakeout/cases.php' class='btn btn-primary active' aria-pressed='true'>Show All</a>";
			?>

<?php
// PHP code in a more secure location
    include("../../secret_php/landfill.php");
//Uses PHP code to connect to database
	$connekt = new mysqli($db_hostname, $db_username, $db_password, $db_database);
// Connection test and feedback
  if (!$connekt) {
    die('Rats! Could not connect: ' . mysqli_error());
  }
// Create variable for query
else {

	$query = "SELECT * FROM cases ORDER BY cases.caseName ASC";
	$result = $connekt->query($query);
}

// Use variable with MySQL command to grab info from database
	// $result = $connekt->query($query);
// Start creating an HTML table and create header row
    echo "<table class='table table-striped table-hover'>";
	echo "<thead><tr><th>Case Name</th><th>Status</th></tr></thead><tbody>";
 // Create a row in HTML table for each row from database
    while ($row = mysqli_fetch_array($result)) {
		if ($row["status"] == 1) {
			$caseStatus = "Open";
		}
		else {
			$caseStatus = "Closed";
		}
        echo "<tr>";
        echo "<td><a href='manage_case.php?id=" . $row["caseID"] . "'>" . $row["caseName"] . "</a></td><td>" . $caseStatus . "</td>";
        echo "</tr>";
    }
// Finish creating HTML table
    echo "</tbody></table>";
// When attempt is complete, connection closes
    mysqli_close($connekt);
?>
		</div>
	</div>
</div>
<!-- /container -->
<?php echo $scriptsAndSuch; ?>
</body>
</html>
