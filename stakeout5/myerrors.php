<?php

function debugToConsole($thisError) {	
	$logError = $thisError;	
	echo "<script>console.log('" . $logError . "');</script>";
}

?>