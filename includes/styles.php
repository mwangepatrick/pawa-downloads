<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'pawa_dl_enqueue_styles' );
function pawa_dl_enqueue_styles() {
    // Register with no src — used purely as a carrier for wp_add_inline_style.
    // Loaded on every front-end page so it works with Elementor and other
    // page builders that store shortcodes outside post_content.
    wp_register_style( 'pawa-downloads', false, [], PAWA_DL_VERSION );
    wp_enqueue_style( 'pawa-downloads' );
    wp_add_inline_style( 'pawa-downloads', pawa_dl_get_css() );
}

function pawa_dl_get_css() {
    return '
.pawa-dl-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
    padding: 40px 0;
}
.pawa-dl-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 24px;
    display: flex;
    gap: 16px;
    align-items: flex-start;
    box-shadow: 0 2px 8px rgba(0,0,0,.06);
    transition: box-shadow .2s, transform .2s;
}
.pawa-dl-card:hover {
    box-shadow: 0 6px 20px rgba(0,0,0,.12);
    transform: translateY(-2px);
}
.pawa-dl-icon {
    flex-shrink: 0;
    width: 40px;
    padding-top: 2px;
}
.pawa-dl-icon svg { display: block; }
.pawa-dl-body { flex: 1; min-width: 0; }
.pawa-dl-title {
    font-size: 1.05rem !important;
    font-weight: 600 !important;
    margin: 0 0 8px !important;
    color: #1a202c !important;
    line-height: 1.4 !important;
}
.pawa-dl-desc {
    font-size: .9rem;
    color: #6b7280;
    margin: 0 0 16px;
    line-height: 1.6;
}
.pawa-dl-desc p { margin: 0; }
.pawa-dl-btn {
    display: inline-block;
    background: #2a7c5f;
    color: #fff !important;
    padding: 8px 20px;
    border-radius: 6px;
    font-size: .875rem;
    font-weight: 600;
    text-decoration: none !important;
    transition: background .2s;
    letter-spacing: .02em;
}
.pawa-dl-btn:hover { background: #1f5e47; color: #fff !important; }
.pawa-dl-soon { font-size: .85rem; color: #9ca3af; font-style: italic; }
.pawa-dl-empty { color: #6b7280; font-style: italic; padding: 40px 0; }
@media (max-width: 600px) {
    .pawa-dl-grid { grid-template-columns: 1fr; }
}';
}
