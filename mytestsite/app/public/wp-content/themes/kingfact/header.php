<?php
/**
 * Theme header (defensive: works with or without ACF)
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); // prints enqueued CSS, meta, etc. ?>
</head>

<body <?php body_class(); ?>>

<?php
// --- Defensive retrieval of header settings ---
// If ACF is active and we used an Options page, use get_field('name', 'option').
// Otherwise fall back to safe defaults.

// Get theme options for fallback
$opts = get_option( 'kingfact_theme_options', array() );

if ( function_exists( 'get_field' ) ) {
    // ACF present — read options (returns false if not set)
    $show_top  = get_field( 'header_show_top', 'option' );
    $hours     = get_field( 'header_hours', 'option' );
    $links     = get_field( 'header_links', 'option' ); // repeater array or false
    $acf_logo  = get_field( 'header_logo', 'option' );
    $quote_txt = get_field( 'header_quote_text', 'option' );
    $quote_url = get_field( 'header_quote_url', 'option' );
    
    // Logo: prefer ACF, then Theme Settings, then false
    $logo = $acf_logo ? $acf_logo : ( ! empty( $opts['header_logo'] ) ? $opts['header_logo'] : false );
    
    // Hours: prefer ACF, then Theme Settings, then default
    $hours = $hours ? $hours : ( ! empty( $opts['header_hours'] ) ? $opts['header_hours'] : 'Mon - Fri: 9:00 - 19:00 / Closed on Weekends' );
    
    // Links: prefer ACF, then Theme Settings
    $links = $links ? $links : ( ! empty( $opts['header_links'] ) ? $opts['header_links'] : false );
} else {
    // ACF not available — provide safe defaults from theme options
    $show_top  = true;
    $hours     = ! empty( $opts['header_hours'] ) ? $opts['header_hours'] : 'Mon - Fri: 9:00 - 19:00 / Closed on Weekends';
    $links     = ! empty( $opts['header_links'] ) ? $opts['header_links'] : false;
    $logo      = ! empty( $opts['header_logo'] ) ? $opts['header_logo'] : false;
    $quote_txt = 'get a quote';
    $quote_url = home_url( '/contact/' );
}

// Normalize values (avoid null)
$show_top  = ( $show_top === false ) ? false : true;
$hours     = $hours ?: ( ! empty( $opts['header_hours'] ) ? $opts['header_hours'] : 'Mon - Fri: 9:00 - 19:00 / Closed on Weekends' );
$quote_txt = $quote_txt ? $quote_txt : 'get a quote';
$quote_url = $quote_url ? $quote_url : home_url( '/contact/' );

// --- Header contact values: prefer ACF options, otherwise use fallback theme options saved by kingfact_theme_settings_page() ---
if ( function_exists( 'get_field' ) ) {
    // Read ACF option values (may be null/empty)
    $acf_addr    = get_field( 'header_contact_address', 'option' );
    $acf_email   = get_field( 'header_contact_email', 'option' );
    $acf_phone   = get_field( 'header_contact_phone', 'option' );
    $acf_socials = get_field( 'header_social_links', 'option' );

    // Use ACF value when present, otherwise fall back to saved theme options, then to hard defaults.
    $header_contact_address = $acf_addr ? $acf_addr : ( ! empty( $opts['header_contact_address'] ) ? $opts['header_contact_address'] : 'Flat 20, Reynolds USA' );
    $header_contact_email   = $acf_email ? $acf_email : ( ! empty( $opts['header_contact_email'] ) ? $opts['header_contact_email'] : 'support@rmail.com' );
    $header_contact_phone   = $acf_phone ? $acf_phone : ( ! empty( $opts['header_contact_phone'] ) ? $opts['header_contact_phone'] : '+812 (345) 6789' );
    $header_socials         = $acf_socials ? $acf_socials : ( ! empty( $opts['header_social_links'] ) && is_array( $opts['header_social_links'] ) ? $opts['header_social_links'] : array() );
} else {
    $header_contact_address = ! empty( $opts['header_contact_address'] ) ? $opts['header_contact_address'] : 'Flat 20, Reynolds USA';
    $header_contact_email   = ! empty( $opts['header_contact_email'] ) ? $opts['header_contact_email'] : 'support@rmail.com';
    $header_contact_phone   = ! empty( $opts['header_contact_phone'] ) ? $opts['header_contact_phone'] : '+812 (345) 6789';
    $header_socials         = ! empty( $opts['header_social_links'] ) && is_array( $opts['header_social_links'] ) ? $opts['header_social_links'] : array();
}

// Debug: removed temporary debug HTML comment
?>

<!-- Site header starts -->
<header>

    <?php if( $show_top ): ?>
    <div class="header2-area black-bg d-none d-md-block ">
        <div class="container">
            <div class="row">

                <div class="col-xl-6 col-lg-6 col-md-6 d-flex align-items-center">
                    <div class="header-2-info">
                        <span><i class="far fa-clock"></i> 
                            <?php echo esc_html( $hours ); ?>
                        </span>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="header-link text-md-right">
                        <ul>
                            <?php if ( $links ) : ?>
                                <?php foreach ( $links as $l ) : ?>
                                    <li>
                                        <a href="<?php echo esc_url( $l['url'] ); ?>">
                                            <?php echo esc_html( $l['text'] ); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php endif; ?>


    <div id="sticky-header" class="main-menu-area menu-2">
        <div class="container">
            <div class="row">

                <div class="col-xl-3 col-lg-3 d-flex align-items-center">
                    <div class="logo">
                        <a href="<?php echo esc_url( home_url() ); ?>">
                            <?php if ( $logo ) : ?>
                                <?php if ( is_array( $logo ) && isset( $logo['url'] ) ) : ?>
                                    <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="logo">
                                <?php else : ?>
                                    <img src="<?php echo esc_url( $logo ); ?>" alt="logo">
                                <?php endif; ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo/logo.png' ); ?>">
                            <?php endif; ?>
                        </a>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-9">

                    <div class="header-button f-right d-none d-lg-block">
                        <a class="b-btn btn-black" href="<?php echo esc_url( $quote_url ); ?>">
                            <span><?php echo esc_html( $quote_txt ); ?></span>
                        </a>
                    </div>

                    <div class="main-menu text-right">
                        <nav id="mobile-menu">
                            <?php
                                wp_nav_menu([
                                    'theme_location' => 'primary',
                                    'container'      => false,
                                    'items_wrap'     => '<ul>%3$s</ul>'
                                ]);
                            ?>
                        </nav>
                    </div>

                </div>

                <div class="col-12">
                    <div class="mobile-menu"></div>
                </div>

            </div>
        </div>
    </div>

     <div class="header-area d-none d-md-block">
                <div class="container">
                    <div class="header-2-border">
                        <div class="row">
                            <div class="col-xl-8 col-lg-9 col-md-9 d-flex align-items-center">
                                <div class="header-info header-3-info d-none d-lg-block">
                                    <span><i class="far fa-map-marker-alt"></i> <?php echo esc_html( $header_contact_address ); ?></span>
                                    <span><i class="far fa-envelope-open"></i> <?php echo esc_html( $header_contact_email ); ?></span>
                                    <span> <i class="far fa-phone"></i> <?php echo esc_html( $header_contact_phone ); ?></span>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-md-3">
                                <div class="header-top-right f-right ">
                                    <div class="header-icon header-2-icon f-right d-none d-lg-block">
                                        <?php $socials = $header_socials;
                                        if ( $socials ) :
                                            foreach ( $socials as $s ) : ?>
                                                <a href="<?php echo esc_url( $s['url'] ); ?>"><i class="<?php echo esc_attr( $s['icon'] ); ?>"></i></a>
                                            <?php endforeach;
                                        else : ?>
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <a href="#"><i class="fab fa-google"></i></a>
                                            <a href="#"><i class="fab fa-dribbble"></i></a>
                                            <a href="#"><i class="fab fa-behance"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="extra-info"> -->
               <!-- aaaa <div class="close-icon">
                    <button>
                        <i class="far fa-window-close"></i>
                    </button>
                </div>
               bbb <div class="logo-side mb-30">
                    <a href="index.html">
                        <img src="assets/img/logo/white.png" alt="" />
                    </a>
                </div> -->
                <!-- <div class="side-info mb-30">
                    <div class="contact-list mb-30">
                        <h4>Office Address</h4>
                        <p>123/A, Miranda City Likaoli
                            Prikano, Dope</p>
                    </div>
                    <div class="contact-list mb-30">
                        <h4>Phone Number</h4>
                        <p>+0989 7876 9865 9</p>
                        <p>+(090) 8765 86543 85</p>
                    </div>
                    <div class="contact-list mb-30">
                        <h4>Email Address</h4>
                        <p>info@example.com</p>
                        <p>example.mail@hum.com</p>
                    </div>
                </div> -->
                <!-- ccc<div class="social-icon-right mt-20">
                    <a href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-google-plus-g"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div> -->
            <!-- </div> -->

</header>
