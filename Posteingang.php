<!DOCTYPE HTML>
<HTML>
<HEAD>

<META CHARSET='UTF-8'>
<TITLE>posteingang</TITLE>
<!--NACHRICHTENHUB DATEI -->
<link rel = "Stylesheet" type = "text/css" href = "style/netzwerkCss.css">
</HEAD>
<BODY>
<?php
include 'Datenbank.php';
include 'disableErrors.php';
error_reporting(-1);
date_default_timezone_set('Europe/Berlin');
$statement = "SELECT * FROM EmpfangeneNachricht WHERE EmpfangeneNachricht.EmpfaengerID = ".$_SESSION['NutzerID'].";";
if(array_key_exists('loesche',$_POST)){
	$loescheErhalteneNachrichten = "DELETE FROM EmpfangeneNachricht WHERE EmpfangeneNachricht.EmpfaengerID = ".$_SESSION['NutzerID'].";";
	$connect->exec($loescheErhalteneNachrichten);
}
if(array_key_exists('sende',$_POST)){	
	$GeldWert = time();
	$SendeNachricht = "INSERT INTO EmpfangeneNachricht(AbsenderID, EmpfaengerID, Nachricht, Zeit) VALUES ('".$_SESSION['NutzerID']."','".$_POST['NachrichtEmpfaenger']."','".$_POST['NachrichtWirdGesendet']."','".$GeldWert."');";
	$connect->exec($SendeNachricht);	
}
if(array_key_exists('aktualisiere',$_POST)){
	ladeNachrichten($connect, $statement);
}else if(array_key_exists('zeigeNutzer',$_POST)){
	oeffneAdressbuch($connect);
};
function ladeNachrichten($datenbankk, $statusEins){
	foreach($datenbankk->query($statusEins)as $eintrag){
		$statementVon = "SELECT Name FROM Nutzer WHERE Nutzer.NutzerID =".$eintrag['AbsenderID'].";";
		if($eintrag['EmpfaengerID'] == $_SESSION['NutzerID']){
			foreach($datenbankk->query($statementVon)as $Eintrag2){
			print "von: ".$Eintrag2['Name'];
		}
		$statementAn = "SELECT Name FROM Nutzer WHERE Nutzer.NutzerID =".$eintrag['EmpfaengerID'].";";
		foreach($datenbankk->query($statementAn)as $Eintrag3){
			print " An: ".$Eintrag3['Name']." Um: ".date('d.m.y H:i:s', $eintrag['Zeit'])."<br>";
		}
		print $eintrag['Nachricht']."\t<br><br>";
		}else{
			echo "hast nichts erhalten";
		};
	}
}
function oeffneAdressbuch($datenbankkk){
	$statementSucheNutzer = "SELECT Name, NutzerID FROM Nutzer";
	foreach($datenbankkk->query($statementSucheNutzer)as $addressBuch){
		print "<div class = 'tr'><div class = 'td'> Nutzer: ".$addressBuch['Name'].";</div><div class = 'td'> Empfängernummer: ".$addressBuch['NutzerID']."</div></div><br>";
	}
}
?>
<div class = "inboxKontrolle">
	<div class = "tableInbox">
		<form method="post">
			<div class = "trInbox">
				<label>Empfaenger:</label>
			</div>
			<div class = "trInbox">
				<input type="text" name="NachrichtEmpfaenger" id = "inboxTextfeld"/>
			</div>
			<div class = "trInbox">
				<label>Nachricht:</label>
			</div>
			<div class = "trInbox">
				<input type="text" name="NachrichtWirdGesendet" id = "inboxTextfeld"/>
			</div>
			<div class = "trInbox">
				<div class = "tdInbox" id = "hide">
					<input type="submit"name="sende"value="sende nachricht" id = "inboxButtonVoll"/>
					</div>
					<div class = "tdInbox">
					<input type="submit"name="aktualisiere"value="aktualisieren" id = "inboxButtonVoll"/>
				</div>
			</div>
			<div class = "trInbox">
					<input type="submit"name="zeigeNutzer"value="Adressbuch aufschlagen" id = "inboxButtonVoll"/>
			</div>
			<div class = "trInbox">
					<input type="submit"name="loesche"value="loesche alles" id = "inboxButtonVoll"/>
			</div>
		</form>
	</div>
		<input type = "button" name = "hideAndSeek" value = "an aus" id = "inboxButtonVoll" onClick = "hideAndSeekJS()"/>
	</div>
	<form action = "Dackel.php" method = "POST">
		<div class = "posteingangDackeln">
			<input type = "submit" name = "posteingangDackelnButton" value = "Dackeln" id = "inboxButtonVoll" onClick = "hideAndSeekJS()"/>
		</div>
	</form>
<script>
function hideAndSeekJS(){
	var boxen = document.getElementsByClassName("trInbox");
	for(var i = 0; i< boxen.length; i++){
		if(boxen[i].style.display === "none"){
			boxen[i].style.display = "block";
		}else{
			boxen[i].style.display = "none";
		}
	}
}
</script>
<?php 
?>
</BODY>
</HTML>