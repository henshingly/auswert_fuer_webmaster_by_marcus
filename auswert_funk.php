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
// Eigene Funktion zum ermitteln des Dateinames
function dateiname($zeile) {
  $pos = strpos($zeile, "=");  // suche nach dem =
  if ($pos++ === false) {
    // nicht gefunden...
  }
  else {  // gefunden
    $dateiname=substr($zeile, $pos++, strlen($zeile));  // Ligenname
  }
  $dateiname=str_replace('.aus', '.l98', $dateiname);
    return $dateiname;  // z.b. liga1.l98
  }  // function Dateiname end
//------------------------------------------------------------------------------


//------------------------------------------------------------------------------
// Eigene Funktion zum Ermitteln der Ligeninfo
function dateiinfo($datei) {
  $dateiname = $datei;  // wird benötigt, falls Datei nicht vorhanden
  $datei = getcwd() . "/ligen/". $datei;  // Ligenpfad

  // überprüfen ob Ligendatei existiert
  if(is_file($datei)){
    $liga = file($datei);  // File wird in Array eingelesen
    $dateiinfo = str_replace('Name=', '', trim($liga[2]));  // Ligainfo in der 3ten Zeile
    $liga = '';
  }
  else {
    // wenn Datei nicht vorhanden -> Dateiname als Info verwenden
    $dateiinfo = $dateiname;
    $dateiname = "";
  }
  return $dateiinfo;
}  // function Ligeninfo end
//------------------------------------------------------------------------------

?>