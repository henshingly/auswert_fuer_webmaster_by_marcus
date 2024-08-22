<?php
/*------------------------------------------------------------------------------
// Individuelle Auswertung der Tippspielligen für Webmaster
// Autor: Marcus - www.bcerlbach.de
//------------------------------------------------------------------------------

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


//------------------------------------------------------------------------------
/* eigene funktion zum ermitteln des dateinames */
function dateiname($zeile) {
	//$zeile = trim($datei); 
	$pos = strpos($zeile, "="); // suche nach dem =
	if ($pos++ === false) {
    	// nicht gefunden...
		}
		else{//gefunden
			$dateiname=substr($zeile, $pos++, strlen($zeile)); //ligenname
			}    
	$dateiname=str_replace('.aus', '.l98', $dateiname);
    return $dateiname; // z.b. liga1.l98
	}//end-function    
//------------------------------------------------------------------------------


//------------------------------------------------------------------------------
/* eigene funktion zum ermitteln der ligen-info */
function dateiinfo($datei) {
    $dateiname=$datei;//wird benötigt, falls datei nicht vorhanden
	$datei=getcwd() . "/ligen/". $datei; // ligen-pfad
	
	//überprüfen, ob ligen-datei existiert 
	if(is_file($datei)){
	    $liga=file($datei);//file wird in array eingelesen
	    $dateiinfo=str_replace('Name=', '', trim($liga[2]));//liga-info in 3ter zeile
		$liga=''; 
	    }
	    else {
 	         //wenn datei nicht vorhanden -> dateiname als info verwenden
	         $dateiinfo=$dateiname;
	         $dateiname="";
	         }
		
    return $dateiinfo; 
	}//end-function    
//------------------------------------------------------------------------------

	
?>