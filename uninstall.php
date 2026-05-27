<?php
// Guard: only run when WordPress triggers plugin deletion.
// Prevents direct URL execution.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit;

$pawa_dl_posts = get_posts( [
    'post_type'      => 'pawa_download',
    'post_status'    => 'any',
    'posts_per_page' => -1,
    'fields'         => 'ids',
] );

foreach ( $pawa_dl_posts as $pawa_dl_id ) {
    // true = force-delete (bypasses trash).
    // WordPress cascade-deletes all post meta automatically.
    wp_delete_post( $pawa_dl_id, true );
}
