<!DOCTYPE html><html>	<head>	<link rel = "stylesheet" href = "scoreboard.css">	</head>	<body>	<?php		include "Datenbank.php";		include "disableErrors.php";		$statementUpdate = 	"UPDATE Dackelspiel 							SET Wueffe = '".$_POST['textfeldWueffeUnsichtbar']."',							Dackel = '".$_POST['textfeldDackelUnsichtbar']."',							DackelSchuhe = '".$_POST['textfeldDackelSchuhUnsichtbar']."',							Dackelhorte = '".$_POST['textfeldDoerferUnsichtbar']."',							Pixel = '".$_POST['textfeldPixelUnsichtbar']."'							WHERE DackelspielNutzerID = '".$_SESSION['NutzerID']."';";		$integerino = $connect->prepare($statementUpdate);		$integerino->execute();		$integerino->closeCursor();		session_destroy();		header("Location:punktetafel.php");		?>	</body></html>