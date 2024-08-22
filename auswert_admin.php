<?php

/*------------------------------------------------------------------------------
// Individuelle Auswertung der Tippspielligen für Webmaster
// Autor: Marcus - www.bcerlbach.de
//------------------------------------------------------------------------------
// Download unter: http://forum.bcerlbach.de/downloads.php?cat=7

  * Wer immer über Updates informiert werden will, der sollte sich 
  * im BCE-Forum registrieren. Denn dann hat man die Möglichkeit einen 
  * Download zu abonieren. D.h. wenn etwas daran geändert wurde, 
  * so wird umgehend eine E-Mail verschickt.
  
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License as
  * published by the Free Software Foundation; either version 2 of
  * the License, or (at your option) any later version.
  * 
  * This program is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
  * General Public License for more details.
  *
  * REMOVING OR CHANGING THE COPYRIGHT NOTICES IS NOT ALLOWED!
  *
------------------------------------------------------------------------------*/


require_once(dirname(__FILE__).'/init.php');

//datei gesamt.aus in array einlesen... evtl. Pfad anpassen
$auswertdatei="addon/tipp/tipps/auswert/gesamt.aus";

//schriftgrösse
$fontsize = 10;

//prüfen ob Datei vorhanden ist
if (is_file($auswertdatei)) {
    $array = @file($auswertdatei);
}
else {
	//Skript abbrechen wenn Datei nicht vorhanden
	die("Datei $auswertdatei nicht vorhanden - Tippspiel neu auswerten!");
	}
		
//prüfen ob Konfig-Datei angelegt ist
if (!is_file("auswert.cfg")) {
	//Skript abbrechen wenn Datei nicht vorhanden -> Datei muss manuell hochgeladen werden
	die("Konfig-Datei nicht vorhanden - auswert.cfg hochladen und chmod 666 setzen!");
}
else {
	 $config = @file("auswert.cfg");
	 
	//seitentitel
	if (strlen(trim($config[1])) > 0) {
	   $title = trim($config[1]);
	}
	else {
	     $title = "www.bcerlbach.de - Individuelle Auswertung der Tippspielligen";
		 }
	
	//farbe seitenhintergund
	if (strlen(trim($config[2])) > 0) {
	   $backgroundcolor = trim($config[2]);
	}
	else {
	     $backgroundcolor = "#B9C4CC";
		 }
		
	// Schriftart - bei Standardschrift Feld leer lassen -> $fontfamily = "";
	if (strlen(trim($config[3])) > 0) {
	   $fontfamily = trim($config[3]);
	}
	else {
	     $fontfamily = "Verdana,Arial,Helvetica,Times";
		 }
		 	
	// Die Schriftfarbe, die bei den Fehlermeldungenim Browser verwendet werden soll
	if (strlen(trim($config[4])) > 0) {
	   $fontfehl = trim($config[4]);
	}
	else {
	     $fontfehl = "#800000";
		 }
	
	//Farbe des Tabellenkopfes
	if (strlen(trim($config[5])) > 0) {
	   $tablehaedercolor = trim($config[5]);
	}
	else {
	     $tablehaedercolor = "#C7CFD6";
		 }
		
	//Farbe des Tabellenintergrundes
	if (strlen(trim($config[6])) > 0) {
	   $tablebackcolor = trim($config[6]);
	}
	else {
	     $tablebackcolor = "#C7CFD6";
		 }
	
	//Farbe der Tabellenschrift
	if (strlen(trim($config[7])) > 0) {
	   $tablefontcolor = trim($config[7]);
	   $fontcolor = trim($config[7]);	   
	}
	else {
	     $tablefontcolor = "#000000";
		 $fontcolor = "#000000";
		 }
	
	//Größe der Tabellenschrift in Punkt
	if (strlen(trim($config[8])) > 0) {
	   $tablefontsize = trim($config[8]);
	}
	else {
	     $tablefontsize = "10";
		 }
	
	//anzeige-tipper-begrenzung laut config
	if (strlen(trim($config[9])) > 0) {
	   $anztipper = trim($config[9]);
	}
	else {
	     $anztipper = "10";
		 }
		
	//sollen tipper die noch keinen tipp abgegeben haben angezeigt werden?
	if (strlen(trim($config[10])) > 0) {
	   $shownichttipper = trim($config[10]);
	}
	else {
	     $shownichttipper = "0";
		 }
	
	//was soll bei der auswertung angezeigt werden?  1 = anzeigen; 0 nicht anzeigen
	//anzahl spiele getippt
	if (strlen(trim($config[11])) > 0) {
	   $show_sp_ges = trim($config[11]);
	}
	else {
	     $show_sp_ges = "1";
		 }
		 
	//quote richtiger tipps
	if (strlen(trim($config[12])) > 0) {
	   $show_sp_proz = trim($config[12]);
	}
	else {
	     $show_sp_proz = "1";
		 }
		 
	//jokerpunkte
	if (strlen(trim($config[13])) > 0) {
	   $show_joker = trim($config[13]);
	}
	else {
	     $show_joker = "1";
		 }
		 
	//anzahl punkte -> hier ist die 1 empfohlen
	if (strlen(trim($config[14])) > 0) {
	   $show_punkte = trim($config[14]);
	}
	else {
	     $show_punkte = "1";
		 }
	
	
	//zeichen im tabellenkopf bei der ausgabe einstellen - Variablen anpassen
	//Anzahl Spiele getippt - Standard "Sp"
	if (strlen(trim($config[15])) > 0) {
	   $var_spiele = trim($config[15]);
	}
	else {
	     $var_spiele = "Sp";
		 }
	//durch Joker dazugewonnene Punkte - standard "JP"
	if (strlen(trim($config[16])) > 0) {
	   $var_joker = trim($config[16]);
	}
	else {
	     $var_joker = "JP";
		 }
		 
	//Prozent Spieltipp richtig - Standard "Sp%"
	if (strlen(trim($config[17])) > 0) {
	   $var_prozrichtig = trim($config[17]);
	}
	else {
	     $var_prozrichtig = "Sp%";
		 }
	
	//Anzahl Tipps richtig - Standard "P"
	if (strlen(trim($config[18])) > 0) {
	   $var_punkte = trim($config[18]);
	}
	else {
	     $var_punkte = "Pkt";
		 }
	
	
	// Zellenhintergrundfarbe für Platz 1 bis 3
	if (strlen(trim($config[19])) > 0) {
	   $colorplatz1 = trim($config[19]);
	}
	else {
	     $colorplatz1 = "#efed25";
		 }
	
	if (strlen(trim($config[20])) > 0) {
	   $colorplatz2 = trim($config[20]);
	}
	else {
	     $colorplatz2 = "#bab4a2";
		 }
	
	if (strlen(trim($config[21])) > 0) {
	   $colorplatz3 = trim($config[21]);
	}
	else {
	     $colorplatz3 = "#cc9b18";
		 }
		 
	//tabellenfüllabstände
	if (strlen(trim($config[22])) > 0) {
	   $tablespace = trim($config[22]);
	}
	else {
	     $tablespace = "1";
		 }
		 
	if (strlen(trim($config[23])) > 0) {
	   $tablepad = trim($config[23]);
	}
	else {
	     $tablepad = "2";
		 }
		 		 	
	//klammern um usernamen anzeigen -> 1 - ja, 0 - nein
	if (strlen(trim($config[24])) > 0) {
	   $show_klammern = trim($config[24]);
	}
	else {
	     $show_klammern = "1";
		 }
		 
	//ausrichtung usernamen - center, left, right
	if (strlen(trim($config[25])) > 0) {
	   $ausrichtung_user = trim($config[25]);
	}
	else {
	     $ausrichtung_user = "center";
		 }		      

	//ausrichtung anzahl spiele - center, left, right
	if (strlen(trim($config[26])) > 0) {
	   $ausrichtung_anzsp = trim($config[26]);
	}
	else {
	     $ausrichtung_anzsp = "center";
		 }		      
		 
	//ausrichtung anzahl spiele - center, left, right
	if (strlen(trim($config[27])) > 0) {
	   $ausrichtung_jokpkt = trim($config[27]);
	}
	else {
	     $ausrichtung_jokpkt = "center";
		 }		      

	//ausrichtung anzahl spiele - center, left, right
	if (strlen(trim($config[28])) > 0) {
	   $ausrichtung_prozsp = trim($config[28]);
	}
	else {
	     $ausrichtung_prozsp = "center";
		 }		      

	//ausrichtung anzahl spiele - center, left, right
	if (strlen(trim($config[29])) > 0) {
	   $ausrichtung_anztip = trim($config[29]);
	}
	else {
	     $ausrichtung_anztip = "center";
		 }		      

	//ausrichtung anzahl spiele - center, left, right
	if (strlen(trim($config[30])) > 0) {
	   $ausrichtung_platz = trim($config[30]);
	}
	else {
	     $ausrichtung_platz = "center";
		 }	

	//ausrichtung anzahl spiele - center, left, right
	if (strlen(trim($config[31])) > 0) {
	   $ausrichtung_team = trim($config[31]);
	}
	else {
	     $ausrichtung_team = "center";
		 }	
		 
	//punkt nach der platzierung? 0 - nein, 1 - ja
	if (strlen(trim($config[32])) > 0) {
	   $show_platzpkt = trim($config[32]);
	}
	else {
	     $show_platzpkt = 0;
		 }		      

	//
	if (strlen(trim($config[33])) > 0) {
	   $show_headline = trim($config[33]);
	}
	else {
	     $show_headline = 0;
		 }		      



	 }//else
	
//prüfen ob Konfig-Datei angelegt ist
if (!is_file("auswert_funk.php")) {
	//Skript abbrechen wenn Datei nicht vorhanden -> Datei muss manuell hochgeladen werden
	die("Funktions-Datei nicht vorhanden - auswert_funk.php hochladen");
}
else { 
     include("auswert_funk.php");
	 }


/* anzahl der tipp-ligen ermitteln */
$zeile = trim($array[1]); // unnötige zeilenumbrüche ... entfernen
$anzligen = substr($zeile, 9, strlen($zeile)); //->eigentlich immer ab 10ter stelle

//version
$ver = "1.8.5";

//zurück-button
$zurueck = "<b><a href=\"javascript:history.go(-1);\">zur&uuml;ck</a></b><br>";		


/* Eingabemaske zusammenbasteln und ausgeben */
$htmlhead = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
      "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
 <title>'.$title.'</title>
<style type="text/css">
body {
font-size: '. $fontsize .'pt;
font-family: '. $fontfamily .';
color: '. $fontcolor .';
background-color: #B9C4CC;
	/* Farbe der Scrollbalken */
	scrollbar-face-color: #B9C4CC;
	scrollbar-track-color: #B9C4CC;
	scrollbar-highlight-color: #B9C4CC;
	scrollbar-3dlight-color: #B9C4CC;
	scrollbar-darkshadow-color: #B9C4CC;
	scrollbar-base-color:#B9C4CC; 
	scrollbar-arrow-color:  #889CB0;	
	scrollbar-shadow-color: #889CB0;	
}

p {
	font-size: '. $fontsize .'pt;
}

h2 {
	margin-top: 5px; 
	margin-bottom: '. $headlinefontsize .'px;
	color: #D8E4EC;
	background-color: #889CB0;
	text-align: center;
}

a { text-decoration: overline,underline; color: #3E4753; font-size: 10pt;}
a:visited	{ text-decoration: underline; color: #3E4753; }
a:hover		{ text-decoration: underline; color: #104E8B; }
a:active	{ text-decoration: underline; color: #D8E4EC; }

table.auswert {
	font-size: '. $tablefontsize .'pt;
	color: '. $tablefontcolor .';
	background-color: '. $tablebackcolor .';
	text-align: center; 
	BORDER: #8CA0B4 1px dotted; 
}
th.auswert {
	background-color: '. $tablehaedercolor .';
}

hr { 
	height: 0px; 
	border: dashed #525E6E 0px; 
	border-top-width: 1px;
}

input {
	color : #000000;
	background-color: #B9C4CC;
	font-size: 10pt;
}

acronym {
	cursor:help;
	border-bottom:1px dotted;
}

font.foot {
	font-size: 8pt;
}

a.foot { text-decoration: overline,underline; color: #3E4753; font-size: 8pt; }

input.button {
	background-color: #889CB0;
	border: #123456 1px dashed;
}

</style>
';
 
$htmlhead .= '
<script type="text/javascript" language="javascript1.2">
<!--
window.status=\''.$title.'\';
';/*function checkAll(elm) {
  for (var i = 0; i < elm.form.elements.length; i++) {
    if (elm.form.elements[i].type == "checkbox") {
      elm.form.elements[i].checked = true;
    }
  }
}
function uncheckAll(elm) {
  for (var i = 0; i < elm.form.elements.length; i++) {
    if (elm.form.elements[i].type == "checkbox") {
      elm.form.elements[i].checked = false;
    }
  }
}
function switchAll(elm) {
  for (var i = 0; i < elm.form.elements.length; i++) {
    if (elm.form.elements[i].type == "checkbox") {
      elm.form.elements[i].checked = !elm.form.elements[i].checked;
    }
  }
}*/
$htmlhead .= 'function select_switch(status) 
{ 
   for (i = 0; i < document.formular.length; i++) 
   { 
      document.formular.elements[i].checked = status; 
   } 
} 
// -->
</script>
</head>';

$htmlbody = '<body> 
<h2>Admin - Entscheidungen</h2>
	<table border="1" cellspacing="0" cellpadding="5" align="center">
		<tr><td align="left">';
	
//$htmlfoot = '</table><p align="right">Auswertskript für Webmaster '.$ver.'<br>&copy; by Marcus - <a href="http://www.bcerlbach.de" target="_blank">www.bcerlbach.de</a></p>
//</body></html>';

$htmlfoot = '<hr width="195" align="right" />
<p style="line-height:12px; margin-top:0px" align="right">
<font class="foot"><a href="http://forum.bcerlbach.de/downloads.php?cat=7" class="foot" target="_blank" title="zum Download">Auswertskript</a> v'. $ver .' &copy; by <a href="http://www.bcerlbach.de" class="foot" target="_blank" title="zur Homepage">Marcus</a></font></p>
</body></html>';



if (!$_POST["iswas"]){
  // Formular an den Browser senden
  $htmlbody .= '<form name="formular" method="post" action="'.$_SERVER["REQUEST_URI"].'">
	<table border="0" cellspacing="'.$tablespace.'" cellpadding="'.$tablepad.'" align="center">
	  <tr>
	  	<td colspan="2" align="left"><br />Die gewünschten Ligen markieren und Einstellungen wählen.<br />Anschließend Button (Auswahl speichern) klicken.<br></td>
	  </tr>';
	  
$ligenkurz = array();	  

for ($i = 0; $i < $anzligen; $i++) {
    
    $z = $i+1; //for beginnt mit 0, die ausgabe aber mit 1 
    $zl = $i+2; //wird benötigt, da die ligen in der datei ab der 3ten zeile stehen
    
    $dateiname = dateiname( trim($array[$zl])); //liefert ligen-name

	$htmlbody .= '	<tr>
	  	<td colspan="2" align="left">	  
	  <input type="checkbox" value="'.$z.'" name="liga'.$z.'" class="checkbox" checked>&nbsp;&nbsp;'.dateiinfo($dateiname)/*funktionsaufruf um ligeninfo zu ermittlen und auszugeben*/.'
		</td>
	</tr>';	  
}//end-for

 
$htmlbody .= '<tr><td colspan="2" align="left" valign="top" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:select_switch(true);"><font size="1">Alle auswählen</font></a> 
<a href="javascript:select_switch(false);"><font size="1">Auswahl aufheben</font></a></td></tr>

<tr><td colspan="2">&nbsp;</td></tr>

<tr><td align="left">Titel:</td><td><input type="input" name="title" value="'.$title.'" size="50"/></td></tr>

<tr><td align="left">Titel als Überschrift anzeigen:</td><td><input type="radio" name="show_headline" value="1" ';
if ($show_headline == 1) { $htmlbody .= 'checked '; }		
$htmlbody .= '/>ja&nbsp;&nbsp;<input type="radio" name="show_headline" value="0" ';
if ($show_headline == 0) { $htmlbody .= 'checked '; }		
$htmlbody .= '/>nein</td></tr>

<tr><td align="left">Schriftart:</td><td><input type="input" name="fontfamily" value="'.$fontfamily.'" size="30"/>&nbsp;&nbsp;oder Feld leer lassen</td></tr>

<tr><td align="left">Anzahl Tipper:</td><td><input type="input" name="anz" value="'.$anztipper.'" size="5"/>&nbsp;&nbsp;(-1=keine Begrenzung)</td></tr>

<tr><td align="left">Nicht-Tipper zeigen?:</td><td><input type="radio" name="shownichttipper" value="1" ';

if ($shownichttipper == "0") {
	$htmlbody .= '/>ja&nbsp;&nbsp;<input type="radio" name="shownichttipper" value="0" checked />nein</td></tr>';
}
else {
     $htmlbody .= 'checked />ja&nbsp;&nbsp;<input type="radio" name="shownichttipper" value="0" />nein</td></tr>';
	 }

$htmlbody .= '<tr><td align="left">Farbe Seitenhintergrund:&nbsp;</td><td><input type="input" name="backgroundcolor" value="'.$backgroundcolor.'" size="10"/>&nbsp;&nbsp;entweder #123456 oder red oder blue...</td></tr>


<tr><td align="left">Schriftfarbe bei Fehler:&nbsp;</td><td><input type="input" name="fontfehl" value="'.$fontfehl.'" size="10"/>&nbsp;</td></tr>

<tr><td align="left">Farbe Tabellenheader:</td><td><input type="input" name="tableheader" value="'.$tablehaedercolor.'" size="10"/></td></tr>

<tr><td align="left">Farbe Tabellenhintergrund:</td><td><input type="input" name="tableback" value="'.$tablebackcolor.'" size="10"/></td></tr>

<tr><td align="left">Farbe Tabellenschrift:</td><td><input type="input" name="tablefontcolor" value="'.$tablefontcolor.'" size="10"/></td></tr>

<tr><td align="left">Farbe 1. Platz:</td><td><input type="input" name="colorplatz1" value="'.$colorplatz1.'" size="10"/>&nbsp;&nbsp;oder Feld leer lassen</td></tr>

<tr><td align="left">Farbe 2. Platz:</td><td><input type="input" name="colorplatz2" value="'.$colorplatz2.'" size="10"/>&nbsp;&nbsp;oder Feld leer lassen</td></tr>

<tr><td align="left">Farbe 3. Platz:</td><td><input type="input" name="colorplatz3" value="'.$colorplatz3.'" size="10"/>&nbsp;&nbsp;oder Feld leer lassen</td></tr>

<tr><td align="left">Größe Tabellenschrift:</td><td><input type="input" name="tablefontsize" value="'.$tablefontsize.'" size="2"/>&nbsp;&nbsp;pt</td></tr>

<tr><td align="left">Tabellenabstand (tablespace):</td><td><input type="input" name="tablespace" value="'.$tablespace.'" size="2"/></td></tr>

<tr><td align="left">Tabellenabstand (tablepad):</td><td><input type="input" name="tablepad" value="'.$tablepad.'" size="2"/></td></tr>

<tr><td align="left">Folgendes anzeigen:</td><td><input type="checkbox" name="show_klammern" value="1" ';
if ($show_klammern == "1") {
	$htmlbody .= 'checked ';
}
$htmlbody .= '/>&nbsp;&nbsp;Klammern um Usernamen zeigen</td></tr>

<tr><td align="left">&nbsp;</td><td><input type="checkbox" name="show_sp_ges" value="1" ';
if ($show_sp_ges == "1") {
	$htmlbody .= 'checked ';
}
$htmlbody .= '/>&nbsp;&nbsp;Anzahl Spiele getippt</td></tr>

<tr><td align="left">&nbsp;</td><td><input type="checkbox" name="show_sp_proz" value="1" ';
if ($show_sp_proz == "1") {
	$htmlbody .= 'checked ';
}
$htmlbody .= '/>&nbsp;&nbsp;Quote richtiger Tipps</td></tr>

<tr><td align="left">&nbsp;</td><td><input type="checkbox" name="show_joker" value="1" ';
if ($show_joker == "1") {
	$htmlbody .= 'checked ';
}
$htmlbody .= '/>&nbsp;&nbsp;Jokerpunkte</td></tr>

<tr><td align="left">&nbsp;</td><td><input type="checkbox" name="show_punkte" value="1" ';
if ($show_punkte == "1") {
	$htmlbody .= 'checked ';
}
$htmlbody .= '/>&nbsp;&nbsp;Anzahl Punkte</td></tr>

<tr><td align="left">Anzahl Spiele getippt:</td><td><input type="input" name="var_spiele" value="'.$var_spiele.'" size="10"/> <input type="radio" name="ausrichtung_anzsp" value="left" ';
if ($ausrichtung_anzsp == "left") { $htmlbody .= 'checked '; }
$htmlbody .= '>links <input type="radio" name="ausrichtung_anzsp" value="center" ';
if ($ausrichtung_anzsp == "center") { $htmlbody .= 'checked '; }
$htmlbody .= '>zentriert <input type="radio" name="ausrichtung_anzsp" value="right" ';
if ($ausrichtung_anzsp == "right") { $htmlbody .= 'checked '; }
$htmlbody .= '>rechts</td></tr>

<tr><td align="left">Jokerpunkte:</td><td><input type="input" name="var_joker" value="'.$var_joker.'" size="10"/> <input type="radio" name="ausrichtung_jokpkt" value="left" ';
if ($ausrichtung_jokpkt == "left") { $htmlbody .= 'checked '; }
$htmlbody .= '>links <input type="radio" name="ausrichtung_jokpkt" value="center" ';
if ($ausrichtung_jokpkt == "center") { $htmlbody .= 'checked '; }
$htmlbody .= '>zentriert <input type="radio" name="ausrichtung_jokpkt" value="right" ';
if ($ausrichtung_jokpkt == "right") { $htmlbody .= 'checked '; }
$htmlbody .= '>rechts</td></tr>

<tr><td align="left">Prozent Spieltipp richtig:</td><td><input type="input" name="var_prozrichtig" value="'.$var_prozrichtig.'" size="10"/> <input type="radio" name="ausrichtung_prozsp" value="left" ';
if ($ausrichtung_prozsp == "left") { $htmlbody .= 'checked '; }
$htmlbody .= '>links <input type="radio" name="ausrichtung_prozsp" value="center" ';
if ($ausrichtung_prozsp == "center") { $htmlbody .= 'checked '; }
$htmlbody .= '>zentriert <input type="radio" name="ausrichtung_prozsp" value="right" ';
if ($ausrichtung_prozsp == "right") { $htmlbody .= 'checked '; }
$htmlbody .= '>rechts</td></tr>

<tr><td align="left">Anzahl Tipps richtig:</td><td><input type="input" name="var_tippsrichtig" value="'.$var_punkte.'" size="10"/> <input type="radio" name="ausrichtung_anztip" value="left" ';
if ($ausrichtung_anztip == "left") { $htmlbody .= 'checked '; }
$htmlbody .= '>links <input type="radio" name="ausrichtung_anztip" value="center" ';
if ($ausrichtung_anztip == "center") { $htmlbody .= 'checked '; }
$htmlbody .= '>zentriert <input type="radio" name="ausrichtung_anztip" value="right" ';
if ($ausrichtung_anztip == "right") { $htmlbody .= 'checked '; }
$htmlbody .= '>rechts</td></tr>

<tr><td align="left">Ausrichtung User-Spalte:</td><td><input type="radio" name="ausrichtung_user" value="center" ';

if ($ausrichtung_user == "center") {
	$htmlbody .= 'checked ';
}		
$htmlbody .= '/>zentriert&nbsp;&nbsp;<input type="radio" name="ausrichtung_user" value="left" ';

if ($ausrichtung_user == "left") {
	$htmlbody .= 'checked ';
}		
$htmlbody .= '/>links&nbsp;&nbsp;<input type="radio" name="ausrichtung_user" value="right" ';

if ($ausrichtung_user == "right") {
	$htmlbody .= 'checked ';
}	
$htmlbody .= '/>rechts</td></tr>';



$htmlbody .= '<tr><td align="left">Punkt bei Platzierung anzeigen:</td><td><input type="radio" name="show_platzpkt" value="1" ';
if ($show_platzpkt == 1) { $htmlbody .= 'checked '; }		
$htmlbody .= '/>ja&nbsp;&nbsp;<input type="radio" name="show_platzpkt" value="0" ';
if ($show_platzpkt == 0) { $htmlbody .= 'checked '; }		
$htmlbody .= '/>nein</td></tr>

<tr><td align="left">Ausrichtung Platzierung:</td><td><input type="radio" name="ausrichtung_platz" value="left" ';
if ($ausrichtung_platz == "left") { $htmlbody .= 'checked '; }
$htmlbody .= '>links <input type="radio" name="ausrichtung_platz" value="center" ';
if ($ausrichtung_platz == "center") { $htmlbody .= 'checked '; }
$htmlbody .= '>zentriert <input type="radio" name="ausrichtung_platz" value="right" ';
if ($ausrichtung_platz == "right") { $htmlbody .= 'checked '; }
$htmlbody .= '>rechts</td></tr>

<tr><td align="left">Ausrichtung Team:</td><td><input type="radio" name="ausrichtung_team" value="left" ';
if ($ausrichtung_team == "left") { $htmlbody .= 'checked '; }
$htmlbody .= '>links <input type="radio" name="ausrichtung_team" value="center" ';
if ($ausrichtung_team == "center") { $htmlbody .= 'checked '; }
$htmlbody .= '>zentriert <input type="radio" name="ausrichtung_team" value="right" ';
if ($ausrichtung_team == "right") { $htmlbody .= 'checked '; }
$htmlbody .= '>rechts</td></tr>



<tr><td colspan="2" align="center">&nbsp;<input type="hidden" name="iswas" value="1" /><br><input type="submit"  class="button" value="Auswahl speichern" name="submit" /><br><font class="foot">(beim Klick wird Config-Datei erstellt)</font></td></tr>
</table></form>
</table>
';

//echo $htmlhead . $htmlbody. $htmlhead; //html-seite sichtbar ausgeben

//******************************************************************************
}
else /* wenn der button geklickt wurde */  
	{
	    
	//prüfung wieviele ligen gewählt wurden
	$zligen=0;
    for ($i = 1; $i <= $anzligen; $i++) {
	    $ligavar="liga".$i;
	    // checken welche ligen gewählt wurden
	    if($_POST[$ligavar]==$i) {
			$zligen++;
		}    
	}//end-for  	
	

	if ($zligen == 0) { /* keine liga gewählt */
		$htmlbody .= '<font class="fehler">-&gt; keine Liga gewählt</font><br><br>'.$zurueck;
	}
	else {
	    	    
		//chmod("auswert.cfg", 0666);
		//werte in config-datei speichern
	    $cfgdatei = fopen("auswert.cfg", "w");
	    											//zeilennr. configdatei
	    fwrite($cfgdatei, $auswertdatei."\r\n");		//1. gesamt.aus
	    fwrite($cfgdatei, $_POST[title]."\r\n");		//2. titel
	    fwrite($cfgdatei, $_POST[backgroundcolor]."\r\n"); //3. hintergrundfarbe
	    fwrite($cfgdatei, $_POST[fontfamily]."\r\n");		//4. fontfamily
	    fwrite($cfgdatei, $_POST[fontfehl]."\r\n");		//5. fontfehl
	    fwrite($cfgdatei, $_POST[tableheader]."\r\n");	//6. tableheader
	    fwrite($cfgdatei, $_POST[tableback]."\r\n");	//7. tableback
	    fwrite($cfgdatei, $_POST[tablefontcolor]."\r\n");//8.tablefontcolor
	    fwrite($cfgdatei, $_POST[tablefontsize]."\r\n");//9. tablefontsize
		fwrite($cfgdatei, $_POST[anz]."\r\n");			//10. anzahl tipper
		fwrite($cfgdatei, $_POST[shownichttipper]."\r\n");//11.shownichttipper
		
		if ($_POST['show_sp_ges'] == 1) { //12 Anzahl Spiele getippt
			fwrite($cfgdatei, "1\r\n");	
		}
		else {
			 fwrite($cfgdatei, "0\r\n");	
		}
		
		if ($_POST['show_sp_proz'] == 1) { //13 quote
			fwrite($cfgdatei, "1\r\n");	
		}
		else {
			 fwrite($cfgdatei, "0\r\n");	
		}		
		if ($_POST['show_joker'] == 1) { //14 jokerpunkte
			fwrite($cfgdatei, "1\r\n");
		}
		else {
			 fwrite($cfgdatei, "0\r\n");	
		}		
		if ($_POST['show_punkte'] == 1) { //15 anzahl punkte
			fwrite($cfgdatei, "1\r\n");	
		}
		else {
			 fwrite($cfgdatei, "0\r\n");	
		}		
		
		fwrite($cfgdatei, $_POST[var_spiele]."\r\n");	//16 "Sp"
		fwrite($cfgdatei, $_POST[var_joker]."\r\n");	//17 "JP"
		fwrite($cfgdatei, $_POST[var_prozrichtig]."\r\n");//18 "Sp%"
		fwrite($cfgdatei, $_POST[var_tippsrichtig]."\r\n");//19 "P"
		fwrite($cfgdatei, $_POST[colorplatz1]."\r\n");//20 fabre 1. platz
		fwrite($cfgdatei, $_POST[colorplatz2]."\r\n");//21 farbe 2. platz
		fwrite($cfgdatei, $_POST[colorplatz3]."\r\n");//22 fabre 3. platz			
		fwrite($cfgdatei, $_POST[tablespace]."\r\n");//23 tab.abstand			
		fwrite($cfgdatei, $_POST[tablepad]."\r\n");//24 tab.abstand
		
		if ($_POST['show_klammern'] == 1) { //25 klammern zeigen
			fwrite($cfgdatei, "1\r\n");	
		}
		else {
			 fwrite($cfgdatei, "0\r\n");	
		}
		
		fwrite($cfgdatei, $_POST[ausrichtung_user]."\r\n");//26 ausrichtung user
		fwrite($cfgdatei, $_POST[ausrichtung_anzsp]."\r\n");//27 ausrichtung user
		fwrite($cfgdatei, $_POST[ausrichtung_jokpkt]."\r\n");//28 ausrichtung user
		fwrite($cfgdatei, $_POST[ausrichtung_prozsp]."\r\n");//29 ausrichtung user
		fwrite($cfgdatei, $_POST[ausrichtung_anztip]."\r\n");//30 ausrichtung user
		fwrite($cfgdatei, $_POST[ausrichtung_platz]."\r\n");//29 ausrichtung user
		fwrite($cfgdatei, $_POST[ausrichtung_team]."\r\n");//30 ausrichtung user		
		fwrite($cfgdatei, $_POST[show_platzpkt]."\r\n");//31 punkt hinter platzierung?
		fwrite($cfgdatei, $_POST[show_headline]."\r\n");//32 titel als überschirft anzeigen
		
		
	    for ($i = 1; $i <= $anzligen; $i++) {
	        
		    $ligavar = "liga".$i;
		    
		    // checken welche ligen gewählt wurden
		    if ($_POST[$ligavar] == $i) {
				fwrite($cfgdatei, 'TP'.$i."\r\n");
			}
		}//end-for     

 
		if (fclose($cfgdatei)) {
		    $htmlbody.='<br />-> Konfig-Datei "auswert.cfg" erfolgreich angelegt<br /><br /> - Die Datei "auswert_admin.php" sollte nun vom Server gelöscht werden!<br /><br /> - von nun an kann auf die Datei "auswert2.php" verwiesen werden (am besten per include(auswert2.php); einbinden)<br /><br /><a href="auswert2.php">zur Ausgabeseite</a><br /><br /></td></tr></table>';
		}
		else {
			 $htmlbody.='<p><br><br><font class="fehler">Config-Datei konnte <b>nicht</b> angelegt werden</font></p>'.$zurueck;   
		}   
		}//else oben
		
    
}//end-else - wenn ok-button geklickt wurde

//html-seite ausgeben
echo $htmlhead . $htmlbody . $htmlfoot;

?>