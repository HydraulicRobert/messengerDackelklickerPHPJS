<!DOCTYPE html>
<html>
 <head>
  <meta charset = "UTF-8"/>
  <link rel = "stylesheet" type = "text/css" href = "style/netzwerkCss.css"/>
  <title>
   Registrieren
  </title>
 </head>
 <body>
 <?php 
include 'Datenbank.php';
include 'disableErrors.php';
error_reporting(-1);
date_default_timezone_set('Europe/Berlin');
$sucheNutzerCounter = 0;
$checkRegistrierung;
if(array_key_exists('registrierenEinloggen', $_POST)){
	$nutzername = str_replace(" ","",$_POST['Name']);
 $statement = "SELECT Name FROM Nutzer WHERE Name = '".$nutzername."';";
foreach($connect->query($statement)as $sucheBisherige){
	 if($sucheBisherige['Name'] == $nutzername){
		$sucheNutzerCounter++;
	 }else{		echo "nicht gefunden";	 }}
 if($sucheNutzerCounter > 0){
	 echo "<script>alert('nutzer existiert bereits')</script>";
	$checkRegistrierung = "nutzer existiert bereits";
 }else{
	$statementRegistriereNutzer = "INSERT INTO Nutzer(Name, Passwort) VALUES('".$nutzername."','".$_POST['passwort']."')";	$connect->exec($statementRegistriereNutzer);	$statementErhalteNutzerID = "SELECT Nutzer.NutzerID FROM Nutzer WHERE Nutzer.Name = '".$_POST['Name']."';";	$NutzerIDStatement;	foreach($connect->query($statementErhalteNutzerID)as $eintrag){	$NutzerIDStatement = $eintrag['NutzerID'];	}	echo "<script>alert('erfolg')</script>"; }} ?>  <form action="" method="POST">	<div class = "table">	 <div class = "tr">	  <div class = "td">			<a id = "registrierenText" name = "registrierenNutzername">Nutzername:</a>		 </div>		 <div class = "td">			<input type="text" name="Name" id="registrierenTextfeld"/>			</div>		</div>		<div class = "tr">			<div class = "td">				<a id = "registrierenText" name = "registrierenPasswort">Passwort:</a>			</div>			<div class = "td">				<input type = "password" name = "passwort" id = "registrierenTextfeld" />			</div>		</div>			<div class = "tr">				<input type = "submit" value = "Erstellen.." name = "registrierenEinloggen" id = "registrierenButton"/>			</div>			<div class = "tr">				<p><a id = "registrierePruefung" name = "registrierePruefung"></a></p>			</div>			<div class = "tr">				<a href = "index.html">zum login</a>			</div>		</div>	</form> </body></html>