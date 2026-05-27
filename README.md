# Pawa Downloads

> Manage and display downloadable files (PDF, Word, Excel) on your WordPress site using a simple shortcode.

[![License: GPL v2](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
[![WordPress](https://img.shields.io/badge/WordPress-5.8%2B-blue)](https://wordpress.org)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple)](https://php.net)

---

## Features

- **Custom post type** for organising downloads in the WordPress admin
- **Media library integration** — pick files directly from your media library
- **Responsive card grid** with colour-coded file-type icons (PDF=red, Word=blue, Excel=green)
- **Simple shortcode** `[pawa_downloads]` with optional `limit` and `order` attributes
- **Works with Elementor** and all major page builders
- **Translation-ready** — full `.pot` file included

---

## Installation

1. Upload the `pawa-downloads` folder to `/wp-content/plugins/`
2. Activate via **Plugins → Activate** in the WordPress admin
3. Go to **Downloads → Add New** to create your first entry
4. Add `[pawa_downloads]` to any page or post

---

## Shortcode Usage

```
[pawa_downloads]                          — up to 12 downloads, newest first (default)
[pawa_downloads limit="6"]               — show 6 downloads
[pawa_downloads order="ASC"]             — oldest first
[pawa_downloads limit="-1"]              — show all downloads
[pawa_downloads limit="6" order="ASC"]  — 6 downloads, oldest first
```

---

## Customisation

### Button colour

The download button uses `#2a7c5f` (green) by default. Override it in your theme's **Additional CSS**:

```css
.pawa-dl-btn {
    background: #your-colour;
}
.pawa-dl-btn:hover {
    background: #your-darker-colour;
}
```

### Dequeue styles

To remove the plugin's stylesheet entirely (e.g. if you want to write your own):

```php
add_action( 'wp_enqueue_scripts', function () {
    wp_dequeue_style( 'pawa-downloads' );
}, 20 );
```

---

## Supported File Types

| Extension | Icon colour |
|-----------|-------------|
| PDF | Red |
| DOC / DOCX | Blue |
| XLS / XLSX | Green |
| All others | Grey (generic) |

---

## Frequently Asked Questions

**Does this work with Elementor?**
Yes. The stylesheet is enqueued on every front-end page, so it works with Elementor, Divi, Beaver Builder, and any page builder that stores shortcodes outside of `post_content`.

**Is the plugin translation-ready?**
Yes. All user-facing strings use the `pawa-downloads` text domain. A `.pot` file is included in `languages/`.

**What happens to my data if I delete the plugin?**
All download entries are permanently deleted (force-deleted, not trashed) when the plugin is removed via the WordPress plugins screen.

---

## Changelog

### 1.0.0
- Initial release

---

## License

[GPL-2.0-or-later](LICENSE) © [Rahisi Solutions](https://rahisisolutions.com)
