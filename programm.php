<!DOCTYPE HTML>
<HTML>
<HEAD>
<META CHARSET="UTF-8">
<TITLE>programm</TITLE>
<!--LOGINVERARBEITUNG-->
<link rel = "Stylesheet" type = "text/css" href = "style/netzwerkCss.css">
</HEAD>
<BODY>
	<?php
		$name = "";
		$passwort = "";
		$name = $_POST['Name'];
		$passwort = $_POST['passwort'];
		$host="localhost";
		$user="root";
		$pass="";
		$datenbank = "Nutzerdaten";
		include 'Datenbank.php';
		include 'disableErrors.php';
		$statementName = "SELECT Name FROM Nutzer WHERE Name = '".$name."';";
		$statementPasswort = "SELECT Passwort, NutzerID FROM Nutzer WHERE Name = '".$name."';";
		foreach($connect->query($statementName)as $eintrag){
			if($name == $eintrag['Name']){
				//passwort pruefen
				foreach($connect->query($statementPasswort)as $eintrag){
					if($passwort == $eintrag['Passwort']){
						echo "erfolg!";
						$_SESSION['Name'] = $name;
						$_SESSION['NutzerID'] = $eintrag['NutzerID'];
						header("Location:Posteingang.php");
					}else {
						echo " falsches passwort";
					}	
				}
				exit;
			} else {
				echo "falscher benutzername";
			}	
		}
	?>
</BODY>
</HTML>