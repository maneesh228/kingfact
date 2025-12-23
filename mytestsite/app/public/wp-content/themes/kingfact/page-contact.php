<?php
/*
Template Name: Contact
Description: Contact page template with form and info
*/
get_header();

// Get banner image from ACF or fallback
$contact_banner_image = get_field('contact_banner_image');
if (!$contact_banner_image) {
    // Fallback to featured image
    $contact_banner_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
    if (!$contact_banner_image) {
        // Final fallback to default
        $contact_banner_image = get_template_directory_uri() . '/assets/img/bg/bg-9.jpg';
    }
}

// Get banner title and breadcrumb texts from ACF
$banner_title = get_field('contact_banner_title');
$breadcrumb_home = get_field('contact_breadcrumb_home');
$breadcrumb_current = get_field('contact_breadcrumb_current');

// Set defaults if empty
if (!$banner_title) $banner_title = 'contact';
if (!$breadcrumb_home) $breadcrumb_home = 'home';
if (!$breadcrumb_current) $breadcrumb_current = 'contact';

// Get contact info from contact page ACF fields
$contact_address = get_field('contact_address');
$contact_email = get_field('contact_email');
$contact_phone = get_field('contact_phone');

// Fallback to header settings (ACF Options) if contact page fields are empty
if (empty($contact_address) || empty($contact_email) || empty($contact_phone)) {
    if (function_exists('get_field')) {
        if (empty($contact_address)) $contact_address = get_field('header_contact_address', 'option');
        if (empty($contact_email)) $contact_email = get_field('header_contact_email', 'option');
        if (empty($contact_phone)) $contact_phone = get_field('header_contact_phone', 'option');
    }
}

// Final fallback to theme options if ACF not available
if ( empty( $contact_address ) || empty( $contact_email ) || empty( $contact_phone ) ) {
    $opts = get_option( 'kingfact_theme_options', array() );
    if (empty($contact_address)) $contact_address = ! empty( $opts['header_contact_address'] ) ? $opts['header_contact_address'] : 'Flat 20, Reynolds USA';
    if (empty($contact_email)) $contact_email = ! empty( $opts['header_contact_email'] ) ? $opts['header_contact_email'] : 'support@rmail.com';
    if (empty($contact_phone)) $contact_phone = ! empty( $opts['header_contact_phone'] ) ? $opts['header_contact_phone'] : '+812 (345) 6789';
}
?>

<main>

    <!-- breadcrumb-area-start -->
    <div class="breadcrumb-area" style="background-image:url(<?php echo esc_url( $contact_banner_image ); ?>); min-height: 350px; display: flex; align-items: center;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-text text-center">
                        <h1><?php echo esc_html($banner_title); ?></h1>
                        <ul class="breadcrumb-menu">
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html($breadcrumb_home); ?></a></li>
                            <li><span><?php echo esc_html($breadcrumb_current); ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->

    <section class="contact-box-area pt-125 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 offset-lg-3 offset-xl-3">
                    <div class="section-title text-center mb-75">
                        <span>contact info</span>
                        <h1>More Business Info</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="contact-box text-center mb-30">
                        <i class="fas fa-envelope"></i>
                        <h3>Mail Here</h3>
                        <?php 
                        // Display email(s) - output WYSIWYG content
                        if ($contact_email) {
                            echo '<div>' . wp_kses_post($contact_email) . '</div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="contact-box text-center mb-30">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>Visit Here</h3>
                        <?php 
                        // Display address - output WYSIWYG content
                        if ($contact_address) {
                            echo '<div>' . wp_kses_post($contact_address) . '</div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="contact-box text-center mb-30">
                        <i class="fas fa-phone"></i>
                        <h3>Call Here</h3>
                        <?php 
                        // Display phone(s) - output WYSIWYG content
                        if ($contact_phone) {
                            echo '<div>' . wp_kses_post($contact_phone) . '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- map-area-start -->
<div class="map-area">
    <div class="map-wrapper">
        <?php 
        /**
         * Google Map Display
         * 
         * The map can be configured in two ways:
         * 1. RECOMMENDED: Paste Google Maps iframe embed code in WordPress Admin
         *    (Edit Contact Page → Google Map tab → Paste iframe code)
         * 
         * 2. FALLBACK: If no iframe is set, displays default JavaScript-based map
         *    (Configure location in assets/js/main.js - basicmap() function)
         */
        
        // Get Google Map iframe from ACF
        $map_iframe = get_field('contact_map_iframe');
        if ( $map_iframe ) {
            // Output the iframe code (already includes <iframe> tags)
            echo wp_kses_post( $map_iframe );
        } else {
            // Fallback to default map if no iframe is set
            echo '<div id="contact-map" class="contact-map"></div>';
        }
        ?>
    </div>
</div>
<!-- map-area-end -->    <!-- contact-area-start -->
    <div class="contact-area pt-125 pb-130">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 offset-lg-3 offset-xl-3">
                    <div class="section-title text-center mb-75">
                        <span>Message us</span>
                        <h1>Contact With Us</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <?php
                    // Contact Form 7 integration
                    // Form submissions are stored in WordPress Admin > Contact > Contact Forms
                    if ( function_exists( 'kingfact_get_contact_form_shortcode' ) ) {
                        echo do_shortcode( kingfact_get_contact_form_shortcode() );
                    } else {
                        // Fallback if function doesn't exist
                        echo do_shortcode('[contact-form-7 id="1"]');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- contact-area-end -->

</main>

<?php get_footer(); ?>
