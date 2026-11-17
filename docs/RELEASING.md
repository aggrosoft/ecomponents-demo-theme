# Build und ExtensionMesh-Veröffentlichung

## Eine neue Version veröffentlichen

1. Theme-Code, `shopware-extension.yml`, Bilder und Dokumentation prüfen.
2. In `composer.json` eine neue stabile Version setzen und einen passenden Eintrag in `CHANGELOG.md` ergänzen.
3. Änderungen nach `main` übernehmen. Der Workflow läuft auch bei manueller Auslösung; Pull Requests prüfen ausschließlich und veröffentlichen nicht.
4. Den Workflow **Build and publish ExtensionMesh theme** abwarten. Ein fehlerhafter Build blockiert den Publish-Job.
5. Release-Artefakte und Registry prüfen; danach im gewünschten Testshop Installation/Update und Theme-Zuweisung abnehmen.

## Build

Die CI verwendet PHP 8.3, Shopware CLI **0.20.0** und festgelegte Action-Commits. Metadaten, PNG-Screenshots, das 256×256-Icon und die Versionskonsistenz werden vor dem Paketieren geprüft. Anschließend erzeugt die CLI das Installationspaket. Das Buildskript überprüft Dateiinhalt, technische Identität und die native `checksum.json`; Shopwares Validator prüft außerdem Paket und Storefront-Twig.

Das Theme besitzt keinen eigenen JavaScript-Einstieg. Native Storefront-Skripte werden geerbt; Theme-SCSS wird beim Speichern/Zuweisen im Zielshop kompiliert. Deshalb ist für das ZIP kein npm-Build oder eingebettetes Vendor-Verzeichnis erforderlich. Dies ist in der Build-Konfiguration ausdrücklich festgelegt.

Die einzige gepflegte Konfiguration heißt **`shopware-extension.yml`**. ExtensionMesh kann diese Datei direkt lesen. Für die Shopware CLI wird während des Builds eine identische, gepunktete Aliasdatei erzeugt; eine abweichende vorhandene Datei wird niemals überschrieben. Alias und Store-Unterlagen werden aus dem ZIP ausgeschlossen.

## Release

Nur `main` darf nach erfolgreichem Build veröffentlichen. Der Publish-Job lädt das geprüfte ZIP über das GitHub-Actions-Artefakt herunter und prüft zuerst `SHA256SUMS`. Danach übernimmt der offizielle Publisher `v1.0.0`, festgelegt auf Commit `46d115ace839124ed9c5f762dd42bf849723eb5e`:

- Installierbares `EcomponentsStarterTheme-<Version>.zip`
- `SHA256SUMS`
- `extension-mesh-release.json`
- `extension-mesh-registry.json`

Das veröffentlichte ZIP bleibt bytegleich zum geprüften Artefakt. Öffentliche Releases erhalten die vom offiziellen Publisher vorgesehene Attestierung. Der Registry-Zweig wird erst nach Veröffentlichung aktualisiert. Der Job verwendet ausschließlich den normalen `GITHUB_TOKEN` mit den benötigten Inhalts-/Attestierungsrechten; zusätzliche persönliche Tokens oder Shopware-Zugangsdaten sind nicht nötig.

Für Versionen mit bereits vorhandenem ExtensionMesh-Release verwendet der Publisher dessen Artefakte unverändert. Metadaten- oder Screenshot-Änderungen für einen neuen Release deshalb immer mit einer neuen Composer-Version veröffentlichen. Der Bestand im alten `dist/` bleibt als Archiv erhalten; neue Releases werden nicht als ZIPs in den Quellcode zurückgeschrieben.

## Quelle für Verbraucher

```text
https://github.com/aggrosoft/ecomponents-demo-theme
```

Stabiler Registry-Kanal:

```text
https://raw.githubusercontent.com/aggrosoft/ecomponents-demo-theme/extension-mesh-registry/extension-mesh-registry.json
```

Die Repository-Produktübernahme liest Beschreibung und Bilder aus der `shopware-extension.yml` des Release-Stands. Der Installations-/Updatekanal verwendet die vom offiziellen Publisher generierten Manifeste. Beide Wege sind vorgesehen; kein eigenes Registry-Format und keine handgeschriebenen Release-Manifeste ergänzen.

## Screenshots aktualisieren

Echte Ansichten des Themes unter `docs/screenshots/` ablegen, Reihenfolge und Sprachfreigabe in der YAML pflegen und `php scripts/validate.php` ausführen. Die sechs aktuellen Bilder stammen aus einer lokalen, lesenden Theme-Vorschau auf nativen Shopware-Seiten. Ein Debugger-Overlay wurde ausschließlich im Aufnahmebrowser ausgeblendet; Shopinhalte wurden nicht verändert. Die Beispielprodukte und ihre Medien sind nicht Bestandteil des Installationspakets.

Eine Demo-Adresse erst unter `store.demo_shops` ergänzen, wenn das Theme dort tatsächlich installiert und geprüft ist. Die externe Demo-Installation wird von dieser Veröffentlichung nicht administriert.
