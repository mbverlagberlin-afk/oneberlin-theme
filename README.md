# OneBerlin – WordPress-Theme

Eigenes Block-Theme für **[oneberlinmedia.de](https://oneberlinmedia.de)** – Bücher · Musik · Software und mehr aus Berlin.
Ersetzt das Kauf-Theme „AnySell“.

## Merkmale

- **Markendesign** in Navy (`#0B1F44`) und Tor-Gold (`#D4AF37`) mit dem Brandenburger-Tor-Logo
- **Schriften lokal eingebunden** (Inter, Inter Display, Lora) – keine Verbindung zu Google Fonts (DSGVO)
- **WooCommerce** komplett: Shop mit eigenen Produkten und Partner-Sortiment, Kategorien-Seitenleiste,
  Preisfilter, Endlos-Scrollen, Einzelprodukt mit Werbehinweis, Warenkorb und Kasse
- **Bereiche** Musik, Software, Magazin und Radio behalten ihre eigene Gestaltung (über Body-Klassen statt langer ID-Listen)
- **Komfort:** klebende Hauptleiste beim Scrollen, „Nach oben“-Knopf, Filter-Knopf auf dem Handy
- **Eigene Vorlagen:** Seitenkopf, Bereiche-Kacheln, Aktionsband (Kategorie „OneBerlin“ im Editor)
- Seiten-Vorlagen: Standard, *Seite in voller Breite (ohne Titel)*, *Seite ohne Titel*, *Leer*

## Aufbau

```
style.css            Theme-Kopf
theme.json           Farben, Schriften, Abstände, Block-Stile
functions.php        Einbindung, WooCommerce-Unterstützung, Bereichs-Klassen
assets/css/          oneberlin.css – alle Stile
assets/js/           oneberlin.js – Scroll-Verhalten, Filter-Knopf
assets/fonts/        Inter, Inter Display, Lora (OFL-Lizenz)
templates/           Seiten-Vorlagen
parts/               Kopf, Fuß, Popup, Shop-Bausteine
patterns/            Block-Vorlagen
```

## Installation

1. ZIP aus den [Releases](../../releases) herunterladen (oder `oneberlin`-Ordner zippen).
2. WordPress → Design → Themes → Theme hinzufügen → Theme hochladen.
3. Aktivieren.

## Neue Version veröffentlichen

Version in `style.css` und `functions.php` (`ONEBERLIN_VERSION`) erhöhen, dann:

```bash
git commit -am "Version 1.0.1" && git push
```

GitHub baut bei jedem Push automatisch `oneberlin.zip` und legt das Release `v<Version>` an (bzw. aktualisiert es).

## Lizenz

Theme-Code: GPL-2.0-or-later. Schriften: SIL Open Font License 1.1 (siehe `assets/fonts/`).

© 2026 OneBerlin – eine Marke von MB Verlag & Media Sounds
