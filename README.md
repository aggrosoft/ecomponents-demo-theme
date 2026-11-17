# Ecomponents Starter

Ein schlichtes, kostenloses Storefront-Theme für **Shopware 6.7**, entwickelt von Aggrosoft GmbH / Ecomponents. Version **1.0.0**, MIT-Lizenz.

## Download

[Installierbares Theme-ZIP herunterladen](https://github.com/aggrosoft/ecomponents-demo-theme/raw/refs/heads/main/dist/EcomponentsStarterTheme-1.0.0.zip) · [SHA-256-Prüfsumme](https://github.com/aggrosoft/ecomponents-demo-theme/blob/main/dist/EcomponentsStarterTheme-1.0.0.zip.sha256)

Quellcode und Versionshistorie: [aggrosoft/ecomponents-demo-theme](https://github.com/aggrosoft/ecomponents-demo-theme).

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
2. Unter **Erweiterungen → Meine Erweiterungen → Erweiterung hochladen** die Datei `EcomponentsStarterTheme-1.0.0.zip` hochladen.
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
