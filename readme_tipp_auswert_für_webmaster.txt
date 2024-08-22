############################################################## 
## Snippet Title: Individuelle Auswerung der LMO-Tippligen f�r Webmaster
## 
## Author: Marcus < info@bcerlbach.de >  http://www.bcerlbach.de/
##
## Version: 1.8.5 (Stand Januar 2010)
## 
## Description: Vorraussetzung ist ein eingerichtetes Tippspiel vom LMO
##
##				-> Dateien ins LMO-Root Entpacken
##				-> die Konfig-Datei "auswert.cfg" auf CHMOD 666 setzen
##				-> "auswert_admin.php" aufrufen
##				-> Einstellungen eingeben, anschlie�end speichern
##				-> Datei "auswert_admin.php" am besten l�schen!
##				-> fertige Resultat kann mit "auswert2.php" betrachtet werden
##				-> einbinden in die Homepage mittels include("auswert2.php");
##
## Download unter: http://forum.bcerlbach.de/downloads.php?cat=7 
##
## Support im LMO-Forum unter: http://www.liga-manager-online.de/lmo-forum/viewtopic.php?t=5305
##
##
## Installation Level: Easy 
## Installation Time:  <5 Minutes
## Files To Edit: -
##
##
## Included Files: auswert_admin.php 
##				   auswert2.php
##				   auswert_funk.php
##				   auswert.cfg
##
############################################################## 
## This MOD is released under the GPL License. 
############################################################## 
## Authors Notes: 
## Individuelle Auswerung der LMO-Tippligen f�r Webmaster
############################################################## 
## Da die Datei gesamt.aus nur gelesen wird ist ein Backup eigentlich nicht n�tig... 
############################################################## 
## Authors Info: 
## Wer immer �ber Updates informiert werden will, der sollte sich im Forum registrieren. Denn dann hat man die M�glichkeit einen Download zu abonieren. D.h. wenn etwas daran ge�ndert wurde, so wird umgehend eine E-Mail verschickt.
############################################################## 
## MOD History:
##
##
##   2010-01-25 - Version 1.8.5
##   - Weitere Einstellm�glichkeiten im Admin-Skript hinzugekommen
##     (verschiedene Ausrichtungen, soll ein Punkt hinter der Platzierung angezeigt werden, soll die �berschrift ausgegeben werden)
##   - Copyright ge�ndert
##
##   -> auswert2.php ersetzen
##   -> auswert_admin.php ausf�hren
##
##   2010-01-24 - Version 1.8.4
##   - Problem beim "includen" der auswert2.php behoben, wenn aufrufendens Skript au�erhalb des LMO-Ordners liegt
##
##   -> auswert2.php ersetzen
##
##   2010-01-22 - Version 1.8.3
##   - Fehler behoben beim Ermitteln vom Tippmodus
##
##   2009-07-26 - Version 1.8.2
##   - Quellcode �berarbeitet
##
##   -> auswert2.php ersetzen
##   -> auswert_admin.php ausf&uuml;hren
##
##   2007-01-20 - Version 1.8.1
##	- CSS-Formatierung �berarbeitet (Einstellungen gelten nur f�r das Skript)
##	- Farbe des Hintergrundes kann nun auch angegeben werden
##
##	-> auswert2.php und auswert_admin.php ersetzen
##  -> auswert_admin.php ausf�hren
##
##   2006-12-05 - Version 1.8
##	- CSS im Header - keine externe Stylsheet-Datei mehr n�tig
##  - erzeugter Code ist HTML-valid
##
##   2006-08-24 - Version 1.7
##	- einstellbar ob Klammern um Username angezeigt werden soll
##	- Ausrichtung der Spalte Username einstellbar
##
##   2006-02-25 - Version 1.6
##	- Konfig-Datei wird (wenn bereits vorhanden) beim Skriptaufruf eingelesen,
##	    so dass nicht immer alles von Grund auf eingestellt werden muss
##	- Ausgabe korrigiert
##
##   2006-02-25 - Version 1.5
##  - Tippmodus wird automatisch ermittelt
##  - Platz 1 bis 3 kann farblich hervorgehoben werden
##  - Programmcode optimiert
##
##   2005-09-22 - Version 1.4
##  - frei w�hlbar welche Spalten in der Ausgabetabelle angezeigt werden sollen
##  - K�rzel des Tabellenkopfes der Ausgabetabelle ebenfalls frei w�hlbar
##	- Jokertipps werden nun richtig dargestellt
##  - ist nun egal was man in den Tippspiel-Optionen unter Anzeigen einstellt
##  -> auswert_admin.php und auswert2.php ersetzen
##
##   2005-09-19 - Version 1.3
##  - einstellbar ob Anzahl Spiele oder die Quote % oder beides angezeigt werden soll
##	- Fehler mit Schriftart ausgeb�gelt
##  -> Dateien ersetzen
##
##   2005-09-16 - Version 1.2
##  - einstellbar ob Nicht-Tipper angezeigt werden sollen
##  - Anzahl getippter Spiele wird nun mit ber�cksichtigt
##  - Tipp-Quote wird mit ausgegeben
##	- Programmcode optimiert
##  -> Dateien ersetzen
##
##   2005-09-12 - Version 1.1
##	- Einstellm�glichkeiten erweitert (Schriftfarbe, -Gr��e)
##	- Markierung der Auswahlfelder erleichtert (grade bei vielen Ligen von Vorteil)
##	- Quellcode optimiert (u.a. Funktionen ausgelagert)
##	- Konfig-Datei muss manuell auf Server kopiert werden
##  -> Dateien ersetzen
##  
############################################################## 


# 
#-----[ kopiere Datei  ]------------------------------------------ 
# 

\auswert_admin.php	-> ins LMO-Root
\auswert2.php   -> ins LMO-Root
\auswert_funk.php   -> ins LMO-Root
\auswert.cfg   -> ins LMO-Root


# 
#-----[ Zugriffsrecht auf Server manuell �ndern  ]---------------------- 
# 

\auswert.cfg   -> chmod 666


# >> www.bcerlbach.de mal besuchen ;) <<
# 
#-----[ SAVE/CLOSE ALL FILES ]------------------------------------------ 
# 
# EoM 
