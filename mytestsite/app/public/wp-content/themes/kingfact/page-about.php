<?php
/*
Template Name: About — Profile / Vision / Mission / Why Us
Description: Custom About page template with Profile, Vision, Mission and Why Us sections.
*/
get_header();

// Get banner image from ACF or fallback
$about_banner_image = get_field('about_banner_image');
if (!$about_banner_image) {
    // Fallback to featured image
    $about_banner_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
    if (!$about_banner_image) {
        // Final fallback to default
        $about_banner_image = get_template_directory_uri() . '/assets/img/bg/bg-9.jpg';
    }
}

// Get banner title and breadcrumb texts from ACF
$banner_title = get_field('about_banner_title');
$breadcrumb_home = get_field('about_breadcrumb_home');
$breadcrumb_current = get_field('about_breadcrumb_current');

// Set defaults if empty
if (!$banner_title) $banner_title = 'About Us';
if (!$breadcrumb_home) $breadcrumb_home = 'home';
if (!$breadcrumb_current) $breadcrumb_current = 'About Us';
?>

<main>
    <div class="breadcrumb-area pt-245 pb-255" style="background-image:url(<?php echo esc_url( $about_banner_image ); ?>)">
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

    <!-- history-area-start -->
    <div class="history-area pt-130 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5">
                    <div class="single-history mb-30">
                        <div class="history-text">
                            <?php
                            $history_subtitle = get_field('history_subtitle');
                            $history_title = get_field('history_title');
                            
                            if (!$history_subtitle) $history_subtitle = 'who we are';
                            if (!$history_title) $history_title = 'Quality & Integrity Service Agency';
                            ?>
                            <span><?php echo esc_html($history_subtitle); ?></span>
                            <h1><?php echo esc_html($history_title); ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7">
                    <div class="history-wrapper mb-30">
                        <div class="history-content">
                            <?php
                            $history_heading = get_field('history_heading');
                            $history_content = get_field('history_content');
                            
                            if (!$history_heading) $history_heading = 'Company History';
                            if (!$history_content) $history_content = 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odite.';
                            ?>
                            <h4><?php echo esc_html($history_heading); ?></h4>
                            <p><?php echo wp_kses_post($history_content); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- history-area-end -->

    <!-- work-area-start -->
    <div class="work-area-start pt-120 pb-90">
        <div class="container">
            <div class="row text-center">
                <?php
                // Vision
                $vision_image = get_field('vision_image');
                $vision_title = get_field('vision_title');
                $vision_content = get_field('vision_content');
                $vision_link = get_field('vision_link');
                
                if (!$vision_image) $vision_image = get_template_directory_uri() . '/assets/img/work/p-01.jpg';
                if (!$vision_title) $vision_title = 'Vision';
                if (!$vision_content) $vision_content = 'But I must explain to you how all this mistaken denouncing pleasure';
                if (!$vision_link) $vision_link = '#';
                ?>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="b-work position-relative mb-30">
                        <div class="b-work-img">
                            <img src="<?php echo esc_url($vision_image); ?>" alt="<?php echo esc_attr($vision_title); ?>">
                        </div>
                        <div class="b-work-content-2">
                            <div class="inner-work-2">
                                <h2><a href="<?php echo esc_url($vision_link); ?>"><?php echo esc_html($vision_title); ?></a></h2>
                                <div><?php echo wp_kses_post($vision_content); ?></div>
                                <div class="b-work-link">
                                    <a href="<?php echo esc_url($vision_link); ?>"><i class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php
                // Mission
                $mission_image = get_field('mission_image');
                $mission_title = get_field('mission_title');
                $mission_content = get_field('mission_content');
                $mission_link = get_field('mission_link');
                
                if (!$mission_image) $mission_image = get_template_directory_uri() . '/assets/img/work/p-02.jpg';
                if (!$mission_title) $mission_title = 'Mission';
                if (!$mission_content) $mission_content = 'But I must explain to you how all this mistaken denouncing pleasure';
                if (!$mission_link) $mission_link = '#';
                ?>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="b-work position-relative mb-30">
                        <div class="b-work-img">
                            <img src="<?php echo esc_url($mission_image); ?>" alt="<?php echo esc_attr($mission_title); ?>">
                        </div>
                        <div class="b-work-content-2">
                            <div class="inner-work-2">
                                <h2><a href="<?php echo esc_url($mission_link); ?>"><?php echo esc_html($mission_title); ?></a></h2>
                                <div><?php echo wp_kses_post($mission_content); ?></div>
                                <div class="b-work-link">
                                    <a href="<?php echo esc_url($mission_link); ?>"><i class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php
                // Goals
                $goals_image = get_field('goals_image');
                $goals_title = get_field('goals_title');
                $goals_content = get_field('goals_content');
                $goals_link = get_field('goals_link');
                
                if (!$goals_image) $goals_image = get_template_directory_uri() . '/assets/img/work/p-03.jpg';
                if (!$goals_title) $goals_title = 'Why Us or Our Goals';
                if (!$goals_content) $goals_content = 'But I must explain to you how all this mistaken denouncing pleasure';
                if (!$goals_link) $goals_link = '#';
                ?>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="b-work position-relative mb-30">
                        <div class="b-work-img">
                            <img src="<?php echo esc_url($goals_image); ?>" alt="<?php echo esc_attr($goals_title); ?>">
                        </div>
                        <div class="b-work-content-2">
                            <div class="inner-work-2">
                                <h2><a href="<?php echo esc_url($goals_link); ?>"><?php echo esc_html($goals_title); ?></a></h2>
                                <div><?php echo wp_kses_post($goals_content); ?></div>
                                <div class="b-work-link">
                                    <a href="<?php echo esc_url($goals_link); ?>"><i class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- work-area-end -->

    <!-- counter-area-start -->
    <?php
    // Get the Home page ID to read counter values from it
    $home_page = get_page_by_path('home');
    $home_id = $home_page ? $home_page->ID : get_option('page_on_front');
    
    // Counter 1
    $counter1_icon = get_field('counter1_icon', $home_id);
    $counter1_number = get_field('counter1_number', $home_id);
    $counter1_label = get_field('counter1_label', $home_id);
    
    // Counter 2
    $counter2_icon = get_field('counter2_icon', $home_id);
    $counter2_number = get_field('counter2_number', $home_id);
    $counter2_label = get_field('counter2_label', $home_id);
    
    // Counter 3
    $counter3_icon = get_field('counter3_icon', $home_id);
    $counter3_number = get_field('counter3_number', $home_id);
    $counter3_label = get_field('counter3_label', $home_id);
    
    // Counter 4
    $counter4_icon = get_field('counter4_icon', $home_id);
    $counter4_number = get_field('counter4_number', $home_id);
    $counter4_label = get_field('counter4_label', $home_id);
    ?>
    <div class="counter-area pb-95">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="counter-wrapper mb-30">
                        <div class="counter-icon">
                            <i class="<?php echo $counter1_icon ? esc_attr($counter1_icon) : 'fal fa-anchor'; ?>"></i>
                        </div>
                        <div class="counter-text">
                            <h1 class="counter"><?php echo $counter1_number ? esc_html($counter1_number) : '3560'; ?></h1>
                            <span><?php echo $counter1_label ? esc_html($counter1_label) : 'Projects Completed'; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="counter-wrapper mb-30">
                        <div class="counter-icon">
                            <i class="<?php echo $counter2_icon ? esc_attr($counter2_icon) : 'fal fa-trophy-alt'; ?>"></i>
                        </div>
                        <div class="counter-text">
                            <h1 class="counter"><?php echo $counter2_number ? esc_html($counter2_number) : '1564'; ?></h1>
                            <span><?php echo $counter2_label ? esc_html($counter2_label) : 'Awards Win'; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="counter-wrapper mb-30">
                        <div class="counter-icon">
                            <i class="<?php echo $counter3_icon ? esc_attr($counter3_icon) : 'fal fa-users'; ?>"></i>
                        </div>
                        <div class="counter-text">
                            <h1 class="counter"><?php echo $counter3_number ? esc_html($counter3_number) : '2630'; ?></h1>
                            <span><?php echo $counter3_label ? esc_html($counter3_label) : 'Qualified Staff'; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="counter-wrapper mb-30">
                        <div class="counter-icon">
                            <i class="<?php echo $counter4_icon ? esc_attr($counter4_icon) : 'fal fa-smile'; ?>"></i>
                        </div>
                        <div class="counter-text">
                            <h1 class="counter"><?php echo $counter4_number ? esc_html($counter4_number) : '100'; ?></h1>
                            <span><?php echo $counter4_label ? esc_html($counter4_label) : 'Happy Clients'; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- counter-area-end -->

    <!-- features section -->
    <?php
    // Get featured section fields from ACF
    $features_bg = get_field('about_features_bg');
    $features_subtitle = get_field('about_features_subtitle');
    $features_title = get_field('about_features_title');
    $features_paragraph = get_field('about_features_paragraph');
    $features_item1_image = get_field('about_features_item1_image');
    $features_item1_title = get_field('about_features_item1_title');
    $features_item1_text = get_field('about_features_item1_text');
    $features_item2_image = get_field('about_features_item2_image');
    $features_item2_title = get_field('about_features_item2_title');
    $features_item2_text = get_field('about_features_item2_text');
    
    // Set defaults
    if (!$features_bg) $features_bg = get_template_directory_uri() . '/assets/img/features/fea-bg.jpg';
    if (!$features_subtitle) $features_subtitle = 'who we are';
    if (!$features_title) $features_title = 'Explore Features';
    if (!$features_paragraph) $features_paragraph = 'But I must explain to you how all this mistaken is denouncing pleasure and praising pain was borners will give you a complete account of the system and expound the actual teachings';
    if (!$features_item1_image) $features_item1_image = get_template_directory_uri() . '/assets/img/features/who-01.jpg';
    if (!$features_item1_title) $features_item1_title = 'Technology Buildup';
    if (!$features_item1_text) $features_item1_text = 'Avoids pleasure itself, because it is pleasure because those who do not know how';
    if (!$features_item2_image) $features_item2_image = get_template_directory_uri() . '/assets/img/features/who-02.jpg';
    if (!$features_item2_title) $features_item2_title = 'Awards & Accolades';
    if (!$features_item2_text) $features_item2_text = 'Avoids pleasure itself, because it is pleasure because those who do not know how';
    ?>
    <div class="features-area pt-120 pb-90" style="background-image:url(<?php echo esc_url($features_bg); ?>)">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="section-title mb-30">
                        <span><?php echo esc_html($features_subtitle); ?></span>
                        <h1><?php echo esc_html($features_title); ?></h1>
                        <div class="mb-20"></div>
                        <p><?php echo wp_kses_post($features_paragraph); ?></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="b-features text-center mb-30">
                        <div class="b-fea-img">
                            <img src="<?php echo esc_url($features_item1_image); ?>" alt="<?php echo esc_attr($features_item1_title); ?>">
                        </div>
                        <div class="b-fea-content">
                            <h3><?php echo esc_html($features_item1_title); ?></h3>
                            <div><?php echo wp_kses_post($features_item1_text); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="b-features text-center mb-30">
                        <div class="b-fea-img">
                            <img src="<?php echo esc_url($features_item2_image); ?>" alt="<?php echo esc_attr($features_item2_title); ?>">
                        </div>
                        <div class="b-fea-content">
                            <h3><?php echo esc_html($features_item2_title); ?></h3>
                            <div><?php echo wp_kses_post($features_item2_text); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- features section end -->

      <!-- testimonial-area -->
            <div class="client-area black-bg pt-125 pb-130">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 offset-lg-3 offset-xl-3">
                            <div class="section-title white-title text-center mb-75">
                                <span>what our clients say</span>
                                <h1>Clients Testimonials</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row client-active arrow-style">
                        <?php
                        // Query testimonials
                        $testimonials_query = new WP_Query(array(
                            'post_type' => 'testimonial',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                            'orderby' => 'menu_order',
                            'order' => 'ASC'
                        ));
                        
                        if ($testimonials_query->have_posts()) :
                            while ($testimonials_query->have_posts()) : $testimonials_query->the_post();
                                $client_name = get_post_meta(get_the_ID(), '_testimonial_client_name', true);
                                $client_position = get_post_meta(get_the_ID(), '_testimonial_client_position', true);
                                
                                // Fallback to post title if name not set
                                if (empty($client_name)) {
                                    $client_name = get_the_title();
                                }
                        ?>
                        <div class="col-xl-12">
                            <div class="client-wrapper text-center">
                                <?php 
                                $testimonial_photo_id = get_post_meta(get_the_ID(), '_testimonial_photo', true);
                                $testimonial_photo_url = $testimonial_photo_id ? wp_get_attachment_image_url($testimonial_photo_id, 'thumbnail') : '';
                                if ($testimonial_photo_url) : 
                                ?>
                                <div class="client-img pos-rel">
                                    <img src="<?php echo esc_url($testimonial_photo_url); ?>" alt="<?php echo esc_attr($client_name); ?>" />
                                </div>
                                <?php endif; ?>
                                <div class="client-content">
                                    <?php if (get_the_content()) : ?>
                                    <p><?php echo wp_kses_post(get_the_content()); ?></p>
                                    <?php endif; ?>
                                    <div class="client-text">
                                        <h4><?php echo esc_html($client_name); ?></h4>
                                        <?php if ($client_position) : ?>
                                        <span><?php echo esc_html($client_position); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            endwhile;
                            wp_reset_postdata();
                        else : 
                        ?>
                        <div class="col-xl-12">
                            <p class="text-center" style="color: #fff;">No testimonials found. Please add testimonials from WordPress Admin → Testimonials.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- testimonial-area end -->
     

</main>

<?php get_footer(); ?>
