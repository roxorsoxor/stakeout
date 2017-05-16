<?php	
session_start();
require_once 'class.gator.php';
require_once 'stylesAndSuch.php';
require_once 'navbar.php';
if(!isset($_SESSION['username'])) {
	echo "<script>console.log('Nobody is logged in.')</script>";
	header("Location:login_form_09.php");
}
else {
	// $_SESSION['username'] = $userRow['username'];
	$username = $_SESSION['username'];
	echo "<script>console.log('" . $username . " is logged in.')</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="user-scalable=no, width=device-width" />
<meta charset="UTF-8">
<title>Assignments</title>
<?php echo $stylesAndSuch; ?>
</head>
<body>
<div class="container">
<?php 
	if ($jefe == 1) {
		echo $navbarJefe;
	}
	else {
		echo $navbarGator;
	}
?>
	  <!-- main -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4>Assignments</h4>
    </div>
    <div class="panel-body"> <!-- Panel Content --> <a href="insert_assignment_09.php" class="btn btn-primary">Assign Case</a>
      <?php
      // PHP code in a more secure location
	  include("../../../php/landfill.php");
	  //Uses PHP code to connect to database
	  $connekt = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	  // Connection test and feedback
	  if (!$connekt)  {    
	  	die('Rats! Could not connect: ' . mysqli_error());  
	  }
	  // Create variable for query
	  $query = "SELECT a.caseID, c.caseName, c.status, a.username, b.forename, b.surname, b.status	
	  	FROM assignments4 a		
	  		INNER JOIN user_creds4 b			
	  			ON a.username = b.username		
	  		INNER JOIN cases4 c			
	  			ON a.caseID = c.caseID				
	  		WHERE b.status = 1 AND c.status = 1";
	  // Use variable with MySQL command to grab info from database
	  $result = $connekt->query($query);
	  // Start creating an HTML table and create header row
	  echo "<table class='table table-striped table-hover'>";
	  echo "<thead><tr><th>Manage</th><th>Case Name</th><th>Investigator</th></tr></thead><tbody>";
	  // Create a row in HTML table for each row from database 
	  while ($row = mysqli_fetch_array($result)) {	 
	  echo "<tr>";	 
	  echo "<td>Manage</td>";	 
	  echo "<td>" . $row["caseName"] . "</td>";	 
	  echo "<td>" . $row['forename'] . " " . $row['surname'] . "</td>";	 
	  echo "</tr>";}
	  // Finish creating HTML table
	  echo "</tbody></table>";
	  // When attempt is complete, connection closes
	  mysqli_close($connekt);
	  ?>
    </div>
  </div>
</div>
<!-- /container -->
</body>
</html>