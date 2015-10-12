<?php

/**
 * @author Anne L'Hôte <anne.lhote@gmail.com>
 * 
 **/

/********** VARIABLES **********/

// Session variables
$iToken			= $_POST['token'];
$sGameName		= $_POST['gameName'];

$oDBConnection	= json_decode(file_get_contents('../../config.json'));

/********** PROGRAM **********/

// DB connection
$mysqli 		= mysqli_connect($oDBConnection->sDbHost, $oDBConnection->sDbUser, $oDBConnection->sDbPassword, $oDBConnection->sDbDatabase) or die("Error " . mysqli_error($link));

// Add this simulation into simulation table
$sQuery			= "INSERT INTO $sTableSimulation ($sColumnToken, $sColumnGame) VALUES ('$iToken', '$sGameName')";

if ($iToken != '' && $sGameName != '') {
	if($stmt = $mysqli->prepare($sQuery)) {
		$stmt->execute();
		$stmt->close();
	}
}

// Close DB connection
$mysqli->close();

?>