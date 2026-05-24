=== Infomail Block ===
Contributors:      Christian Studer
Tags:              block
Tested up to:      6.8
Stable tag:        0.1.0
License:           MIT

Zeigt eine Auswahl von Terminen fürs Oberfeld-Infomail in einer Tabelle an.

Initiale Version mit hardgecodeter Kalender-URL: <https://chischte.oberfeld.be/remote.php/dav/public-calendars/Mr282TY3ekfKGPNF/?export>

Enthält composer-Dependency `johngrogg/ics-parser`.

== Development ==

- WordPress `Studio` starten, Webseite öffnen.
- Ins Verzeichnis `wp-content/plugins/infomail-kalender-block` wechseln.
- `npm run start` ausführen für Live-CSS & JS-Änderungen.

== Installation ==

- Version in `package.json` und `infomail-kalender-block.php` anpassen
- `build-zip.sh` ausführen.
- Erstelltes `infomail-kalender-block-?.?.?.zip` als Plugin hochladen.
