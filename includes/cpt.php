<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', 'pawa_dl_register_cpt' );
function pawa_dl_register_cpt() {
    $labels = [
        'name'               => __( 'Downloads', 'pawa-downloads' ),
        'singular_name'      => __( 'Download', 'pawa-downloads' ),
        'add_new'            => __( 'Add New', 'pawa-downloads' ),
        'add_new_item'       => __( 'Add New Download', 'pawa-downloads' ),
        'edit_item'          => __( 'Edit Download', 'pawa-downloads' ),
        'new_item'           => __( 'New Download', 'pawa-downloads' ),
        'view_item'          => __( 'View Download', 'pawa-downloads' ),
        'search_items'       => __( 'Search Downloads', 'pawa-downloads' ),
        'not_found'          => __( 'No downloads found', 'pawa-downloads' ),
        'not_found_in_trash' => __( 'No downloads found in Trash', 'pawa-downloads' ),
        'menu_name'          => __( 'Downloads', 'pawa-downloads' ),
    ];

    register_post_type( 'pawa_download', [
        'labels'        => $labels,
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'show_in_rest'  => false, // intentional: uses classic editor
        'supports'      => [ 'title', 'editor' ],
        'menu_icon'     => 'dashicons-download',
        'menu_position' => 20,
        'rewrite'       => false,
    ] );
}
