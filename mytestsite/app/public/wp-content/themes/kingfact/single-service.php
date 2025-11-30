<?php
/*
Template for single service posts
*/

get_header();

// Display breadcrumb for service detail page
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        $service_title = get_the_title();
    }
    rewind_posts();
}

echo do_shortcode('[kingfact_breadcrumb title="' . esc_attr( $service_title ) . '" current="' . esc_attr( $service_title ) . '"]');
?>

<style>
.service-details-area .service-details-img img {
    border-radius: 8px;
}
.service-sidebar .widget {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 30px;
}
.service-sidebar .widget h4 {
    margin-bottom: 20px;
    color: #333;
}
.service-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.service-list li {
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}
.service-list li:last-child {
    border-bottom: none;
}
.service-list a {
    color: #666;
    text-decoration: none;
    transition: color 0.3s;
}
.service-list a:hover {
    color: #000;
}
.contact-info {
    text-align: center;
}
.contact-btn {
    margin-top: 20px;
}
</style>

<div class="service-details-area pt-130 pb-130">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
        <?php
            $service_id = get_the_ID();
            $service_icon = get_post_meta( $service_id, '_service_icon', true );
        ?>
        
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="service-details-content">
                    <?php
                    $service_banner_id = get_post_meta( $service_id, '_service_banner', true );
                    $service_banner_url = $service_banner_id ? wp_get_attachment_image_url( $service_banner_id, 'large' ) : '';
                    if ( $service_banner_url ) : ?>
                    <div class="service-details-img mb-40">
                        <img src="<?php echo esc_url( $service_banner_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" style="width: 100%; height: auto;">
                    </div>
                    <?php endif; ?>
                    
                    <div class="service-details-text">
                        <h2>
                            <?php if ( ! empty( $service_icon ) ) : ?>
                            <i class="<?php echo esc_attr( $service_icon ); ?>"></i> 
                            <?php endif; ?>
                            <?php the_title(); ?>
                        </h2>
                        
                        <div class="service-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-4">
                <div class="service-sidebar">
                    <div class="widget">
                        <h4>Other Services</h4>
                        <div class="other-services">
                            <?php
                            // Get other services
                            $other_services = new WP_Query(array(
                                'post_type' => 'service',
                                'posts_per_page' => 5,
                                'post__not_in' => array( $service_id ),
                                'orderby' => 'menu_order',
                                'order' => 'ASC'
                            ));
                            
                            if ( $other_services->have_posts() ) :
                                echo '<ul class="service-list">';
                                while ( $other_services->have_posts() ) : $other_services->the_post();
                                    $other_icon = get_post_meta( get_the_ID(), '_service_icon', true );
                                    echo '<li>';
                                    echo '<a href="' . esc_url( get_permalink() ) . '">';
                                    if ( ! empty( $other_icon ) ) {
                                        echo '<i class="' . esc_attr( $other_icon ) . '"></i> ';
                                    }
                                    echo esc_html( get_the_title() );
                                    echo '</a>';
                                    echo '</li>';
                                endwhile;
                                echo '</ul>';
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                    
                    <div class="widget">
                        <h4>Need Help?</h4>
                        <div class="contact-info">
                            <p>Contact us for more information about this service.</p>
                            <div class="contact-btn">
                                <a href="<?php echo esc_url( home_url('/contact/') ); ?>" class="b-btn btn-black">
                                    <span>Contact Us</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>
