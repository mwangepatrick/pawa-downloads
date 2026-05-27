=== Pawa Downloads ===
Contributors: rahisisolutions
Tags: downloads, file manager, custom post type, shortcode, pdf
Requires at least: 5.8
Tested up to: 6.8
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Manage and display downloadable files (PDF, Word, Excel) on your WordPress site using a simple shortcode.

== Description ==

Pawa Downloads lets you manage downloadable files through a dedicated **Downloads** section in your WordPress admin. Add PDFs, Word documents, Excel spreadsheets, and more — then display them anywhere on your site with a single shortcode.

**Features:**

* Custom post type for organising downloads
* Media library integration — pick files directly from your WordPress media library
* Responsive card grid layout with colour-coded file-type icons (PDF, Word, Excel)
* Simple shortcode: `[pawa_downloads]`
* Optional `limit` and `order` attributes
* Works with Elementor and all major page builders
* Translation-ready

**Shortcode usage:**

Display all downloads (up to 12, newest first):
`[pawa_downloads]`

Show 6 downloads, oldest first:
`[pawa_downloads limit="6" order="ASC"]`

Show all downloads:
`[pawa_downloads limit="-1"]`

== Installation ==

1. Upload the `pawa-downloads` folder to the `/wp-content/plugins/` directory, or install via **Plugins > Add New** in WordPress.
2. Activate the plugin through the **Plugins** screen.
3. Go to **Downloads > Add New** to create your first download entry.
4. Add the `[pawa_downloads]` shortcode to any page or post.

== Frequently Asked Questions ==

= How do I change the button colour? =

The download button uses `#2a7c5f` (green) by default. Override it in your theme's Additional CSS (Appearance > Customise > Additional CSS):

```css
.pawa-dl-btn {
    background: #your-colour;
}
.pawa-dl-btn:hover {
    background: #your-darker-colour;
}
```

= What file types are supported? =

Any file type can be linked. PDF, DOC, DOCX, XLS, and XLSX files get colour-coded icons automatically (red, blue, green). All other file types display a generic grey document icon.

= Does this work with Elementor? =

Yes. The plugin's stylesheet is loaded on every front-end page, so it works correctly with Elementor, Divi, Beaver Builder, and other page builders that store shortcodes outside of `post_content`.

= Can I limit how many downloads are shown? =

Yes. Use the `limit` attribute: `[pawa_downloads limit="6"]`. Set `limit="-1"` to show all downloads with no cap.

= Can I sort downloads oldest-first? =

Yes. Use `[pawa_downloads order="ASC"]`.

== Screenshots ==

1. The Downloads admin list view.
2. Adding a download with the media library picker.
3. The front-end card grid with file-type icons and download buttons.

== Changelog ==

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.0 =
Initial release.
