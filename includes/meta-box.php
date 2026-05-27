<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// ---------------------------------------------------------------------------
// Enqueue WP media library — scoped to pawa_download edit screens only
// ---------------------------------------------------------------------------
add_action( 'admin_enqueue_scripts', 'pawa_dl_enqueue_media' );
function pawa_dl_enqueue_media( $hook ) {
    if ( 'post-new.php' !== $hook && 'post.php' !== $hook ) {
        return;
    }
    $screen = get_current_screen();
    if ( $screen && 'pawa_download' === $screen->post_type ) {
        wp_enqueue_media();
        wp_register_script( 'pawa-dl-admin', false, [ 'jquery' ], PAWA_DL_VERSION, true );
        wp_enqueue_script( 'pawa-dl-admin' );
        wp_localize_script( 'pawa-dl-admin', 'pawaDlAdmin', [
            'title'  => __( 'Select File to Download', 'pawa-downloads' ),
            'button' => __( 'Use this file', 'pawa-downloads' ),
        ] );
        wp_add_inline_script( 'pawa-dl-admin', '
jQuery( document ).ready( function ( $ ) {
    $( "#pawa_dl_upload_btn" ).on( "click", function ( e ) {
        e.preventDefault();
        var frame = wp.media( {
            title:  pawaDlAdmin.title,
            button: { text: pawaDlAdmin.button },
            multiple: false
        } );
        frame.on( "select", function () {
            var attachment = frame.state().get( "selection" ).first().toJSON();
            $( "#pawa_dl_file_url" ).val( attachment.url );
        } );
        frame.open();
    } );
} );
' );
    }
}

// ---------------------------------------------------------------------------
// Register meta box
// ---------------------------------------------------------------------------
add_action( 'add_meta_boxes', 'pawa_dl_add_file_metabox' );
function pawa_dl_add_file_metabox() {
    add_meta_box(
        'pawa_dl_download_file',
        __( 'Download File', 'pawa-downloads' ),
        'pawa_dl_render_file_metabox',
        'pawa_download',
        'normal',
        'high'
    );
}

// ---------------------------------------------------------------------------
// Render meta box HTML
// ---------------------------------------------------------------------------
function pawa_dl_render_file_metabox( $post ) {
    $file_url = get_post_meta( $post->ID, '_pawa_dl_file_url', true );
    wp_nonce_field( 'pawa_dl_save_download', 'pawa_dl_nonce' );
    ?>
    <p>
        <label for="pawa_dl_file_url">
            <strong><?php esc_html_e( 'File URL', 'pawa-downloads' ); ?></strong>
        </label><br>
        <input
            type="text"
            id="pawa_dl_file_url"
            name="pawa_dl_file_url"
            value="<?php echo esc_attr( $file_url ); ?>"
            style="width:75%;margin-right:8px;"
            placeholder="https://"
        />
        <button type="button" class="button" id="pawa_dl_upload_btn">
            <?php esc_html_e( 'Choose File', 'pawa-downloads' ); ?>
        </button>
    </p>
    <p style="color:#666;font-size:12px;">
        <?php esc_html_e( 'Accepted: PDF, DOC, DOCX, XLS, XLSX. Upload via Choose File or paste a direct URL.', 'pawa-downloads' ); ?>
    </p>
    <?php
}

// ---------------------------------------------------------------------------
// Save meta
// ---------------------------------------------------------------------------
add_action( 'save_post_pawa_download', 'pawa_dl_save_download_meta' );
function pawa_dl_save_download_meta( $post_id ) {
    if ( ! isset( $_POST['pawa_dl_nonce'] ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! wp_verify_nonce( wp_unslash( $_POST['pawa_dl_nonce'] ), 'pawa_dl_save_download' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['pawa_dl_file_url'] ) ) {
        update_post_meta(
            $post_id,
            '_pawa_dl_file_url',
            esc_url_raw( wp_unslash( $_POST['pawa_dl_file_url'] ) )
        );
    }
}
