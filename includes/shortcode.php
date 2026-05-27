<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_shortcode( 'pawa_downloads', 'pawa_dl_shortcode' );
function pawa_dl_shortcode( $atts ) {
    $atts = shortcode_atts(
        [
            'limit' => 12,
            'order' => 'DESC',
        ],
        $atts,
        'pawa_downloads'
    );

    $limit = intval( $atts['limit'] );
    $order = strtoupper( $atts['order'] ) === 'ASC' ? 'ASC' : 'DESC';

    $downloads = get_posts( [
        'post_type'      => 'pawa_download',
        'post_status'    => 'publish',
        'posts_per_page' => ( $limit < 0 ) ? -1 : $limit,
        'orderby'        => 'date',
        'order'          => $order,
    ] );

    if ( empty( $downloads ) ) {
        return '<p class="pawa-dl-empty">'
            . esc_html__( 'No downloads available yet. Check back soon.', 'pawa-downloads' )
            . '</p>';
    }

    $icons = [
        'pdf'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="#e53e3e"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM8.5 15.5c0 .3-.2.5-.5.5H7v1H6v-4h2c.8 0 1.5.7 1.5 1.5v1zm4 .5H11v1h-1v-4h2.5c.8 0 1.5.7 1.5 1.5v1c0 .8-.7 1.5-1.5 1.5zM18 13h-3v4h1v-1.5h1.5v-1H16V14h2v-1zm-10 1h1v1H8v-1zm4 0h1v1h-1v-1z"/></svg>',
        'doc'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="#2b579a"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM7 13h10v1H7v-1zm0 3h10v1H7v-1zm0-6h5v1H7v-1z"/></svg>',
        'docx' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="#2b579a"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM7 13h10v1H7v-1zm0 3h10v1H7v-1zm0-6h5v1H7v-1z"/></svg>',
        'xls'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="#217346"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM8 17l2-3-2-3h1.5l1.25 2 1.25-2H13.5l-2 3 2 3H12l-1.25-2L9.5 17H8z"/></svg>',
        'xlsx' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="#217346"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM8 17l2-3-2-3h1.5l1.25 2 1.25-2H13.5l-2 3 2 3H12l-1.25-2L9.5 17H8z"/></svg>',
    ];
    $default_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="#718096"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM7 13h10v1H7v-1zm0 3h10v1H7v-1zm0-6h5v1H7v-1z"/></svg>';

    ob_start();
    echo '<div class="pawa-dl-grid">';

    foreach ( $downloads as $item ) {
        $file_url = get_post_meta( $item->ID, '_pawa_dl_file_url', true );
        $ext      = strtolower( pathinfo( parse_url( (string) $file_url, PHP_URL_PATH ), PATHINFO_EXTENSION ) );
        $icon     = isset( $icons[ $ext ] ) ? $icons[ $ext ] : $default_icon;
        $desc     = wpautop( wp_kses_post( $item->post_content ) );
        ?>
        <div class="pawa-dl-card">
            <div class="pawa-dl-icon"><?php echo $icon; ?></div>
            <div class="pawa-dl-body">
                <h3 class="pawa-dl-title"><?php echo esc_html( $item->post_title ); ?></h3>
                <?php if ( $desc ) : ?>
                    <div class="pawa-dl-desc"><?php echo $desc; ?></div>
                <?php endif; ?>
                <?php if ( $file_url ) : ?>
                    <a href="<?php echo esc_url( $file_url ); ?>"
                       class="pawa-dl-btn"
                       download
                       target="_blank"
                       rel="noopener noreferrer">
                        <?php esc_html_e( '↓ Download', 'pawa-downloads' ); ?>
                    </a>
                <?php else : ?>
                    <span class="pawa-dl-soon">
                        <?php esc_html_e( 'Coming soon', 'pawa-downloads' ); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    echo '</div>';
    return ob_get_clean();
}
