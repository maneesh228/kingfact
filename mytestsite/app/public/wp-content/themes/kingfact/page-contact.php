<?php
/*
Template Name: Contact
Description: Contact page template with form and info
*/
get_header();

// Get featured image or fallback to default
$breadcrumb_bg = get_the_post_thumbnail_url(get_the_ID(), 'full');
if (!$breadcrumb_bg) {
    $breadcrumb_bg = get_template_directory_uri() . '/assets/img/bg/bg-9.jpg';
}

// Get contact info from header settings (ACF Options)
$contact_address = '';
$contact_email = '';
$contact_phone = '';

if ( function_exists( 'get_field' ) ) {
    $contact_address = get_field( 'header_contact_address', 'option' );
    $contact_email = get_field( 'header_contact_email', 'option' );
    $contact_phone = get_field( 'header_contact_phone', 'option' );
}

// Fallback to theme options if ACF not available
if ( empty( $contact_address ) || empty( $contact_email ) || empty( $contact_phone ) ) {
    $opts = get_option( 'kingfact_theme_options', array() );
    $contact_address = ! empty( $opts['header_contact_address'] ) ? $opts['header_contact_address'] : 'Flat 20, Reynolds USA';
    $contact_email = ! empty( $opts['header_contact_email'] ) ? $opts['header_contact_email'] : 'support@rmail.com';
    $contact_phone = ! empty( $opts['header_contact_phone'] ) ? $opts['header_contact_phone'] : '+812 (345) 6789';
}
?>

<main>

    <!-- breadcrumb-area-start -->
    <div class="breadcrumb-area pt-245 pb-255" style="background-image:url(<?php echo esc_url( $breadcrumb_bg ); ?>)">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-text text-center">
                        <h1>contact</h1>
                        <ul class="breadcrumb-menu">
                            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">home</a></li>
                            <li><span>contact</span></li>
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
                        <p><a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?></a></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="contact-box text-center mb-30">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>Visit Here</h3>
                        <p><?php echo esc_html( $contact_address ); ?></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="contact-box text-center mb-30">
                        <i class="fas fa-phone"></i>
                        <h3>Call Here</h3>
                        <p><a href="tel:<?php echo esc_attr( str_replace( array( ' ', '(', ')', '-' ), '', $contact_phone ) ); ?>"><?php echo esc_html( $contact_phone ); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- map-area-start -->
    <div class="map-area">
        <div class="map-wrapper">
            <div id="contact-map" class="contact-map"></div>
        </div>
    </div>
    <!-- map-area-end -->

    <!-- contact-area-start -->
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
                    <form id="contacts-us-form" class="contacts-us-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
                        <input type="hidden" name="action" value="submit_contact_form">
                        <?php wp_nonce_field( 'contact_form_submit', 'contact_nonce' ); ?>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="contacts-icon contactss-name">
                                    <input type="text" name="contact_name" placeholder="Your Name...." required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contacts-icon contactss-email">
                                    <input type="email" name="contact_email" placeholder="Your Email...." required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contacts-icon contactss-website">
                                    <input type="text" name="contact_website" placeholder="Your Website....">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="contacts-icon contactss-message">
                                    <textarea name="contact_message" id="comments" cols="30" rows="10" placeholder="Your Comments...." required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="contacts-us-form-button text-center">
                                    <button type="submit" class="b-btn btn-black">
                                        <span>Send Message</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-messages mt-3"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contact-area-end -->

</main>

<?php get_footer(); ?>
