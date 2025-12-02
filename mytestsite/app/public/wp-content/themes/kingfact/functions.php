<?php
// Enqueue assets only when the page template 'page-home.php' is used
function theme_enqueue_home_assets() {
    if (is_front_page() || is_page_template( 'page-home.php' )  || is_page_template( 'page-products.php' )  || is_page_template( 'front-home.php' ) || is_page_template( 'page-services.php' ) || is_page_template( 'page-about.php' )
        || is_page_template( 'page-contact.php' ) || is_singular( 'service' ) || is_singular( 'product' ) || is_404() 
        || is_home() || is_archive() || is_single() || is_search() || is_category() || is_tag() || is_author()
        || is_page_template( 'page-media.php' ) ||  is_page_template( 'page-terms.php')  || is_page_template( 'page-sitemap.php' ) 
        || is_page_template( 'page-settings-privacy.php' )
        ){

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

        // Google Maps API (for contact page - only if custom iframe not set)
        if ( is_page_template( 'page-contact.php' ) ) {
            // Check if custom map iframe is set
            $map_iframe = get_field('contact_map_iframe');
            
            // Only load Google Maps API if no custom iframe is configured
            if ( empty( $map_iframe ) ) {
                $google_maps_api_key = 'YOUR_GOOGLE_MAPS_API_KEY'; // Replace with your actual API key
                wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=' . $google_maps_api_key, array(), null, true );
            }
        }
    }
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_home_assets' );

// Debug: print comment in <head> indicating whether homepage enqueue condition is met
add_action( 'wp_head', function() {
    if ( is_front_page() || is_page_template( 'page-home.php' ) || is_page_template( 'front-home.php' ) || is_page_template( 'page-services.php' ) || is_page_template( 'page-about.php' ) || is_page_template( 'page-contact.php' ) || is_singular( 'service' ) || is_404() || is_home() || is_archive() || is_single() || is_search() ) {
        echo "\n<!-- kingfact: enqueue condition = TRUE -->\n";
    } else {
        echo "\n<!-- kingfact: enqueue condition = FALSE -->\n";
    }
} );

// Add custom CSS for active menu highlighting
add_action( 'wp_head', function() {
    ?>
    <style>
        /* Active menu item styles - WordPress default classes */
        .main-menu nav > ul > li.current-menu-item > a,
        .main-menu nav > ul > li.current-menu-ancestor > a,
        .main-menu nav > ul > li.current-menu-parent > a,
        .main-menu nav > ul > li.current_page_item > a,
        .main-menu nav > ul > li.current_page_ancestor > a,
        .main-menu nav > ul > li.current_page_parent > a {
            color: #febc35;
        }
        
        .main-menu > nav > ul > li.current-menu-item > a::before,
        .main-menu > nav > ul > li.current-menu-ancestor > a::before,
        .main-menu > nav > ul > li.current-menu-parent > a::before,
        .main-menu > nav > ul > li.current_page_item > a::before,
        .main-menu > nav > ul > li.current_page_ancestor > a::before,
        .main-menu > nav > ul > li.current_page_parent > a::before {
            width: 100%;
            opacity: 1;
            background-color: #febc35;
        }
        
        /* Submenu active items */
        .main-menu nav > ul > li .sub-menu li.current-menu-item > a,
        .main-menu nav > ul > li .sub-menu li.current_page_item > a {
            color: #febc35;
            background-color: rgba(254, 188, 53, 0.1);
        }
    </style>
    <?php
}, 100 );

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

// Fix navigation menu active classes for custom post types
add_filter('nav_menu_css_class', 'kingfact_fix_menu_active_class', 10, 4);
function kingfact_fix_menu_active_class($classes, $item, $args, $depth) {
    // Only apply to primary menu
    if ($args->theme_location !== 'primary') {
        return $classes;
    }
    
    // Remove current-menu-item and current_page_item from all items on single service/product pages
    if (is_singular('service') || is_singular('product')) {
        $classes = array_diff($classes, array('current-menu-item', 'current_page_item', 'current_page_parent'));
        
        // Add current-menu-item to Services menu item when viewing single service
        if (is_singular('service')) {
            $services_page = get_page_by_path('services');
            if ($services_page && $item->object_id == $services_page->ID) {
                $classes[] = 'current-menu-item';
                $classes[] = 'current_page_parent';
            }
        }
        
        // Add current-menu-item to Products menu item when viewing single product
        if (is_singular('product')) {
            $products_page = get_page_by_path('products');
            if ($products_page && $item->object_id == $products_page->ID) {
                $classes[] = 'current-menu-item';
                $classes[] = 'current_page_parent';
            }
        }
    }
    
    return $classes;
}


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
    $bigtitle = get_post_meta( $post->ID, '_slide_bigtitle', true );
    $btn_text = get_post_meta( $post->ID, '_slide_btn_text', true );
    $btn_url  = get_post_meta( $post->ID, '_slide_btn_url', true );
    $slide_image = get_post_meta( $post->ID, '_slide_image', true );
    $slide_image_url = $slide_image ? wp_get_attachment_image_url( $slide_image, 'full' ) : '';

    ?>
    <p>
      <label><strong>Slide Background Image</strong></label><br>
      <div class="slide-image-wrapper" style="margin-top: 10px;">
        <div class="slide-image-preview" style="margin-bottom: 10px;">
          <?php if ( $slide_image_url ) : ?>
            <img src="<?php echo esc_url( $slide_image_url ); ?>" style="max-width: 100%; height: auto; border: 1px solid #ddd;" />
          <?php else : ?>
            <img src="" style="display: none; max-width: 100%; height: auto; border: 1px solid #ddd;" />
          <?php endif; ?>
        </div>
        <input type="hidden" id="slide_image" name="slide_image" value="<?php echo esc_attr( $slide_image ); ?>" />
        <button type="button" class="button slide-image-upload"><?php echo $slide_image ? 'Change Image' : 'Upload Image'; ?></button>
        <?php if ( $slide_image ) : ?>
          <button type="button" class="button slide-image-remove" style="margin-left: 5px;">Remove Image</button>
        <?php endif; ?>
      </div>
    </p>

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
      <em>Use the main editor (above) for the slide description / paragraph text.</em>
    </p>
    
    <script>
    jQuery(document).ready(function($) {
        var slideImageFrame;
        
        $('.slide-image-upload').on('click', function(e) {
            e.preventDefault();
            
            if (slideImageFrame) {
                slideImageFrame.open();
                return;
            }
            
            slideImageFrame = wp.media({
                title: 'Select Slide Background Image',
                button: {
                    text: 'Use This Image'
                },
                multiple: false
            });
            
            slideImageFrame.on('select', function() {
                var attachment = slideImageFrame.state().get('selection').first().toJSON();
                $('#slide_image').val(attachment.id);
                $('.slide-image-preview img').attr('src', attachment.url).show();
                $('.slide-image-upload').text('Change Image');
                
                if ($('.slide-image-remove').length === 0) {
                    $('.slide-image-upload').after('<button type="button" class="button slide-image-remove" style="margin-left: 5px;">Remove Image</button>');
                }
            });
            
            slideImageFrame.open();
        });
        
        $(document).on('click', '.slide-image-remove', function(e) {
            e.preventDefault();
            $('#slide_image').val('');
            $('.slide-image-preview img').attr('src', '').hide();
            $('.slide-image-upload').text('Upload Image');
            $(this).remove();
        });
    });
    </script>
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
        'slide_image'    => '_slide_image',
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
            } elseif ( $input === 'slide_image' ) {
                update_post_meta( $post_id, $meta_key, absint( $value ) );
            } else {
                update_post_meta( $post_id, $meta_key, sanitize_text_field( $value ) );
            }
        } else {
            delete_post_meta( $post_id, $meta_key );
        }
    }
}
add_action( 'save_post', 'kingfact_slide_save' );

// Enqueue media uploader for slide edit screen
function kingfact_slide_enqueue_media() {
    global $post_type;
    if ( 'slide' === $post_type ) {
        wp_enqueue_media();
    }
}
add_action( 'admin_enqueue_scripts', 'kingfact_slide_enqueue_media' );


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

        // Enqueue media uploader scripts
        wp_enqueue_media();

        // Handle save
        if ( isset( $_POST['kingfact_theme_settings_nonce'] ) && wp_verify_nonce( $_POST['kingfact_theme_settings_nonce'], 'kingfact_save_theme_settings' ) ) {
            $save = array();
            // Logos
            $save['header_logo'] = esc_url_raw( wp_unslash( $_POST['header_logo'] ?? '' ) );
            $save['footer_logo'] = esc_url_raw( wp_unslash( $_POST['footer_logo'] ?? '' ) );
            // Header
            $save['header_hours'] = sanitize_text_field( wp_unslash( $_POST['header_hours'] ?? '' ) );
            $save['header_quote_text'] = sanitize_text_field( wp_unslash( $_POST['header_quote_text'] ?? '' ) );
            $save['header_quote_url'] = esc_url_raw( wp_unslash( $_POST['header_quote_url'] ?? '' ) );
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

            // Header top bar links
            $link_texts = isset( $_POST['header_link_text'] ) ? array_map( 'sanitize_text_field', wp_unslash( (array) $_POST['header_link_text'] ) ) : array();
            $link_urls  = isset( $_POST['header_link_url'] ) ? array_map( 'esc_url_raw', wp_unslash( (array) $_POST['header_link_url'] ) ) : array();
            $header_links = array();
            for ( $i = 0; $i < max( count( $link_texts ), count( $link_urls ) ); $i++ ) {
                $txt = trim( $link_texts[ $i ] ?? '' );
                $url = trim( $link_urls[ $i ] ?? '' );
                if ( $txt || $url ) {
                    $header_links[] = array( 'text' => $txt, 'url' => $url );
                }
            }
            $save['header_links'] = $header_links;

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

            // Footer quick links
            $qlink_texts = isset( $_POST['footer_quick_link_text'] ) ? array_map( 'sanitize_text_field', wp_unslash( (array) $_POST['footer_quick_link_text'] ) ) : array();
            $qlink_urls  = isset( $_POST['footer_quick_link_url'] ) ? array_map( 'esc_url_raw', wp_unslash( (array) $_POST['footer_quick_link_url'] ) ) : array();
            $footer_quick_links = array();
            for ( $i = 0; $i < max( count( $qlink_texts ), count( $qlink_urls ) ); $i++ ) {
                $txt = trim( $qlink_texts[ $i ] ?? '' );
                $url = trim( $qlink_urls[ $i ] ?? '' );
                if ( $txt || $url ) {
                    $footer_quick_links[] = array( 'text' => $txt, 'url' => $url );
                }
            }
            $save['footer_quick_links'] = $footer_quick_links;

            kingfact_update_options( $save );
            echo '<div class="updated"><p>Settings saved.</p></div>';
        }

        // Load current values
        $header_logo = kingfact_get_option( 'header_logo', '' );
        $header_hours = kingfact_get_option( 'header_hours', 'Mon - Fri: 9:00 - 19:00 / Closed on Weekends' );
        $header_quote_text = kingfact_get_option( 'header_quote_text', 'get a quote' );
        $header_quote_url = kingfact_get_option( 'header_quote_url', home_url( '/contact/' ) );
        $header_address = kingfact_get_option( 'header_contact_address', 'Flat 20, Reynolds USA' );
        $header_email = kingfact_get_option( 'header_contact_email', 'support@rmail.com' );
        $header_phone = kingfact_get_option( 'header_contact_phone', '+812 (345) 6789' );
        $header_links = kingfact_get_option( 'header_links', array() );
        $header_socials = kingfact_get_option( 'header_social_links', array() );

        $footer_logo = kingfact_get_option( 'footer_logo', '' );
        $footer_text = kingfact_get_option( 'footer_text', 'But I must explain to you how all this misn idea of denouncing pleasure and prais pain <a href="#">Continue Reading</a>' );
        $footer_contact_address = kingfact_get_option( 'footer_contact_address', '1058 Meadowb, Mall Road' );
        $footer_contact_email = kingfact_get_option( 'footer_contact_email', 'support@gmail.com' );
        $footer_contact_phone = kingfact_get_option( 'footer_contact_phone', '+000 (123) 44 558' );
        $footer_copyright = kingfact_get_option( 'footer_copyright', 'Copyright © ' . date('Y') . ' kingfact. All rights reserved.' );
        $footer_quick_links = kingfact_get_option( 'footer_quick_links', array() );
        $footer_socials = kingfact_get_option( 'footer_social_links', array() );

        ?>
        <div class="wrap">
            <h1>Theme Settings</h1>
            <form method="post">
                <?php wp_nonce_field( 'kingfact_save_theme_settings', 'kingfact_theme_settings_nonce' ); ?>

                <h2>Header Settings</h2>

                <table class="form-table">
                    <tr>
                        <th><label for="header_logo">Header Logo</label></th>
                        <td>
                            <input type="hidden" name="header_logo" id="header_logo" value="<?php echo esc_attr( $header_logo ); ?>">
                            <div style="margin-bottom: 10px;">
                                <?php if ( $header_logo ) : ?>
                                    <img src="<?php echo esc_url( $header_logo ); ?>" style="max-width: 200px; height: auto; display: block; margin-bottom: 10px;" id="header_logo_preview">
                                <?php else : ?>
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo/logo.png' ); ?>" style="max-width: 200px; height: auto; display: block; margin-bottom: 10px;" id="header_logo_preview">
                                <?php endif; ?>
                            </div>
                            <button type="button" class="button" id="upload_header_logo_button">Upload Logo</button>
                            <button type="button" class="button" id="remove_header_logo_button" style="<?php echo $header_logo ? '' : 'display:none;'; ?>">Remove Logo</button>
                            <p class="description">Upload a custom header logo, or leave blank to use the default logo.</p>
                        </td>
                    </tr>
                </table>
                
                <table class="form-table">
                    <tr>
                        <th><label for="header_hours">Opening Hours Text</label></th>
                        <td>
                            <input name="header_hours" id="header_hours" class="large-text" value="<?php echo esc_attr( $header_hours ); ?>">
                            <p class="description">Text displayed in the header top bar showing your opening hours.</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="header_quote_text">Quote Button Text</label></th>
                        <td>
                            <input name="header_quote_text" id="header_quote_text" class="regular-text" value="<?php echo esc_attr( $header_quote_text ); ?>">
                            <p class="description">Text displayed on the header quote button (e.g., "get a quote").</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="header_quote_url">Quote Button URL</label></th>
                        <td>
                            <input name="header_quote_url" id="header_quote_url" class="regular-text" value="<?php echo esc_attr( $header_quote_url ); ?>">
                            <p class="description">URL where the quote button should link to (e.g., /contact/).</p>
                        </td>
                    </tr>
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

                <h3>Header Top Bar Links</h3>
                <div id="header-top-links">
                    <table class="form-table" id="header-links-table">
                        <?php if ( $header_links ) : foreach ( $header_links as $link ) : ?>
                            <tr>
                                <th>Link Text</th>
                                <td><input name="header_link_text[]" class="regular-text" value="<?php echo esc_attr( $link['text'] ); ?>"> URL: <input name="header_link_url[]" class="regular-text" value="<?php echo esc_attr( $link['url'] ); ?>"></td>
                            </tr>
                        <?php endforeach; endif; ?>
                        <tr class="template-row" style="display:none;">
                            <th>Link Text</th>
                            <td><input name="header_link_text[]" class="regular-text"> URL: <input name="header_link_url[]" class="regular-text"></td>
                        </tr>
                    </table>
                    <p><button type="button" class="button" id="add-header-link">Add Top Link</button></p>
                </div>

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
                        <th><label for="footer_logo">Footer Logo</label></th>
                        <td>
                            <input type="hidden" name="footer_logo" id="footer_logo" value="<?php echo esc_attr( $footer_logo ); ?>">
                            <div style="margin-bottom: 10px;">
                                <?php if ( $footer_logo ) : ?>
                                    <img src="<?php echo esc_url( $footer_logo ); ?>" style="max-width: 200px; height: auto; display: block; margin-bottom: 10px;" id="footer_logo_preview">
                                <?php else : ?>
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo/logo-2.png' ); ?>" style="max-width: 200px; height: auto; display: block; margin-bottom: 10px;" id="footer_logo_preview">
                                <?php endif; ?>
                            </div>
                            <button type="button" class="button" id="upload_footer_logo_button">Upload Logo</button>
                            <button type="button" class="button" id="remove_footer_logo_button" style="<?php echo $footer_logo ? '' : 'display:none;'; ?>">Remove Logo</button>
                            <p class="description">Upload a custom footer logo, or leave blank to use the default logo.</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="footer_text">Footer Text (HTML allowed)</label></th>
                        <td><textarea name="footer_text" id="footer_text" rows="5" class="large-text"><?php echo esc_textarea( $footer_text ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="footer_copyright">Copyright Text</label></th>
                        <td><input name="footer_copyright" id="footer_copyright" class="regular-text" value="<?php echo esc_attr( $footer_copyright ); ?>"></td>
                    </tr>
                </table>

                <h3>Footer Quick Links</h3>
                <div id="footer-quick-links">
                    <table class="form-table" id="footer-quick-links-table">
                        <?php if ( $footer_quick_links ) : foreach ( $footer_quick_links as $qlink ) : ?>
                            <tr>
                                <th>Link Text</th>
                                <td><input name="footer_quick_link_text[]" class="regular-text" value="<?php echo esc_attr( $qlink['text'] ); ?>"> URL: <input name="footer_quick_link_url[]" class="regular-text" value="<?php echo esc_attr( $qlink['url'] ); ?>"></td>
                            </tr>
                        <?php endforeach; endif; ?>
                        <tr class="template-row" style="display:none;">
                            <th>Link Text</th>
                            <td><input name="footer_quick_link_text[]" class="regular-text"> URL: <input name="footer_quick_link_url[]" class="regular-text"></td>
                        </tr>
                    </table>
                    <p><button type="button" class="button" id="add-footer-quick-link">Add Quick Link</button></p>
                </div>
                <p><em>Note: Quick Links appear in the footer navigation section.</em></p>
                <p><em>Note: Contact information (address, email, phone) and social links are managed in the "Header Contact" and "Header Social Links" sections above and are shared across the site including footer.</em></p>

                <p class="submit"><button type="submit" class="button button-primary">Save Settings</button></p>
            </form>
        </div>

        <script>
        (function(){
            // Footer quick link addition
            var addFooterQuickLink = document.getElementById('add-footer-quick-link');
            if (addFooterQuickLink) {
                addFooterQuickLink.addEventListener('click', function(){
                    var table = document.getElementById('footer-quick-links-table');
                    var tbody = table.querySelector('tbody') || table;
                    var tpl = tbody.querySelector('.template-row');
                    if (tpl) {
                        var newRow = tpl.cloneNode(true);
                        newRow.style.display = '';
                        newRow.classList.remove('template-row');
                        tbody.insertBefore(newRow, tpl);
                    }
                });
            }

            // Header top link addition
            var addHeaderLink = document.getElementById('add-header-link');
            if (addHeaderLink) {
                addHeaderLink.addEventListener('click', function(){
                    var table = document.getElementById('header-links-table');
                    var tbody = table.querySelector('tbody') || table;
                    var tpl = tbody.querySelector('.template-row');
                    if (tpl) {
                        var newRow = tpl.cloneNode(true);
                        newRow.style.display = '';
                        newRow.classList.remove('template-row');
                        tbody.insertBefore(newRow, tpl);
                    }
                });
            }

            // Social link addition
            var addHeader = document.getElementById('add-header-social');
            if (addHeader) {
                addHeader.addEventListener('click', function(){
                    var table = document.getElementById('header-social-table');
                    var tbody = table.querySelector('tbody') || table;
                    var tpl = tbody.querySelector('.template-row');
                    if (tpl) {
                        var newRow = tpl.cloneNode(true);
                        newRow.style.display = '';
                        newRow.classList.remove('template-row');
                        tbody.insertBefore(newRow, tpl);
                    }
                });
            }

            // Media uploader for Header Logo
            jQuery(document).ready(function($){
                var headerLogoFrame;
                $('#upload_header_logo_button').on('click', function(e){
                    e.preventDefault();
                    if (headerLogoFrame) {
                        headerLogoFrame.open();
                        return;
                    }
                    headerLogoFrame = wp.media({
                        title: 'Select Header Logo',
                        button: { text: 'Use this logo' },
                        multiple: false
                    });
                    headerLogoFrame.on('select', function(){
                        var attachment = headerLogoFrame.state().get('selection').first().toJSON();
                        $('#header_logo').val(attachment.url);
                        $('#header_logo_preview').attr('src', attachment.url).show();
                        $('#remove_header_logo_button').show();
                    });
                    headerLogoFrame.open();
                });

                $('#remove_header_logo_button').on('click', function(e){
                    e.preventDefault();
                    $('#header_logo').val('');
                    $('#header_logo_preview').attr('src', '<?php echo esc_js( get_template_directory_uri() . '/assets/img/logo/logo.png' ); ?>');
                    $(this).hide();
                });

                // Media uploader for Footer Logo
                var footerLogoFrame;
                $('#upload_footer_logo_button').on('click', function(e){
                    e.preventDefault();
                    if (footerLogoFrame) {
                        footerLogoFrame.open();
                        return;
                    }
                    footerLogoFrame = wp.media({
                        title: 'Select Footer Logo',
                        button: { text: 'Use this logo' },
                        multiple: false
                    });
                    footerLogoFrame.on('select', function(){
                        var attachment = footerLogoFrame.state().get('selection').first().toJSON();
                        $('#footer_logo').val(attachment.url);
                        $('#footer_logo_preview').attr('src', attachment.url).show();
                        $('#remove_footer_logo_button').show();
                    });
                    footerLogoFrame.open();
                });

                $('#remove_footer_logo_button').on('click', function(e){
                    e.preventDefault();
                    $('#footer_logo').val('');
                    $('#footer_logo_preview').attr('src', '<?php echo esc_js( get_template_directory_uri() . '/assets/img/logo/logo-2.png' ); ?>');
                    $(this).hide();
                });
            });
        })();
        </script>
        <?php
    }
}

// Register features_section shortcode so [features_section] works in posts/pages
function kingfact_features_shortcode( $atts, $content = null ) {
    $base = get_template_directory_uri() . '/assets/';

    $defaults = array(
        'title'    => 'Explore Features',
        'subtitle' => 'what we do',
        'first_paragraph' => 'But I must explain to you how all this mistaken is denouncing pleasure and praising pain was borners will give you a complete account of the system and expound the actual teachings',
        'bg'       => 'img/features/fea-bg.jpg',
        'btn_text' => 'read more',
        'btn_url'  => '#',
        'img1'     => 'img/features/who-01.jpg',
        'img2'     => 'img/features/who-02.jpg',
        // optional third feature
        'title2'    => 'Technology Buildup',
        'paragraph2' => "Avoids pleasure itself, because it is pleasure because those who do not know how",
        'title3'    => 'Awards & Accolades',
        'paragraph3' => "Avoids pleasure itself, because it is pleasure because those who do not know how",
        'allow_html' => '0',
    );
    

    $a = shortcode_atts( $defaults, $atts, 'features_section' );

    // Helper function to determine if URL is full or relative
    $get_image_url = function( $image_path ) use ( $base ) {
        // Debug: Log what we're processing (visible in HTML source when debugging)
        if ( WP_DEBUG ) {
            error_log( "Processing image path: " . $image_path );
        }
        
        // If it starts with http:// or https:// or //, it's a full URL
        if ( preg_match( '/^(https?:)?\/\//', $image_path ) ) {
            if ( WP_DEBUG ) {
                error_log( "Detected full URL: " . $image_path );
            }
            return $image_path;
        }
        
        // If it starts with /, it's an absolute path from site root
        if ( strpos( $image_path, '/' ) === 0 ) {
            $url = home_url( $image_path );
            if ( WP_DEBUG ) {
                error_log( "Converted absolute path to: " . $url );
            }
            return $url;
        }
        
        // Otherwise treat as relative to theme assets
        $url = $base . ltrim( $image_path, '/' );
        if ( WP_DEBUG ) {
            error_log( "Using theme asset path: " . $url );
        }
        return $url;
    };

    $maybe_html = function( $text ) use ( $a ) {
        return ( '1' === (string) $a['allow_html'] ) ? wp_kses_post( $text ) : esc_html( $text );
    };

    ob_start();
    ?>
    <div class="features-area pt-120 pb-90" style="background-image:url(<?php echo esc_url( ltrim( $a['bg'], '/' ) ); ?>)">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="section-title mb-30">
              <span><?php echo esc_html( $a['subtitle'] ); ?></span>
              <h1><?php echo esc_html( $a['title'] ); ?></h1>
              <div class="mb-20"></div>
              <p><?php echo $content ? $maybe_html( $content ) : $maybe_html( $a['first_paragraph'] ); ?></p>
              <div class="fea-btn mt-30">
                <a class="b-btn btn-black" href="<?php echo esc_url( $a['btn_url'] ); ?>">
                  <span><?php echo esc_html( $a['btn_text'] ); ?></span>
                </a>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="b-features text-center mb-30">
              <div class="b-fea-img">
                <img src="<?php echo esc_url( $get_image_url( $a['img1'] ) ); ?>" alt="<?php echo esc_attr( $a['title2'] ); ?>">
              </div>
              <div class="b-fea-content">
                <h3><?php echo esc_html( $a['title2'] ); ?></h3>
                <p><?php echo $maybe_html( $a['paragraph2'] ); ?></p>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="b-features text-center mb-30">
              <div class="b-fea-img">
                <img src="<?php echo esc_url( $get_image_url( $a['img2'] ) ); ?>" alt="<?php echo esc_attr( $a['title3'] ); ?>">
              </div>
              <div class="b-fea-content">
                <h3><?php echo esc_html( $a['title3'] ); ?></h3>
                <p><?php echo $maybe_html( $a['paragraph3'] ); ?></p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'features_section', 'kingfact_features_shortcode' );

// Shortcode: breadcrumb area with configurable background and labels
function kingfact_breadcrumb_shortcode( $atts ) {
    $base = get_template_directory_uri() . '/assets/';

    $a = shortcode_atts( array(
        'title'        => 'Our Services',
        'home_label'   => 'home',
        'home_url'     => home_url('/'),
        'parent_label' => '',
        'parent_url'   => '',
        'current'      => 'Services',
        'bg'           => 'img/bg/bg-9.jpg',
        'class'        => '',
    ), $atts, 'kingfact_breadcrumb' );

    // Check if bg is a full URL (starts with http:// or https://) or a relative path
    if ( preg_match('/^https?:\/\//', $a['bg']) ) {
        $bg_url = $a['bg']; // Use full URL as-is
    } else {
        $bg_url = $base . ltrim( $a['bg'], '/' ); // Prepend base path for relative URLs
    }

    ob_start();
    ?>
    <div class="breadcrumb-area pt-245 pb-255 <?php echo esc_attr( $a['class'] ); ?>" style="background-image:url(<?php echo esc_url( $bg_url ); ?>)">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-text text-center">
                        <h1><?php echo esc_html( $a['title'] ); ?></h1>
                        <ul class="breadcrumb-menu">
                            <li><a href="<?php echo esc_url( $a['home_url'] ); ?>"><?php echo esc_html( $a['home_label'] ); ?></a></li>
                            <?php if ( ! empty( $a['parent_label'] ) && ! empty( $a['parent_url'] ) ) : ?>
                                <li><a href="<?php echo esc_url( $a['parent_url'] ); ?>"><?php echo esc_html( $a['parent_label'] ); ?></a></li>
                            <?php endif; ?>
                            <li><span><?php echo esc_html( $a['current'] ); ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'kingfact_breadcrumb', 'kingfact_breadcrumb_shortcode' );

// 1) Register 'service' CPT for Services/Products
function kingfact_register_service_cpt() {
    $labels = array(
        'name'               => __( 'Services', 'kingfact' ),
        'singular_name'      => __( 'Service', 'kingfact' ),
        'add_new'            => __( 'Add New', 'kingfact' ),
        'add_new_item'       => __( 'Add New Service', 'kingfact' ),
        'edit_item'          => __( 'Edit Service', 'kingfact' ),
        'new_item'           => __( 'New Service', 'kingfact' ),
        'view_item'          => __( 'View Service', 'kingfact' ),
        'search_items'       => __( 'Search Services', 'kingfact' ),
        'not_found'          => __( 'No services found', 'kingfact' ),
        'not_found_in_trash' => __( 'No services found in Trash', 'kingfact' ),
        'all_items'          => __( 'All Services', 'kingfact' ),
        'menu_name'          => __( 'Services', 'kingfact' ),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array( 
            'slug' => 'service',
            'with_front' => false 
        ),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-hammer',
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        'show_in_rest'        => true, // Enable Gutenberg editor
    );

    register_post_type( 'service', $args );
}
add_action( 'init', 'kingfact_register_service_cpt' );

// Flush rewrite rules on theme activation to ensure service URLs work
function kingfact_flush_rewrite_rules() {
    kingfact_register_service_cpt();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'kingfact_flush_rewrite_rules' );

// Manual function to flush rewrite rules if needed
function kingfact_manual_flush_rewrite_rules() {
    if ( current_user_can( 'manage_options' ) && isset( $_GET['flush_service_rules'] ) ) {
        kingfact_register_service_cpt();
        flush_rewrite_rules();
        
        echo '<div style="padding: 20px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; margin: 20px; border-radius: 5px;">';
        echo '<h2>✅ Rewrite Rules Flushed Successfully!</h2>';
        echo '<p>Service URLs should now work properly.</p>';
        echo '<p><strong>Test your services:</strong></p>';
        echo '<ul>';
        
        $services = get_posts( array( 'post_type' => 'service', 'numberposts' => -1, 'post_status' => 'publish' ) );
        foreach ( $services as $service ) {
            $url = get_permalink( $service->ID );
            echo '<li><a href="' . esc_url( $url ) . '" target="_blank">' . esc_html( $service->post_title ) . '</a> - ' . esc_html( $url ) . '</li>';
        }
        echo '</ul>';
        echo '<p><a href="' . admin_url( 'edit.php?post_type=service' ) . '">← Back to Services</a></p>';
        echo '</div>';
        exit;
    }
}
add_action( 'init', 'kingfact_manual_flush_rewrite_rules' );

// Add admin notice for flushing rules
add_action( 'admin_notices', function() {
    if ( isset( $_GET['rules_flushed'] ) ) {
        echo '<div class="notice notice-success is-dismissible"><p>Service URL rules have been flushed successfully!</p></div>';
    }
} );

// 2) Add meta box for service extra fields
function kingfact_service_meta_boxes() {
    add_meta_box( 
        'kingfact_service_fields', 
        'Service Settings', 
        'kingfact_service_meta_box_cb', 
        'service', 
        'normal', 
        'high' 
    );
}
add_action( 'add_meta_boxes', 'kingfact_service_meta_boxes' );

function kingfact_service_meta_box_cb( $post ) {
    wp_nonce_field( 'kingfact_service_save', 'kingfact_service_nonce' );

    $service_banner = get_post_meta( $post->ID, '_service_banner', true );
    $service_banner_url = $service_banner ? wp_get_attachment_image_url( $service_banner, 'full' ) : '';
    $service_url = get_post_meta( $post->ID, '_service_url', true );
    $service_link_text = get_post_meta( $post->ID, '_service_link_text', true );
    $service_icon = get_post_meta( $post->ID, '_service_icon', true );

    ?>
    <table class="form-table">
        <tr>
            <th><label><strong>Service Banner Image</strong></label></th>
            <td>
                <div class="service-banner-wrapper" style="margin-top: 10px;">
                    <div class="service-banner-preview" style="margin-bottom: 10px;">
                        <?php if ( $service_banner_url ) : ?>
                            <img src="<?php echo esc_url( $service_banner_url ); ?>" style="max-width: 100%; height: auto; border: 1px solid #ddd;" />
                        <?php else : ?>
                            <img src="" style="display: none; max-width: 100%; height: auto; border: 1px solid #ddd;" />
                        <?php endif; ?>
                    </div>
                    <input type="hidden" id="service_banner" name="service_banner" value="<?php echo esc_attr( $service_banner ); ?>" />
                    <button type="button" class="button service-banner-upload"><?php echo $service_banner ? 'Change Image' : 'Upload Image'; ?></button>
                    <?php if ( $service_banner ) : ?>
                        <button type="button" class="button service-banner-remove" style="margin-left: 5px;">Remove Image</button>
                    <?php endif; ?>
                    <p class="description" style="margin-top: 5px;">Upload a banner image for this service (displayed on home page)</p>
                </div>
            </td>
        </tr>
        <tr>
            <th><label for="service_url"><strong>Service Link URL</strong></label></th>
            <td>
                <input type="url" id="service_url" name="service_url" value="<?php echo esc_attr( $service_url ); ?>" class="regular-text" />
                <p class="description">Link to service details page or external URL</p>
            </td>
        </tr>
        <tr>
            <th><label for="service_link_text"><strong>Link Text</strong></label></th>
            <td>
                <input type="text" id="service_link_text" name="service_link_text" value="<?php echo esc_attr( $service_link_text ); ?>" class="regular-text" />
                <p class="description">Text for the "read more" link (default: "read more")</p>
            </td>
        </tr>
        <tr>
            <th><label for="service_icon"><strong>Service Icon</strong></label></th>
            <td>
                <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr( $service_icon ); ?>" class="regular-text" />
                <p class="description">FontAwesome icon class (e.g., "fas fa-hammer", "fas fa-building")</p>
            </td>
        </tr>
    </table>

    <div style="margin-top: 20px;">
        <h4>Instructions:</h4>
        <ul>
            <li><strong>Title:</strong> Use the main title field above for the service name</li>
            <li><strong>Description:</strong> Use the main editor for the service description</li>
            <li><strong>Banner Image:</strong> Upload using the banner image field above</li>
            <li><strong>Excerpt:</strong> Use excerpt for short description (will fallback to description if empty)</li>
            <li><strong>Order:</strong> Use the Order field in Page Attributes to control display order</li>
        </ul>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        var serviceBannerFrame;
        
        $('.service-banner-upload').on('click', function(e) {
            e.preventDefault();
            
            if (serviceBannerFrame) {
                serviceBannerFrame.open();
                return;
            }
            
            serviceBannerFrame = wp.media({
                title: 'Select Service Banner Image',
                button: {
                    text: 'Use This Image'
                },
                multiple: false
            });
            
            serviceBannerFrame.on('select', function() {
                var attachment = serviceBannerFrame.state().get('selection').first().toJSON();
                $('#service_banner').val(attachment.id);
                $('.service-banner-preview img').attr('src', attachment.url).show();
                $('.service-banner-upload').text('Change Image');
                
                if ($('.service-banner-remove').length === 0) {
                    $('.service-banner-upload').after('<button type="button" class="button service-banner-remove" style="margin-left: 5px;">Remove Image</button>');
                }
            });
            
            serviceBannerFrame.open();
        });
        
        $(document).on('click', '.service-banner-remove', function(e) {
            e.preventDefault();
            $('#service_banner').val('');
            $('.service-banner-preview img').attr('src', '').hide();
            $('.service-banner-upload').text('Upload Image');
            $(this).remove();
        });
    });
    </script>
    <?php
}

function kingfact_service_save( $post_id ) {
    // Security checks
    if ( ! isset( $_POST['kingfact_service_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['kingfact_service_nonce'], 'kingfact_service_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Save custom fields
    $fields = array(
        'service_banner' => '_service_banner',
        'service_url' => '_service_url',
        'service_link_text' => '_service_link_text',
        'service_icon' => '_service_icon',
    );

    foreach ( $fields as $input => $meta_key ) {
        if ( isset( $_POST[ $input ] ) ) {
            $value = wp_unslash( $_POST[ $input ] );
            if ( $input === 'service_url' ) {
                update_post_meta( $post_id, $meta_key, esc_url_raw( $value ) );
            } elseif ( $input === 'service_banner' ) {
                update_post_meta( $post_id, $meta_key, absint( $value ) );
            } else {
                update_post_meta( $post_id, $meta_key, sanitize_text_field( $value ) );
            }
        } else {
            delete_post_meta( $post_id, $meta_key );
        }
    }
}
add_action( 'save_post', 'kingfact_service_save' );

// Enqueue media uploader for service edit screen
function kingfact_service_enqueue_media() {
    global $post_type;
    if ( 'service' === $post_type ) {
        wp_enqueue_media();
    }
}
add_action( 'admin_enqueue_scripts', 'kingfact_service_enqueue_media' );

// 3) Admin columns for Service CPT
add_filter( 'manage_edit-service_columns', 'kingfact_service_manage_columns' );
function kingfact_service_manage_columns( $columns ) {
    $new = array();
    $new['cb'] = $columns['cb'];
    $new['thumbnail'] = __( 'Image', 'kingfact' );
    $new['title'] = __( 'Service Name', 'kingfact' );
    $new['description'] = __( 'Description', 'kingfact' );
    $new['service_url'] = __( 'Service URL', 'kingfact' );
    $new['menu_order'] = __( 'Order', 'kingfact' );
    $new['date'] = $columns['date'];
    return $new;
}

add_action( 'manage_service_posts_custom_column', 'kingfact_service_custom_column', 10, 2 );
function kingfact_service_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'thumbnail':
            $thumb_id = get_post_thumbnail_id( $post_id );
            if ( $thumb_id ) {
                echo wp_get_attachment_image( $thumb_id, array( 80, 80 ) );
            } else {
                echo '<span style="color:#999;">' . __( 'No image', 'kingfact' ) . '</span>';
            }
            break;

        case 'description':
            $excerpt = get_the_excerpt( $post_id );
            if ( $excerpt ) {
                echo wp_trim_words( $excerpt, 10, '...' );
            } else {
                $content = get_post_field( 'post_content', $post_id );
                echo wp_trim_words( strip_tags( $content ), 10, '...' );
            }
            break;

        case 'service_url':
            $url = get_post_meta( $post_id, '_service_url', true );
            if ( $url ) {
                echo '<a href="' . esc_url( $url ) . '" target="_blank">' . esc_html( $url ) . '</a>';
            } else {
                echo '<span style="color:#999;">' . __( '—', 'kingfact' ) . '</span>';
            }
            break;

        case 'menu_order':
            $order = get_post_field( 'menu_order', $post_id );
            echo intval( $order );
            break;
    }
}

// Make menu_order column sortable
add_filter( 'manage_edit-service_sortable_columns', 'kingfact_service_sortable_columns' );
function kingfact_service_sortable_columns( $columns ) {
    $columns['menu_order'] = 'menu_order';
    return $columns;
}

// Adjust query when sorting by menu_order for services
add_action( 'pre_get_posts', 'kingfact_service_orderby_menu_order' );
function kingfact_service_orderby_menu_order( $query ) {
    if ( ! is_admin() ) return;
    $orderby = $query->get( 'orderby' );
    $post_type = $query->get( 'post_type' );

    if ( 'service' === $post_type ) {
        if ( 'menu_order' === $orderby ) {
            $query->set( 'orderby', 'menu_order' );
            $query->set( 'order', 'ASC' );
        }
    }
}

// Admin: enqueue sortable script for Services list and localize nonce/ajax
add_action( 'admin_enqueue_scripts', 'kingfact_enqueue_service_admin_scripts' );
function kingfact_enqueue_service_admin_scripts( $hook ) {
    global $post_type;

    // Only enqueue on edit.php for service post type
    if ( 'edit.php' !== $hook || 'service' !== ( isset( $_GET['post_type'] ) ? $_GET['post_type'] : $post_type ) ) {
        return;
    }

    // jQuery UI sortable is included with WP
    wp_enqueue_script( 'jquery-ui-sortable' );

    // Small admin script for services
    $handle = 'kingfact-service-admin';
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
                    action: 'kingfact_update_service_order',
                    nonce: '%s',
                    order: order
                }, function(resp){
                    if (resp && resp.success) {
                        // optional: flash a notice
                        $('#message.updated').remove();
                        $('<div id="message" class="updated notice is-dismissible"><p>Service order saved.</p></div>').insertBefore('.wrap');
                    } else {
                        alert('Could not save service order.');
                    }
                }, 'json');
            }
        });
    });
})(jQuery);
JS;

    $nonce = wp_create_nonce( 'kingfact_service_order' );
    $inline = sprintf( $inline, esc_js( $nonce ) );

    wp_add_inline_script( $handle, $inline );
    wp_enqueue_script( $handle );
}

// AJAX handler to save the menu_order for services
add_action( 'wp_ajax_kingfact_update_service_order', 'kingfact_update_service_order' );
function kingfact_update_service_order() {
    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_send_json_error( 'no_permission' );
    }

    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'kingfact_service_order' ) ) {
        wp_send_json_error( 'bad_nonce' );
    }

    if ( ! isset( $_POST['order'] ) || ! is_array( $_POST['order'] ) ) {
        wp_send_json_error( 'bad_input' );
    }

    $order = array_map( 'absint', $_POST['order'] );

    foreach ( $order as $position => $post_id ) {
        // double-check post type
        $post = get_post( $post_id );
        if ( ! $post || 'service' !== $post->post_type ) continue;

        // Update menu_order (0-based position)
        wp_update_post( array( 'ID' => $post_id, 'menu_order' => $position ) );
    }

    wp_send_json_success();
}

// 4) Services Display Shortcode
function kingfact_services_display_shortcode( $atts, $content = null ) {
    $base = get_template_directory_uri() . '/assets/';

    $defaults = array(
        // Layout settings
        'columns'           => '3', // 2, 3, 4, 6
        'posts_per_page'    => -1,  // -1 for all, or specific number
        'orderby'           => 'menu_order',
        'order'             => 'ASC',
        'padding_top'       => 'pt-130',
        'padding_bottom'    => 'pb-130',
        'class'             => '',
        
        // Section title
        'show_title'        => '0',
        'section_title'     => 'Our Services',
        'section_subtitle'  => 'what we offer',
        
        // Bottom button
        'show_button'       => '1',
        'button_text'       => 'view all services',
        'button_url'        => '#',
        
        // Filter options
        'include_ids'       => '', // Comma-separated post IDs
        'exclude_ids'       => '', // Comma-separated post IDs
        'category'          => '', // If you add categories later
    );

    $a = shortcode_atts( $defaults, $atts, 'services_display' );

    // Calculate column classes
    $col_class = 'col-xl-4 col-lg-4 col-md-6'; // default 3 columns
    switch ( $a['columns'] ) {
        case '2':
            $col_class = 'col-xl-6 col-lg-6 col-md-6';
            break;
        case '4':
            $col_class = 'col-xl-3 col-lg-3 col-md-6';
            break;
        case '6':
            $col_class = 'col-xl-2 col-lg-2 col-md-4';
            break;
    }

    // Query arguments
    $query_args = array(
        'post_type'      => 'service',
        'posts_per_page' => intval( $a['posts_per_page'] ),
        'orderby'        => $a['orderby'],
        'order'          => $a['order'],
        'post_status'    => 'publish',
    );

    // Handle include/exclude IDs
    if ( ! empty( $a['include_ids'] ) ) {
        $include_ids = array_map( 'intval', explode( ',', $a['include_ids'] ) );
        $query_args['post__in'] = $include_ids;
    }

    if ( ! empty( $a['exclude_ids'] ) ) {
        $exclude_ids = array_map( 'intval', explode( ',', $a['exclude_ids'] ) );
        $query_args['post__not_in'] = $exclude_ids;
    }

    // Get services
    $services_query = new WP_Query( $query_args );

    if ( ! $services_query->have_posts() ) {
        wp_reset_postdata();
        
        $debug_info = '<div class="services-area pt-130 pb-130">';
        $debug_info .= '<div class="container">';
        $debug_info .= '<div class="row"><div class="col-xl-12">';
        $debug_info .= '<div class="no-services" style="padding: 40px; background: #f9f9f9; margin: 20px 0; text-align: center; border-radius: 10px;">';
        $debug_info .= '<h3 style="color: #333; margin-bottom: 20px;">No Services Found</h3>';
        $debug_info .= '<p style="margin-bottom: 20px;"><strong>To display services, please:</strong></p>';
        $debug_info .= '<ol style="text-align: left; max-width: 400px; margin: 0 auto;"><li>Go to WordPress Admin → Services → Add New</li>';
        $debug_info .= '<li>Create some services and publish them (not as drafts)</li>';
        $debug_info .= '<li>Add featured images and content to each service</li></ol>';
        $debug_info .= '<p style="margin-top: 20px;"><a href="' . admin_url('post-new.php?post_type=service') . '" class="b-btn btn-black"><span>Add Your First Service</span></a></p>';
        $debug_info .= '</div>';
        $debug_info .= '</div></div></div></div>';
        
        return $debug_info;
    }

    ob_start();
    ?>
    <div class="services-area <?php echo esc_attr( $a['padding_top'] . ' ' . $a['padding_bottom'] . ' ' . $a['class'] ); ?>">
        <div class="container">
            
            <?php if ( '1' === $a['show_title'] ) : ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="section-title text-center mb-70">
                        <span><?php echo esc_html( $a['section_subtitle'] ); ?></span>
                        <h2><?php echo esc_html( $a['section_title'] ); ?></h2>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="row" id="services-container">
                <?php 
                $service_count = 0;
                $total_services = $services_query->found_posts;
                while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
                <?php
                    $service_count++;
                    $service_id = get_the_ID();
                    $service_url = get_post_meta( $service_id, '_service_url', true );
                    $service_link_text = get_post_meta( $service_id, '_service_link_text', true );
                    $service_icon = get_post_meta( $service_id, '_service_icon', true );
                    
                    // Always use service detail page permalink for read more
                    $service_detail_url = get_permalink( $service_id );
                    
                    // Fallback link text
                    if ( empty( $service_link_text ) ) {
                        $service_link_text = 'read more';
                    }
                    
                    // Get description (excerpt or content)
                    $description = get_the_excerpt();
                    if ( empty( $description ) ) {
                        $description = wp_trim_words( get_the_content(), 20, '...' );
                    }
                    
                    // Add class to hide services after the 6th one
                    $hide_class = $service_count > 6 ? 'service-hidden' : '';
                ?>
                
                <div class="<?php echo esc_attr( $col_class ); ?> service-item <?php echo esc_attr( $hide_class ); ?>">
                    <div class="b-services b-services-02 mb-80">
                        <?php
                        $service_banner_id = get_post_meta(get_the_ID(), '_service_banner', true);
                        $service_banner_url = $service_banner_id ? wp_get_attachment_image_url($service_banner_id, 'medium') : '';
                        if ($service_banner_url) : ?>
                        <div class="b-services-img">
                            <img src="<?php echo esc_url($service_banner_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" style="width: 100%; height: auto;">
                        </div>
                        <?php endif; ?>
                        
                        <div class="b-services-content">
                            <h3>
                                <?php if ( ! empty( $service_icon ) ) : ?>
                                <i class="<?php echo esc_attr( $service_icon ); ?>"></i> 
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $service_detail_url ); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <?php if ( ! empty( $description ) ) : ?>
                            <p><?php echo esc_html( $description ); ?></p>
                            <?php endif; ?>
                            
                            <div class="sv-link">
                                <a href="<?php echo esc_url( $service_detail_url ); ?>"><?php echo esc_html( $service_link_text ); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            
            <?php if ( $total_services > 6 ) : ?>
            <!-- Show More / Show Less Button -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="fea-btn text-center">
                        <button class="b-btn btn-black" id="toggle-services-btn" onclick="toggleServices()">
                            <span id="service-btn-text">View All Services (<?php echo ($total_services - 6); ?> more)</span>
                        </button>
                    </div>
                </div>
            </div>
            <?php elseif ( '1' === $a['show_button'] ) : ?>
            <!-- Regular "view all services" button -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="fea-btn text-center">
                        <a class="b-btn btn-black" href="<?php echo esc_url( $a['button_url'] !== '#' ? $a['button_url'] : '/services/' ); ?>">
                            <span><?php echo esc_html( $a['button_text'] ); ?></span>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <style>
    /* Service image full width styling */
    .b-services .b-services-img {
        overflow: hidden;
        width: 100%;
    }
    .b-services .b-services-img img {
        width: 100% !important;
        height: auto !important;
        max-width: 100% !important;
        display: block;
        object-fit: cover;
    }
    
    <?php if ( $total_services > 6 ) : ?>
    /* Show more functionality styles */
    .service-hidden {
        display: none;
    }
    .service-show-animation {
        animation: fadeInUp 0.6s ease-out;
    }
    .service-hide-animation {
        animation: fadeOutDown 0.4s ease-out;
    }
    #toggle-services-btn {
        transition: all 0.3s ease;
    }
    #toggle-services-btn:hover {
        transform: translateY(-2px);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeOutDown {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
    <?php endif; ?>
    </style>

    <script>
    function toggleServices() {
        const hiddenServices = document.querySelectorAll('.service-hidden');
        const button = document.getElementById('toggle-services-btn');
        const buttonText = document.getElementById('service-btn-text');
        const isExpanded = button.classList.contains('expanded');
        
        if (!isExpanded) {
            // Show all services
            hiddenServices.forEach((service, index) => {
                setTimeout(() => {
                    service.classList.remove('service-hidden');
                    service.classList.add('service-show-animation');
                }, index * 100);
            });
            
            button.classList.add('expanded');
            buttonText.textContent = 'Show Less Services';
            
       
        } else {
            // Hide extra services
            const allServices = document.querySelectorAll('.service-item');
            const servicesToHide = Array.from(allServices).slice(6);
            
            servicesToHide.forEach((service, index) => {
                setTimeout(() => {
                    service.classList.add('service-hide-animation');
                    setTimeout(() => {
                        service.classList.remove('service-show-animation', 'service-hide-animation');
                        service.classList.add('service-hidden');
                    }, 400);
                }, index * 50);
            });
            
            button.classList.remove('expanded');
            buttonText.textContent = 'View All Services (<?php echo ($total_services - 6); ?> more)';
            
            // Smooth scroll to services container
            setTimeout(() => {
                document.getElementById('services-container').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 300);
        }
    }
    </script>
    
    <?php
    return ob_get_clean();
}
add_shortcode( 'services_display', 'kingfact_services_display_shortcode' );

// ========================================
// PRODUCTS CUSTOM POST TYPE (Similar to Services)
// ========================================

// 1) Register 'product' CPT for Products
function kingfact_register_product_cpt() {
    $labels = array(
        'name'               => __( 'Products', 'kingfact' ),
        'singular_name'      => __( 'Product', 'kingfact' ),
        'add_new'            => __( 'Add New', 'kingfact' ),
        'add_new_item'       => __( 'Add New Product', 'kingfact' ),
        'edit_item'          => __( 'Edit Product', 'kingfact' ),
        'new_item'           => __( 'New Product', 'kingfact' ),
        'view_item'          => __( 'View Product', 'kingfact' ),
        'search_items'       => __( 'Search Products', 'kingfact' ),
        'not_found'          => __( 'No products found', 'kingfact' ),
        'not_found_in_trash' => __( 'No products found in Trash', 'kingfact' ),
        'all_items'          => __( 'All Products', 'kingfact' ),
        'menu_name'          => __( 'Products', 'kingfact' ),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array( 
            'slug' => 'product',
            'with_front' => false 
        ),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 21,
        'menu_icon'           => 'dashicons-products',
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        'show_in_rest'        => true, // Enable Gutenberg editor
    );

    register_post_type( 'product', $args );
}
add_action( 'init', 'kingfact_register_product_cpt' );

// Flush rewrite rules for products
function kingfact_flush_product_rewrite_rules() {
    kingfact_register_product_cpt();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'kingfact_flush_product_rewrite_rules' );

// Register Testimonial Custom Post Type
function kingfact_register_testimonial_cpt() {
    $labels = array(
        'name'                  => 'Testimonials',
        'singular_name'         => 'Testimonial',
        'menu_name'             => 'Testimonials',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Testimonial',
        'edit_item'             => 'Edit Testimonial',
        'new_item'              => 'New Testimonial',
        'view_item'             => 'View Testimonial',
        'search_items'          => 'Search Testimonials',
        'not_found'             => 'No testimonials found',
        'not_found_in_trash'    => 'No testimonials found in trash',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'testimonials' ),
        'capability_type'     => 'post',
        'menu_position'       => 21,
        'menu_icon'           => 'dashicons-testimonial',
        'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'show_in_rest'        => true,
    );

    register_post_type( 'testimonial', $args );
}
add_action( 'init', 'kingfact_register_testimonial_cpt' );

// Flush rewrite rules for testimonials
function kingfact_flush_testimonial_rewrite_rules() {
    kingfact_register_testimonial_cpt();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'kingfact_flush_testimonial_rewrite_rules' );

// Add meta box for testimonial fields
function kingfact_testimonial_meta_boxes() {
    add_meta_box(
        'kingfact_testimonial_fields',
        'Testimonial Details',
        'kingfact_testimonial_meta_box_cb',
        'testimonial',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'kingfact_testimonial_meta_boxes' );

function kingfact_testimonial_meta_box_cb( $post ) {
    wp_nonce_field( 'kingfact_testimonial_save', 'kingfact_testimonial_nonce' );

    $testimonial_photo = get_post_meta( $post->ID, '_testimonial_photo', true );
    $client_name = get_post_meta( $post->ID, '_testimonial_client_name', true );
    $client_position = get_post_meta( $post->ID, '_testimonial_client_position', true );

    ?>
    <table class="form-table">
        <tr>
            <th><label for="testimonial_photo"><strong>Client Photo</strong></label></th>
            <td>
                <div class="testimonial-photo-upload-wrapper">
                    <input type="hidden" id="testimonial_photo" name="testimonial_photo" value="<?php echo esc_attr( $testimonial_photo ); ?>" />
                    <div id="testimonial-photo-preview" style="margin-bottom: 10px;">
                        <?php if ( $testimonial_photo ) : 
                            $photo_url = wp_get_attachment_image_url( $testimonial_photo, 'thumbnail' );
                            if ( $photo_url ) : ?>
                            <img src="<?php echo esc_url( $photo_url ); ?>" style="max-width: 150px; height: auto; display: block; margin-bottom: 10px; border-radius: 50%;" />
                        <?php endif; endif; ?>
                    </div>
                    <button type="button" class="button testimonial-photo-upload"><?php echo $testimonial_photo ? 'Change Photo' : 'Upload Photo'; ?></button>
                    <?php if ( $testimonial_photo ) : ?>
                    <button type="button" class="button testimonial-photo-remove" style="margin-left: 5px;">Remove Photo</button>
                    <?php endif; ?>
                    <p class="description">Upload the client's photo. Use this instead of Featured Image for testimonial displays.</p>
                </div>
            </td>
        </tr>
        <tr>
            <th><label for="testimonial_client_name"><strong>Client Name</strong></label></th>
            <td>
                <input type="text" id="testimonial_client_name" name="testimonial_client_name" value="<?php echo esc_attr( $client_name ); ?>" class="regular-text" />
                <p class="description">Client's full name (e.g., "Sonika D. Silva")</p>
            </td>
        </tr>
        <tr>
            <th><label for="testimonial_client_position"><strong>Client Position/Role</strong></label></th>
            <td>
                <input type="text" id="testimonial_client_position" name="testimonial_client_position" value="<?php echo esc_attr( $client_position ); ?>" class="regular-text" />
                <p class="description">Client's position or role (e.g., "web designer", "civile engineer")</p>
            </td>
        </tr>
    </table>
    <p><em><strong>Client Photo:</strong> Upload using the photo field above.</em></p>
    <p><em><strong>Content Editor:</strong> Use the main editor above for the testimonial text/quote.</em></p>
    
    <script>
    jQuery(document).ready(function($) {
        var testimonialPhotoUploader;
        
        $('.testimonial-photo-upload').on('click', function(e) {
            e.preventDefault();
            
            if (testimonialPhotoUploader) {
                testimonialPhotoUploader.open();
                return;
            }
            
            testimonialPhotoUploader = wp.media({
                title: 'Select Client Photo',
                button: { text: 'Use this photo' },
                multiple: false,
                library: { type: 'image' }
            });
            
            testimonialPhotoUploader.on('select', function() {
                var attachment = testimonialPhotoUploader.state().get('selection').first().toJSON();
                $('#testimonial_photo').val(attachment.id);
                var imgUrl = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                $('#testimonial-photo-preview').html('<img src="' + imgUrl + '" style="max-width: 150px; height: auto; display: block; margin-bottom: 10px; border-radius: 50%;" />');
                $('.testimonial-photo-upload').text('Change Photo');
                if ($('.testimonial-photo-remove').length === 0) {
                    $('.testimonial-photo-upload').after('<button type="button" class="button testimonial-photo-remove" style="margin-left: 5px;">Remove Photo</button>');
                }
            });
            
            testimonialPhotoUploader.open();
        });
        
        $(document).on('click', '.testimonial-photo-remove', function(e) {
            e.preventDefault();
            $('#testimonial_photo').val('');
            $('#testimonial-photo-preview').html('');
            $('.testimonial-photo-upload').text('Upload Photo');
            $(this).remove();
        });
    });
    </script>
    <?php
}

function kingfact_testimonial_save( $post_id ) {
    if ( ! isset( $_POST['kingfact_testimonial_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['kingfact_testimonial_nonce'], 'kingfact_testimonial_save' ) ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['testimonial_photo'] ) ) {
        update_post_meta( $post_id, '_testimonial_photo', absint( $_POST['testimonial_photo'] ) );
    }
    if ( isset( $_POST['testimonial_client_name'] ) ) {
        update_post_meta( $post_id, '_testimonial_client_name', sanitize_text_field( $_POST['testimonial_client_name'] ) );
    }
    if ( isset( $_POST['testimonial_client_position'] ) ) {
        update_post_meta( $post_id, '_testimonial_client_position', sanitize_text_field( $_POST['testimonial_client_position'] ) );
    }
}
add_action( 'save_post', 'kingfact_testimonial_save' );

// Enqueue media uploader for testimonial edit screen
function kingfact_testimonial_enqueue_media() {
    global $post_type;
    if ( 'testimonial' === $post_type ) {
        wp_enqueue_media();
    }
}
add_action( 'admin_enqueue_scripts', 'kingfact_testimonial_enqueue_media' );

// 2) Add meta box for product extra fields
function kingfact_product_meta_boxes() {
    add_meta_box( 
        'kingfact_product_fields', 
        'Product Settings', 
        'kingfact_product_meta_box_cb', 
        'product', 
        'normal', 
        'high' 
    );
}
add_action( 'add_meta_boxes', 'kingfact_product_meta_boxes' );

function kingfact_product_meta_box_cb( $post ) {
    wp_nonce_field( 'kingfact_product_save', 'kingfact_product_nonce' );

    $product_banner = get_post_meta( $post->ID, '_product_banner', true );
    $product_url = get_post_meta( $post->ID, '_product_url', true );
    $product_link_text = get_post_meta( $post->ID, '_product_link_text', true );
    $product_icon = get_post_meta( $post->ID, '_product_icon', true );
    $product_price = get_post_meta( $post->ID, '_product_price', true );
    $product_images = get_post_meta( $post->ID, '_product_images', true );
    $product_videos = get_post_meta( $post->ID, '_product_videos', true );

    ?>
    <table class="form-table">
        <tr>
            <th><label for="product_banner"><strong>Banner Image</strong></label></th>
            <td>
                <div class="product-banner-upload-wrapper">
                    <input type="hidden" id="product_banner" name="product_banner" value="<?php echo esc_attr( $product_banner ); ?>" />
                    <div id="product-banner-preview" style="margin-bottom: 10px;">
                        <?php if ( $product_banner ) : 
                            $banner_url = wp_get_attachment_image_url( $product_banner, 'medium' );
                            if ( $banner_url ) : ?>
                            <img src="<?php echo esc_url( $banner_url ); ?>" style="max-width: 300px; height: auto; display: block; margin-bottom: 10px;" />
                        <?php endif; endif; ?>
                    </div>
                    <button type="button" class="button product-banner-upload"><?php echo $product_banner ? 'Change Banner Image' : 'Upload Banner Image'; ?></button>
                    <?php if ( $product_banner ) : ?>
                    <button type="button" class="button product-banner-remove" style="margin-left: 5px;">Remove Banner</button>
                    <?php endif; ?>
                    <p class="description">Banner image for product detail page and listings. Use this instead of Featured Image for product displays.</p>
                </div>
            </td>
        </tr>
        <tr>
            <th><label for="product_price"><strong>Product Price</strong></label></th>
            <td>
                <input type="text" id="product_price" name="product_price" value="<?php echo esc_attr( $product_price ); ?>" class="regular-text" />
                <p class="description">Product price (e.g., "$99", "Contact for Price")</p>
            </td>
        </tr>
        <tr>
            <th><label for="product_url"><strong>Product Link URL</strong></label></th>
            <td>
                <input type="url" id="product_url" name="product_url" value="<?php echo esc_attr( $product_url ); ?>" class="regular-text" />
                <p class="description">Link to product details page or external URL</p>
            </td>
        </tr>
        <tr>
            <th><label for="product_link_text"><strong>Link Text</strong></label></th>
            <td>
                <input type="text" id="product_link_text" name="product_link_text" value="<?php echo esc_attr( $product_link_text ); ?>" class="regular-text" />
                <p class="description">Text for the "read more" link (default: "view details")</p>
            </td>
        </tr>
        <tr>
            <th><label for="product_icon"><strong>Product Icon</strong></label></th>
            <td>
                <input type="text" id="product_icon" name="product_icon" value="<?php echo esc_attr( $product_icon ); ?>" class="regular-text" />
                <p class="description">FontAwesome icon class (e.g., "fas fa-box", "fas fa-laptop")</p>
            </td>
        </tr>
        <tr>
            <th><label for="product_images"><strong>Product Images</strong></label></th>
            <td>
                <input type="text" id="product_images" name="product_images" value="<?php echo esc_attr( $product_images ); ?>" class="large-text" />
                <button type="button" id="select_product_images" class="button">Select Images</button>
                <p class="description">Select multiple images for the product gallery. Image IDs will be saved automatically.</p>
                <div id="product_images_preview" style="margin-top: 10px;">
                    <?php if ( ! empty( $product_images ) ) : 
                        $image_ids = explode( ',', $product_images );
                        foreach ( $image_ids as $image_id ) :
                            $image_id = trim( $image_id );
                            if ( ! empty( $image_id ) ) :
                                $image_url = wp_get_attachment_image_url( $image_id, 'thumbnail' );
                                if ( $image_url ) :
                    ?>
                    <img src="<?php echo esc_url( $image_url ); ?>" style="width: 80px; height: 80px; object-fit: cover; margin: 5px; border: 1px solid #ddd;" />
                    <?php 
                                endif;
                            endif;
                        endforeach;
                    endif; ?>
                </div>
            </td>
        </tr>
        <tr>
            <th><label for="product_videos"><strong>Product Videos</strong></label></th>
            <td>
                <textarea id="product_videos" name="product_videos" class="large-text" rows="5"><?php echo esc_textarea( $product_videos ); ?></textarea>
                <p class="description">
                    Enter video URLs, one per line. Supports:
                    <br>• YouTube URLs (e.g., https://www.youtube.com/watch?v=VIDEO_ID)
                    <br>• Direct video file URLs (e.g., https://example.com/video.mp4)
                    <br>• Vimeo URLs and other video platforms
                </p>
            </td>
        </tr>
    </table>

    <div style="margin-top: 20px;">
        <h4>Instructions:</h4>
        <ul>
            <li><strong>Title:</strong> Use the main title field above for the product name</li>
            <li><strong>Description:</strong> Use the main editor for the product description</li>
            <li><strong>Banner Image:</strong> Upload a custom banner image for product displays (replaces Featured Image)</li>
            <li><strong>Excerpt:</strong> Use excerpt for short description (will fallback to description if empty)</li>
            <li><strong>Order:</strong> Use the Order field in Page Attributes to control display order</li>
            <li><strong>Images:</strong> Use the "Select Images" button to add product gallery images</li>
            <li><strong>Videos:</strong> Add YouTube URLs or direct video file URLs in the videos field</li>
        </ul>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // Product Banner Upload
        var productBannerUploader;
        
        $('.product-banner-upload').on('click', function(e) {
            e.preventDefault();
            
            if (productBannerUploader) {
                productBannerUploader.open();
                return;
            }
            
            productBannerUploader = wp.media({
                title: 'Select Banner Image',
                button: { text: 'Use this image' },
                multiple: false,
                library: { type: 'image' }
            });
            
            productBannerUploader.on('select', function() {
                var attachment = productBannerUploader.state().get('selection').first().toJSON();
                $('#product_banner').val(attachment.id);
                var imgUrl = attachment.sizes && attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url;
                $('#product-banner-preview').html('<img src="' + imgUrl + '" style="max-width: 300px; height: auto; display: block; margin-bottom: 10px;" />');
                $('.product-banner-upload').text('Change Banner Image');
                if ($('.product-banner-remove').length === 0) {
                    $('.product-banner-upload').after('<button type="button" class="button product-banner-remove" style="margin-left: 5px;">Remove Banner</button>');
                }
            });
            
            productBannerUploader.open();
        });
        
        $(document).on('click', '.product-banner-remove', function(e) {
            e.preventDefault();
            $('#product_banner').val('');
            $('#product-banner-preview').html('');
            $('.product-banner-upload').text('Upload Banner Image');
            $(this).remove();
        });
        
        // Product Images Gallery
        var productImagesUploader;
        
        $('#select_product_images').on('click', function(e) {
            e.preventDefault();
            
            if (productImagesUploader) {
                productImagesUploader.open();
                return;
            }
            
            productImagesUploader = wp.media.frames.productImagesUploader = wp.media({
                title: 'Select Product Images',
                button: {
                    text: 'Select Images'
                },
                multiple: true,
                library: {
                    type: 'image'
                }
            });
            
            productImagesUploader.on('select', function() {
                var attachments = productImagesUploader.state().get('selection').toJSON();
                var imageIds = [];
                var previewHtml = '';
                
                attachments.forEach(function(attachment) {
                    imageIds.push(attachment.id);
                    if (attachment.sizes && attachment.sizes.thumbnail) {
                        previewHtml += '<img src="' + attachment.sizes.thumbnail.url + '" style="width: 80px; height: 80px; object-fit: cover; margin: 5px; border: 1px solid #ddd;" />';
                    }
                });
                
                $('#product_images').val(imageIds.join(','));
                $('#product_images_preview').html(previewHtml);
            });
            
            productImagesUploader.open();
        });
    });
    </script>
    
    <?php
}

function kingfact_product_save( $post_id ) {
    // Security checks
    if ( ! isset( $_POST['kingfact_product_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['kingfact_product_nonce'], 'kingfact_product_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Save custom fields
    $fields = array(
        'product_banner' => '_product_banner',
        'product_url' => '_product_url',
        'product_link_text' => '_product_link_text',
        'product_icon' => '_product_icon',
        'product_price' => '_product_price',
        'product_images' => '_product_images',
        'product_videos' => '_product_videos',
    );

    foreach ( $fields as $input => $meta_key ) {
        if ( isset( $_POST[ $input ] ) ) {
            $value = wp_unslash( $_POST[ $input ] );
            if ( $input === 'product_url' ) {
                update_post_meta( $post_id, $meta_key, esc_url_raw( $value ) );
            } elseif ( $input === 'product_banner' ) {
                update_post_meta( $post_id, $meta_key, absint( $value ) );
            } else {
                update_post_meta( $post_id, $meta_key, sanitize_text_field( $value ) );
            }
        } else {
            delete_post_meta( $post_id, $meta_key );
        }
    }
}
add_action( 'save_post', 'kingfact_product_save' );

// 3) Admin columns for Product CPT
add_filter( 'manage_edit-product_columns', 'kingfact_product_manage_columns' );
function kingfact_product_manage_columns( $columns ) {
    $new = array();
    $new['cb'] = $columns['cb'];
    $new['thumbnail'] = __( 'Image', 'kingfact' );
    $new['title'] = __( 'Product Name', 'kingfact' );
    $new['description'] = __( 'Description', 'kingfact' );
    $new['product_price'] = __( 'Price', 'kingfact' );
    $new['menu_order'] = __( 'Order', 'kingfact' );
    $new['date'] = $columns['date'];
    return $new;
}

add_action( 'manage_product_posts_custom_column', 'kingfact_product_custom_column', 10, 2 );
function kingfact_product_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'thumbnail':
            $thumb_id = get_post_thumbnail_id( $post_id );
            if ( $thumb_id ) {
                echo wp_get_attachment_image( $thumb_id, array( 80, 80 ) );
            } else {
                echo '<span style="color:#999;">' . __( 'No image', 'kingfact' ) . '</span>';
            }
            break;

        case 'description':
            $excerpt = get_the_excerpt( $post_id );
            if ( $excerpt ) {
                echo wp_trim_words( $excerpt, 10, '...' );
            } else {
                $content = get_post_field( 'post_content', $post_id );
                echo wp_trim_words( strip_tags( $content ), 10, '...' );
            }
            break;

        case 'product_price':
            $price = get_post_meta( $post_id, '_product_price', true );
            if ( $price ) {
                echo '<strong>' . esc_html( $price ) . '</strong>';
            } else {
                echo '<span style="color:#999;">' . __( '—', 'kingfact' ) . '</span>';
            }
            break;

        case 'menu_order':
            $order = get_post_field( 'menu_order', $post_id );
            echo intval( $order );
            break;
    }
}

// Make menu_order column sortable for products
add_filter( 'manage_edit-product_sortable_columns', 'kingfact_product_sortable_columns' );
function kingfact_product_sortable_columns( $columns ) {
    $columns['menu_order'] = 'menu_order';
    return $columns;
}

// Adjust query when sorting by menu_order for products
add_action( 'pre_get_posts', 'kingfact_product_orderby_menu_order' );
function kingfact_product_orderby_menu_order( $query ) {
    if ( ! is_admin() ) return;
    $orderby = $query->get( 'orderby' );
    $post_type = $query->get( 'post_type' );

    if ( 'product' === $post_type ) {
        if ( 'menu_order' === $orderby ) {
            $query->set( 'orderby', 'menu_order' );
            $query->set( 'order', 'ASC' );
        }
    }
}

// Admin: enqueue sortable script for Products list
add_action( 'admin_enqueue_scripts', 'kingfact_enqueue_product_admin_scripts' );
function kingfact_enqueue_product_admin_scripts( $hook ) {
    global $post_type;

    // Only enqueue on edit.php for product post type
    if ( 'edit.php' !== $hook || 'product' !== ( isset( $_GET['post_type'] ) ? $_GET['post_type'] : $post_type ) ) {
        return;
    }

    // jQuery UI sortable is included with WP
    wp_enqueue_script( 'jquery-ui-sortable' );

    // Small admin script for products
    $handle = 'kingfact-product-admin';
    wp_register_script( $handle, false, array( 'jquery', 'jquery-ui-sortable' ), '1.0', true );

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
                    action: 'kingfact_update_product_order',
                    nonce: '%s',
                    order: order
                }, function(resp){
                    if (resp && resp.success) {
                        $('#message.updated').remove();
                        $('<div id="message" class="updated notice is-dismissible"><p>Product order saved.</p></div>').insertBefore('.wrap');
                    } else {
                        alert('Could not save product order.');
                    }
                }, 'json');
            }
        });
    });
})(jQuery);
JS;

    $nonce = wp_create_nonce( 'kingfact_product_order' );
    $inline = sprintf( $inline, esc_js( $nonce ) );

    wp_add_inline_script( $handle, $inline );
    wp_enqueue_script( $handle );
}

// AJAX handler to save the menu_order for products
add_action( 'wp_ajax_kingfact_update_product_order', 'kingfact_update_product_order' );
function kingfact_update_product_order() {
    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_send_json_error( 'no_permission' );
    }

    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'kingfact_product_order' ) ) {
        wp_send_json_error( 'bad_nonce' );
    }

    if ( ! isset( $_POST['order'] ) || ! is_array( $_POST['order'] ) ) {
        wp_send_json_error( 'bad_input' );
    }

    $order = array_map( 'absint', $_POST['order'] );

    foreach ( $order as $position => $post_id ) {
        $post = get_post( $post_id );
        if ( ! $post || 'product' !== $post->post_type ) continue;

        wp_update_post( array( 'ID' => $post_id, 'menu_order' => $position ) );
    }

    wp_send_json_success();
}

// 4) Products Display Shortcode
function kingfact_products_display_shortcode( $atts, $content = null ) {
    $base = get_template_directory_uri() . '/assets/';

    $defaults = array(
        // Layout settings
        'columns'           => '3', // 2, 3, 4, 6
        'posts_per_page'    => -1,  // -1 for all, or specific number
        'orderby'           => 'menu_order',
        'order'             => 'ASC',
        'padding_top'       => 'pt-130',
        'padding_bottom'    => 'pb-130',
        'class'             => '',
        
        // Section title
        'show_title'        => '0',
        'section_title'     => 'Our Products',
        'section_subtitle'  => 'what we offer',
        
        // Bottom button
        'show_button'       => '1',
        'button_text'       => 'view all products',
        'button_url'        => '#',
        
        // Filter options
        'include_ids'       => '', // Comma-separated post IDs
        'exclude_ids'       => '', // Comma-separated post IDs
        'category'          => '', // If you add categories later
    );

    $a = shortcode_atts( $defaults, $atts, 'products_display' );

    // Calculate column classes
    $col_class = 'col-xl-4 col-lg-4 col-md-6'; // default 3 columns
    switch ( $a['columns'] ) {
        case '2':
            $col_class = 'col-xl-6 col-lg-6 col-md-6';
            break;
        case '4':
            $col_class = 'col-xl-3 col-lg-3 col-md-6';
            break;
        case '6':
            $col_class = 'col-xl-2 col-lg-2 col-md-4';
            break;
    }

    // Query arguments
    $query_args = array(
        'post_type'      => 'product',
        'posts_per_page' => intval( $a['posts_per_page'] ),
        'orderby'        => $a['orderby'],
        'order'          => $a['order'],
        'post_status'    => 'publish',
    );

    // Handle include/exclude IDs
    if ( ! empty( $a['include_ids'] ) ) {
        $include_ids = array_map( 'intval', explode( ',', $a['include_ids'] ) );
        $query_args['post__in'] = $include_ids;
    }

    if ( ! empty( $a['exclude_ids'] ) ) {
        $exclude_ids = array_map( 'intval', explode( ',', $a['exclude_ids'] ) );
        $query_args['post__not_in'] = $exclude_ids;
    }

    // Get products
    $products_query = new WP_Query( $query_args );

    if ( ! $products_query->have_posts() ) {
        wp_reset_postdata();
        
        $debug_info = '<div class="no-products" style="padding: 20px; background: #f9f9f9; margin: 20px 0;">';
        $debug_info .= '<h4>No products found</h4>';
        $debug_info .= '<p><strong>Please make sure you have:</strong></p>';
        $debug_info .= '<ol><li>Created products in WordPress Admin → Products</li>';
        $debug_info .= '<li>Published the products (not saved as drafts)</li>';
        $debug_info .= '<li>Added featured images and content</li></ol>';
        $debug_info .= '</div>';
        
        return $debug_info;
    }

    ob_start();
    ?>
    <div class="products-area <?php echo esc_attr( $a['padding_top'] . ' ' . $a['padding_bottom'] . ' ' . $a['class'] ); ?>">
        <div class="container">
            
            <?php if ( '1' === $a['show_title'] ) : ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="section-title text-center mb-70">
                        <span><?php echo esc_html( $a['section_subtitle'] ); ?></span>
                        <h2><?php echo esc_html( $a['section_title'] ); ?></h2>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="row" id="products-container">
                <?php 
                $product_count = 0;
                $total_products = $products_query->found_posts;
                while ( $products_query->have_posts() ) : $products_query->the_post(); ?>
                <?php
                    $product_count++;
                    $product_id = get_the_ID();
                    $product_url = get_post_meta( $product_id, '_product_url', true );
                    $product_link_text = get_post_meta( $product_id, '_product_link_text', true );
                    $product_icon = get_post_meta( $product_id, '_product_icon', true );
                    $product_price = get_post_meta( $product_id, '_product_price', true );
                    
                    // Always use product detail page permalink for read more
                    $product_detail_url = get_permalink( $product_id );
                    
                    // Fallback link text
                    if ( empty( $product_link_text ) ) {
                        $product_link_text = 'view details';
                    }
                    
                    // Get description (excerpt or content)
                    $description = get_the_excerpt();
                    if ( empty( $description ) ) {
                        $description = wp_trim_words( get_the_content(), 20, '...' );
                    }
                    
                    // Add class to hide products after the 6th one
                    $hide_class = $product_count > 6 ? 'product-hidden' : '';
                ?>
                
                <div class="<?php echo esc_attr( $col_class ); ?> product-item <?php echo esc_attr( $hide_class ); ?>">
                    <div class="b-products mb-30" style="border: 1px solid #ddd; padding: 20px; background: #fff;">
                        <?php 
                        $product_banner_id = get_post_meta(get_the_ID(), '_product_banner', true);
                        $product_banner_url = $product_banner_id ? wp_get_attachment_image_url($product_banner_id, 'medium') : '';
                        if ($product_banner_url) : 
                        ?>
                        <div class="b-products-img" style="margin-bottom: 15px;">
                            <img src="<?php echo esc_url($product_banner_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" style="width: 100%; height: auto; max-width: 100%;" />
                        </div>
                        <?php endif; ?>
                        
                        <div class="b-products-content">
                            <h3 style="margin-bottom: 10px; color: #333;">
                                <?php if ( ! empty( $product_icon ) ) : ?>
                                <i class="<?php echo esc_attr( $product_icon ); ?>" style="margin-right: 8px;"></i> 
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $product_detail_url ); ?>" style="text-decoration: none; color: #333;">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <?php if ( ! empty( $product_price ) ) : ?>
                            <div class="product-price" style="margin-bottom: 10px;">
                                <span style="font-size: 18px; font-weight: bold; color: #e74c3c;"><?php echo esc_html( $product_price ); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ( ! empty( $description ) ) : ?>
                            <p style="margin-bottom: 15px; color: #666;"><?php echo esc_html( $description ); ?></p>
                            <?php endif; ?>
                            
                            <div class="pv-link">
                                <a href="<?php echo esc_url( $product_detail_url ); ?>" style="color: #007cba; text-decoration: none; font-weight: bold;"><?php echo esc_html( $product_link_text ); ?> →</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            
            <?php if ( $total_products > 6 ) : ?>
            <!-- Show More / Show Less Button -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="fea-btn text-center">
                        <button class="b-btn btn-black" id="toggle-products-btn" onclick="toggleProducts()">
                            <span id="product-btn-text">View All Products (<?php echo ($total_products - 6); ?> more)</span>
                        </button>
                    </div>
                </div>
            </div>
            <?php elseif ( '1' === $a['show_button'] ) : ?>
            <!-- Regular "view all products" button -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="fea-btn text-center">
                        <a class="b-btn btn-black" href="<?php echo esc_url( $a['button_url'] !== '#' ? $a['button_url'] : '/products/' ); ?>">
                            <span><?php echo esc_html( $a['button_text'] ); ?></span>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if ( $total_products > 6 ) : ?>
    <style>
    .product-hidden {
        display: none;
    }
    .product-show-animation {
        animation: fadeInUp 0.6s ease-out;
    }
    .product-hide-animation {
        animation: fadeOutDown 0.4s ease-out;
    }
    #toggle-products-btn {
        transition: all 0.3s ease;
    }
    #toggle-products-btn:hover {
        transform: translateY(-2px);
    }
    </style>

    <script>
    function toggleProducts() {
        const hiddenProducts = document.querySelectorAll('.product-hidden');
        const button = document.getElementById('toggle-products-btn');
        const buttonText = document.getElementById('product-btn-text');
        const isExpanded = button.classList.contains('expanded');
        
        if (!isExpanded) {
            // Show all products
            hiddenProducts.forEach((product, index) => {
                setTimeout(() => {
                    product.classList.remove('product-hidden');
                    product.classList.add('product-show-animation');
                }, index * 100);
            });
            
            button.classList.add('expanded');
            buttonText.textContent = 'Show Less Products';
            
        } else {
            // Hide extra products
            const allProducts = document.querySelectorAll('.product-item');
            const productsToHide = Array.from(allProducts).slice(6);
            
            productsToHide.forEach((product, index) => {
                setTimeout(() => {
                    product.classList.add('product-hide-animation');
                    setTimeout(() => {
                        product.classList.remove('product-show-animation', 'product-hide-animation');
                        product.classList.add('product-hidden');
                    }, 400);
                }, index * 50);
            });
            
            button.classList.remove('expanded');
            buttonText.textContent = 'View All Products (<?php echo ($total_products - 6); ?> more)';
            
            // Smooth scroll to products container
            setTimeout(() => {
                document.getElementById('products-container').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 300);
        }
    }
    </script>
    <?php endif; ?>
    
    <?php
    return ob_get_clean();
}
add_shortcode( 'products_display', 'kingfact_products_display_shortcode' );

// Enqueue media scripts for product admin
function kingfact_enqueue_product_media_scripts($hook) {
    global $post_type;
    
    if (($hook === 'post-new.php' || $hook === 'post.php') && $post_type === 'product') {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'kingfact_enqueue_product_media_scripts');

/**
 * Blog functionality
 */

// Add blog page to settings for easier management
function kingfact_add_blog_settings() {
    if ( function_exists( 'acf_add_options_page' ) ) {
        // Blog settings are part of theme options
        // We can add blog-specific fields in ACF
    }
}
add_action( 'acf/init', 'kingfact_add_blog_settings' );

// Register ACF fields for blog settings (if ACF is active)
if ( function_exists( 'acf_add_local_field_group' ) ) {
    acf_add_local_field_group( array(
        'key' => 'group_blog_settings',
        'title' => 'Blog Settings',
        'fields' => array(
            array(
                'key' => 'field_blog_breadcrumb_bg',
                'label' => 'Blog Breadcrumb Background',
                'name' => 'blog_breadcrumb_bg',
                'type' => 'image',
                'instructions' => 'Upload the background image for blog breadcrumb area',
                'return_format' => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-theme-options',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
    ));
}

// Modify excerpt length for blog posts
function kingfact_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'kingfact_excerpt_length', 999 );

// Modify excerpt more string
function kingfact_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'kingfact_excerpt_more' );

// Add Blog Post Banner Image Meta Box
function kingfact_add_post_banner_meta_box() {
    add_meta_box(
        'post_banner_meta_box',
        'Blog Post Banner Image',
        'kingfact_post_banner_meta_box_callback',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kingfact_add_post_banner_meta_box');

// Blog Post Banner Meta Box Callback
function kingfact_post_banner_meta_box_callback($post) {
    wp_nonce_field('kingfact_save_post_banner', 'kingfact_post_banner_nonce');
    
    $post_banner_id = get_post_meta($post->ID, '_post_banner', true);
    $post_banner_url = $post_banner_id ? wp_get_attachment_image_url($post_banner_id, 'medium') : '';
    ?>
    <div class="post-banner-field-wrapper">
        <p class="description">Upload a custom banner image for this blog post. This will be used instead of the featured image wherever blog tiles are displayed.</p>
        
        <div class="post-banner-upload-container" style="margin: 15px 0;">
            <div class="post-banner-preview" style="margin-bottom: 10px;">
                <?php if ($post_banner_url) : ?>
                    <img src="<?php echo esc_url($post_banner_url); ?>" style="max-width: 100%; height: auto; display: block;" />
                <?php else : ?>
                    <img src="" style="max-width: 100%; height: auto; display: none;" />
                <?php endif; ?>
            </div>
            
            <input type="hidden" name="post_banner" id="post_banner" value="<?php echo esc_attr($post_banner_id); ?>" />
            
            <button type="button" class="button post-banner-upload" <?php echo $post_banner_url ? 'style="display:none;"' : ''; ?>>
                Upload Banner Image
            </button>
            
            <button type="button" class="button post-banner-change" <?php echo $post_banner_url ? '' : 'style="display:none;"'; ?>>
                Change Banner Image
            </button>
            
            <button type="button" class="button post-banner-remove" <?php echo $post_banner_url ? '' : 'style="display:none;"'; ?>>
                Remove Banner Image
            </button>
        </div>
    </div>
    
    <style>
        .post-banner-preview img {
            border: 1px solid #ddd;
            padding: 5px;
            background: #f9f9f9;
        }
    </style>
    
    <script>
    jQuery(document).ready(function($) {
        var mediaUploader;
        
        $('.post-banner-upload, .post-banner-change').on('click', function(e) {
            e.preventDefault();
            
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            
            mediaUploader = wp.media({
                title: 'Choose Blog Post Banner Image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#post_banner').val(attachment.id);
                $('.post-banner-preview img').attr('src', attachment.url).show();
                $('.post-banner-upload').hide();
                $('.post-banner-change, .post-banner-remove').show();
            });
            
            mediaUploader.open();
        });
        
        $('.post-banner-remove').on('click', function(e) {
            e.preventDefault();
            $('#post_banner').val('');
            $('.post-banner-preview img').attr('src', '').hide();
            $('.post-banner-upload').show();
            $('.post-banner-change, .post-banner-remove').hide();
        });
    });
    </script>
    <?php
}

// Save Blog Post Banner Meta
function kingfact_save_post_banner($post_id) {
    if (!isset($_POST['kingfact_post_banner_nonce']) || !wp_verify_nonce($_POST['kingfact_post_banner_nonce'], 'kingfact_save_post_banner')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['post_banner'])) {
        update_post_meta($post_id, '_post_banner', absint($_POST['post_banner']));
    } else {
        delete_post_meta($post_id, '_post_banner');
    }
}
add_action('save_post', 'kingfact_save_post_banner');

// Enqueue media uploader for blog posts
function kingfact_enqueue_post_media_scripts($hook) {
    global $post_type;
    
    if ('post' === $post_type && ('post.php' === $hook || 'post-new.php' === $hook)) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'kingfact_enqueue_post_media_scripts');

// Add custom image sizes for blog
add_action( 'after_setup_theme', 'kingfact_blog_image_sizes' );
function kingfact_blog_image_sizes() {
    add_image_size( 'blog-thumbnail', 400, 300, true );
    add_image_size( 'blog-large', 800, 600, true );
}

// Enable support for Post Formats (optional - for different post types like video, gallery, etc.)
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

// Add custom search form
function kingfact_custom_search_form( $form ) {
    $form = '
    <form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
        <div class="search-form-wrapper">
            <input type="search" class="search-field" placeholder="' . esc_attr__( 'Search...', 'kingfact' ) . '" value="' . get_search_query() . '" name="s" />
            <button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
        </div>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'kingfact_custom_search_form' );

// Add comments template styling support
function kingfact_comment( $comment, $args, $depth ) {
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment-body">
            <div class="comment-author vcard">
                <?php echo get_avatar( $comment, 60 ); ?>
                <cite class="fn"><?php echo get_comment_author_link(); ?></cite>
                <span class="comment-date"><?php echo get_comment_date(); ?></span>
            </div>
            
            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'kingfact' ); ?></em>
                <br />
            <?php endif; ?>

            <div class="comment-text">
                <?php comment_text(); ?>
            </div>

            <div class="comment-reply">
                <?php 
                comment_reply_link( array_merge( $args, array( 
                    'depth' => $depth, 
                    'max_depth' => $args['max_depth'],
                    'reply_text' => '<i class="fas fa-reply"></i> Reply'
                ) ) ); 
                ?>
            </div>
        </div>
    <?php
}

// Add Counter Section ACF Options Page
function kingfact_add_counter_options_page() {
    if ( function_exists( 'acf_add_options_page' ) ) {
        acf_add_options_page(array(
            'page_title'    => 'Counter Section Settings',
            'menu_title'    => 'Counter Section',
            'menu_slug'     => 'counter-section-settings',
            'capability'    => 'manage_options',
            'redirect'      => false,
            'icon_url'      => 'dashicons-chart-bar',
            'position'      => 25,
        ));
    }
}
add_action( 'acf/init', 'kingfact_add_counter_options_page' );

// Register ACF fields for Home Page Sections with Tabs
if ( function_exists( 'acf_add_local_field_group' ) ) {
    acf_add_local_field_group( array(
        'key' => 'group_home_sections',
        'title' => 'Home Page Sections',
        'fields' => array(
            
            // Slides Section Tab
            array(
                'key' => 'field_slides_tab',
                'label' => 'Slides',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_slides_instructions',
                'label' => 'Manage Home Page Slides',
                'name' => '',
                'type' => 'message',
                'message' => '<p style="font-size: 14px; line-height: 1.6;">Home page slides are managed through the <strong>Slides</strong> custom post type.</p>
                <p style="font-size: 14px; line-height: 1.6;">To add or edit slides:</p>
                <ol style="font-size: 14px; line-height: 1.8;">
                    <li>Go to <strong>Slides → All Slides</strong> in the admin menu</li>
                    <li>Click <strong>Add New</strong> to create a new slide</li>
                    <li>Upload a background image, add title, subtitle, and button text</li>
                    <li>Use drag & drop in the All Slides page to reorder slides</li>
                    <li>Publish the slide to make it appear on the homepage</li>
                </ol>
                <p style="margin-top: 15px;"><a href="' . admin_url('post-new.php?post_type=slide') . '" class="button button-primary" style="margin-right: 10px;"><span class="dashicons dashicons-plus-alt" style="vertical-align: middle; margin-top: 3px;"></span> Add New Slide</a>
                <a href="' . admin_url('edit.php?post_type=slide') . '" class="button"><span class="dashicons dashicons-images-alt2" style="vertical-align: middle; margin-top: 3px;"></span> Manage All Slides</a></p>',
                'new_lines' => '',
                'esc_html' => 0,
            ),
            
            // Features Section Tab
            array(
                'key' => 'field_features_tab',
                'label' => 'Features',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_features_bg',
                'label' => 'Background Image',
                'name' => 'features_bg',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_features_subtitle',
                'label' => 'Subtitle',
                'name' => 'features_subtitle',
                'type' => 'text',
                'default_value' => 'who we are',
            ),
            array(
                'key' => 'field_features_title',
                'label' => 'Title',
                'name' => 'features_title',
                'type' => 'text',
                'default_value' => 'Explore Features',
            ),
            array(
                'key' => 'field_features_paragraph',
                'label' => 'Description',
                'name' => 'features_paragraph',
                'type' => 'textarea',
                'default_value' => 'But I must explain to you how all this mistaken is denouncing pleasure and praising pain was borners will give you a complete account of the system and expound the actual teachings',
            ),
            array(
                'key' => 'field_features_btn_text',
                'label' => 'Button Text',
                'name' => 'features_btn_text',
                'type' => 'text',
                'default_value' => 'read more',
            ),
            array(
                'key' => 'field_features_btn_url',
                'label' => 'Button URL',
                'name' => 'features_btn_url',
                'type' => 'url',
                'default_value' => '#',
            ),
            array(
                'key' => 'field_features_item1_image',
                'label' => 'Feature 1 Image',
                'name' => 'features_item1_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_features_item1_title',
                'label' => 'Feature 1 Title',
                'name' => 'features_item1_title',
                'type' => 'text',
                'default_value' => 'Technology Buildup',
            ),
            array(
                'key' => 'field_features_item1_text',
                'label' => 'Feature 1 Text',
                'name' => 'features_item1_text',
                'type' => 'textarea',
                'default_value' => 'Avoids pleasure itself, because it is pleasure because those who do not know how',
            ),
            array(
                'key' => 'field_features_item2_image',
                'label' => 'Feature 2 Image',
                'name' => 'features_item2_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_features_item2_title',
                'label' => 'Feature 2 Title',
                'name' => 'features_item2_title',
                'type' => 'text',
                'default_value' => 'Awards & Accolades',
            ),
            array(
                'key' => 'field_features_item2_text',
                'label' => 'Feature 2 Text',
                'name' => 'features_item2_text',
                'type' => 'textarea',
                'default_value' => 'Avoids pleasure itself, because it is pleasure because those who do not know how',
            ),
            
            // Services Section Tab
            array(
                'key' => 'field_services_tab',
                'label' => 'Services',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_services_subtitle',
                'label' => 'Subtitle',
                'name' => 'services_subtitle',
                'type' => 'text',
                'default_value' => 'what we do',
            ),
            array(
                'key' => 'field_services_title',
                'label' => 'Title',
                'name' => 'services_title',
                'type' => 'text',
                'default_value' => 'Latest Services',
            ),
            array(
                'key' => 'field_services_message',
                'label' => 'Manage Services',
                'name' => 'services_message',
                'type' => 'message',
                'message' => 'Services are displayed from the <strong>Services</strong> custom post type. Each service shows its featured image, title, description, and link.<br><br>Services are ordered by menu order and limited to 6 items on the home page.<br><br><a href="' . admin_url('post-new.php?post_type=service') . '" class="button button-primary button-large" target="_blank" style="margin-right: 10px;">+ Add New Service</a><a href="' . admin_url('edit.php?post_type=service') . '" class="button button-secondary" target="_blank">View All Services</a>',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
            
            // Video Section Tab
            array(
                'key' => 'field_video_tab',
                'label' => 'Video',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_video_bg',
                'label' => 'Background Image',
                'name' => 'video_bg',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_video_url',
                'label' => 'Video URL',
                'name' => 'video_url',
                'type' => 'url',
                'instructions' => 'YouTube or Vimeo video URL',
                'default_value' => '#',
            ),
            array(
                'key' => 'field_video_title',
                'label' => 'Title',
                'name' => 'video_title',
                'type' => 'textarea',
                'default_value' => 'Need Our Premium Services Full Free & More',
            ),
            array(
                'key' => 'field_video_btn_text',
                'label' => 'Button Text',
                'name' => 'video_btn_text',
                'type' => 'text',
                'default_value' => 'read more',
            ),
            array(
                'key' => 'field_video_btn_url',
                'label' => 'Button URL',
                'name' => 'video_btn_url',
                'type' => 'url',
                'default_value' => '/services',
            ),
            
            // Products Section Tab
            array(
                'key' => 'field_products_tab',
                'label' => 'Products',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_products_subtitle',
                'label' => 'Subtitle',
                'name' => 'products_subtitle',
                'type' => 'text',
                'default_value' => 'our works',
            ),
            array(
                'key' => 'field_products_title',
                'label' => 'Title',
                'name' => 'products_title',
                'type' => 'text',
                'default_value' => 'Project We Have Done',
            ),
            array(
                'key' => 'field_products_message',
                'label' => 'Manage Products',
                'name' => 'products_message',
                'type' => 'message',
                'message' => 'Products are displayed from the <strong>Products</strong> custom post type. Each product shows its featured image, title, and description.<br><br>Products are ordered by menu order and limited to 6 items on the home page.<br><br><a href="' . admin_url('post-new.php?post_type=product') . '" class="button button-primary button-large" target="_blank" style="margin-right: 10px;">+ Add New Product</a><a href="' . admin_url('edit.php?post_type=product') . '" class="button button-secondary" target="_blank">View All Products</a>',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
            
            // Counter Section Tab
            array(
                'key' => 'field_counter_section_tab',
                'label' => 'Counter',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_counter_bg',
                'label' => 'Background Image',
                'name' => 'counter_bg',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_counter_subtitle',
                'label' => 'Subtitle',
                'name' => 'counter_subtitle',
                'type' => 'text',
                'default_value' => 'fun fact',
            ),
            array(
                'key' => 'field_counter_title',
                'label' => 'Title',
                'name' => 'counter_title',
                'type' => 'text',
                'default_value' => 'Let\'s See Our Fun Facts',
            ),
            array(
                'key' => 'field_counter_description',
                'label' => 'Description',
                'name' => 'counter_description',
                'type' => 'textarea',
                'default_value' => 'But I must explain to you how amistaken idea denouncing pleasure praising',
            ),
            array(
                'key' => 'field_counter_btn_text',
                'label' => 'Button Text',
                'name' => 'counter_btn_text',
                'type' => 'text',
                'default_value' => 'read more',
            ),
            array(
                'key' => 'field_counter_btn_url',
                'label' => 'Button URL',
                'name' => 'counter_btn_url',
                'type' => 'url',
                'default_value' => '/products',
            ),
            
            // Counter 1 Group
            array(
                'key' => 'field_counter1_group',
                'label' => '— Counter 1 —',
                'type' => 'message',
                'message' => '',
            ),
            array(
                'key' => 'field_counter1_icon',
                'label' => 'Counter 1 - Icon Class',
                'name' => 'counter1_icon',
                'type' => 'text',
                'instructions' => 'FontAwesome icon class (e.g., fal fa-anchor)',
                'default_value' => 'fal fa-anchor',
                'placeholder' => 'fal fa-anchor',
            ),
            array(
                'key' => 'field_counter1_number',
                'label' => 'Counter 1 - Number',
                'name' => 'counter1_number',
                'type' => 'text',
                'default_value' => '2000',
                'placeholder' => '2000',
            ),
            array(
                'key' => 'field_counter1_label',
                'label' => 'Counter 1 - Label',
                'name' => 'counter1_label',
                'type' => 'text',
                'default_value' => 'Project Done',
                'placeholder' => 'Project Done',
            ),
            
            // Counter 2 Group
            array(
                'key' => 'field_counter2_group',
                'label' => '— Counter 2 —',
                'type' => 'message',
                'message' => '',
            ),
            array(
                'key' => 'field_counter2_icon',
                'label' => 'Counter 2 - Icon Class',
                'name' => 'counter2_icon',
                'type' => 'text',
                'instructions' => 'FontAwesome icon class (e.g., fal fa-ball-pile)',
                'default_value' => 'fal fa-ball-pile',
                'placeholder' => 'fal fa-ball-pile',
            ),
            array(
                'key' => 'field_counter2_number',
                'label' => 'Counter 2 - Number',
                'name' => 'counter2_number',
                'type' => 'text',
                'default_value' => '3500',
                'placeholder' => '3500',
            ),
            array(
                'key' => 'field_counter2_label',
                'label' => 'Counter 2 - Label',
                'name' => 'counter2_label',
                'type' => 'text',
                'default_value' => 'Power Plants',
                'placeholder' => 'Power Plants',
            ),
            
            // Counter 3 Group
            array(
                'key' => 'field_counter3_group',
                'label' => '— Counter 3 —',
                'type' => 'message',
                'message' => '',
            ),
            array(
                'key' => 'field_counter3_icon',
                'label' => 'Counter 3 - Icon Class',
                'name' => 'counter3_icon',
                'type' => 'text',
                'instructions' => 'FontAwesome icon class (e.g., fal fa-hospital-user)',
                'default_value' => 'fal fa-hospital-user',
                'placeholder' => 'fal fa-hospital-user',
            ),
            array(
                'key' => 'field_counter3_number',
                'label' => 'Counter 3 - Number',
                'name' => 'counter3_number',
                'type' => 'text',
                'default_value' => '2630',
                'placeholder' => '2630',
            ),
            array(
                'key' => 'field_counter3_label',
                'label' => 'Counter 3 - Label',
                'name' => 'counter3_label',
                'type' => 'text',
                'default_value' => 'Qualified Staff',
                'placeholder' => 'Qualified Staff',
            ),

            // Counter 4 Group
            array(
                'key' => 'field_counter4_group',
                'label' => '— Counter 4 —',
                'type' => 'message',
                'message' => '',
            ),
            array(
                'key' => 'field_counter4_icon',
                'label' => 'Counter 4 - Icon Class',
                'name' => 'counter4_icon',
                'type' => 'text',
                'instructions' => 'FontAwesome icon class (e.g., fal fa-hospital-user)',
                'default_value' => 'fal fa-smile',
                'placeholder' => 'fal fa-smile',
            ),
            array(
                'key' => 'field_counter4_number',
                'label' => 'Counter 4 - Number',
                'name' => 'counter4_number',
                'type' => 'text',
                'default_value' => '101',
                'placeholder' => '101',
            ),
            array(
                'key' => 'field_counter4_label',
                'label' => 'Counter 4 - Label',
                'name' => 'counter4_label',
                'type' => 'text',
                'default_value' => 'Happy Clients',
                'placeholder' => 'Happy Clients',
            ),
            
            // Testimonials Section Tab
            array(
                'key' => 'field_testimonials_tab',
                'label' => 'Testimonials',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_testimonials_subtitle',
                'label' => 'Subtitle',
                'name' => 'testimonials_subtitle',
                'type' => 'text',
                'default_value' => 'what our clients say',
            ),
            array(
                'key' => 'field_testimonials_title',
                'label' => 'Title',
                'name' => 'testimonials_title',
                'type' => 'text',
                'default_value' => 'Clients Testimonials',
            ),
            array(
                'key' => 'field_testimonials_message',
                'label' => 'Manage Testimonials',
                'name' => 'testimonials_message',
                'type' => 'message',
                'message' => 'Testimonials are displayed from the <strong>Testimonials</strong> custom post type. Each testimonial shows client photo, testimonial text, name, and position.<br><br>Testimonials are ordered by menu order and all published testimonials will be shown in the slider.<br><br><a href="' . admin_url('post-new.php?post_type=testimonial') . '" class="button button-primary button-large" target="_blank" style="margin-right: 10px;">+ Add New Testimonial</a><a href="' . admin_url('edit.php?post_type=testimonial') . '" class="button button-secondary" target="_blank">View All Testimonials</a>',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
            
            // Our Goals Section Tab
            array(
                'key' => 'field_goals_tab',
                'label' => 'Our Goals',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_goals_subtitle',
                'label' => 'Subtitle',
                'name' => 'goals_subtitle',
                'type' => 'text',
                'default_value' => 'our goals',
            ),
            array(
                'key' => 'field_goals_title',
                'label' => 'Goals Title',
                'name' => 'goals_title',
                'type' => 'text',
                'default_value' => 'Experience Industrial Engineering Company Based In New York',
            ),
            array(
                'key' => 'field_goals_image',
                'label' => 'Goals Image',
                'name' => 'goals_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_goals_video_url',
                'label' => 'Goals Video URL',
                'name' => 'goals_video_url',
                'type' => 'url',
                'instructions' => 'YouTube or Vimeo video URL for popup',
                'default_value' => 'https://www.youtube.com/watch?v=LTXD6XZXc3U',
            ),
            
            // Goal Item 1
            array(
                'key' => 'field_goal1_icon',
                'label' => 'Goal 1 - Icon Class',
                'name' => 'goal1_icon',
                'type' => 'text',
                'instructions' => 'FontAwesome icon class (e.g., far fa-user-hard-hat)',
                'default_value' => 'far fa-user-hard-hat',
            ),
            array(
                'key' => 'field_goal1_title',
                'label' => 'Goal 1 - Title',
                'name' => 'goal1_title',
                'type' => 'text',
                'default_value' => 'Creative Architecture',
            ),
            array(
                'key' => 'field_goal1_description',
                'label' => 'Goal 1 - Description',
                'name' => 'goal1_description',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque',
            ),
            
            // Goal Item 2
            array(
                'key' => 'field_goal2_icon',
                'label' => 'Goal 2 - Icon Class',
                'name' => 'goal2_icon',
                'type' => 'text',
                'instructions' => 'FontAwesome icon class (e.g., far fa-alarm-clock)',
                'default_value' => 'far fa-alarm-clock',
            ),
            array(
                'key' => 'field_goal2_title',
                'label' => 'Goal 2 - Title',
                'name' => 'goal2_title',
                'type' => 'text',
                'default_value' => 'Timely Maintenance',
            ),
            array(
                'key' => 'field_goal2_description',
                'label' => 'Goal 2 - Description',
                'name' => 'goal2_description',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque',
            ),
            
            // Goal Item 3
            array(
                'key' => 'field_goal3_icon',
                'label' => 'Goal 3 - Icon Class',
                'name' => 'goal3_icon',
                'type' => 'text',
                'instructions' => 'FontAwesome icon class (e.g., far fa-usd-square)',
                'default_value' => 'far fa-usd-square',
            ),
            array(
                'key' => 'field_goal3_title',
                'label' => 'Goal 3 - Title',
                'name' => 'goal3_title',
                'type' => 'text',
                'default_value' => 'Competitive Low Cost',
            ),
            array(
                'key' => 'field_goal3_description',
                'label' => 'Goal 3 - Description',
                'name' => 'goal3_description',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque',
            ),

            
            // Latest News & Blogs Section Tab
            array(
                'key' => 'field_blogs_tab',
                'label' => 'Latest News & Blogs',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_blogs_subtitle',
                'label' => 'Subtitle',
                'name' => 'blogs_subtitle',
                'type' => 'text',
                'default_value' => 'articles & tips',
            ),
            array(
                'key' => 'field_blogs_title',
                'label' => 'Title',
                'name' => 'blogs_title',
                'type' => 'text',
                'default_value' => 'Latest News & Blog',
            ),
            array(
                'key' => 'field_blogs_banner',
                'label' => 'Right Side Banner Image',
                'name' => 'blogs_banner',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'instructions' => 'Upload image to display in the right column banner area',
            ),
            array(
                'key' => 'field_blogs_message',
                'label' => 'Manage Blog Posts',
                'name' => 'blogs_message',
                'type' => 'message',
                'message' => 'Blog posts are displayed from WordPress <strong>Posts</strong>. The latest 2 posts will be shown in the left column.<br><br>The section displays post date, comments count, featured image, title, and excerpt.<br><br><a href="' . admin_url('post-new.php') . '" class="button button-primary button-large" target="_blank" style="margin-right: 10px;">+ Add New Blog Post</a><a href="' . admin_url('edit.php') . '" class="button button-secondary" target="_blank">View All Blog Posts</a>',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
            
            // Newsletter Section Tab
            array(
                'key' => 'field_newsletter_tab',
                'label' => 'Newsletter',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_newsletter_bg',
                'label' => 'Background Image',
                'name' => 'newsletter_bg',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_newsletter_subtitle',
                'label' => 'Subtitle',
                'name' => 'newsletter_subtitle',
                'type' => 'text',
                'default_value' => 'to get more information',
            ),
            array(
                'key' => 'field_newsletter_title',
                'label' => 'Title',
                'name' => 'newsletter_title',
                'type' => 'text',
                'default_value' => 'Subscribe Newsletter',
            ),
            array(
                'key' => 'field_newsletter_placeholder',
                'label' => 'Email Placeholder',
                'name' => 'newsletter_placeholder',
                'type' => 'text',
                'default_value' => 'Enter Your Email :',
            ),
            array(
                'key' => 'field_newsletter_btn_text',
                'label' => 'Button Text',
                'name' => 'newsletter_btn_text',
                'type' => 'text',
                'default_value' => 'subscribe',
            ),
            
            // Brand Section Tab
            array(
                'key' => 'field_brand_tab',
                'label' => 'Brand Section',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_brand_logo_1',
                'label' => 'Brand Logo 1',
                'name' => 'brand_logo_1',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'instructions' => 'Upload brand logo image 1',
            ),
            array(
                'key' => 'field_brand_logo_2',
                'label' => 'Brand Logo 2',
                'name' => 'brand_logo_2',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'instructions' => 'Upload brand logo image 2',
            ),
            array(
                'key' => 'field_brand_logo_3',
                'label' => 'Brand Logo 3',
                'name' => 'brand_logo_3',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'instructions' => 'Upload brand logo image 3',
            ),
            array(
                'key' => 'field_brand_logo_4',
                'label' => 'Brand Logo 4',
                'name' => 'brand_logo_4',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'instructions' => 'Upload brand logo image 4',
            ),
            array(
                'key' => 'field_brand_logo_5',
                'label' => 'Brand Logo 5',
                'name' => 'brand_logo_5',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'instructions' => 'Upload brand logo image 5',
            ),
            array(
                'key' => 'field_brand_logo_6',
                'label' => 'Brand Logo 6',
                'name' => 'brand_logo_6',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'instructions' => 'Upload brand logo image 6',
            ),
            array(
                'key' => 'field_brand_logo_7',
                'label' => 'Brand Logo 7',
                'name' => 'brand_logo_7',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'instructions' => 'Upload brand logo image 7',
            ),
            array(
                'key' => 'field_brand_logo_8',
                'label' => 'Brand Logo 8',
                'name' => 'brand_logo_8',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'instructions' => 'Upload brand logo image 8',
            ),
            array(
                'key' => 'field_brand_logo_9',
                'label' => 'Brand Logo 9',
                'name' => 'brand_logo_9',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'instructions' => 'Upload brand logo image 9',
            ),
            array(
                'key' => 'field_brand_logo_10',
                'label' => 'Brand Logo 10',
                'name' => 'brand_logo_10',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'instructions' => 'Upload brand logo image 10',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-home.php',
                ),
            ),
        ),
        'menu_order' => 1,
        'position' => 'normal',
        'style' => 'default',
    ));
    
    // Services Page ACF Fields
    acf_add_local_field_group(array(
        'key' => 'group_services_page',
        'title' => 'Services Page Settings',
        'fields' => array(
            // Banner Section Tab
            array(
                'key' => 'field_services_page_banner_tab',
                'label' => 'Banner Section',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_services_page_banner_image',
                'label' => 'Banner Background Image',
                'name' => 'services_page_banner_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'instructions' => 'Upload a custom banner image. If not set, will use page featured image or default.',
            ),
            array(
                'key' => 'field_services_page_banner_title',
                'label' => 'Banner Title',
                'name' => 'services_page_banner_title',
                'type' => 'text',
                'instructions' => 'Leave empty to use page title',
                'placeholder' => 'Page title will be used if empty',
            ),
            array(
                'key' => 'field_services_page_breadcrumb_home',
                'label' => 'Breadcrumb - Home Text',
                'name' => 'services_page_breadcrumb_home',
                'type' => 'text',
                'default_value' => 'home',
                'placeholder' => 'home',
            ),
            array(
                'key' => 'field_services_page_breadcrumb_current',
                'label' => 'Breadcrumb - Current Page Text',
                'name' => 'services_page_breadcrumb_current',
                'type' => 'text',
                'instructions' => 'Leave empty to use page title',
                'placeholder' => 'Page title will be used if empty',
            ),
            array(
                'key' => 'field_services_page_message',
                'label' => 'Manage Services',
                'name' => 'services_page_message',
                'type' => 'message',
                'message' => 'Services are displayed from the <strong>Services</strong> custom post type. Each service shows custom banner image, title, description, icon, and link details.<br><br>Services are ordered by menu order and displayed in a responsive grid layout.<br><br><a href="' . admin_url('post-new.php?post_type=service') . '" class="button button-primary button-large" target="_blank" style="margin-right: 10px;">+ Add New Service</a><a href="' . admin_url('edit.php?post_type=service') . '" class="button button-secondary" target="_blank">View All Services</a>',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-services.php',
                ),
            ),
        ),
        'menu_order' => 2,
        'position' => 'normal',
        'style' => 'default',
    ));
    
    // Products Page ACF Fields
    acf_add_local_field_group(array(
        'key' => 'group_products_page',
        'title' => 'Products Page Settings',
        'fields' => array(
            // Banner Section Tab
            array(
                'key' => 'field_products_page_banner_tab',
                'label' => 'Banner Section',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_products_page_banner_image',
                'label' => 'Banner Background Image',
                'name' => 'products_page_banner_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'instructions' => 'Upload a custom banner image. If not set, will use default.',
            ),
            array(
                'key' => 'field_products_page_banner_title',
                'label' => 'Banner Title',
                'name' => 'products_page_banner_title',
                'type' => 'text',
                'instructions' => 'Leave empty to use page title',
                'placeholder' => 'Page title will be used if empty',
            ),
            array(
                'key' => 'field_products_page_breadcrumb_home',
                'label' => 'Breadcrumb - Home Text',
                'name' => 'products_page_breadcrumb_home',
                'type' => 'text',
                'default_value' => 'home',
                'placeholder' => 'home',
            ),
            array(
                'key' => 'field_products_page_breadcrumb_current',
                'label' => 'Breadcrumb - Current Page Text',
                'name' => 'products_page_breadcrumb_current',
                'type' => 'text',
                'instructions' => 'Leave empty to use page title',
                'placeholder' => 'Page title will be used if empty',
            ),
            array(
                'key' => 'field_products_page_message',
                'label' => 'Manage Products',
                'name' => 'products_page_message',
                'type' => 'message',
                'message' => 'Products are displayed from the <strong>Products</strong> custom post type. Each product shows custom banner image, title, description, price, and additional details.<br><br>Products are ordered by menu order and include features like image galleries, video links, and custom icons.<br><br><a href="' . admin_url('post-new.php?post_type=product') . '" class="button button-primary button-large" target="_blank" style="margin-right: 10px;">+ Add New Product</a><a href="' . admin_url('edit.php?post_type=product') . '" class="button button-secondary" target="_blank">View All Products</a>',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-products.php',
                ),
            ),
        ),
        'menu_order' => 3,
        'position' => 'normal',
        'style' => 'default',
    ));
    
    // Blog Page ACF Fields
    acf_add_local_field_group(array(
        'key' => 'group_blog_page',
        'title' => 'Blog Page Settings',
        'fields' => array(
            // Banner Section Tab
            array(
                'key' => 'field_blog_page_banner_tab',
                'label' => 'Banner Section',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_blog_page_banner_image',
                'label' => 'Banner Background Image',
                'name' => 'blog_page_banner_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'instructions' => 'Upload a custom banner image. If not set, will use default.',
            ),
            array(
                'key' => 'field_blog_page_banner_title',
                'label' => 'Banner Title',
                'name' => 'blog_page_banner_title',
                'type' => 'text',
                'instructions' => 'Leave empty to use page title',
                'placeholder' => 'Page title will be used if empty',
            ),
            array(
                'key' => 'field_blog_page_breadcrumb_home',
                'label' => 'Breadcrumb - Home Text',
                'name' => 'blog_page_breadcrumb_home',
                'type' => 'text',
                'default_value' => 'home',
                'placeholder' => 'home',
            ),
            array(
                'key' => 'field_blog_page_breadcrumb_current',
                'label' => 'Breadcrumb - Current Page Text',
                'name' => 'blog_page_breadcrumb_current',
                'type' => 'text',
                'instructions' => 'Leave empty to use page title',
                'placeholder' => 'Page title will be used if empty',
            ),
            array(
                'key' => 'field_blog_page_message',
                'label' => 'Manage Blog Posts',
                'name' => 'blog_page_message',
                'type' => 'message',
                'message' => 'Blog posts are displayed from WordPress <strong>Posts</strong>. The blog listing page shows all published posts with featured images, titles, excerpts, dates, and comment counts.<br><br>Posts are ordered by publish date (newest first) and include pagination for easy navigation.<br><br><a href="' . admin_url('post-new.php') . '" class="button button-primary button-large" target="_blank" style="margin-right: 10px;">+ Add New Blog Post</a><a href="' . admin_url('edit.php') . '" class="button button-secondary" target="_blank">View All Blog Posts</a>',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'posts_page',
                ),
            ),
        ),
        'menu_order' => 4,
        'position' => 'normal',
        'style' => 'default',
    ));
}

// Our Goals Section Shortcode
function our_goals_shortcode() {
    ob_start();
    ?>
    <div class="choose-area pt-125 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-10 offset-lg-1 offset-xl-1">
                    <div class="section-title mr-50 ml-50 text-center mb-75">
                        <span>our goals</span>
                        <h1>Experience Industrial Engineering Company Based In New York</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="choose-wrapper mb-30">
                        <div class="choose-content">
                            <ul>
                                <li>
                                    <div class="choose-icon f-left">
                                        <i class="far fa-user-hard-hat"></i>
                                    </div>
                                    <div class="choose-text">
                                        <h4>Creative Architecture</h4>
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="choose-icon f-left">
                                        <i class="far fa-alarm-clock"></i>
                                    </div>
                                    <div class="choose-text">
                                        <h4>Timely Maintenance</h4>
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="choose-icon f-left">
                                        <i class="far fa-usd-square"></i>
                                    </div>
                                    <div class="choose-text">
                                        <h4>Competitive Low Cost</h4>
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="choose-img pos-rel mb-30">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg/choose-01.jpg" alt="">
                        <div class="choose-video-icon">
                            <a class="popup-video" href="https://www.youtube.com/watch?v=LTXD6XZXc3U"><i class="fas fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('our_goals', 'our_goals_shortcode');

// Newsletter Subscription Handler
function handle_newsletter_subscription() {
    // Verify nonce for security
    if (!isset($_POST['newsletter_nonce']) || !wp_verify_nonce($_POST['newsletter_nonce'], 'newsletter_subscribe')) {
        // For backward compatibility, allow submissions without nonce initially
        // wp_send_json_error('Security check failed');
        // return;
    }
    
    // Get and sanitize email
    $email = isset($_POST['newsletter_email']) ? sanitize_email($_POST['newsletter_email']) : '';
    
    // Validate email
    if (empty($email) || !is_email($email)) {
        wp_send_json_error('Please enter a valid email address.');
        return;
    }
    
    // Check if email already exists
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    
    // Create table if it doesn't exist
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        subscribed_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        status varchar(20) DEFAULT 'active' NOT NULL,
        PRIMARY KEY  (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    
    // Check if email already subscribed
    $existing = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name WHERE email = %s",
        $email
    ));
    
    if ($existing > 0) {
        wp_send_json_error('This email is already subscribed to our newsletter.');
        return;
    }
    
    // Insert new subscriber
    $result = $wpdb->insert(
        $table_name,
        array(
            'email' => $email,
            'subscribed_date' => current_time('mysql'),
            'status' => 'active'
        ),
        array('%s', '%s', '%s')
    );
    
    if ($result) {
        // Send confirmation email (optional)
        $to = $email;
        $subject = 'Newsletter Subscription Confirmation';
        $message = 'Thank you for subscribing to our newsletter! You will receive updates from us soon.';
        $headers = array('Content-Type: text/html; charset=UTF-8');
        
        wp_mail($to, $subject, $message, $headers);
        
        wp_send_json_success('Thank you for subscribing! Check your email for confirmation.');
    } else {
        wp_send_json_error('Something went wrong. Please try again later.');
    }
}

// Register AJAX handlers for both logged-in and non-logged-in users
add_action('wp_ajax_newsletter_subscribe', 'handle_newsletter_subscription');
add_action('wp_ajax_nopriv_newsletter_subscribe', 'handle_newsletter_subscription');

// Enqueue newsletter AJAX script
function enqueue_newsletter_scripts() {
    if (is_page_template('page-home.php')) {
        ?>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#newsletter-form').on('submit', function(e) {
                e.preventDefault();
                
                var email = $('#newsletter-email').val();
                var $message = $('#newsletter-message');
                var $button = $(this).find('button[type="submit"]');
                
                // Disable button and show loading
                $button.prop('disabled', true).html('<span>Subscribing...</span>');
                $message.html('');
                
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'newsletter_subscribe',
                        newsletter_email: email
                    },
                    success: function(response) {
                        if (response.success) {
                            $message.html('<p style="color: #4CAF50; font-weight: bold;">' + response.data + '</p>');
                            $('#newsletter-email').val('');
                        } else {
                            $message.html('<p style="color: #f44336; font-weight: bold;">' + response.data + '</p>');
                        }
                    },
                    error: function() {
                        $message.html('<p style="color: #f44336; font-weight: bold;">An error occurred. Please try again.</p>');
                    },
                    complete: function() {
                        $button.prop('disabled', false).html('<span>subscribe</span>');
                    }
                });
            });
        });
        </script>
        <?php
    }
}
add_action('wp_footer', 'enqueue_newsletter_scripts');

// Register ACF fields for About Page History Section
if ( function_exists( 'acf_add_local_field_group' ) ) {
    acf_add_local_field_group( array(
        'key' => 'group_about_history',
        'title' => 'About Page Settings',
        'fields' => array(
            // Banner & Breadcrumb Tab
            array(
                'key' => 'field_about_banner_tab',
                'label' => 'Banner Section',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_about_banner_image',
                'label' => 'Banner Background Image',
                'name' => 'about_banner_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'instructions' => 'Upload a banner background image for the About page. Recommended size: 1920x600px',
            ),
            array(
                'key' => 'field_about_banner_title',
                'label' => 'Banner Title',
                'name' => 'about_banner_title',
                'type' => 'text',
                'default_value' => 'About Us',
                'placeholder' => 'About Us',
                'instructions' => 'Main title displayed in the banner center',
            ),
            array(
                'key' => 'field_about_breadcrumb_home',
                'label' => 'Breadcrumb - Home Text',
                'name' => 'about_breadcrumb_home',
                'type' => 'text',
                'default_value' => 'home',
                'placeholder' => 'home',
                'instructions' => 'Text for the home breadcrumb link',
            ),
            array(
                'key' => 'field_about_breadcrumb_current',
                'label' => 'Breadcrumb - Current Page Text',
                'name' => 'about_breadcrumb_current',
                'type' => 'text',
                'default_value' => 'About Us',
                'placeholder' => 'About Us',
                'instructions' => 'Text for the current page in breadcrumb',
            ),
            
            // History Section Tab
            array(
                'key' => 'field_history_tab',
                'label' => 'History Section',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_history_subtitle',
                'label' => 'History Subtitle',
                'name' => 'history_subtitle',
                'type' => 'text',
                'instructions' => 'Small text above the main title (e.g., "who we are")',
                'default_value' => 'who we are',
                'placeholder' => 'who we are',
            ),
            array(
                'key' => 'field_history_title',
                'label' => 'History Title',
                'name' => 'history_title',
                'type' => 'text',
                'instructions' => 'Main heading for the history section',
                'default_value' => 'Quality & Integrity Service Agency',
                'placeholder' => 'Quality & Integrity Service Agency',
            ),
            array(
                'key' => 'field_history_heading',
                'label' => 'History Heading',
                'name' => 'history_heading',
                'type' => 'text',
                'instructions' => 'Heading for the history content (e.g., "Company History")',
                'default_value' => 'Company History',
                'placeholder' => 'Company History',
            ),
            array(
                'key' => 'field_history_content',
                'label' => 'History Content',
                'name' => 'history_content',
                'type' => 'textarea',
                'instructions' => 'Main content describing your company history',
                'rows' => 6,
                'default_value' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odite.',
            ),
            
            // Vision, Mission & Goals Tab
            array(
                'key' => 'field_vmg_tab',
                'label' => 'Vision, Mission & Goals',
                'type' => 'tab',
                'placement' => 'top',
            ),
            
            // Vision Fields
            array(
                'key' => 'field_vision_image',
                'label' => 'Vision Image',
                'name' => 'vision_image',
                'type' => 'image',
                'instructions' => 'Upload an image for the vision section',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_vision_title',
                'label' => 'Vision Title',
                'name' => 'vision_title',
                'type' => 'text',
                'default_value' => 'Vision',
                'placeholder' => 'Vision',
            ),
            array(
                'key' => 'field_vision_content',
                'label' => 'Vision Content',
                'name' => 'vision_content',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'But I must explain to you how all this mistaken denouncing pleasure',
            ),
            array(
                'key' => 'field_vision_link',
                'label' => 'Vision Link URL',
                'name' => 'vision_link',
                'type' => 'url',
                'placeholder' => 'https://',
            ),
            
            // Mission Fields
            array(
                'key' => 'field_mission_image',
                'label' => 'Mission Image',
                'name' => 'mission_image',
                'type' => 'image',
                'instructions' => 'Upload an image for the mission section',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_mission_title',
                'label' => 'Mission Title',
                'name' => 'mission_title',
                'type' => 'text',
                'default_value' => 'Mission',
                'placeholder' => 'Mission',
            ),
            array(
                'key' => 'field_mission_content',
                'label' => 'Mission Content',
                'name' => 'mission_content',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'But I must explain to you how all this mistaken denouncing pleasure',
            ),
            array(
                'key' => 'field_mission_link',
                'label' => 'Mission Link URL',
                'name' => 'mission_link',
                'type' => 'url',
                'placeholder' => 'https://',
            ),
            
            // Goals Fields
            array(
                'key' => 'field_goals_image',
                'label' => 'Goals Image',
                'name' => 'goals_image',
                'type' => 'image',
                'instructions' => 'Upload an image for the goals section',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_goals_title',
                'label' => 'Goals Title',
                'name' => 'goals_title',
                'type' => 'text',
                'default_value' => 'Why Us or Our Goals',
                'placeholder' => 'Why Us or Our Goals',
            ),
            array(
                'key' => 'field_goals_content',
                'label' => 'Goals Content',
                'name' => 'goals_content',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'But I must explain to you how all this mistaken denouncing pleasure',
            ),
            array(
                'key' => 'field_goals_link',
                'label' => 'Goals Link URL',
                'name' => 'goals_link',
                'type' => 'url',
                'placeholder' => 'https://',
            ),
            
            // Counter Section Info Tab
            array(
                'key' => 'field_counter_info_tab',
                'label' => 'Counter Section',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_counter_section_info',
                'label' => 'Counter Section Information',
                'name' => 'counter_section_info',
                'type' => 'message',
                'message' => '<div style="padding: 15px; background: #f0f6fc; border-left: 4px solid #2271b1; margin: 10px 0;">
                    <h3 style="margin-top: 0; color: #1d2327;">Edit Counter Section</h3>
                    <p style="margin: 10px 0; font-size: 14px;">The counter/statistics section displayed on the About page is managed from the Home page settings.</p>
                    <p style="margin: 10px 0; font-size: 14px;">Click the button below to edit counter values, icons, and labels:</p>
                    <a href="' . admin_url('post.php?post=' . get_option('page_on_front') . '&action=edit') . '" class="button button-primary" style="margin-top: 10px;" target="_blank">
                        <span class="dashicons dashicons-admin-home" style="vertical-align: middle; margin-right: 5px;"></span>
                        Go to Home Page Counter Section
                    </a>
                </div>',
                'new_lines' => '',
            ),
            
            // Featured Section Tab
            array(
                'key' => 'field_about_features_tab',
                'label' => 'Featured Section',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_about_features_bg',
                'label' => 'Background Image',
                'name' => 'about_features_bg',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'instructions' => 'Upload background image for featured section',
            ),
            array(
                'key' => 'field_about_features_subtitle',
                'label' => 'Subtitle',
                'name' => 'about_features_subtitle',
                'type' => 'text',
                'default_value' => 'who we are',
                'placeholder' => 'who we are',
            ),
            array(
                'key' => 'field_about_features_title',
                'label' => 'Title',
                'name' => 'about_features_title',
                'type' => 'text',
                'default_value' => 'Explore Features',
                'placeholder' => 'Explore Features',
            ),
            array(
                'key' => 'field_about_features_paragraph',
                'label' => 'Description',
                'name' => 'about_features_paragraph',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'But I must explain to you how all this mistaken is denouncing pleasure and praising pain was borners will give you a complete account of the system and expound the actual teachings',
            ),
            array(
                'key' => 'field_about_features_item1_image',
                'label' => 'Feature 1 Image',
                'name' => 'about_features_item1_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'thumbnail',
                'instructions' => 'Upload image for first feature',
            ),
            array(
                'key' => 'field_about_features_item1_title',
                'label' => 'Feature 1 Title',
                'name' => 'about_features_item1_title',
                'type' => 'text',
                'default_value' => 'Technology Buildup',
                'placeholder' => 'Technology Buildup',
            ),
            array(
                'key' => 'field_about_features_item1_text',
                'label' => 'Feature 1 Text',
                'name' => 'about_features_item1_text',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'Avoids pleasure itself, because it is pleasure because those who do not know how',
            ),
            array(
                'key' => 'field_about_features_item2_image',
                'label' => 'Feature 2 Image',
                'name' => 'about_features_item2_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'thumbnail',
                'instructions' => 'Upload image for second feature',
            ),
            array(
                'key' => 'field_about_features_item2_title',
                'label' => 'Feature 2 Title',
                'name' => 'about_features_item2_title',
                'type' => 'text',
                'default_value' => 'Awards & Accolades',
                'placeholder' => 'Awards & Accolades',
            ),
            array(
                'key' => 'field_about_features_item2_text',
                'label' => 'Feature 2 Text',
                'name' => 'about_features_item2_text',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'Avoids pleasure itself, because it is pleasure because those who do not know how',
            ),
            
            // Testimonials Section Info Tab
            array(
                'key' => 'field_about_testimonials_info_tab',
                'label' => 'Testimonials',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_about_testimonials_section_info',
                'label' => 'Testimonials Section Information',
                'name' => 'about_testimonials_section_info',
                'type' => 'message',
                'message' => '<div style="padding: 15px; background: #f0f6fc; border-left: 4px solid #2271b1; margin: 10px 0;">
                    <h3 style="margin-top: 0; color: #1d2327;">Edit Testimonials</h3>
                    <p style="margin: 10px 0; font-size: 14px;">The testimonials section displayed on the About page is managed from the Home page settings.</p>
                    <p style="margin: 10px 0; font-size: 14px;">You can also manage individual testimonials from the Testimonials post type.</p>
                    <p style="margin: 10px 0; font-size: 14px;"><strong>Click the buttons below:</strong></p>
                    <div style="margin-top: 15px;">
                        <a href="' . admin_url('post.php?post=' . get_option('page_on_front') . '&action=edit') . '" class="button button-primary" style="margin-right: 10px;" target="_blank">
                            <span class="dashicons dashicons-admin-home" style="vertical-align: middle; margin-right: 5px;"></span>
                            Go to Home Page Testimonials Section
                        </a>
                        <a href="' . admin_url('edit.php?post_type=testimonial') . '" class="button button-secondary" target="_blank">
                            <span class="dashicons dashicons-admin-comments" style="vertical-align: middle; margin-right: 5px;"></span>
                            Manage All Testimonials
                        </a>
                    </div>
                </div>',
                'new_lines' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-about.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ));
}

// Register ACF fields for Contact Page
if ( function_exists( 'acf_add_local_field_group' ) ) {
    acf_add_local_field_group( array(
        'key' => 'group_contact_page',
        'title' => 'Contact Page Settings',
        'fields' => array(
            // Banner & Breadcrumb Tab
            array(
                'key' => 'field_contact_banner_tab',
                'label' => 'Banner & Breadcrumb',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_contact_banner_image',
                'label' => 'Banner Background Image',
                'name' => 'contact_banner_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'instructions' => 'Upload a banner background image for the Contact page. Recommended size: 1920x600px',
            ),
            array(
                'key' => 'field_contact_banner_title',
                'label' => 'Banner Title',
                'name' => 'contact_banner_title',
                'type' => 'text',
                'default_value' => 'contact',
                'placeholder' => 'contact',
                'instructions' => 'Main title displayed in the banner center',
            ),
            array(
                'key' => 'field_contact_breadcrumb_home',
                'label' => 'Breadcrumb - Home Text',
                'name' => 'contact_breadcrumb_home',
                'type' => 'text',
                'default_value' => 'home',
                'placeholder' => 'home',
                'instructions' => 'Text for the home breadcrumb link',
            ),
            array(
                'key' => 'field_contact_breadcrumb_current',
                'label' => 'Breadcrumb - Current Page Text',
                'name' => 'contact_breadcrumb_current',
                'type' => 'text',
                'default_value' => 'contact',
                'placeholder' => 'contact',
                'instructions' => 'Text for the current page in breadcrumb',
            ),
            // Google Map Tab
            array(
                'key' => 'field_contact_map_tab',
                'label' => 'Google Map',
                'type' => 'tab',
                'placement' => 'top',
            ),
            array(
                'key' => 'field_contact_map_message',
                'label' => '',
                'name' => '',
                'type' => 'message',
                'message' => '<strong>How to add Google Maps:</strong><br>
                    1. Go to <a href="https://www.google.com/maps" target="_blank">Google Maps</a><br>
                    2. Search for your business location<br>
                    3. Click the <strong>"Share"</strong> button<br>
                    4. Click <strong>"Embed a map"</strong> tab<br>
                    5. Select map size (Small/Medium/Large/Custom size)<br>
                    6. Copy the <strong>entire iframe code</strong><br>
                    7. Paste it in the field below',
                'new_lines' => '',
                'esc_html' => 0,
            ),
            array(
                'key' => 'field_contact_map_iframe',
                'label' => 'Google Map Iframe Code',
                'name' => 'contact_map_iframe',
                'type' => 'textarea',
                'rows' => 8,
                'new_lines' => '',
                'maxlength' => '',
                'placeholder' => '<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'instructions' => 'Paste the complete iframe embed code from Google Maps here.',
            ),
            array(
                'key' => 'field_contact_map_preview',
                'label' => 'Map Preview',
                'name' => '',
                'type' => 'message',
                'message' => 'Save/Update the page to see your map displayed on the contact page.',
                'new_lines' => '',
                'esc_html' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-contact.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ));
}

// Include Contact Form 7 setup
require_once get_template_directory() . '/inc/setup-contact-form.php';

// Register ACF fields for Media Page
if ( function_exists( 'acf_add_local_field_group' ) ) {
    acf_add_local_field_group( array(
        'key' => 'group_media_page',
        'title' => 'Media Page Settings',
        'fields' => array(
            // Tab: Banner & Breadcrumb
            array(
                'key' => 'field_media_tab_banner',
                'label' => 'Banner & Breadcrumb',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'placement' => 'top',
            ),
            array(
                'key' => 'field_media_banner_image',
                'label' => 'Banner Image',
                'name' => 'media_banner_image',
                'type' => 'image',
                'instructions' => 'Upload the banner image for the media page. Recommended size: 1920x400px',
                'required' => 0,
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_media_banner_title',
                'label' => 'Banner Title',
                'name' => 'media_banner_title',
                'type' => 'text',
                'instructions' => 'Main title displayed on the banner',
                'required' => 0,
                'default_value' => 'Media',
                'placeholder' => 'Media',
            ),
            array(
                'key' => 'field_media_breadcrumb_home',
                'label' => 'Breadcrumb - Home Text',
                'name' => 'media_breadcrumb_home',
                'type' => 'text',
                'instructions' => 'Text for the home breadcrumb link',
                'required' => 0,
                'default_value' => 'home',
                'placeholder' => 'home',
            ),
            array(
                'key' => 'field_media_breadcrumb_current',
                'label' => 'Breadcrumb - Current Page Text',
                'name' => 'media_breadcrumb_current',
                'type' => 'text',
                'instructions' => 'Text for the current page in breadcrumb',
                'required' => 0,
                'default_value' => 'media',
                'placeholder' => 'media',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-media.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ));
}

// Custom Media Gallery Meta Box with dynamic add/remove
add_action('add_meta_boxes', 'kingfact_add_media_gallery_meta_box');
function kingfact_add_media_gallery_meta_box() {
    global $post;
    
    // Only add meta box if it's the media page template
    if (!$post) return;
    
    $template = get_post_meta($post->ID, '_wp_page_template', true);
    if ($template !== 'page-media.php') {
        return;
    }
    
    add_meta_box(
        'kingfact_media_gallery',
        'Media Galleries',
        'kingfact_media_gallery_meta_box_callback',
        'page',
        'normal',
        'high'
    );
}

function kingfact_media_gallery_meta_box_callback($post) {
    wp_nonce_field('kingfact_save_media_gallery', 'kingfact_media_gallery_nonce');
    
    $image_gallery = get_post_meta($post->ID, '_media_image_gallery', true);
    $video_gallery = get_post_meta($post->ID, '_media_video_gallery', true);
    
    if (!is_array($image_gallery)) $image_gallery = array();
    if (!is_array($video_gallery)) $video_gallery = array();
    ?>
    
    <style>
    .media-gallery-tabs {
        margin-bottom: 20px;
        border-bottom: 1px solid #ccc;
    }
    .media-gallery-tabs button {
        background: #f1f1f1;
        border: 1px solid #ccc;
        border-bottom: none;
        padding: 10px 20px;
        cursor: pointer;
        margin-right: 5px;
    }
    .media-gallery-tabs button.active {
        background: #fff;
        font-weight: bold;
    }
    .gallery-tab-content {
        display: none;
        padding: 20px 0;
    }
    .gallery-tab-content.active {
        display: block;
    }
    .gallery-item {
        background: #f9f9f9;
        padding: 15px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        position: relative;
    }
    .gallery-item img {
        max-width: 150px;
        height: auto;
        display: block;
        margin: 10px 0;
    }
    .gallery-item .remove-item {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #dc3545;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 3px;
    }
    .gallery-item .remove-item:hover {
        background: #c82333;
    }
    .add-gallery-item {
        background: #0073aa;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 3px;
        margin-top: 10px;
    }
    .add-gallery-item:hover {
        background: #005177;
    }
    .upload-image-btn {
        background: #0073aa;
        color: white;
        border: none;
        padding: 8px 15px;
        cursor: pointer;
        border-radius: 3px;
        margin-top: 5px;
    }
    .upload-image-btn:hover {
        background: #005177;
    }
    </style>
    
    <div class="media-gallery-tabs">
        <button type="button" class="gallery-tab-btn active" data-tab="images">Image Gallery</button>
        <button type="button" class="gallery-tab-btn" data-tab="videos">Video Gallery</button>
    </div>
    
    <!-- Image Gallery Tab -->
    <div class="gallery-tab-content active" id="images-tab">
        <div id="image-gallery-items">
            <?php if (!empty($image_gallery)) : foreach ($image_gallery as $index => $image_id) : 
                $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
            ?>
            <div class="gallery-item">
                <button type="button" class="remove-item" onclick="removeGalleryItem(this)">Remove</button>
                <input type="hidden" name="media_image_gallery[]" value="<?php echo esc_attr($image_id); ?>">
                <?php if ($image_url) : ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="Gallery Image">
                <?php endif; ?>
            </div>
            <?php endforeach; endif; ?>
        </div>
        <button type="button" class="add-gallery-item" onclick="addImageGalleryItem()">Add Image</button>
    </div>
    
    <!-- Video Gallery Tab -->
    <div class="gallery-tab-content" id="videos-tab">
        <div id="video-gallery-items">
            <?php if (!empty($video_gallery)) : foreach ($video_gallery as $index => $video_url) : ?>
            <div class="gallery-item">
                <button type="button" class="remove-item" onclick="removeGalleryItem(this)">Remove</button>
                <label>Video URL:</label>
                <input type="url" name="media_video_gallery[]" value="<?php echo esc_attr($video_url); ?>" 
                       placeholder="https://www.youtube.com/watch?v=... or https://vimeo.com/..." 
                       style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>
            <?php endforeach; endif; ?>
        </div>
        <button type="button" class="add-gallery-item" onclick="addVideoGalleryItem()">Add Video</button>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // Tab switching
        $('.gallery-tab-btn').on('click', function() {
            $('.gallery-tab-btn').removeClass('active');
            $(this).addClass('active');
            
            $('.gallery-tab-content').removeClass('active');
            $('#' + $(this).data('tab') + '-tab').addClass('active');
        });
    });
    
    function addImageGalleryItem() {
        var container = document.getElementById('image-gallery-items');
        var item = document.createElement('div');
        item.className = 'gallery-item';
        item.innerHTML = '<button type="button" class="remove-item" onclick="removeGalleryItem(this)">Remove</button>' +
                        '<input type="hidden" name="media_image_gallery[]" value="" class="image-id-input">' +
                        '<button type="button" class="upload-image-btn" onclick="openMediaUploader(this)">Select Image</button>' +
                        '<div class="image-preview"></div>';
        container.appendChild(item);
    }
    
    function addVideoGalleryItem() {
        var container = document.getElementById('video-gallery-items');
        var item = document.createElement('div');
        item.className = 'gallery-item';
        item.innerHTML = '<button type="button" class="remove-item" onclick="removeGalleryItem(this)">Remove</button>' +
                        '<label>Video URL:</label>' +
                        '<input type="url" name="media_video_gallery[]" value="" ' +
                        'placeholder="https://www.youtube.com/watch?v=... or https://vimeo.com/..." ' +
                        'style="width: 100%; padding: 8px; margin-top: 5px;">';
        container.appendChild(item);
    }
    
    function removeGalleryItem(button) {
        if (confirm('Are you sure you want to remove this item?')) {
            button.parentElement.remove();
        }
    }
    
    function openMediaUploader(button) {
        var galleryItem = button.closest('.gallery-item');
        var imageInput = galleryItem.querySelector('.image-id-input');
        var imagePreview = galleryItem.querySelector('.image-preview');
        
        if (window.mediaUploader) {
            window.mediaUploader.open();
            window.currentImageInput = imageInput;
            window.currentImagePreview = imagePreview;
            return;
        }
        
        window.mediaUploader = wp.media({
            title: 'Select Image',
            button: { text: 'Use this image' },
            multiple: false
        });
        
        window.mediaUploader.on('select', function() {
            var attachment = window.mediaUploader.state().get('selection').first().toJSON();
            window.currentImageInput.value = attachment.id;
            window.currentImagePreview.innerHTML = '<img src="' + attachment.sizes.thumbnail.url + '" alt="Gallery Image">';
        });
        
        window.currentImageInput = imageInput;
        window.currentImagePreview = imagePreview;
        window.mediaUploader.open();
    }
    </script>
    <?php
}

// Save media gallery data
add_action('save_post', 'kingfact_save_media_gallery_meta_box');
function kingfact_save_media_gallery_meta_box($post_id) {
    // Security checks
    if (!isset($_POST['kingfact_media_gallery_nonce']) || 
        !wp_verify_nonce($_POST['kingfact_media_gallery_nonce'], 'kingfact_save_media_gallery')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save image gallery
    if (isset($_POST['media_image_gallery'])) {
        $image_gallery = array_filter($_POST['media_image_gallery'], function($val) {
            return !empty($val);
        });
        update_post_meta($post_id, '_media_image_gallery', array_values($image_gallery));
    } else {
        delete_post_meta($post_id, '_media_image_gallery');
    }
    
    // Save video gallery
    if (isset($_POST['media_video_gallery'])) {
        $video_gallery = array_map('esc_url_raw', $_POST['media_video_gallery']);
        $video_gallery = array_filter($video_gallery, function($val) {
            return !empty($val);
        });
        update_post_meta($post_id, '_media_video_gallery', array_values($video_gallery));
    } else {
        delete_post_meta($post_id, '_media_video_gallery');
    }
}




