# wp-losungen-sql

Plugin um die Losungen der Herrenhuter Brüdergemeine in einer WordPress-Seite anzuzeigen.

Das Plugin stellt ein Widget zur Anzeige in einer Seitenleiste und einen Shortcode zur Anzeige in einm Block zur Vefügung.

Die Einstellungen es Plugins lassen sich unter Einstellungen - Losungen anpassen.

Die Losungen müssen als Tabelle losungen in der WordPress Datenbank der Seite vorliegen.

## Widget

Das Wiget zeigt die aktuelle Losung in einer Seitenleiste an.

## Shortcode

Der Shortcode [losung] erlaubt die anzeige einzelner Losungen oder einer Tabelle mit Losungen in einer Seite / einem Artikel. 

Verwendung: [losung {date=*datum*} {from=*datum*} {to=*datum*} max=*Anzahl*]

* date: gibt einen Tag an. Hat Vorrang vor den anderen Parametern
* from: Anfangsdatum ab dem die Losungen ausgegeben werden
* to:   Enddatum bis zu dem die Losungen ausgegeben werden
* max:  Maximale Anzahl der Tage, 0 = *unendlich*

Ohne Angabe eines Datums wird die Losung des aktuellen Tages ausgegeben.

Der Shortcode versteht die englischen Datumsangaben der Funktion ''date''.

### Beispiel

  [losung from="last week" to="next week - 1 day"]

##ToDo: 

* Prüfen, ob Losungen verfügbar
* Automatischer Update der Losungen
* Löschen der veralten, nicht mehr zu verbreitenen Losungen des Vor-Vorjahres
* Fix des BibelServer.com links. Derzeit wird der Parameter bible des Widget ignoriert
* Entfernen des Download Server im Wiget

