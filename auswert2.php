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

//Konfigurationen laden
if (is_file(PATH_TO_LMO . "/auswert.cfg")) {
    $config = @file(PATH_TO_LMO . "/auswert.cfg");
}
else {
	 die("Konfigurationsdatei nicht vorhanden - neu anlegen!");
	 }

//auswertdatei übergeben	
$array = @file(PATH_TO_LMO . "/" . trim($config[0]));

//seitentitel
$title = trim($config[1]);//"BC Erlbach 1919 - Individuelle Auswertung der Tippspielligen";

//hintergrundfarbe
$backgroundcolor = trim($config[2]);//#B9C4CC;

// Schriftart - bei Standardschrift Feld leer lassen -> $fontface = "";
$fontfamily = trim($config[3]);//"Arial,Courier,Sans-Serif";

// Die Schriftfarbe, die bei den Fehlermeldungenim Browser verwendet werden soll
$fontfehl = trim($config[4]);//"#800000";

//Farbe des Tabellenkopfes
$tablehaedercolor = trim($config[5]);//"#C7CFD6";

//Farbe des Tabellenintergrundes
$tablebackcolor = trim($config[6]);//"#C7CFD6";

//Farbe der Tabellenschrift
$tablefontcolor = trim($config[7]);//"#000000";

//Größe der Tabellenschrift in Punkt
$tablefontsize = trim($config[8]);//"10";
$fontsize = trim($config[8]);//"10";

//anzeige-tipper-begrenzung laut config
$showtipper = trim($config[9]); 

//sollen tipper die noch keinen tipp abgegeben haben angezeigt werden?
$shownichttipper = trim($config[10]);//0; // 0=nein - 1=ja

//was soll bei der auswertung angezeigt werden?  1 = anzeigen; 0 nicht anzeigen
$show_sp_ges = trim($config[11]);//1;//Anzahl Spiele getippt
$show_sp_proz = trim($config[12]);//1;//quote richtiger tipps
$show_joker = trim($config[13]);//1;//jokerpunkte 
$show_punkte = trim($config[14]);//1;//anzahl punkte -> hier ist die 1 empfohlen

//zeichen im tabellenkopf bei der ausgabe einstellen - Variablen anpassen
$var_spiele = trim($config[15]);//"Sp";//Anzahl Spiele getippt - Standard "Sp"
$var_joker = trim($config[16]);//"JP";//durch Joker dazugewonnene Punkte - standard "JP"
$var_prozrichtig = trim($config[17]);//"Sp%";//Prozent Spieltipp richtig - Standard "Sp%"
$var_tippsrichtig = trim($config[18]);//"P";//Anzahl Tipps richtig - Standard "P"

// Zellenhintergrundfarbe für Platz 1 bis 3
$colorplatz1 = trim($config[19]);//"#ef56b1"; 
$colorplatz2 = trim($config[20]);//"#af1e4"; 
$colorplatz3 = trim($config[21]);//"#a234ae"; 

// Tabellenfüllabstände
$tablespace = trim($config[22]);//1
$tablepad = trim($config[23]);//2

//klammern um usernamen zeigen
$show_klammern = trim($config[24]);//1

//klammern um usernamen zeigen
$ausrichtung_user = trim($config[25]);//zentriert

$ausrichtung_anzsp = trim($config[26]);//zentriert
$ausrichtung_jokpkt = trim($config[27]);//zentriert
$ausrichtung_prozsp = trim($config[28]);//zentriert
$ausrichtung_anztip = trim($config[29]);//zentriert
$ausrichtung_platz = trim($config[30]);//zentriert
$ausrichtung_team = trim($config[31]);//zentriert

//punkt hinter platzierung
$show_platzpkt = trim($config[32]);//zentriert

$show_headline = trim($config[33]);//zentriert





$anfang = 34; // endwert + 1

/*wenn weitere einstellungen aus cfg-datei geladen werden: 3 stellen sind anzupassen
--- zeile 109: for ($i = XX+1; $i <= count($config)-1; $i++) {
*/

/* anzahl der tipp-ligen ermitteln */
$zeile = trim($array[1]); // unnötige zeilenumbrüche ... entfernen
$anzligen = substr($zeile, 9, strlen($zeile)); //->eigentlich immer ab 10ter stelle

$tipp_modus = @file(PATH_TO_LMO."/config/tipp/cfg.txt");

//tippmodus ermitteln
for ($i=0; $i<=count($tipp_modus); $i++) {
	if (substr($tipp_modus[$i], 0, 9) == "tippmodus") { 
		//echo "tippmodus:".$i; 
		$tippmodus = substr($tipp_modus[$i], 10, 1); // 0=Tendenz  1=Ergebnis
	}
	if (substr($tipp_modus[$i], 0, 9) == "jokertipp") {
		//echo "jokertipp:".$i; 
		$usejoker = substr($tipp_modus[$i], 10, 1); // 0=nein  1=ja
	}	
}//for

$tippmodus=1;

$ver = "1.8.4"; //Version

/* eingeloggten User ermitteln */
$username = "";
if ( (isset($_SESSION['lmotippername']) && $_SESSION['lmotippername'] != "") && (isset($_SESSION['lmotipperok']) && $_SESSION['lmotipperok'] > 0) ) { 	
    //echo "...mach dies, wenn eingeloggt... ". $_SESSION['lmotippername'];
    $username = "[". $_SESSION['lmotippername'] ."]";
	} 
/*	else {
	     echo "nicht eingeloggt...";
		 }*/

//funktionen einbinden		
include("auswert_funk.php");

$zurueck = "<br><br><br><b><a href=\"javascript:history.go(-1);\">zur&uuml;ck</a></b><br>";
	
//html datei generieren
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
background-color: '. $backgroundcolor .';

/* Farbe der Scrollbalken */
	scrollbar-face-color: #B9C4CC;
	scrollbar-track-color: #B9C4CC;
	scrollbar-highlight-color: #B9C4CC;
	scrollbar-3dlight-color: #B9C4CC;
	scrollbar-darkshadow-color: #B9C4CC;
	scrollbar-base-color:#B9C4CC; 
	scrollbar-arrow-color:  #889CB0;	
	scrollbar-shadow-color: #889CB0;	
/* Ende Farbe der Scrollbalken */

}

table.auswert {
	font-size: '. $tablefontsize .'pt;
	color: '. $tablefontcolor .';
	background-color: '. $tablebackcolor .';
	text-align: center; 
	border: #8CA0B4 1px dotted; 
}

th.auswert {
	background-color: '. $tablehaedercolor .';
}

hr.auswert { 
	height: 0px; 
	border: dashed #525E6E 0px; 
	border-top-width: 1px;
}

acronym.auswert {
	cursor:help;
	border-bottom:1px dotted;
	a:visited	{ text-decoration: underline; color: #3E4753; }
}

font.foot {
	font-size: 8pt;
}

font.fehler {
	font-size: '. $fontfehl .';
}

a.foot { text-decoration: overline,underline; color: #3E4753; font-size: 8pt;}

.rechts { text-align:right; }

.auswertheadline { /*background: #ff0000;*/ text-align: left; }

.ausrichtung_anzsp { text-align: '. $ausrichtung_anzsp .'; }
.ausrichtung_jokpkt { text-align: '. $ausrichtung_jokpkt .'; }
.ausrichtung_prozsp { text-align: '. $ausrichtung_prozsp .'; }
.ausrichtung_anztip { text-align: '. $ausrichtung_anztip .'; }
.ausrichtung_platz { text-align: '. $ausrichtung_platz .'; }
.ausrichtung_team { text-align: '. $ausrichtung_team .'; }

</style>
';
 
/*if (strlen($stylesheet) > 0) {
	$htmlhead .= '<link rel="stylesheet" href="'.$stylesheet.'" type="text/css">';
}*/

$htmlhead .= '</head>';

/*$htmlfoot = '
<hr class="auswert" width="195" align="right" />
<p style="line-height:12px; margin-top:0px" align="right">
<font class="foot"><a href="http://forum.bcerlbach.de/downloads.php?cat=7" class="foot" target="_blank" title="zum Download">Auswertskript für Webmaster</a> v'. $ver .' &copy; by <a href="http://www.bcerlbach.de" class="foot" target="_blank" title="zur Homepage">Marcus</a></font></p>
</body></html>';*/

$htmlfoot = '<div class="rechts"><small>[<acronym title="Auswertskript von Marcus - www.bcerlbach.de">&copy;</acronym>]</small></div>
</body></html>';


$ligenkurz = array();//beinhaltet kürzel für ligen
$anzgetipptkurz = array();//beinhaltet kürzel für anzahl getippter spiele
$jokerkurz = array();//beinhaltet punkte für joker
	
	  
for ($i = $anfang; $i <= count($config)-1; $i++) {	
    // ligen aus config übergeben
    array_push($ligenkurz, trim($config[$i]));
    
	// anzahl getippter spiele	
    $sg = str_replace("TP", "SG", trim($config[$i]));
    array_push($anzgetipptkurz, $sg);//-- kürzel = 'SG'.$i
    
    // jokerpunkte
    $jok = str_replace("TP", "P", trim($config[$i]));
    array_push($jokerkurz, $jok);//-- joker = 'P6'.$i
} 
	
$zligen = count($ligenkurz);//zähler der gewählten ligen
    

//überprüfen dass mind. eine liga gewählt wurde
if ($zligen > 0) 
	{
	 
	$auswert = array();//ausgefiltertes array
	$goal = array(array(),array()); // 2dimensionales array anlegen

	$anzgoal = -1;
    
	/* for durchläuft jede zeile von der auswertungsdatei */
	for ($i = $anzligen+3; $i < sizeof($array); $i++) 
		{
		//usernamen ermitteln, wenn gefunden in array speichern
		$posname = strpos($array[$i], "["); 
		if ($posname !== false)	{
			//gefundenen namen ins array speichern
			$goal[++$anzgoal][0] = $array[$i];
		}

 	    //foreach1 ermittelt die erzielten punkte
		foreach ($ligenkurz as $value) 
		{
		    $value = $value."="; // = muss stehen da bei TP1 auch TP10 TP11 erfasst
			$pos1 = strpos($array[$i], $value); 
			
			if ($pos1 !== false){
		    	//punkte gleich array dazu addieren
		    	$goal[$anzgoal][1] += ltrim(strrchr($array[$i],'='),'=');
			}
		}//foreach1 end
			
		//foreach2 ermittelt die anzahl an getippten spielen
		foreach ($anzgetipptkurz as $value) 
		{
		    $value = $value."="; // = muss stehen da bei TP1 auch TP10 TP11 erfasst
			$pos1 = strpos($array[$i], $value); 
			
			if ($pos1 !== false){
			     //anzahl getippter spiele gleich array dazu addieren
			     $goal[$anzgoal][2] += ltrim(strrchr($array[$i],'='),'=');
			}
		}//foreach2 end
		
		//wird nur benötigt, wenn die joker-punkte angezeigt werden sollen
		if (($show_joker == 1) and ($usejoker == 1))
			{
			//foreach3 ermittelt jokerpunkte
			foreach ($jokerkurz as $value) 
			{
			    $value = $value."="; // = muss stehen da bei TP1 auch TP10 TP11 erfasst
				$pos1 = strpos($array[$i], $value); 
				
				if ($pos1 !== false){
				     //anzahl getippter spiele gleich array dazu addieren
				     $goal[$anzgoal][3] += ltrim(strrchr($array[$i],'='),'=');
				     //variable zeigt ob jokerpunkte genutzt werden, wenn ja joker=1
				     $joker=1;
				}
			}//foreach3 end
		}//if joker				

		//wird nur benötigt, wenn teams angezeigt werden sollen
		if ($show_team == 1)
			{				
			//teamname ermitteln, wenn gefunden in array speichern
			$pos1 = strpos($array[$i], "Team="); 
			if ($pos1 !== false)	{
				//gefundenen namen ins array speichern
				$goal[$anzgoal][4] = ltrim(strrchr($array[$i],'='),'=');
				//var. zeigt ob teams genutzt werden muss, wenn ja team=1
				if (strlen($goal[$anzgoal][4]) != 1) { 
				    $team = 1; 
				}
			}
		}//if team


						
	}//end for	
	
/*for ($i=0; $i < count($goal); $i++){
	echo "$i  ".$goal[$i][0]."  ".$goal[$i][1]." ".$goal[$i][2]."  ".$goal[$i][3]."<br>";
	}*/


/*-------------------------------------------*/
/* BUBBLE SORT  des zweidimensionalen arrays */
/*-------------------------------------------*/

$anzahl_elemente = count($goal); //Anzal der Elemente ermittlen. -1 da Arrays mit 0 beginnen! ;o) 

//Schleife wird entsprechend der Anzahl der Elemente im Array $zahlen wiederholt 
for($y=0; $y<$anzahl_elemente; $y++) 
     { 

     //Jedes Element wird einzelen angesprochen und verschoben wenn das linke Element grösser ist als der rechte 
     for($x=0; $x<$anzahl_elemente; $x++) 
          { 

          //In diesem Beispiel aufsteigend. 
          //Möchte man absteigend sortieren, einfach das grösser Zeichen mit einem kleiner Zeichen tauschen 
          
		// tauschen wenn:
		// 1. erzielte punkte unterschiedlich  oder
		// 2. erzielte pkte gleich + erzielte pkte>0 + anz. tipp unterschiedlich
          if (($goal[$x][1] < $goal[$x+1][1])
          	 or (($goal[$x][1] == $goal[$x+1][1])
				and ($goal[$x][1] > 0)
				and ($goal[$x][2] > $goal[$x+1][2]))) { 
				    
              //Werte werden zwischengespeichert... 
              $grosser_wert = $goal[$x][1]; 
              $kleiner_wert = $goal[$x+1][1];
			  //-namen ebenfalls
		  	  $grosser_name = $goal[$x][0]; 
              $kleiner_name = $goal[$x+1][0];
              //-anzahl getippter spiele
              $grosse_anz = $goal[$x][2];
			  $kleine_anz = $goal[$x+1][2];
			  //-joker
              $grosse_joker = $goal[$x][3];
			  $kleine_joker = $goal[$x+1][3];
			  //-team
              $grosse_team = $goal[$x][4];
			  $kleine_team = $goal[$x+1][4];
			  
              //... und anschließen werte vertauschen
              $goal[$x][1] = $kleiner_wert; 
              $goal[$x+1][1] = $grosser_wert; 
              //-namen tauschen
              $goal[$x][0] = $kleiner_name; 
              $goal[$x+1][0] = $grosser_name; 
              //-anzahl getippter spiele tauschen
			  $goal[$x][2] = $kleine_anz;
			  $goal[$x+1][2] = $grosse_anz;              
			  //-joker
			  $goal[$x][3] = $kleine_joker;
			  $goal[$x+1][3] = $grosse_joker; 
  			  //-team
			  $goal[$x][4] = $kleine_team;
			  $goal[$x+1][4] = $grosse_team;   			  
          }//if

		}//for2 
	}//for1
	  

/*-------------------------------------------*/
/* endausgabe des sortierten arrays          */
/*-------------------------------------------*/

$htmlbody .= '
<body>
<table align="center" class="auswert" cellspacing="'.$tablespace.'" cellpadding="'.$tablepad.'" style="text-align:center; color:'.$tablefontcolor.'; ">';

if ($show_headline == 1) { $htmlbody .= '<tr><td class="auswertheadline" colspan="5">'.$title.'</td></tr>'; }

$htmlbody .= '<tr>
	    <th class="auswert">Platz</th><th class="auswert" align="'.$ausrichtung_user.'">Name</th>';

//gesamten getippter spiele ausgeben?		
if ($show_sp_ges == 1) { 
    $htmlbody.= '<th class="auswert"><acronym class="auswert" title="Anzahl Spiele getippt"><u>'.$var_spiele.'</u></acronym></th>'; 
}

//werden jokerpunkte zugelassen? wenn ja, spalte einblenden	 ja oder nein?   
if (($show_joker == 1) and ($usejoker == 1)) { 
    $htmlbody .= '<th class="auswert"><acronym class="auswert" title="durch Joker dazugewonnene Punkte"><u>'.$var_joker.'</u></acronym></th>'; 
}

//quote richtiger spieler ausgeben ja oder nein?
if ($show_sp_proz == 1) { 
    if ($tippmodus == 0) { // tendenz
	    $htmlbody .= '<th class="auswert"><acronym class="auswert" title="Prozent Spieltipp richtig%"><u>'.$var_prozrichtig.'</u></acronym></th>';
	}
	elseif ($tippmodus == 1) { // ergebnis
		$htmlbody .= '<th class="auswert"><acronym class="auswert" title="Punkte pro Spiel"><u>'.$var_prozrichtig.'</u></acronym></th>';
	}
}

//anzahl tipps ausgeben ja oder nein?		
if ($show_punkte == 1) { 
    $htmlbody.= '<th class="auswert"><acronym class="auswert" title="Anzahl Tipps richtig"><u>'.$var_tippsrichtig.'</u></acronym></th>'; 
}

//team ausgeben ja oder nein?
if (($show_team == 1) and ($team == 1)) { 
    $htmlbody.= '<th class="auswert"><acronym title="Teamzugehörigkeit"><u>'.$var_team.'</u></acronym></th>'; 
}

		
$htmlbody .= '</tr>
';
	   
$platz = 0;
$platz2 = 0;	
   
//für html aufbereiten
for ($i = 0; $i <= count($goal)-1; $i++) {
    
    // begrenzung anzahl tipper
    if ($i == $showtipper) { 
	    break; 
	} 

	//wenn klammern nicht angezeigt werden sollen
	if ($show_klammern == 0) { 
    	$goal[$i][0] = str_replace( "[", "", $goal[$i][0] ); 
    	$goal[$i][0] = str_replace( "]", "", $goal[$i][0] ); 
    }
	
	//bedingung, die alle nicht-tipper rausfiltert falls gewünscht
	if (($shownichttipper != 0) or ($goal[$i][2] != 0)) {
	
		//wert im array mit username vergleichen -> fett darstellen
	    if (chop($goal[$i][0]) == $username) { 
		    $goal[$i][0] = "<b>". $goal[$i][0] ."</b>"; 
		}
	    
	    
	    $htmlbody .= '<tr> <td >';
	    
	    $platz++;
	    
	    //ausgabe der platzierung wenn: 
		//  1. punkte ungleich dem vorgänger
	    //  2. punkte gleich, aber anzahl getippter spiele unterschiedlich
	    if (($goal[$i][1] != $goal[$i-1][1]) or (($goal[$i][1] == $goal[$i-1][1]) and (($goal[$i][2] != $goal[$i-1][2])))) {
			
			$platz2++;
			
			if ($platz == 1) {
			    $htmlbody .= '<tr bgcolor="'.$colorplatz1.'"> <td class="ausrichtung_platz">';
			}
			else if ($platz == 2) {
			        $htmlbody .= '<tr bgcolor="'.$colorplatz2.'"> <td class="ausrichtung_platz">';
				 }
				 else if ($platz == 3) {
			    		 $htmlbody .= '<tr bgcolor="'.$colorplatz3.'"> <td class="ausrichtung_platz">';
					  }
					  else {
			     		   $htmlbody .= '<tr bgcolor="'.$tablebackcolor.'"> <td class="ausrichtung_platz">';
				 	  }
					  
			$htmlbody .= $platz;
			if ($show_platzpkt == 1) { $htmlbody .= "."; }
		}
		else {
			 if ($platz2 == 1) {
			     $htmlbody .= '<tr bgcolor="'.$colorplatz1.'"> <td>';
			 }
			 else if ($platz2 == 2) {
			     	  $htmlbody .= '<tr bgcolor="'.$colorplatz2.'"> <td>';
			 	  }
			 	  else if ($platz2 == 3) {
			     		  $htmlbody .= '<tr bgcolor="'.$colorplatz3.'"> <td>';
					   }
					   else {
						    $htmlbody .= '<tr bgcolor="'.$tablebackcolor.'"> <td>';
							}		    
		     //$platz2 = $platz-1;
		     $htmlbody .= '&nbsp;'; 
		}
	    
	    
	    /*
	    //wenn unterschieldliche punkte und getippte spiele -> ausgabe platz
	    if ($goal[$i][1] != $goal[$i-1][1]) {
			$htmlbody .= $platz;
		}
				//prüfen auf gleiche anzahl an getippten spielen:
				
		else if ($goal[$i][2] == $goal[$i-1][2]) {
				$htmlbody .= '&nbsp;'; // wenn ja, wird leerzeichen ausgegeben
			 }
			 else { // platz auch ausgeben, wenn punkte gleich aber unterschiedlich viele spiele getippt
			      $htmlbody .= $platz; // wenn nein, wird platz ausgeben
			      }
		*/
		
		//erfolgsquote in prozent oder in punkte pro spiel
		if ($goal[$i][2] > 0) { 
		    if ($tippmodus == 0) { // tendenz
				$quote = $goal[$i][1] / $goal[$i][2] * 100;
			}
			else { // ergebnis
			     $quote = $goal[$i][1] / $goal[$i][2];
			}
		}
		else { 
		     $quote = 0; 
			 }
		
		$htmlbody .= '</td> <td align="'.$ausrichtung_user.'">'.$goal[$i][0].'</td>';
				
				
		//gesamten getippter spiele ausgeben?		
		if ($show_sp_ges == 1) { 
		    $htmlbody .= '<td class="ausrichtung_anzsp">'.$goal[$i][2].'&nbsp;</td>'; 
		}
		
		//werden jokerpunkte zugelassen? wenn ja, spalte einblenden	 ja oder nein?   
		if (($show_joker == 1) and ($joker == 1)) { 
		    $htmlbody .= '<td class="ausrichtung_jokpkt">'.$goal[$i][3].'&nbsp;</td>'; 
		}
		
		//quote richtiger spieler ausgeben ja oder nein?
		if ($show_sp_proz == 1) { 
		    $htmlbody .= '<td class="ausrichtung_prozsp">'.round($quote, 2).'&nbsp;</td>'; 
		}
		
		//anzahl tipps ausgeben ja oder nein?		
		if ($show_punkte == 1) { 
		    $htmlbody .= '<td class="ausrichtung_anztip">'.$goal[$i][1].'&nbsp;</td>'; 
		}

		//teamname anzeigen - ja oder nein?		
		if (($show_team == 1) and ($team == 1)) { 
		    $htmlbody .= '<td class="ausrichtung_team">'.$goal[$i][4].'&nbsp;</td>'; 
		}
		
		$htmlbody .= '</tr>
		';	
						 
		}//end filter nicht-tipper
				
}//for
   
$htmlbody.='</table>';


$zeit2 = microtime();
//echo "<br>Berechnung dauerte" . ($zeit2-$zeit1);
		
		}
		else /* keine liga gewählt */
		{
		$htmlbody .= '<p align="center"><br><br><font class="fehler">keine Liga gewählt</font><br><br>'.$zurueck.'</p>';
		}//else $zligen>0
    

// ausgabe html code an browser
echo $htmlhead . $htmlbody . $htmlfoot;

clearstatcache();

?>