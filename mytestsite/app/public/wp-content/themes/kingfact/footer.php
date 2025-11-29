<?php
// Prepare footer values: prefer ACF options when non-empty, otherwise use fallback theme options
$opts = get_option( 'kingfact_theme_options', array() );
if ( function_exists( 'get_field' ) ) {
    $acf_footer_logo    = get_field( 'footer_logo', 'option' );
    $acf_footer_text    = get_field( 'footer_text', 'option' );
    $acf_quick_links    = get_field( 'footer_quick_links', 'option' );
    // Use header contact fields for footer
    $acf_contact_addr   = get_field( 'header_contact_address', 'option' );
    $acf_contact_email  = get_field( 'header_contact_email', 'option' );
    $acf_contact_phone  = get_field( 'header_contact_phone', 'option' );
    // Use header social links for footer
    $acf_footer_socials = get_field( 'header_social_links', 'option' );
    $acf_copyright      = get_field( 'footer_copyright', 'option' );

    $footer_logo    = $acf_footer_logo ? $acf_footer_logo : ( ! empty( $opts['footer_logo'] ) ? $opts['footer_logo'] : false );
    $footer_text    = $acf_footer_text ? $acf_footer_text : ( ! empty( $opts['footer_text'] ) ? $opts['footer_text'] : '<p>But I must explain to you how all this misn idea of denouncing pleasure and prais pain</p><a href="#">Continue Reading</a>' );
    $quick_links    = $acf_quick_links ? $acf_quick_links : ( ! empty( $opts['footer_quick_links'] ) ? $opts['footer_quick_links'] : array() );
    // Use header contact data as fallback
    $footer_contact_address = $acf_contact_addr ? $acf_contact_addr : ( ! empty( $opts['header_contact_address'] ) ? $opts['header_contact_address'] : '1058 Meadowb, Mall Road' );
    $footer_contact_email   = $acf_contact_email ? $acf_contact_email : ( ! empty( $opts['header_contact_email'] ) ? $opts['header_contact_email'] : 'support@gmail.com' );
    $footer_contact_phone   = $acf_contact_phone ? $acf_contact_phone : ( ! empty( $opts['header_contact_phone'] ) ? $opts['header_contact_phone'] : '+000 (123) 44 558' );
    // Use header social links for footer
    $footer_socials = $acf_footer_socials ? $acf_footer_socials : ( ! empty( $opts['header_social_links'] ) ? $opts['header_social_links'] : array() );
    $footer_copyright = $acf_copyright ? $acf_copyright : ( ! empty( $opts['footer_copyright'] ) ? $opts['footer_copyright'] : 'Copyright © ' . date('Y') . ' kingfact. All rights reserved.' );
} else {
    $footer_logo    = ! empty( $opts['footer_logo'] ) ? $opts['footer_logo'] : false;
    $footer_text    = ! empty( $opts['footer_text'] ) ? $opts['footer_text'] : '<p>But I must explain to you how all this misn idea of denouncing pleasure and prais pain</p><a href="#">Continue Reading</a>';
    $quick_links    = ! empty( $opts['footer_quick_links'] ) ? $opts['footer_quick_links'] : array();
    // Use header contact data
    $footer_contact_address = ! empty( $opts['header_contact_address'] ) ? $opts['header_contact_address'] : '1058 Meadowb, Mall Road';
    $footer_contact_email   = ! empty( $opts['header_contact_email'] ) ? $opts['header_contact_email'] : 'support@gmail.com';
    $footer_contact_phone   = ! empty( $opts['header_contact_phone'] ) ? $opts['header_contact_phone'] : '+000 (123) 44 558';
    // Use header social links for footer
    $footer_socials = ! empty( $opts['header_social_links'] ) ? $opts['header_social_links'] : array();
    $footer_copyright = ! empty( $opts['footer_copyright'] ) ? $opts['footer_copyright'] : 'Copyright © ' . date('Y') . ' kingfact. All rights reserved.';
}
?>

<!-- footer-area-start -->
        <footer class="pos-rel">
            <span class="line line-1"></span>
            <span class="line line-2"></span>
            <span class="line line-3"></span>
            <div class="footer-widget-area black-bg pt-80">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="footer-wrapper mb-30">
                                <div class="footer-2-logo">
                                    <a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo esc_url( $footer_logo ? ( is_array( $footer_logo ) && ! empty( $footer_logo['url'] ) ? $footer_logo['url'] : $footer_logo ) : get_template_directory_uri() . '/assets/img/logo/logo-2.png' ); ?>" alt=""></a>
                                </div>
                                <div class="footer-text footer-2-text">
                                    <?php echo wp_kses_post( $footer_text ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6">
                            <div class="footer-wrapper pl-25 mb-30">
                                <h3 class="footer-title">Quick Links</h3>
                                <div class="footer-link">
                                    <?php
                                    if ( has_nav_menu( 'footer' ) ) {
                                        wp_nav_menu( array(
                                            'theme_location' => 'footer',
                                            'container'      => false,
                                            'menu_class'     => '',
                                            'items_wrap'     => '<ul>%3$s</ul>',
                                            'depth'          => 1,
                                        ) );
                                    } else {
                                        // Fallback menu if no menu is assigned
                                        echo '<ul>';
                                        echo '<li><a href="#">About Company</a></li>';
                                        echo '<li><a href="#">Latest Projects</a></li>';
                                        echo '<li><a href="#">Latest From Blog</a></li>';
                                        echo '<li><a href="#">Our Mission</a></li>';
                                        echo '<li><a href="#">Our Testimonials</a></li>';
                                        echo '<li><a href="#">Contact Us</a></li>';
                                        echo '</ul>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="footer-wrapper pl-30 mb-30">
                                <h3 class="footer-title">Latest News</h3>
                                <ul class="footer-news">
                                    <?php
                                    // Get latest 2 blog posts
                                    $footer_posts = new WP_Query(array(
                                        'post_type' => 'post',
                                        'posts_per_page' => 2,
                                        'post_status' => 'publish',
                                        'orderby' => 'date',
                                        'order' => 'DESC'
                                    ));

                                    if ( $footer_posts->have_posts() ) :
                                        while ( $footer_posts->have_posts() ) : $footer_posts->the_post();
                                    ?>
                                        <li>
                                            <div class="footer-news-img f-left">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php if ( has_post_thumbnail() ) : ?>
                                                        <?php the_post_thumbnail( 'thumbnail', array( 'alt' => get_the_title() ) ); ?>
                                                    <?php else : ?>
                                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/blog/blog-01.jpg' ); ?>" alt="<?php the_title_attribute(); ?>">
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                            <div class="footer-news-text">
                                                <h5><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 8, '...' ); ?></a></h5>
                                                <span><i class="fal fa-calendar-alt"></i> <?php echo get_the_date( 'd M Y' ); ?></span>
                                            </div>
                                        </li>
                                    <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    else :
                                        // Fallback if no posts exist
                                    ?>
                                        <li>
                                            <div class="footer-news-img f-left">
                                                <a href="#"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/footer/01.jpg' ); ?>" alt=""></a>
                                            </div>
                                            <div class="footer-news-text">
                                                <h5><a href="#">No posts available yet</a></h5>
                                                <span><i class="fal fa-calendar-alt"></i> <?php echo date( 'd M Y' ); ?></span>
                                            </div>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="footer-wrapper mb-30 pl-40">
                                <h3 class="footer-title">Contact Us</h3>
                                <ul class="footer-info">
                                    <li><span><i class="far fa-map-marker-alt"></i> <?php echo esc_html( $footer_contact_address ); ?></span></li>
                                    <li><span><i class="far fa-envelope-open"></i> <?php echo esc_html( $footer_contact_email ); ?></span></li>
                                    <li><span><i class="far fa-phone"></i> <?php echo esc_html( $footer_contact_phone ); ?></span></li>
                                    <li><span><i class="far fa-paper-plane"></i> <?php echo esc_html( home_url() ); ?></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="footer-bottom-area footer-2-bottom mt-40 pt-25 pb-25">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="copyright  copyright-1 text-center col-md-left">
                                    <p><?php echo esc_html( $footer_copyright ); ?></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="footer-bottom-wrapper">
                                        <div class="footer-2-icon f-right">
                                            <?php $fs = $footer_socials; if ( $fs ) : foreach ( $fs as $f ) : ?>
                                                <a href="<?php echo esc_url( $f['url'] ); ?>"><i class="<?php echo esc_attr( $f['icon'] ); ?>"></i></a>
                                            <?php endforeach; else : ?>
                                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                <a href="#"><i class="fab fa-twitter"></i></a>
                                                <a href="#"><i class="fab fa-instagram"></i></a>
                                                <a href="#"><i class="fab fa-google"></i></a>
                                            <?php endif; ?>
                                        </div>
                                        <ul class="footer-bottom-link f-right">
                                            <li><a href="/settings-privacy">Setting & Privacy </a></li>
                                            <li><a href="/terms-of-use">Terms of Use</a></li>
                                            <li><a href="/sitemap">Site Map</a></li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer-area-end -->

    <!-- allow WP to print enqueued JS and footer hooks -->
    <?php wp_footer(); ?>
</body>
</html>
