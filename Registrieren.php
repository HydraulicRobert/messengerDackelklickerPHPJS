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
	 }else{
 if($sucheNutzerCounter > 0){
	 echo "<script>alert('nutzer existiert bereits')</script>";
	$checkRegistrierung = "nutzer existiert bereits";
 }else{
	$statementRegistriereNutzer = "INSERT INTO Nutzer(Name, Passwort) VALUES('".$nutzername."','".$_POST['passwort']."')";