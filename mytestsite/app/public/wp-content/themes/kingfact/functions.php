<?php
// Enqueue assets only when the page template 'page-home.php' is used
function theme_enqueue_home_assets() {
    if (is_front_page() || is_page_template( 'page-home.php' )  || is_page_template( 'front-home.php' ) ) {

        $base = get_template_directory_uri() . '/assets/';

        // Styles (load dependencies first where necessary)
        wp_enqueue_style( 'bootstrap', $base . 'css/bootstrap.min.css', array(), '4.0' );
        wp_enqueue_style( 'owl', $base . 'css/owl.carousel.min.css', array('bootstrap'), null );
        wp_enqueue_style( 'animate', $base . 'css/animate.min.css', array(), null );
        wp_enqueue_style( 'magnific', $base . 'css/magnific-popup.css', array(), null );
        wp_enqueue_style( 'fontawesome', $base . 'css/fontawesome-all.min.css', array(), null );
        wp_enqueue_style( 'themify', $base . 'css/themify-icons.css', array(), null );
        wp_enqueue_style( 'meanmenu', $base . 'css/meanmenu.css', array(), null );
        wp_enqueue_style( 'slick', $base . 'css/slick.css', array(), null );
        wp_enqueue_style( 'main-style', $base . 'css/main.css', array(), '1.0' );
        wp_enqueue_style( 'responsive', $base . 'css/responsive.css', array('main-style'), '1.0' );

        // Optionally enqueue .scss source files for local/dev preview if present.
        // NOTE: Browsers do not compile SCSS. Enqueuing .scss is only useful if you
        // have a server-side/preprocessor that serves compiled CSS at the same path
        // or you are using a dev tool that handles it. Prefer compiled CSS in production.
        $scss_dir = get_template_directory_uri() . '/assets/scss/';
        $scss_files = array(
            'style.scss', // add any SCSS filenames you want to reference
            'custom.scss'
        );
        foreach ( $scss_files as $s ) {
            $url = $scss_dir . $s;
            // register with a distinct handle; make main-style a dependency so load order is preserved
            wp_register_style( 'kingfact-scss-' . sanitize_title( $s ), $url, array('main-style'), null );
            wp_enqueue_style( 'kingfact-scss-' . sanitize_title( $s ) );
        }

        // Slider Revolution CSS
        wp_enqueue_style( 'rev-settings', $base . 'rs/css/settings.css', array(), null );
        wp_enqueue_style( 'rev-layers', $base . 'rs/css/layers.css', array(), null );
        wp_enqueue_style( 'rev-nav', $base . 'rs/css/navigation.css', array(), null );

        // JS (load in footer where possible)
        wp_enqueue_script( 'modernizr', $base . 'js/vendor/modernizr-3.5.0.min.js', array(), null, false ); // header
        // jQuery: WordPress has its own jQuery; if theme needs legacy version you can deregister - but caution:
        // We'll use WP's jQuery to avoid conflicts. If plugin requires the legacy vendor jQuery, you can enqueue it instead.
        // wp_enqueue_script( 'jquery-legacy', $base . 'js/vendor/jquery-1.12.4.min.js', array(), null, true );

        wp_enqueue_script( 'popper', $base . 'js/popper.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'bootstrap-js', $base . 'js/bootstrap.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'owl', $base . 'js/owl.carousel.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'isotope', $base . 'js/isotope.pkgd.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'slick', $base . 'js/slick.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'meanmenu', $base . 'js/jquery.meanmenu.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'ajax-form', $base . 'js/ajax-form.js', array('jquery'), null, true );
        wp_enqueue_script( 'wow', $base . 'js/wow.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'scrollup', $base . 'js/jquery.scrollUp.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'counterup', $base . 'js/jquery.counterup.min.js', array('jquery','waypoints'), null, true );
        wp_enqueue_script( 'waypoints', $base . 'js/waypoints.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'imagesloaded', $base . 'js/imagesloaded.pkgd.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'magnific', $base . 'js/jquery.magnific-popup.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'plugins', $base . 'js/plugins.js', array('jquery'), null, true );
        wp_enqueue_script( 'main-js', $base . 'js/main.js', array('jquery','plugins'), '1.0', true );

        // Slider Revolution scripts
        wp_enqueue_script( 'rev-tools', $base . 'rs/js/jquery.themepunch.tools.min.js', array('jquery'), null, true );
        wp_enqueue_script( 'rev', $base . 'rs/js/jquery.themepunch.revolution.min.js', array('rev-tools'), null, true );
        wp_enqueue_script( 'rev-active', $base . 'rs/js/revolution-active.js', array('rev'), null, true );

        // If slider extensions are present and needed:
        $rev_ext = array(
            'extensions/revolution.extension.actions.min.js',
            'extensions/revolution.extension.carousel.min.js',
            'extensions/revolution.extension.kenburn.min.js',
            'extensions/revolution.extension.layeranimation.min.js',
            'extensions/revolution.extension.migration.min.js',
            'extensions/revolution.extension.navigation.min.js',
            'extensions/revolution.extension.parallax.min.js',
            'extensions/revolution.extension.slideanims.min.js',
            'extensions/revolution.extension.video.min.js'
        );
        foreach ( $rev_ext as $ext ) {
            wp_enqueue_script( 'rev-ext-' . md5($ext), $base . 'rs/js/' . $ext, array('rev'), null, true );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_home_assets' );

// Debug: print comment in <head> indicating whether homepage enqueue condition is met
add_action( 'wp_head', function() {
    if ( is_front_page() || is_page_template( 'page-home.php' ) || is_page_template( 'front-home.php' ) ) {
        echo "\n<!-- kingfact: enqueue condition = TRUE -->\n";
    } else {
        echo "\n<!-- kingfact: enqueue condition = FALSE -->\n";
    }
} );

// Enable featured image support for the theme (do this once)
add_action( 'after_setup_theme', function() {
    add_theme_support( 'post-thumbnails' );
    // optionally also add specific sizes
    add_image_size( 'slide-full', 1920, 1080, true );
    
    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'kingfact' ),
        'footer'  => __( 'Footer Menu', 'kingfact' ),
    ));
    
    // Add support for title tag
    add_theme_support( 'title-tag' );
    
    // Add support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
});


// 1) Register 'slide' CPT
function kingfact_register_slide_cpt() {
    $labels = array(
        'name'          => __( 'Slides', 'kingfact' ),
        'singular_name' => __( 'Slide', 'kingfact' ),
        'add_new_item'  => __( 'Add New Slide', 'kingfact' ),
        'edit_item'     => __( 'Edit Slide', 'kingfact' ),
        'all_items'     => __( 'All Slides', 'kingfact' ),
        'menu_name'     => __( 'Slides', 'kingfact' ),
    );
    $args = array(
        'labels'        => $labels,
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ), // menu_order
        'menu_icon'     => 'dashicons-images-alt2',
    );
    register_post_type( 'slide', $args );
}
add_action( 'init', 'kingfact_register_slide_cpt' );

// 2) Add meta box for extra slide fields
function kingfact_slide_meta_boxes() {
    add_meta_box( 'kingfact_slide_fields', 'Slide Settings', 'kingfact_slide_meta_box_cb', 'slide', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'kingfact_slide_meta_boxes' );

function kingfact_slide_meta_box_cb( $post ) {
    wp_nonce_field( 'kingfact_slide_save', 'kingfact_slide_nonce' );

    $subtitle = get_post_meta( $post->ID, '_slide_subtitle', true );
    $bigtitle = get_post_meta( $post->ID, '_slide_bigtitle', true ); // optional: can use post_title
    $btn_text = get_post_meta( $post->ID, '_slide_btn_text', true );
    $btn_url  = get_post_meta( $post->ID, '_slide_btn_url', true );

    ?>
    <p>
      <label for="slide_subtitle"><strong>Subtitle (small line)</strong></label><br>
      <input type="text" id="slide_subtitle" name="slide_subtitle" value="<?php echo esc_attr( $subtitle ); ?>" style="width:100%;">
    </p>

    <p>
      <label for="slide_bigtitle"><strong>Big Heading</strong></label><br>
      <input type="text" id="slide_bigtitle" name="slide_bigtitle" value="<?php echo esc_attr( $bigtitle ); ?>" style="width:100%;">
      <small class="description">If left empty, this slide's post title will be used.</small>
    </p>

    <p>
      <label for="slide_btn_text"><strong>Button Text</strong></label><br>
      <input type="text" id="slide_btn_text" name="slide_btn_text" value="<?php echo esc_attr( $btn_text ); ?>" style="width:100%;">
    </p>

    <p>
      <label for="slide_btn_url"><strong>Button URL</strong></label><br>
      <input type="url" id="slide_btn_url" name="slide_btn_url" value="<?php echo esc_attr( $btn_url ); ?>" style="width:100%;">
    </p>

    <p>
      <em>Use the main editor (above) for the slide description / paragraph text. Set the Featured Image to be the slide background image.</em>
    </p>
    <?php
}

function kingfact_slide_save( $post_id ) {
    // nonce, autosave, capability checks
    if ( ! isset( $_POST['kingfact_slide_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['kingfact_slide_nonce'], 'kingfact_slide_save' ) ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // save fields
    $fields = array(
        'slide_subtitle' => '_slide_subtitle',
        'slide_bigtitle' => '_slide_bigtitle',
        'slide_btn_text' => '_slide_btn_text',
        'slide_btn_url'  => '_slide_btn_url',
    );
    foreach ( $fields as $input => $meta_key ) {
        if ( isset( $_POST[ $input ] ) ) {
            $value = wp_unslash( $_POST[ $input ] );
            if ( $input === 'slide_btn_url' ) {
                update_post_meta( $post_id, $meta_key, esc_url_raw( $value ) );
            } else {
                update_post_meta( $post_id, $meta_key, sanitize_text_field( $value ) );
            }
        } else {
            delete_post_meta( $post_id, $meta_key );
        }
    }
}
add_action( 'save_post', 'kingfact_slide_save' );


// ACF: Header Settings Fields
if ( function_exists('acf_add_local_field_group') ) {

    acf_add_local_field_group(array(
        'key' => 'group_header_settings',
        'title' => 'Header Settings',
        'fields' => array(

            array(
                'key' => 'field_header_show_top',
                'label' => 'Show Top Bar',
                'name' => 'header_show_top',
                'type' => 'true_false',
                'default_value' => 1,
            ),

            array(
                'key' => 'field_header_hours',
                'label' => 'Opening Hours Text',
                'name' => 'header_hours',
                'type' => 'text',
                'default_value' => 'Mon - Fri: 9:00 - 19:00 / Closed on Weekends',
            ),

            array(
                'key' => 'field_header_links',
                'label' => 'Top Bar Links',
                'name' => 'header_links',
                'type' => 'repeater',
                'button_label' => 'Add Header Link',
                'sub_fields' => array(
                    array(
                        'key' => 'field_header_link_text',
                        'label' => 'Link Text',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_header_link_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                    ),
                ),
            ),

            array(
                'key' => 'field_header_logo',
                'label' => 'Logo Image',
                'name' => 'header_logo',
                'type' => 'image',
                'return_format' => 'array',
            ),

            array(
                'key' => 'field_header_quote_text',
                'label' => 'Quote Button Text',
                'name' => 'header_quote_text',
                'type' => 'text',
                'default_value' => 'get a quote',
            ),

            array(
                'key' => 'field_header_quote_url',
                'label' => 'Quote Button URL',
                'name' => 'header_quote_url',
                'type' => 'url',
                'default_value' => home_url('/contact/'),
            ),

            // --- New header contact fields ---
            array(
                'key' => 'field_header_contact_address',
                'label' => 'Contact Address',
                'name' => 'header_contact_address',
                'type' => 'text',
                'default_value' => 'Flat 20, Reynolds USA',
            ),

            array(
                'key' => 'field_header_contact_email',
                'label' => 'Contact Email',
                'name' => 'header_contact_email',
                'type' => 'email',
                'default_value' => 'support@rmail.com',
            ),

            array(
                'key' => 'field_header_contact_phone',
                'label' => 'Contact Phone',
                'name' => 'header_contact_phone',
                'type' => 'text',
                'default_value' => '+812 (345) 6789',
            ),

            array(
                'key' => 'field_header_social_links',
                'label' => 'Social Links',
                'name' => 'header_social_links',
                'type' => 'repeater',
                'button_label' => 'Add Social Link',
                'sub_fields' => array(
                    array(
                        'key' => 'field_header_social_icon',
                        'label' => 'Icon Class',
                        'name' => 'icon',
                        'type' => 'text',
                        'instructions' => 'Enter FontAwesome class, e.g. "fab fa-facebook-f"'
                    ),
                    array(
                        'key' => 'field_header_social_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                    ),
                ),
            ),

        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'theme-general-settings',
                ),
            ),
        ),
    ));

    // Create Options Page
    if ( function_exists('acf_add_options_page') ) {
        acf_add_options_page(array(
            'page_title'  => 'Theme Settings',
            'menu_title'  => 'Theme Settings',
            'menu_slug'   => 'theme-general-settings',
            'capability'  => 'edit_posts',
            'redirect'    => false
        ));
    }
}

// ACF: Footer Settings Fields
if ( function_exists('acf_add_local_field_group') ) {
    acf_add_local_field_group(array(
        'key' => 'group_footer_settings',
        'title' => 'Footer Settings',
        'fields' => array(
            array(
                'key' => 'field_footer_logo',
                'label' => 'Footer Logo',
                'name' => 'footer_logo',
                'type' => 'image',
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_footer_text',
                'label' => 'Footer Text',
                'name' => 'footer_text',
                'type' => 'textarea',
                'rows' => 4,
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_footer_quick_links',
                'label' => 'Quick Links',
                'name' => 'footer_quick_links',
                'type' => 'repeater',
                'button_label' => 'Add Link',
                'sub_fields' => array(
                    array(
                        'key' => 'field_footer_quick_link_text',
                        'label' => 'Link Text',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_footer_quick_link_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                    ),
                ),
            ),
            array(
                'key' => 'field_footer_contact_address',
                'label' => 'Contact Address',
                'name' => 'footer_contact_address',
                'type' => 'text',
            ),
            array(
                'key' => 'field_footer_contact_email',
                'label' => 'Contact Email',
                'name' => 'footer_contact_email',
                'type' => 'email',
            ),
            array(
                'key' => 'field_footer_contact_phone',
                'label' => 'Contact Phone',
                'name' => 'footer_contact_phone',
                'type' => 'text',
            ),
            array(
                'key' => 'field_footer_social_links',
                'label' => 'Footer Social Links',
                'name' => 'footer_social_links',
                'type' => 'repeater',
                'button_label' => 'Add Social Link',
                'sub_fields' => array(
                    array(
                        'key' => 'field_footer_social_icon',
                        'label' => 'Icon Class',
                        'name' => 'icon',
                        'type' => 'text',
                        'instructions' => 'Enter FontAwesome class, e.g. "fab fa-facebook-f"'
                    ),
                    array(
                        'key' => 'field_footer_social_url',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'url',
                    ),
                ),
            ),
            array(
                'key' => 'field_footer_copyright',
                'label' => 'Copyright Text',
                'name' => 'footer_copyright',
                'type' => 'text',
                'default_value' => 'Copyright © ' . date('Y') . ' kingfact. All rights reserved.',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'theme-general-settings',
                ),
            ),
        ),
    ));

    // Create Options Page
    if ( function_exists('acf_add_options_page') ) {
        acf_add_options_page(array(
            'page_title'  => 'Theme Settings',
            'menu_title'  => 'Theme Settings',
            'menu_slug'   => 'theme-general-settings',
            'capability'  => 'edit_posts',
            'redirect'    => false
        ));
    }
}

// Contact Form Handler
function handle_contact_form_submission() {
    // Verify nonce
    if ( ! isset( $_POST['contact_nonce'] ) || ! wp_verify_nonce( $_POST['contact_nonce'], 'contact_form_submit' ) ) {
        wp_die( 'Security check failed' );
    }

    // Sanitize and validate form data
    $name    = sanitize_text_field( $_POST['contact_name'] );
    $email   = sanitize_email( $_POST['contact_email'] );
    $phone   = sanitize_text_field( $_POST['contact_phone'] );
    $subject = sanitize_text_field( $_POST['contact_subject'] );
    $message = sanitize_textarea_field( $_POST['contact_message'] );

    // Validate required fields
    if ( empty( $name ) || empty( $email ) || empty( $subject ) || empty( $message ) ) {
        wp_redirect( add_query_arg( 'contact', 'error', wp_get_referer() ) );
        exit;
    }

    // Prepare email
    $to = get_option( 'admin_email' ); // Send to site admin email
    $email_subject = 'Contact Form: ' . $subject;
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Phone: $phone\n\n";
    $email_message .= "Message:\n$message";
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email
    );

    // Send email
    $sent = wp_mail( $to, $email_subject, $email_message, $headers );

    // Redirect based on success/failure
    if ( $sent ) {
        wp_redirect( add_query_arg( 'contact', 'success', wp_get_referer() ) );
    } else {
        wp_redirect( add_query_arg( 'contact', 'error', wp_get_referer() ) );
    }
    exit;
}
add_action( 'admin_post_nopriv_submit_contact_form', 'handle_contact_form_submission' );
add_action( 'admin_post_submit_contact_form', 'handle_contact_form_submission' );

// Admin columns for Slide CPT: thumbnail, subtitle, order
add_filter( 'manage_edit-slide_columns', 'kingfact_slide_manage_columns' );
function kingfact_slide_manage_columns( $columns ) {
    $new = array();
    $new['cb']            = $columns['cb'];
    $new['thumbnail']     = __( 'Image', 'kingfact' );
    $new['title']         = __( 'Title', 'kingfact' );
    $new['subtitle']      = __( 'Subtitle', 'kingfact' );
    $new['menu_order']    = __( 'Order', 'kingfact' );
    $new['date']          = $columns['date'];
    return $new;
}

add_action( 'manage_slide_posts_custom_column', 'kingfact_slide_custom_column', 10, 2 );
function kingfact_slide_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'thumbnail':
            $thumb_id = get_post_thumbnail_id( $post_id );
            if ( $thumb_id ) {
                $img = wp_get_attachment_image( $thumb_id, array(120,80) );
                echo $img;
            } else {
                echo '<span style="color:#999;">' . __( 'No image', 'kingfact' ) . '</span>';
            }
            break;

        case 'subtitle':
            $subtitle = get_post_meta( $post_id, '_slide_subtitle', true );
            echo $subtitle ? esc_html( $subtitle ) : '<span style="color:#999;">' . __( '—', 'kingfact' ) . '</span>';
            break;

        case 'menu_order':
            $order = get_post_field( 'menu_order', $post_id );
            echo intval( $order );
            break;
    }
}

// Make menu_order column sortable
add_filter( 'manage_edit-slide_sortable_columns', 'kingfact_slide_sortable_columns' );
function kingfact_slide_sortable_columns( $columns ) {
    $columns['menu_order'] = 'menu_order';
    return $columns;
}

// Adjust query when sorting by menu_order
add_action( 'pre_get_posts', 'kingfact_slide_orderby_menu_order' );
function kingfact_slide_orderby_menu_order( $query ) {
    if ( ! is_admin() ) return;
    $orderby = $query->get( 'orderby' );
    $post_type = $query->get( 'post_type' );

    if ( 'slide' === $post_type ) {
        if ( 'menu_order' === $orderby ) {
            $query->set( 'orderby', 'menu_order' );
            $query->set( 'order', 'ASC' );
        }
    }
}

// Admin: enqueue sortable script for Slides list and localize nonce/ajax
add_action( 'admin_enqueue_scripts', 'kingfact_enqueue_slide_admin_scripts' );
function kingfact_enqueue_slide_admin_scripts( $hook ) {
    global $post_type;

    // Only enqueue on edit.php for slide post type
    if ( 'edit.php' !== $hook || 'slide' !== ( isset( $_GET['post_type'] ) ? $_GET['post_type'] : $post_type ) ) {
        return;
    }

    // jQuery UI sortable is included with WP
    wp_enqueue_script( 'jquery-ui-sortable' );

    // Small admin script
    $handle = 'kingfact-slide-admin';
    wp_register_script( $handle, false, array( 'jquery', 'jquery-ui-sortable' ), '1.0', true );

    // Use a nowdoc so PHP doesn't try to interpolate JS $ variables
    $inline = <<<'JS'
(function($){
    $(function(){
        var tbody = $('.wp-list-table.posts tbody');
        if (!tbody.length) return;

        tbody.sortable({
            items: 'tr[id^=post-]',
            axis: 'y',
            cursor: 'move',
            helper: function(e, tr){
                var originals = tr.children();
                var helper = tr.clone();
                helper.children().each(function(index){
                    // Set helper cell widths to match
                    $(this).width(originals.eq(index).width());
                });
                return helper;
            },
            update: function(event, ui){
                var order = [];
                tbody.find('tr[id^=post-]').each(function(i){
                    var id = $(this).attr('id').replace('post-','');
                    order.push(parseInt(id,10));
                });

                $.post(ajaxurl, {
                    action: 'kingfact_update_slide_order',
                    nonce: '%s',
                    order: order
                }, function(resp){
                    if (resp && resp.success) {
                        // optional: flash a notice
                        $('#message.updated').remove();
                        $('<div id="message" class="updated notice is-dismissible"><p>Slide order saved.</p></div>').insertBefore('.wrap');
                    } else {
                        alert('Could not save order.');
                    }
                }, 'json');
            }
        });
    });
})(jQuery);
JS;

    $nonce = wp_create_nonce( 'kingfact_slide_order' );
    $inline = sprintf( $inline, esc_js( $nonce ) );

    wp_add_inline_script( $handle, $inline );
    wp_enqueue_script( $handle );
}

// AJAX handler to save the menu_order for slides
add_action( 'wp_ajax_kingfact_update_slide_order', 'kingfact_update_slide_order' );
function kingfact_update_slide_order() {
    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_send_json_error( 'no_permission' );
    }

    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'kingfact_slide_order' ) ) {
        wp_send_json_error( 'bad_nonce' );
    }

    if ( ! isset( $_POST['order'] ) || ! is_array( $_POST['order'] ) ) {
        wp_send_json_error( 'bad_input' );
    }

    $order = array_map( 'absint', $_POST['order'] );

    foreach ( $order as $position => $post_id ) {
        // double-check post type
        $post = get_post( $post_id );
        if ( ! $post || 'slide' !== $post->post_type ) continue;

        // Update menu_order (0-based position)
        wp_update_post( array( 'ID' => $post_id, 'menu_order' => $position ) );
    }

    wp_send_json_success();
}

// Fallback Theme Settings page when ACF Pro Options page is not available
if ( ! function_exists( 'acf_add_options_page' ) ) {
    add_action( 'admin_menu', function() {
        add_theme_page( 'Theme Settings', 'Theme Settings', 'edit_posts', 'theme-general-settings', 'kingfact_theme_settings_page' );
    } );

    function kingfact_get_option( $key, $default = '' ) {
        $opts = get_option( 'kingfact_theme_options', array() );
        return isset( $opts[ $key ] ) ? $opts[ $key ] : $default;
    }

    function kingfact_update_options( $data ) {
        $opts = get_option( 'kingfact_theme_options', array() );
        $opts = array_merge( $opts, $data );
        update_option( 'kingfact_theme_options', $opts );
    }

    function kingfact_theme_settings_page() {
        if ( ! current_user_can( 'edit_posts' ) ) {
            return;
        }

        // Handle save
        if ( isset( $_POST['kingfact_theme_settings_nonce'] ) && wp_verify_nonce( $_POST['kingfact_theme_settings_nonce'], 'kingfact_save_theme_settings' ) ) {
            $save = array();
            // Header
            $save['header_contact_address'] = sanitize_text_field( wp_unslash( $_POST['header_contact_address'] ?? '' ) );
            $save['header_contact_email']   = sanitize_email( wp_unslash( $_POST['header_contact_email'] ?? '' ) );
            $save['header_contact_phone']   = sanitize_text_field( wp_unslash( $_POST['header_contact_phone'] ?? '' ) );

            // Header socials - arrays of icon and url
            $icons = isset( $_POST['header_social_icon'] ) ? array_map( 'sanitize_text_field', wp_unslash( (array) $_POST['header_social_icon'] ) ) : array();
            $urls  = isset( $_POST['header_social_url'] ) ? array_map( 'esc_url_raw', wp_unslash( (array) $_POST['header_social_url'] ) ) : array();
            $header_socials = array();
            for ( $i = 0; $i < max( count( $icons ), count( $urls ) ); $i++ ) {
                $ic = trim( $icons[ $i ] ?? '' );
                $ur = trim( $urls[ $i ] ?? '' );
                if ( $ic || $ur ) {
                    $header_socials[] = array( 'icon' => $ic, 'url' => $ur );
                }
            }
            $save['header_social_links'] = $header_socials;

            // Footer
            $save['footer_text'] = wp_kses_post( wp_unslash( $_POST['footer_text'] ?? '' ) );
            $save['footer_contact_address'] = sanitize_text_field( wp_unslash( $_POST['footer_contact_address'] ?? '' ) );
            $save['footer_contact_email'] = sanitize_email( wp_unslash( $_POST['footer_contact_email'] ?? '' ) );
            $save['footer_contact_phone'] = sanitize_text_field( wp_unslash( $_POST['footer_contact_phone'] ?? '' ) );
            $save['footer_copyright'] = sanitize_text_field( wp_unslash( $_POST['footer_copyright'] ?? '' ) );

            // Footer socials
            $f_icons = isset( $_POST['footer_social_icon'] ) ? array_map( 'sanitize_text_field', wp_unslash( (array) $_POST['footer_social_icon'] ) ) : array();
            $f_urls  = isset( $_POST['footer_social_url'] ) ? array_map( 'esc_url_raw', wp_unslash( (array) $_POST['footer_social_url'] ) ) : array();
            $footer_socials = array();
            for ( $i = 0; $i < max( count( $f_icons ), count( $f_urls ) ); $i++ ) {
                $ic = trim( $f_icons[ $i ] ?? '' );
                $ur = trim( $f_urls[ $i ] ?? '' );
                if ( $ic || $ur ) {
                    $footer_socials[] = array( 'icon' => $ic, 'url' => $ur );
                }
            }
            $save['footer_social_links'] = $footer_socials;

            kingfact_update_options( $save );
            echo '<div class="updated"><p>Settings saved.</p></div>';
        }

        // Load current values
        $header_address = kingfact_get_option( 'header_contact_address', 'Flat 20, Reynolds USA' );
        $header_email = kingfact_get_option( 'header_contact_email', 'support@rmail.com' );
        $header_phone = kingfact_get_option( 'header_contact_phone', '+812 (345) 6789' );
        $header_socials = kingfact_get_option( 'header_social_links', array() );

        $footer_text = kingfact_get_option( 'footer_text', 'But I must explain to you how all this misn idea of denouncing pleasure and prais pain <a href="#">Continue Reading</a>' );
        $footer_contact_address = kingfact_get_option( 'footer_contact_address', '1058 Meadowb, Mall Road' );
        $footer_contact_email = kingfact_get_option( 'footer_contact_email', 'support@gmail.com' );
        $footer_contact_phone = kingfact_get_option( 'footer_contact_phone', '+000 (123) 44 558' );
        $footer_copyright = kingfact_get_option( 'footer_copyright', 'Copyright © ' . date('Y') . ' kingfact. All rights reserved.' );
        $footer_socials = kingfact_get_option( 'footer_social_links', array() );

        ?>
        <div class="wrap">
            <h1>Theme Settings</h1>
            <form method="post">
                <?php wp_nonce_field( 'kingfact_save_theme_settings', 'kingfact_theme_settings_nonce' ); ?>

                <h2>Header Contact</h2>
                <table class="form-table">
                    <tr>
                        <th><label for="header_contact_address">Contact Address</label></th>
                        <td><input name="header_contact_address" id="header_contact_address" class="regular-text" value="<?php echo esc_attr( $header_address ); ?>"></td>
                    </tr>
                    <tr>
                        <th><label for="header_contact_email">Contact Email</label></th>
                        <td><input name="header_contact_email" id="header_contact_email" class="regular-text" value="<?php echo esc_attr( $header_email ); ?>"></td>
                    </tr>
                    <tr>
                        <th><label for="header_contact_phone">Contact Phone</label></th>
                        <td><input name="header_contact_phone" id="header_contact_phone" class="regular-text" value="<?php echo esc_attr( $header_phone ); ?>"></td>
                    </tr>
                </table>

                <h3>Header Social Links</h3>
                <div id="header-socials">
                    <table class="form-table" id="header-social-table">
                        <?php if ( $header_socials ) : foreach ( $header_socials as $s ) : ?>
                            <tr>
                                <th>Icon class</th>
                                <td><input name="header_social_icon[]" class="regular-text" value="<?php echo esc_attr( $s['icon'] ); ?>"> URL: <input name="header_social_url[]" class="regular-text" value="<?php echo esc_attr( $s['url'] ); ?>"></td>
                            </tr>
                        <?php endforeach; endif; ?>
                        <tr class="template-row" style="display:none;">
                            <th>Icon class</th>
                            <td><input name="header_social_icon[]" class="regular-text"> URL: <input name="header_social_url[]" class="regular-text"></td>
                        </tr>
                    </table>
                    <p><button type="button" class="button" id="add-header-social">Add Social Link</button></p>
                </div>

                <h2>Footer Settings</h2>
                <table class="form-table">
                    <tr>
                        <th><label for="footer_text">Footer Text (HTML allowed)</label></th>
                        <td><textarea name="footer_text" id="footer_text" rows="5" class="large-text"><?php echo esc_textarea( $footer_text ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="footer_contact_address">Contact Address</label></th>
                        <td><input name="footer_contact_address" id="footer_contact_address" class="regular-text" value="<?php echo esc_attr( $footer_contact_address ); ?>"></td>
                    </tr>
                    <tr>
                        <th><label for="footer_contact_email">Contact Email</label></th>
                        <td><input name="footer_contact_email" id="footer_contact_email" class="regular-text" value="<?php echo esc_attr( $footer_contact_email ); ?>"></td>
                    </tr>
                    <tr>
                        <th><label for="footer_contact_phone">Contact Phone</label></th>
                        <td><input name="footer_contact_phone" id="footer_contact_phone" class="regular-text" value="<?php echo esc_attr( $footer_contact_phone ); ?>"></td>
                    </tr>
                    <tr>
                        <th><label for="footer_copyright">Copyright Text</label></th>
                        <td><input name="footer_copyright" id="footer_copyright" class="regular-text" value="<?php echo esc_attr( $footer_copyright ); ?>"></td>
                    </tr>
                </table>

                <h3>Footer Social Links</h3>
                <table class="form-table" id="footer-social-table">
                    <?php if ( $footer_socials ) : foreach ( $footer_socials as $f ) : ?>
                        <tr>
                            <th>Icon class</th>
                            <td><input name="footer_social_icon[]" class="regular-text" value="<?php echo esc_attr( $f['icon'] ); ?>"> URL: <input name="footer_social_url[]" class="regular-text" value="<?php echo esc_attr( $f['url'] ); ?>"></td>
                        </tr>
                    <?php endforeach; endif; ?>
                    <tr class="template-row" style="display:none;">
                        <th>Icon class</th>
                        <td><input name="footer_social_icon[]" class="regular-text"> URL: <input name="footer_social_url[]" class="regular-text"></td>
                    </tr>
                </table>
                <p><button type="button" class="button" id="add-footer-social">Add Footer Social Link</button></p>

                <p class="submit"><button type="submit" class="button button-primary">Save Settings</button></p>
            </form>
        </div>

        <script>
        (function(){
            var addHeader = document.getElementById('add-header-social');
            if (addHeader) {
                addHeader.addEventListener('click', function(){
                    var table = document.getElementById('header-social-table');
                    var tpl = table.querySelector('.template-row');
                    table.insertBefore(tpl.cloneNode(true), tpl);
                    table.querySelectorAll('.template-row').forEach(function(row){ row.style.display=''; row.classList.remove('template-row'); });
                });
            }
            var addFooter = document.getElementById('add-footer-social');
            if (addFooter) {
                addFooter.addEventListener('click', function(){
                    var table = document.getElementById('footer-social-table');
                    var tpl = table.querySelector('.template-row');
                    table.insertBefore(tpl.cloneNode(true), tpl);
                    table.querySelectorAll('.template-row').forEach(function(row){ row.style.display=''; row.classList.remove('template-row'); });
                });
            }

        })();
        </script>
        <?php
    }
}
