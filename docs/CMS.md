# CMS-Startseite und Logo

Ecomponents Starter enthält die Gestaltung, keine fest eingebauten Shoptexte, Teaserbilder oder Logos. Alle Inhalte werden mit nativen Shopware-Funktionen gepflegt. Ein Theme-Update überschreibt keine Erlebniswelt.

## Logo

1. Ein eigenes Logo unter **Inhalte → Medien** hochladen und dessen Titel/Alternativtext pflegen.
2. Unter **Inhalte → Themes → Ecomponents Starter → Theme bearbeiten → Medien** die Felder für Desktop-, Tablet- und Mobil-Logo auswählen (`sw-logo-desktop`, `sw-logo-tablet`, `sw-logo-mobile`).
3. Im vorgesehenen Verkaufskanal speichern/kompilieren. Das Theme verwendet die native Logo-Ausgabe einschließlich Verlinkung zur Startseite und responsiver Bildauswahl.

Das Plugin-Icon unter `src/Resources/config/` dient der Erweiterungsverwaltung. Es wird nicht als Shoplogo eingeblendet.

## Frei befüllbare Startseite

Unter **Inhalte → Erlebniswelten** ein Seitenlayout anlegen. Im Layout bei den CSS-Klassen `ec-starter-home` eintragen. Für jeden Bereich eine native Standardsektion mit zentriertem Inhalt verwenden. Die folgenden Klassen werden im jeweiligen Block unter **Einstellungen → CSS-Klassen** eingetragen. Blockabstände auf 0 setzen; die Klassen übernehmen das responsive Spacing.

| Bereich | Nativer Block | CSS-Klasse | Pflege |
| --- | --- | --- | --- |
| Hero | Bild/Text, zwei Spalten | `ec-starter-home-hero` | Links Textelement mit genau einer Hauptüberschrift und optionalem Button; rechts Bildelement |
| Vorteile | Text, drei Spalten | `ec-starter-benefit-grid` | Drei separat editierbare Überschriften und Texte |
| Abschnittseinstieg | Text | `ec-starter-section-heading` | Überschrift und kurzer Einleitungstext |
| Themen-Teaser | Bild/Text-Galerie, drei Spalten | `ec-starter-teasers` | Je Karte ein Bildelement sowie ein Textelement mit Überschrift, Text und Link |
| Sortiment | Produkt-Slider | `ec-starter-products` | Dynamische Produktgruppe, Sortierung und Anzahl auswählen |
| Editorial | Bild/Text, zwei Spalten | `ec-starter-split` | Links Bild; rechts Überschrift, Text und optionaler Button |
| Abschluss | Text | `ec-starter-cta` | Überschrift, Text und Link/Button |

Eine kleine Einleitungszeile kann im Textelement die Klasse `ec-starter-eyebrow` erhalten. Für Buttons die nativen Klassen `btn btn-primary` oder `btn btn-outline-secondary` verwenden. Die älteren Klassen `ec-starter-hero`, `ec-starter-card` und `ec-starter-benefits` bleiben verfügbar.

Bei einem Bild/Text-Block bei Bedarf den Elementtyp des linken Slots auf **Text** und des rechten Slots auf **Bild** ändern; die Slots bleiben normale Shopware-CMS-Elemente. Beim Hero das Bild auf **Cover** stellen. Bild und Text bleiben mobil beide sichtbar.

## Dynamische Produkte

Unter **Kataloge → Dynamische Produktgruppen** eine Regel für den gewünschten Katalog beziehungsweise die gewünschte Kategorie anlegen. Im CMS-Produkt-Slider als Produktauswahl **Dynamische Produktgruppe** verwenden und diese Gruppe auswählen. Neue passende Produkte erscheinen automatisch; Shopware berücksichtigt zusätzlich Verkaufskanal-Sichtbarkeit und Verfügbarkeit. Keine Produktnummern oder Produkt-IDs im Theme hinterlegen.

## Startseite zuordnen

Im gewünschten **Verkaufskanal → Allgemein → Grundeinstellungen / Startseite** das neue Layout auswählen. Vorherige Zuordnung für eine Rücknahme dokumentieren. Anschließend Desktop und Mobilansicht sowie Links, Suche, Navigation und Produkt-Slider prüfen. Ein Layout kann vor der Zuweisung über die CMS-Vorschau geprüft werden.

## Demo-Inhalte

Die Screenshots zeigen separat gepflegte CMS-Demodaten mit Ecomponents-Logo, Medien und vorhandenen Produkten. Diese Daten sind kein Bestandteil des installierbaren Themes. Die Installation erzeugt keine Texte, Produkte, Medien oder Startseiten. Ein Zielshop kann vollständig eigene Inhalte und Marken verwenden.
