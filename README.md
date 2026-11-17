# Ecomponents Starter

Ein schlichtes, kostenloses Storefront-Theme für **Shopware 6.7**, entwickelt von Aggrosoft GmbH / Ecomponents. Version **1.1.0**, MIT-Lizenz.

## Download

[Aktuelle GitHub-Releases und Installationspakete](https://github.com/aggrosoft/ecomponents-demo-theme/releases) enthalten das geprüfte Theme-ZIP, `SHA256SUMS`, `extension-mesh-release.json` und `extension-mesh-registry.json`.

Quellcode und Versionshistorie: [aggrosoft/ecomponents-demo-theme](https://github.com/aggrosoft/ecomponents-demo-theme).

## Installation über ExtensionMesh

Diese Repository-Adresse als Quelle hinzufügen:

```text
https://github.com/aggrosoft/ecomponents-demo-theme
```

Die Quelle wird über den automatisch gepflegten Zweig `extension-mesh-registry` aufgelöst. Theme installieren und aktivieren, anschließend unter **Inhalte → Themes** dem gewünschten Verkaufskanal zuweisen. Die Installation allein ändert kein bereits zugewiesenes Theme.

## Screenshots

Die Bilder zeigen die **lokale Theme-Vorschau** mit vorhandenen Beispielinhalten. Die Beispielprodukte, Bilder und Erlebniswelten werden nicht mitinstalliert. Es handelt sich nicht um die Behauptung einer erfolgten Umstellung des externen Demoshops.

[Startseite Desktop](docs/screenshots/05-home-desktop.png) · [Startseite Mobil](docs/screenshots/06-home-mobile.png) · [Produktübersicht](https://github.com/aggrosoft/ecomponents-demo-theme/blob/main/docs/screenshots/01-catalog-desktop.png) · [Produktdetail](https://github.com/aggrosoft/ecomponents-demo-theme/blob/main/docs/screenshots/02-product-desktop.png) · [Mobilansicht](https://github.com/aggrosoft/ecomponents-demo-theme/blob/main/docs/screenshots/03-product-mobile.png) · [Konto](https://github.com/aggrosoft/ecomponents-demo-theme/blob/main/docs/screenshots/04-account-desktop.png)

## Dynamische CMS-Startseite und Logo

Das Theme liefert ausschließlich die Gestaltung. Texte, Teaser, Bilder, Links und Produktgruppen werden in nativen Shopware-Erlebniswelten gepflegt; Logos werden über die normalen Medienfelder der Theme-Konfiguration gewählt. Es werden keine Startseiteninhalte oder Shopnamen beim Installieren angelegt. Eine Anleitung für eine frei befüllbare Startseite steht in [CMS und Logo](docs/CMS.md).

## Enthalten

- Helle Oberfläche mit klarer Navigation und gut lesbarer Typografie.
- Responsive Produktkarten, native Filter und Produktgalerie.
- Abgestimmte Produktdetails, Formulare, Konto, Warenkorb und Checkout.
- Mobile Shopware-Navigation, Footer-Akkordeons und Rechtsseiten-Dialoge.
- Anpassbare Farben, Systemschriften und Logos über Shopwares Theme-Konfiguration.
- Zusätzliche Einstellungen für Eckenradius und maximale Inhaltsbreite.
- Keine zusätzliche JavaScript-Datei, externe Schriftquelle, Telemetrie oder erzwungene Markenanzeige in der Storefront.

Das Theme erweitert das Shopware-Standardtheme. Produkte, Bilder, Menüs, Texte und Erlebniswelten kommen aus dem jeweiligen Shop. Es werden keine Beispieldaten, neuen Seiten oder sonstigen Datenbankinhalte installiert. Die ZIP-Datei enthält ausschließlich den eigenen Theme-Code; Shopware und Drittanbieter-Plugins werden nicht mitgeliefert.

## Voraussetzungen

- Shopware Core und Storefront **6.7.x**; technisch geprüft gegen **6.7.15.1**.
- Eine mit der verwendeten Shopware-Version kompatible PHP-Installation, mindestens PHP 8.2 gemäß Paketdefinition.
- Vorhandener Storefront-Verkaufskanal.

Die Kompatibilität einzelner Plugins hängt von deren Nutzung der nativen Storefront-Erweiterungspunkte ab. Das Theme benötigt weder EcomponentsTheme noch ExtensionMesh. Es enthält keine Shopware-Core-Overrides außerhalb eines ergänzten CSS-Namens am `body`.

## Installation über die Administration

1. Aktuelles Theme und relevante Konfiguration sichern.
2. Unter **Erweiterungen → Meine Erweiterungen → Erweiterung hochladen** das passende `EcomponentsStarterTheme-<Version>.zip` aus den Releases hochladen.
3. **Ecomponents Starter** installieren und aktivieren.
4. Unter **Inhalte → Themes** das Theme dem gewünschten Storefront-Verkaufskanal zuweisen. Die Zuweisung ausdrücklich nur für den vorgesehenen Kanal vornehmen.
5. Im Theme Logo, Farben und Schriften prüfen und speichern. Shopware kompiliert die Theme-Assets bei Zuweisung/Speichern.
6. Startseite, Kategorie, Produkt, Suche, mobile Navigation, Konto und Checkout im Zielshop prüfen.

Für CLI-Übernahme das Verzeichnis als `custom/plugins/EcomponentsStarterTheme/` bereitstellen:

```bash
php bin/console plugin:refresh
php bin/console plugin:install --activate EcomponentsStarterTheme
php bin/console theme:refresh
```

Danach das Theme im Admin dem tatsächlichen Zielkanal zuweisen. Wenn die Zielumgebung keine automatische Kompilierung ausführt:

```bash
php bin/console theme:compile --only=ZIEL_VERKAUFSKANAL_ID --sync --keep-assets
```

`ZIEL_VERKAUFSKANAL_ID` ersetzen. Kein npm-, Composer-Update oder globaler Theme-Build notwendig. Bei späteren Versionen den Plugin-Updateablauf statt einer erneuten Installation verwenden.

## Einstellungen

Die Standardfelder für Farben, Schriftfamilien, Logos, Kaufbutton und Preisfarbe werden von Shopware geerbt. Als Standards werden lokal verfügbare Systemschriften verwendet. Logo und Shopname werden nicht fest im Theme hinterlegt.

Im zusätzlichen Block **Starter: Layout**:

| Einstellung | Standard | Bereich |
| --- | --- | --- |
| Eckenradius | 12 px | 0–24 px |
| Maximale Inhaltsbreite | 1320 px | 960–1680 px |

Eigene Farben vor Veröffentlichung auf ausreichenden Kontrast prüfen. Das Theme enthält keinen integrierten Dark-Mode-Schalter.

## Optionale CMS-Klassen

Unter **Inhalte → Erlebniswelten** können eigene Abschnitte mit nativen Text-, Bild- und Produktblöcken erstellt werden. Folgende Klassen im Feld **CSS-Klasse** eines Blocks sind optional:

| Klasse | Darstellung |
| --- | --- |
| `ec-starter-hero` | Ruhiger Einstieg mit Hintergrund, Rahmen und großzügigem Abstand |
| `ec-starter-card` | Helle Inhaltskarte |
| `ec-starter-benefits` | Dreispaltige Liste von Vorteilen; auf Mobilgeräten untereinander |

Für die Vorteile einen nativen Textblock mit normaler ungeordneter Liste verwenden. Ohne diese Klassen funktionieren bestehende Shopware-Layouts weiterhin. Das Theme erzeugt keine fest eingebauten Inhalte oder Links und beinhaltet keine Bilder oder Rechtstexte für einen konkreten Shop.

## Anpassen und weitergeben

Die MIT-Lizenz erlaubt Nutzung, Anpassung und Weitergabe entsprechend dem beiliegenden Lizenztext. Bei einer eigenen Weiterentwicklung die Copyright- und Lizenzhinweise erhalten. Für eine Umbenennung Composer-Namen, Namespace, Plugin-Klasse, Theme-Namespace und Verzeichnis konsistent anpassen.

Eine individuelle Anpassung lässt sich alternativ als abgeleitetes Theme auf Basis von `@EcomponentsStarterTheme` pflegen. Vorhandene Konfigurationen und nicht zugehörige Plugins müssen dabei nicht verändert werden.

## Daten und Entfernung

Keine Migrationen, Installationsroutinen oder eigenen Entitäten. Ein Themewechsel entfernt keine Produkte, Kategorien, Bestellungen, Medien oder Erlebniswelten. Vor Deinstallation zuerst dem Verkaufskanal ein anderes Theme zuweisen und dieses kompilieren. Die normalen Shopware-Plugin-/Theme-Datensätze und gespeicherten Theme-Einstellungen werden von Shopware verwaltet.

## Prüfstatus dieser Version

PHP-Klasse, Twig, Theme-Konfiguration und vollständige native Storefront-Kompilierung wurden gegen Shopware **6.7.15.1** geprüft, einschließlich einer abweichenden Farb-/Layoutkonfiguration. Das Release-Archiv wird mit Shopwares Plugin-ZIP-Erkennung und durch Vergleich aller enthaltenen Dateien validiert.

Vor Veröffentlichung deines Shops bleibt eine Abnahme mit dessen tatsächlichen Produkten, Erlebniswelten und Plugins erforderlich. Das Theme enthält keine eigenen Beispieldaten und übernimmt keine Änderungen automatisch auf andere Installationen.

## Build und Release

Der Workflow prüft jeden Pull Request und jeden Push auf `main`. Nur ein erfolgreicher Build von `main` darf veröffentlichen. `composer.json` ist die Versionsquelle: eine neue stabile Version erzeugt den Tag `v<Version>`, einen GitHub-Release und den stabilen ExtensionMesh-Registry-Zweig. Vorhandene ExtensionMesh-Releases werden unverändert wiederverwendet.

Die zentral gepflegten Store-Daten stehen in `shopware-extension.yml`: DE/EN-Beschreibung, Installationsanleitung, FAQ, Highlights, Features, Tags, PNG-Icon und Screenshot-Reihenfolge. `position` bedient die aktuelle Shopware CLI; das identische `priority` erhält die Kompatibilität mit dem installierten ExtensionMesh-Importer.

Voraussetzungen für einen lokalen Build: PHP 8.2+ mit ZIP, YAML und mbstring sowie **Shopware CLI 0.20.0**. Der Build verändert keine Shopware-Datenbank und installiert weder Composer- noch npm-Abhängigkeiten:

```bash
php scripts/validate.php
php scripts/build.php
shopware-cli --no-interaction --no-update-hint --no-ai-hint extension validate .build/EcomponentsStarterTheme-1.0.1.zip --only=builtin,storefront-twig
```

Die Ausgabe liegt in `.build/`. Optional `SHOPWARE_CLI_BIN` auf eine vorhandene CLI-Binärdatei setzen. Shopware CLI erwartet eine native, gepunktete Konfigurationsdatei; das Buildskript erzeugt dafür vorübergehend eine identische `.shopware-extension.yml` und entfernt ausschließlich seine selbst erzeugte Datei wieder. Es gibt nur eine gepflegte Metadatenquelle.

Das Paket enthält die SCSS-Quellen, die Shopware bei der Theme-Zuweisung kompiliert. Da das Theme ausschließlich natives JavaScript erbt, ist kein eigener Storefront-JavaScript-Build notwendig. Store-Screenshots, Entwicklungswerkzeuge, Workflows und alte ZIPs werden nicht in das Installationspaket gepackt.

Der offizielle [ExtensionMesh-Publisher](https://github.com/Extension-Mesh/shopware-publisher/tree/46d115ace839124ed9c5f762dd42bf849723eb5e) veröffentlicht exakt das geprüfte Build-Artefakt. Danach wird der Registry-Zweig automatisch aktualisiert. Diesen Zweig und seine Manifeste nicht manuell pflegen. Details: [Release-Verfahren](https://github.com/aggrosoft/ecomponents-demo-theme/blob/main/docs/RELEASING.md).
