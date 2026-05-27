<?php
/**
 * Plugin Name:       Pawa Downloads
 * Plugin URI:        https://github.com/mwangepatrick/pawa-downloads
 * Description:       Manage and display downloadable files (PDF, Word, Excel) using a simple shortcode.
 * Version:           1.0.0
 * Author:            Rahisi Solutions
 * Author URI:        https://rahisisolutions.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pawa-downloads
 * Domain Path:       /languages
 * Requires at least: 5.8
 * Requires PHP:      7.4
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ---------------------------------------------------------------------------
// Constants
// ---------------------------------------------------------------------------
define( 'PAWA_DL_VERSION', '1.0.0' );
define( 'PAWA_DL_DIR', plugin_dir_path( __FILE__ ) );
define( 'PAWA_DL_URL', plugin_dir_url( __FILE__ ) );

// ---------------------------------------------------------------------------
// PHP version check — abort activation on PHP < 7.4
// ---------------------------------------------------------------------------
register_activation_hook( __FILE__, 'pawa_dl_activation_check' );
function pawa_dl_activation_check() {
    if ( version_compare( PHP_VERSION, '7.4', '<' ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) );
        wp_die(
            sprintf(
                /* translators: %s: current PHP version string */
                esc_html__( 'Pawa Downloads requires PHP 7.4 or higher. Your server is running PHP %s. Please upgrade PHP and try again.', 'pawa-downloads' ),
                PHP_VERSION
            ),
            esc_html__( 'Plugin Activation Error', 'pawa-downloads' ),
            [ 'back_link' => true ]
        );
    }
}

// ---------------------------------------------------------------------------
// Load text domain
// ---------------------------------------------------------------------------
add_action( 'plugins_loaded', function () {
    load_plugin_textdomain(
        'pawa-downloads',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages/'
    );
} );

// ---------------------------------------------------------------------------
// Load includes
// ---------------------------------------------------------------------------
require_once PAWA_DL_DIR . 'includes/cpt.php';
require_once PAWA_DL_DIR . 'includes/meta-box.php';
require_once PAWA_DL_DIR . 'includes/shortcode.php';
require_once PAWA_DL_DIR . 'includes/styles.php';
