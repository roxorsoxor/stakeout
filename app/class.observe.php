<?php

require_once '../../secret_php/dbconfig.php';

class OBSERVATION {
	
	public function insertObserve($username,$observation,$observeAsset,$lat,$lng,$caseID,$action,$pix) {
		try {
			$stmt = $db->prepare('INSERT INTO observations(username,observation,observeAsset,lat,lng,caseID,action,pix) VALUES(:uname, :observation, :observeAsset, :lat, :lng, :caseID, :action, :pix)');
			
			$stmt->bindParam(':uname',$username);
			$stmt->bindParam(':observation',$observation);
			$stmt->bindParam(':observeAsset',$observeAsset);
			$stmt->bindParam(':lat',$lat);
			$stmt->bindParam(':lng',$lng);	
			$stmt->bindParam(':caseID',$caseID);
			$stmt->bindParam(':action',$action);
			$stmt->bindParam(':pix',$pix);
			
			if($stmt->execute()) {
				$successMSG = "new record succesfully inserted ...";
				header("refresh:5;observations.php"); // redirects image view page after 5 seconds.
			}
			else {
				$errMSG = "error while inserting....";
			}			
		}
		
		catch(PDOException $ex) {
			echo $ex->getMessage();
		}
	}

} // end of class